<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Division;
use Image;
use File;

class DistrictsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
    	$districts = District::orderBy('id','desc')->get();
    	return view('backend.pages.districts.index',compact('districts') );
    }

    public function create(){
        $divisions = Division::orderBy('priority','asc')->get();
        return view('backend.pages.districts.create', compact('districts', 'divisions'));
    }

    public function edit($id){

        $district = District::find($id);
        $divisions = Division::orderBy('priority','asc')->get();
        if(!is_null($district)){
            return view('backend.pages.districts.edit', compact('district','divisions'));
        }else{
            return redirect()->route('admin.districts');
        }
    }

    public function store(Request $request ){
    	$this->validate($request, 
    		[
    			'name' => 'required',
    			'division_id' => 'required'
    		],
    		[
    			'name.required' => 'Please provide division name',
    			'division_id.required' => 'Please provide division ID'
    		]

    	);
    	
    	$district 				= new District;
        $district->name         = $request->name;
        $district->division_id     = $request->division_id;
        $district->save();

        session()->flash('success','A new districts has added successfully!');
        return redirect()->route('admin.districts');

    }

    public function update(Request $request, $id ){
        $this->validate($request, 
            [
                'name' => 'required',
                'division_id' => 'required'
            ],
            [
                'name.required' => 'Please provide division name',
                'division_id.required' => 'Please provide division ID'
            ]);
        $district       = District::find($id);
        $district->name         = $request->name;
        $district->division_id     = $request->division_id;

        $district->save();

        session()->flash('success','District updated!');
        return redirect()->route('admin.districts');

    }

    public function delete($id){
     $district  = District::find($id);

     if(!is_null($district)){
        $district->delete();
    }
    session()->flash('success', 'district has deleted successfully!!');
    return back();
}
}
