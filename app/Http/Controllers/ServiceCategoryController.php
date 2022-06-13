<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceCategory;

class ServiceCategoryController extends Controller
{
    public $route="service_category";
    public $view ="ServiceCategory";
    public $moduleName = 'Services Category';

    public function index()
    {        
        $moduleName = $this->moduleName;                
        $service_category = ServiceCategory::orderBy('id','DESC')->get();  
        return view('admin/Admb2b/'.$this->view.'/index', compact('moduleName', 'service_category'));
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
            'Status' => 'required',
        ]);  
        $data = $request->all();
        $data['name'] = ucfirst($request->name);
        //$data['category_id'] = rand(10000,99999);
        
        
        $category = ServiceCategory::create($data);
       
              
        return redirect($this->route)->withStatus(__('Category is added successfully.'));
    }
    
    public function edit($id)
    {
		echo "taaa";
		die();
        $moduleName = $this->moduleName;  
        $category = ServiceCategory::find($id);     
      
        return view('admin/Admb2b/'.$this->view.'/_form', compact('moduleName', 'category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',                                          
            'Status' => 'required',            
        ]);  
        $data = $request->all();  
        $data['name'] = ucfirst($request->name);   
        
        ServiceCategory::find($id)->update($data);        
        return redirect($this->route)->withStatus(__('Category is updated successfully.'));
    }

    
}
