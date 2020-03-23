<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\Models\Product;
use App\Models\ProductImage;
use Image;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
        $products = Product::orderBy('id','desc')->get();
        return view('backend.pages.product.index')->with('products',$products); 
    }

    public function create(){
    	return view('backend.pages.product.create'); 
    }

    public function edit($id){
    	$product = Product::find($id);
    	return view('backend.pages.product.edit')->with('product',$product);
    }

    // public function delete($id){
    // 	// $products = Product::orderBy('id','desc')->get();
    // 	return view('backend.pages.product.delete')->with('products',$products);
    // }

    public function store(Request $request ){
   		//validation

   		$validatedData = $request->validate([
   		        'title' 		 => 'required|max:150',
   		        'description'	 => 'required',
   		        'price' 		 => 'required|numeric',
   		        'quantity' 		 => 'required|numeric',
                'category_id'    => 'required|numeric',
                'brand_id'       => 'required|numeric',
   		    ]);
 	

    	$product = new Product;

    	$product->title = $request->title;
    	$product->description = $request->description;
    	$product->quantity = $request->quantity;
    	$product->price = $request->price;
    	$product->slug = Str::slug($request->title);

    	$product->category_id = $request->category_id;
    	$product->brand_id = $request->brand_id;
    	$product->admin_id = 1;

    	$product->save();

    	// product image insert

    	// if($request->hasFile('product_image')){
    	// 	$image = $request->file('product_image');
    	// 	$img   = time().'.'.$image->getClientOriginalExtension();
    	// 	$location = public_path('images/products/'.$img);
    	// 	// echo $location;die();
    	// 	Image::make($image)->save($location);

    	// 	$product_image = new ProductImage;
    	// 	$product_image->product_id = $product->id;
    	// 	$product_image->image = $img;
    	// 	$product_image->save();	
    	// }

    	if(count($request->product_image) > 0 ){
            $i = 0;
    		foreach ($request->product_image as $image ) {
    			// $image = $request->file('product_image');
    			$img   = time(). $i.'.'.$image->getClientOriginalExtension();
    			$location = public_path('images/products/'.$img);
    				// echo $location;die();
    			Image::make($image)->save($location);

    			$product_image = new ProductImage;
    			$product_image->product_id = $product->id;
    			$product_image->image = $img;
    			$product_image->save();	
                $i++;
    		}
    	}

    	return redirect()->route('admin.products');
    }

     public function update(Request $request, $id ){
    		//validation

    		$validatedData = $request->validate([
    		        'title' 		 => 'required|max:150',
    		        'description'	 => 'required',
    		        'price' 		 => 'required|numeric',
    		        'quantity' 		 => 'required|numeric',
                    'category_id'    => 'required|numeric',
                    'brand_id'       => 'required|numeric',
    		    ]);
    

     	$product = Product::find($id);

     	$product->title = $request->title;
     	$product->description = $request->description;
     	$product->quantity = $request->quantity;
     	$product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->save();
        if(count($request->product_image) > 0 ){
            $i = 0;
            foreach ($request->product_image as $image ) {
                // $image = $request->file('product_image');
                $img   = time(). $i.'.'.$image->getClientOriginalExtension();
                $location = public_path('images/products/'.$img);
                    // echo $location;die();
                Image::make($image)->save($location);

                $product_image = new ProductImage;
                $product_image->product_id = $product->id;
                $product_image->image = $img;
                $product_image->save(); 
                $i++;
            }
        }

     	
     	return redirect()->route('admin.products');
     }

     public function delete($id){
        $product  = Product::find($id);

        if(!is_null($product)){
            $product->delete();
        }

        // delete all images
        foreach ($product->images as $image) {
           $file_name =  $image->image;
           if(file_exists(public_path('images/products/'.$file_name))){
            unlink(public_path('images/products/'.$file_name));
           }

            $image->delete();
        }

        session()->flash('success', 'Product has deleted successfully!!');
        return back();
     }
}
