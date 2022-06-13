<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlzBusinessResources;
use Excel;

class BusinessRcsController extends Controller
{
    public $route="business_resources";
    public $view ="BusinessResources";
    public $moduleName = 'Business Resources';

    public function index()
    {        
        $moduleName = $this->moduleName;                
        //$trainings = Product::with(['category','subcategory','brandData'])->orderBy('id','DESC')->get();  
        $BlzBusinessResources = BlzBusinessResources::orderBy('id','DESC')->get();
        return view('admin/'.$this->view.'/index', compact('moduleName', 'BlzBusinessResources'));  
    }

    public function create()
    {
		
        $moduleName = $this->moduleName;  
       
        return view('admin/'.$this->view.'/form',compact('moduleName'));
    }

     public function store(Request $request)
    {
      
        $request->validate([
            'resource_name' => 'required',    
               
        ]); 
        
        if ($request->hasFile('document_upload')) {   
            $image = $request->file('document_upload');
            $ResourcesImage = uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/upload');
            $image->move($destinationPath, $ResourcesImage);         
            $ResourcesImage = $ResourcesImage;
        }else{
            $ResourcesImage = '';
        } 

        if ($request->hasFile('resource_video')) {   
            $image = $request->file('resource_video');
            $Resourcesvideo = uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/video');
            $image->move($destinationPath, $Resourcesvideo);         
            $Resourcesvideo = $Resourcesvideo;
        }else{
            $Resourcesvideo = '';
        } 

        $Resources = BlzBusinessResources::create([
            'resource_name' => $request->resource_name,
            'resource_links' => $request->resource_links,
            'document_upload' => $ResourcesImage,
            'resource_video' => $Resourcesvideo,
            'Status' => $request->Status,
            
        ]);
        //echo 'kkkkk'; die;
        return redirect($this->route)->withStatus(__('Event is added successfully.'));
    }

    public function edit($id){
        $moduleName = $this->moduleName;  
        $BlzRes = BlzBusinessResources::find($id); 
        return view('admin/'.$this->view.'/_form', compact('moduleName', 'BlzRes'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'resource_name' => 'required',    
             
               
        ]); 
      
        $BlzRes = BlzBusinessResources::find($id);
      
		if ($request->hasFile('document_upload')) {   
            $image = $request->file('document_upload');
            $ResourcesImage = uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/upload');
            $image->move($destinationPath, $imageName);         
            $ResourcesImage = $imageName;
        }else{
            $ResourcesImage = '';
        } 
		
		//
     
        $bresources = BlzBusinessResources::find($id)->update([
           'resource_name' => $request->resource_name,
            'resource_links' => $request->resource_links,
            'document_upload' => $ResourcesImage,
             'Status' => $request->Status,
        ]);
        
        return redirect($this->route)->withStatus(__('Business Resources is updated successfully.'));
    }
    public function delete($id){
        $moduleName = $this->moduleName;  
        $BlzEvent = BlzBusinessResources::find($id)->delete();
        return redirect($this->route)->withStatus(__('Business Resources Delete successfully.'));
    }
}
