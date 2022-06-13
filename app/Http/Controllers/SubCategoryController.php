<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;

class SubCategoryController extends Controller
{
    public $route="subcategory";
    public $view ="subcategory";
    public $moduleName = 'Sub Category';

    public function index()
    {        
        $moduleName = $this->moduleName;                
        $subcategory = SubCategory::with(['category'])->orderBy('id','DESC')->get();  
        return view('admin/Admb2b/'.$this->view.'/index', compact('moduleName', 'subcategory'));
    }

    public function create()
    {
        $moduleName = $this->moduleName;       
        $category = Category::OrderBy('id','DESC')->get();    
        return view('admin/Admb2b/'.$this->view.'/form', compact('moduleName', 'category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required', 
            'category_id' => 'required',     
            'image' => 'required',     
            'status' => 'required',
        ]);  
        $data = $request->all();
        $data['name'] = ucfirst($request->name);
        $data['subcategory_id'] = rand(10000,99999);
        if ($request->hasFile('image')) {   
            $image = $request->file('image');
            $name = uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/upload');
            $image->move($destinationPath, $name);         
            $data['image'] = $name;
        }  
        
        $category = SubCategory::create($data);
       
              
        return redirect($this->route)->withStatus(__('SubCategory is added successfully.'));
    }
    
    public function edit($id)
    {
        $moduleName = $this->moduleName;  
        $subcategory = SubCategory::find(decrypt($id));     
        $category = Category::OrderBy('id','DESC')->get();    
        return view('admin/Admb2b/'.$this->view.'/_form', compact('moduleName', 'category', 'subcategory'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',  
            'category_id' => 'required',                                          
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
        SubCategory::find($id)->update($data);        
        return redirect($this->route)->withStatus(__('SubCategory is updated successfully.'));
    }
}
