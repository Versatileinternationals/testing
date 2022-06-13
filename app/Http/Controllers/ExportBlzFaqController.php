<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlzFaq;

class ExportBlzFaqController extends Controller
{
    public $route="expblz_faq";
    public $view ="faq";
    public $moduleName = 'Faq';

    public function index()
    {     
       
        $moduleName = $this->moduleName;                
        $faq = BlzFaq::orderBy('id','DESC')->get();  
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
            'Title' => 'required',     
            'description' => 'required',     
            'Status' => 'required',
        ]);  
        
		$FAQ = BlzFaq::create([

            'Title' => $request->Title,
            'description' => $request->description,
            'Status' => $request->Status, 
        ]);

        
        return redirect($this->route)->withStatus(__('Faq is added successfully.'));
    }
    
    public function edit($id)
    {
        $moduleName = $this->moduleName;  
        $faq = BlzFaq::find($id);     
      
        return view('admin/ExportBlz/'.$this->view.'/_form', compact('moduleName', 'faq'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Title' => 'required',                                          
            'description' => 'required', 
            'Status' => 'required', 
        ]); 
   
         $FAQ = BlzFaq::find($id)->update([

            'Title' => $request->Title,
            'description' => $request->description,
            'Status' => $request->Status,

        ]);
    
        return redirect($this->route)->withStatus(__('FAQ is updated successfully.'));
    }
     public function delete($id)
	{
        $moduleName = $this->moduleName;  
        $FAQ = BlzFaq::find($id)->delete();
        return redirect($this->route)->withStatus(__('FAQ is delete successfully.'));
    }
}