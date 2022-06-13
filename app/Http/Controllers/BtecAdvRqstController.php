<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlzAdvisoryRequests;
use App\Models\Request_Assistance;
use Excel;

class BtecAdvRqstController extends Controller
{
    public $route="btec_advisory";
    public $view ="AdvRqst";
    public $moduleName = 'Advisory Requests';

    public function index()
    {        
	    $moduleName = $this->moduleName;                
      
        $BlzAdvisoryRequests = Request_Assistance::where('Status',1)->where('admin_type',2)->orderBy('id','DESC')->get();
		
        
        return view('admin/BtecAdm/'.$this->view.'/index', compact('moduleName', 'BlzAdvisoryRequests'));
    }

    public function create()
    {
        $moduleName = $this->moduleName;  
        return view('admin/BlzInvest/'.$this->view.'/form',compact('moduleName')); 
    }

    public function store(Request $request)
    {
       //echo 'fffffff'; die;
        $request->validate([
            'Name' => 'required',
            'Email' => 'required',
            'Mobile' => 'required',
            'Purpose' => 'required',
            'Message' => 'required',    
        ]); 
        
        $events = BlzAdvisoryRequests::create([
            'Name' => $request->Name,
            'Email' => $request->Email,
            'Mobile' => $request->Mobile,
            'Purpose' => $request->Purpose,
            'Message' => $request->Message,
        ]);
        //echo 'kkkkk'; die;
        return redirect($this->route)->withStatus(__('Advisory Request is added successfully.'));
    }

    public function edit($id){
        $moduleName = $this->moduleName;  
        $BlzAdvisoryRequests = BlzAdvisoryRequests::find($id); 
        return view('admin/BlzInvest/'.$this->view.'/_form', compact('moduleName', 'BlzAdvisoryRequests'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'Message' => 'required',    
        ]); 
      
        $BlzAdvisoryRequests = BlzAdvisoryRequests::find($id);
       
     
        $training = BlzAdvisoryRequests::find($id)->update([
           'Message' => $request->Message,
        ]);
        
        return redirect($this->route)->withStatus(__('Advisory Request is updated successfully.'));
    }
    public function delete($id){
        $moduleName = $this->moduleName;  
        $BlzAdvisoryRequests = BlzAdvisoryRequests::find($id)->delete();
        return redirect($this->route)->withStatus(__('Advisory Request is updated successfully.'));
    }
}
