<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlzQueryList;
use Excel;

class ExportBlzQueryListsController extends Controller
{
    public $route="expblz_query";
    public $view ="QueryList";
    public $moduleName ='QueryList';

    public function index()
    {     
          
        $moduleName = $this->moduleName;                
        $faq = BlzQueryList::orderBy('id','DESC')->get();  
        return view('admin/ExportBlz/'.$this->view.'/index', compact('moduleName', 'faq'));
    }

    public function create()
    {
        $moduleName = $this->moduleName;           
        return view('admin/ExportBlz/'.$this->view.'/form', compact('moduleName'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',     
            'querys' => 'required',     
            'Status' => 'required',
        ]);  
        
		$QueryLists = BlzQueryList::create([

            'title' => $request->title,
            'querys' => $request->querys,
            'Status' => $request->Status, 
        ]);

        
        return redirect($this->route)->withStatus(__('QueryList is added successfully.'));
    }
    
    public function edit($id)
    {
        $moduleName = $this->moduleName;  
        $QueryLists = BlzQueryList::find($id);     
      
        return view('admin/ExportBlz/'.$this->view.'/_form', compact('moduleName', 'QueryLists'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',                                          
            'querys' => 'required', 
            'Status' => 'required', 
        ]); 
   
         $QueryLists = BlzQueryList::find($id)->update([

            'title' => $request->title,
            'querys' => $request->querys,
            'Status' => $request->Status,

        ]);
    
        return redirect($this->route)->withStatus(__('QueryList is updated successfully.'));
    }
     public function delete($id)
	{
        $moduleName = $this->moduleName;  
        $QueryLists = BlzQueryList::find($id)->delete();
        return redirect($this->route)->withStatus(__('QueryList is delete successfully.'));
    }
}
