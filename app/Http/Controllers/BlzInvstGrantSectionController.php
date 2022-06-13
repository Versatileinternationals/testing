<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlzGrantSection;
use Excel;

class BlzInvstGrantSectionController extends Controller
{
    public $route="blzinvst_grant_section";
    public $view ="GrantSection";
    public $moduleName = 'Grant Section';

    public function index()
    {        
        $moduleName = $this->moduleName;                
        //$trainings = Product::with(['category','subcategory','brandData'])->orderBy('id','DESC')->get();
         $BlzEvent = BlzGrantSection::orderBy('id','DESC')->get();
        return view('admin/BlzInvest/'.$this->view.'/index', compact('moduleName', 'BlzEvent'));  
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
            'url' => 'required',    
            'image' => 'required',
            'Status' => 'required',       
        ]); 
        
        if ($request->hasFile('image')) {  
           	
            $image = $request->file('image');
			
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/GrantSection');
            $image->move($destinationPath, $imageName);         
            $grantimage = $imageName;
        }else{
            $grantimage = '';
        } 

        $events = BlzGrantSection::create([
            'url' => $request->url,
            'image' => $grantimage,
            'Status' => $request->Status,
        ]);
		
       
		
        return redirect($this->route)->withStatus(__('Grant Section is added successfully.'));
    }

    public function edit($id){
        $moduleName = $this->moduleName;  
        $BlzGrant = BlzGrantSection::find($id); 
        return view('admin/BlzInvest/'.$this->view.'/_form', compact('moduleName', 'BlzGrant'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'url' => 'required',    
           // 'image' => 'required',
            'Status' => 'required',    
        ]); 
      
        $BlzEvent = BlzGrantSection::find($id);
       if ($request->hasFile('image'))
		   {  
           	
            $image = $request->file('image');
			
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/GrantSection');
            $image->move($destinationPath, $imageName);         
            $grantimage = $imageName;
        }else{
            $grantimage = '';
        } 
     
        $training = BlzGrantSection::find($id)->update([
            'url' => $request->url,
            'image' => $grantimage,
            
            'Status' => $request->Status,
        ]);
        
        return redirect($this->route)->withStatus(__('Grant Section is updated successfully.'));
    }
    public function delete($id){
        $moduleName = $this->moduleName;  
        $BlzEvent = BlzGrantSection::find($id)->delete();
        return redirect($this->route)->withStatus(__('Grant Section is updated successfully.'));
    }
}
