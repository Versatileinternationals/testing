<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlzBusinessTemplates;
use Excel;

class SdbcBusinessTmplController extends Controller
{
    public $route="sdbc_businesstmpl";
    public $view ="BusinessTmpl";
    public $moduleName = 'Business Templates';

    public function index()
    {        
        $moduleName = $this->moduleName;                
        //$trainings = Product::with(['category','subcategory','brandData'])->orderBy('id','DESC')->get();  
        $BlzBusinessTemplates = BlzBusinessTemplates::where('status',1)->orderBy('id','DESC')->get();
        return view('admin/SdbcAdm/'.$this->view.'/index', compact('moduleName', 'BlzBusinessTemplates'));  
    }

    public function create()
    {
        $moduleName = $this->moduleName;  
       // $category = Category::where('status',1)->get();
       // $brand = Brand::where('status',1)->get();
        //$products = Product::where('status',1)->orderBy('id','DESC')->get();
        return view('admin/SdbcAdm/'.$this->view.'/form',compact('moduleName'));
    }

    public function store(Request $request)
    {
       //echo 'fffffff'; die;
        $request->validate([
            'TemplateName' => 'required',    
        ]); 
        
        if ($request->hasFile('Document')) {   
            $image = $request->file('Document');
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/upload');
            $image->move($destinationPath, $imageName);         
            $Document = $imageName;
        }else{
            $Document = '';
        } 


        $events = BlzBusinessTemplates::create([
            'TemplateName' => $request->TemplateName,
            'Document' => $Document,
            'Status' => $request->Status,
        ]);
        //echo 'kkkkk'; die;
        return redirect($this->route)->withStatus(__('Template is added successfully.'));
    }

    public function edit($id){
        $moduleName = $this->moduleName;  
        $BlzBusinessTemplates = BlzBusinessTemplates::find($id); 
        return view('admin/SdbcAdm/'.$this->view.'/_form', compact('moduleName', 'BlzBusinessTemplates'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'TemplateName' => 'required',    
        ]); 
      
        $BlzBusinessTemplates = BlzBusinessTemplates::find($id);
       if ($request->hasFile('Document')) {   
            $image = $request->file('Document');
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/upload');
            $image->move($destinationPath, $imageName);         
            $Document = $imageName;
        } else{
            $Document = $BlzBusinessTemplates->Document;
        }
     
        $training = BlzBusinessTemplates::find($id)->update([
           'TemplateName' => $request->TemplateName,
            'Document' => $Document,
            'Status' => $request->Status,
        ]);
        
        return redirect($this->route)->withStatus(__('Event is updated successfully.'));
    }
    public function delete($id){
        $moduleName = $this->moduleName;  
        $BlzBusinessTemplates = BlzBusinessTemplates::find($id)->delete();
        return redirect($this->route)->withStatus(__('Event is updated successfully.'));
    }}
