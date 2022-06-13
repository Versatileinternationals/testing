<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blzgen_promotion;
use Excel;

class BlzInvstInvstgenpromotionController extends Controller
{
    public $route="blzinvst_genpromotion";
    public $view ="Invst_generation_promotion";
    public $moduleName = 'Investment Generation & Promotion';

    public function index()
    {        
        $moduleName = $this->moduleName;                
        //$trainings = Product::with(['category','subcategory','brandData'])->orderBy('id','DESC')->get();  
        $Blzgen_promotion = Blzgen_promotion::where('status',1)->orderBy('id','DESC')->get();
        return view('admin/BlzInvest/'.$this->view.'/index', compact('moduleName', 'Blzgen_promotion'));
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
        
        $events = Blzgen_promotion::create([
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
        $Blzgen_promotion = Blzgen_promotion::find($id); 
        return view('admin/BlzInvest/'.$this->view.'/_form', compact('moduleName', 'Blzgen_promotion'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'Message' => 'required',    
        ]); 
      
        $Blzgen_promotion = Blzgen_promotion::find($id);
       
     
        $training = BlzAdvisoryRequests::find($id)->update([
           'Message' => $request->Message,
        ]);
        
        return redirect($this->route)->withStatus(__('Advisory Request is updated successfully.'));
    }
    public function delete($id){
        $moduleName = $this->moduleName;  
        $Blzgen_promotion = Blzgen_promotion::find($id)->delete();
        return redirect($this->route)->withStatus(__('What we do section is updated successfully.'));
    }
}
