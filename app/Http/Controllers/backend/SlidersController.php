<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Image;
use File;

class SlidersController extends Controller
{
    public function __construct()
        {
            $this->middleware('auth:admin');
        }
        public function index(){
            $sliders = Slider::orderBy('prioriy','asc')->get();
            return view('backend.pages.sliders.index',compact('sliders') );
        }

        public function store(Request $request ){
            $this->validate($request, 
                [
                    'title' => 'required',
                    'image' => 'required',
                    'prioriy' => 'required',
                    'button_linke' => 'nullable|url',
                ],
                [
                    'title.required' => 'Please provide slider title',
                    'image.required' => 'Please provide select image',
                    'prioriy.required' => 'Please provide priority number',
                    'button_linke.url' => 'Please provide valid slider url'
                ]

            );
            
            $slider               = new Slider;
            $slider->title         = $request->title;
            $slider->prioriy     = $request->prioriy;
            $slider->button_text     = $request->button_text;
            $slider->button_linke     = $request->button_link;

            //insert image 
            if($request->hasFile('image')){
                $image = $request->file('image');
                $img   = time().'.'.$image->getClientOriginalExtension();
                $location = public_path('images/sliders/'.$img);
                Image::make($image)->save($location);
                $slider->image    = $img;
            }

            $slider->save();

            session()->flash('success','A new slide has added successfully!');
            return redirect()->route('admin.sliders');

        }

        public function update(Request $request, $id ){
            $this->validate($request, 
                [
                    'title' => 'required',
                    'image' => 'nullable|image',
                    'prioriy' => 'required',
                    'button_linke' => 'nullable|url',
                ],
                [
                    'title.required' => 'Please provide slider title',
                    'image.image' => 'Please provide select image',
                    'prioriy.required' => 'Please provide priority number',
                    'button_linke.url' => 'Please provide valid slider url'
                ]
            );
            $slider                  = Slider::find($id);
            $slider->title           = $request->title;
            $slider->prioriy         = $request->prioriy;
            $slider->button_text     = $request->button_text;
            $slider->button_linke    = $request->button_link;

            //insert image 
            if($request->hasFile('image')){

                //delete image

                if(File::exists('images/sliders/'.$slider->image)){
                    File::delete('images/sliders/'.$slider->image);
                }

                $image = $request->file('image');
                $img   = time().'.'.$image->getClientOriginalExtension();
                $location = public_path('images/sliders/'.$img);
                Image::make($image)->save($location);
                $slider->image    = $img;
            }

            $slider->save();

            session()->flash('success','Slider updated!');
            return redirect()->route('admin.sliders');

        }

        public function delete($id){
           $slider  = Slider::find($id);

           if(!is_null($slider)){
            
            if(File::exists('images/sliders/'.$slider->image)){
                File::delete('images/sliders/'.$slider->image);
            }
            $slider->delete();
           }
           session()->flash('success', 'slider has deleted successfully!!');
           return back();
        }
}
