<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    public $route="brand";
    public $view ="brand";
    public $moduleName = 'Brand';

    public function index()
    {        
        $moduleName = $this->moduleName;                
        $brand = Brand::orderBy('id','DESC')->get();  
        return view('admin/'.$this->view.'/index', compact('moduleName', 'brand'));
    }

    public function create()
    {
        $moduleName = $this->moduleName;           
        return view('admin/'.$this->view.'/form', compact('moduleName'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',     
            'image' => 'required',     
            'status' => 'required',
        ]);  
        $data = $request->all();
        $data['name'] = ucfirst($request->name);
        $data['brand_id'] = rand(10000,99999);
        if ($request->hasFile('image')) {   
            $image = $request->file('image');
            $name = uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/upload');
            $image->move($destinationPath, $name);         
            $data['image'] = $name;
        }  
        
        $brand = Brand::create($data);
       
              
        return redirect($this->route)->withStatus(__('Brand is added successfully.'));
    }
    
    public function edit($id)
    {
        $moduleName = $this->moduleName;  
        $brand = Brand::find(decrypt($id));     
      
        return view('admin/'.$this->view.'/_form', compact('moduleName', 'brand'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',                                          
            'status' => 'required',            
        ]);  
        $data = $request->all();  
        $data['name'] = ucfirst($request->name);   
        if ($request->hasFile('image')) {   
            $image = $request->file('image');
            $name = uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/upload');
            $image->move($destinationPath, $name);         
            $data['image'] = $name;
        }   
        Brand::find($id)->update($data);        
        return redirect($this->route)->withStatus(__('Brand is updated successfully.'));
    }

}