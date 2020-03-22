<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use Image;
use File;

class BrandsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
    	$brands = Brand::orderBy('id','desc')->get();
    	return view('backend.pages.brands.index',compact('brands') );
    }

    public function create(){

    	return view('backend.pages.brands.create', compact('main_brands'));
    }

    public function edit($id){

        $brand = Brand::find($id);
        if(!is_null($brand)){
            return view('backend.pages.brands.edit', compact('brand','main_brands'));
        }else{
            return redirect()->route('admin.brands');
        }
    }

    public function store(Request $request ){
    	$this->validate($request, 
    		[
    			'name' => 'required',
    			'image' => 'nullable|image'
    		],
    		[
    			'name.required' => 'Please enter brand name',
    			'image.image' => 'Please select valid image with jpg,gif,png'
    		]

    	);
    	
    	$brand 				= new Brand;
        $brand->name         = $request->name;
        $brand->description  = $request->description;

    	//insert image 
    	if($request->hasFile('image')){
    		$image = $request->file('image');
    		$img   = time().'.'.$image->getClientOriginalExtension();
    		$location = public_path('images/brands/'.$img);
    		Image::make($image)->save($location);
            $brand->image    = $img;
        }
    	$brand->save();

    	session()->flash('success','A new brand has added!');
    	return redirect()->route('admin.brands');

    }

    public function update(Request $request, $id ){
        $this->validate($request, 
            [
                'name' => 'required',
                'image' => 'nullable|image'
            ],
            [
                'name.required' => 'Please enter brand name',
                'image.image' => 'Please select valid image with jpg,gif,png'
            ]);
        $brand       = Brand::find($id);
        $brand->name         = $request->name;
        $brand->description  = $request->description;

        //insert image 
        if($request->hasFile('image')){
            $image = $request->file('image');
            $img   = time().'.'.$image->getClientOriginalExtension();
            $location = public_path('images/brands/'.$img);
            Image::make($image)->save($location);
            $brand->image    = $img;
        }

        $brand->save();

        session()->flash('success','A new brand has added!');
        return redirect()->route('admin.brands');

    }

    public function delete($id){
       $brand  = Brand::find($id);

       if(!is_null($brand)){
            // if brand is parent brand then delete all sub brand

            // delete all brand images
            if(File::exists('images/brands/'.$brand->image)){
                File::delete('images/brands/'.$brand->image);
            }
            $brand->delete();
       }
       session()->flash('success', 'brand has deleted successfully!!');
       return back();
    }
}
