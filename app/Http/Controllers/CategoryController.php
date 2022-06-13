<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public $route="category";
    public $view ="category";
    public $moduleName = 'Category';

    public function index()
    {        
        $moduleName = $this->moduleName;                
        $category = Category::orderBy('id','DESC')->get();  
        return view('admin/Admb2b/'.$this->view.'/index', compact('moduleName', 'category'));
    }

    public function create()
    {
        $moduleName = $this->moduleName;           
        return view('admin/Admb2b/'.$this->view.'/form', compact('moduleName'));
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
        $data['category_id'] = rand(10000,99999);
        if ($request->hasFile('image')) {   
            $image = $request->file('image');
            $name = uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/upload');
            $image->move($destinationPath, $name);         
            $data['image'] = $name;
        }  
        
        $category = Category::create($data);
       
              
        return redirect($this->route)->withStatus(__('Category is added successfully.'));
    }
    
    public function edit($id)
    {
        $moduleName = $this->moduleName;  
        $category = Category::find(decrypt($id));     
      
        return view('admin/Admb2b/'.$this->view.'/_form', compact('moduleName', 'category'));
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
        Category::find($id)->update($data);        
        return redirect($this->route)->withStatus(__('Category is updated successfully.'));
    }

    
}
