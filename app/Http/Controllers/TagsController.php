<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tags;

class TagsController extends Controller
{
    public $route="tags";
    public $view ="tags";
    public $moduleName = 'Tags';

    public function index()
    {        
        $moduleName = $this->moduleName;                
        $tags = Tags::orderBy('id','DESC')->get();  
        return view('admin/Admb2b/'.$this->view.'/index', compact('moduleName', 'tags'));
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
              
            'status' => 'required',
        ]);  
        $tags = Tags::create([
            'name' => $request->name,
            
        ]);
              
        return redirect($this->route)->withStatus(__('Tags is added Successfully.'));
    }
    
    public function edit($id)
    {
        $moduleName = $this->moduleName;  
        $Tags = Tags::find($id);     
      
        return view('admin/Admb2b/'.$this->view.'/_form', compact('moduleName', 'Tags'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',                                          
            'status' => 'required',            
        ]);  
        //$Tags = Tags::find($id);
       
        $Tags = Tags::find($id)->update([
           'name' => $request->name,
           
            'Status' => $request->status,
        ]);
        return redirect($this->route)->withStatus(__('Tag is updated successfully.'));
    }
    public function delete($id){
        $moduleName = $this->moduleName;  
        $tags = Tags::find($id)->delete();
        return redirect($this->route)->withStatus(__('Tags is delete successfully.'));
    }
}