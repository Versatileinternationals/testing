<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlzBusinessResources;
use Excel;

class ExportBlzBusinessRcsController extends Controller
{
    public $route="expblz_business_resources";
    public $view ="BusinessResources";
    public $moduleName = 'Business Resources';

    public function index()
    {        
        $moduleName = $this->moduleName;                
        //$trainings = Product::with(['category','subcategory','brandData'])->orderBy('id','DESC')->get();  
        $BlzBusinessResources = BlzBusinessResources::where('status',1)->orderBy('id','DESC')->get();
        return view('admin/ExportBlz/'.$this->view.'/index', compact('moduleName', 'BlzBusinessResources'));  
    }

    public function create()
    {
		
        $moduleName = $this->moduleName;  
       // $category = Category::where('status',1)->get();
       // $brand = Brand::where('status',1)->get();
        //$products = Product::where('status',1)->orderBy('id','DESC')->get();
        return view('admin/ExportBlz/'.$this->view.'/form',compact('moduleName'));
    }

     public function store(Request $request)
    {
       //echo 'fffffff'; die;
        $request->validate([
            'resource_name' => 'required',    
            'resource_links' => 'required',          
                  
        ]); 
        
        if ($request->hasFile('document_upload')) {   
            $image = $request->file('document_upload');
            $ResourcesImage = uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/upload');
            $image->move($destinationPath, $imageName);         
            $ResourcesImage = $imageName;
        }else{
            $ResourcesImage = '';
        } 


        $Resources = BlzBusinessResources::create([
            'resource_name' => $request->resource_name,
            'resource_links' => $request->resource_links,
            'document_upload' => $ResourcesImage,
           
            
        ]);
        //echo 'kkkkk'; die;
        return redirect($this->route)->withStatus(__('Event is added successfully.'));
    }

    public function edit($id){
        $moduleName = $this->moduleName;  
        $BlzRes = BlzBusinessResources::find($id); 
        return view('admin/ExportBlz/'.$this->view.'/_form', compact('moduleName', 'BlzRes'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'resource_name' => 'required',    
            'resource_links' => 'required',          
               
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
        ]);
        
        return redirect($this->route)->withStatus(__('Business Resources is updated successfully.'));
    }
    public function delete($id){
        $moduleName = $this->moduleName;  
        $BlzEvent = BlzBusinessResources::find($id)->delete();
        return redirect($this->route)->withStatus(__('Business Resources Delete successfully.'));
    }
}
