<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;

class BannerController extends Controller
{
    public $route="banner";
    public $view ="banner";
    public $moduleName = 'Banner';

    public function index()
    {        
        $moduleName = $this->moduleName;                
        $banner = Banner::orderBy('id','DESC')->get();  
        return view('admin/'.$this->view.'/index', compact('moduleName', 'banner'));
    }

    public function create()
    {
        $moduleName = $this->moduleName;           
        return view('admin/'.$this->view.'/form', compact('moduleName'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',     
            'description' => 'required',     
            'url' => 'required',         
            'status' => 'required',
            'image' => 'required',
        ]);  
        $data = $request->all();
        $data['title'] = ucfirst($request->title);
        $data['banner_id'] = rand(10000,99999);
        $data['added_by'] = auth()->user()->id;
        if ($request->hasFile('image')) {   
            $image = $request->file('image');
            $name = uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/upload');
            $image->move($destinationPath, $name);         
            $data['image'] = $name;
        }  

        $banner = Banner::create($data);
       
        return redirect($this->route)->withStatus(__('Banner is added successfully.'));
    }
    
    public function edit($id)
    {
        $moduleName = $this->moduleName;  
        $banner = Banner::find(decrypt($id));     
      
        return view('admin/'.$this->view.'/_form', compact('moduleName', 'banner'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',     
            'description' => 'required',     
            'title' => 'required',     
            'url' => 'required',         
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
        Banner::find($id)->update($data);        
        return redirect($this->route)->withStatus(__('Banner is updated successfully.'));
    }

}
