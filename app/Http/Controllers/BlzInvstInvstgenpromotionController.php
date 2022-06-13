<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blz_whatwedo;
use App\Models\Blz_team_member;
use App\Models\Blz_resources;
use Excel;

class BlzInvstInvstgenpromotionController extends Controller
{
    public $route="blzinvst_what_we_do";
    public $view ="Invst_generation_promotion";
    public $moduleName = 'What We Do';

    public function index()
    {        
        $moduleName = $this->moduleName;                
        //$trainings = Product::with(['category','subcategory','brandData'])->orderBy('id','DESC')->get();  
        $Blzgen_promotion = Blz_whatwedo::where('status',1)->orderBy('id','DESC')->get();
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
            'image' => 'required',
            'description' => 'required',
            'Status' => 'required',
        ]); 
        if ($request->hasFile('image')) {   
            $image = $request->file('image');
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/team');
            $image->move($destinationPath, $imageName);         
            $imageName = $imageName;
        }else{
            $imageName = '';
        } 
		
        $events = Blz_whatwedo::create([
            'image' => $imageName,
            'description' => $request->description,
            'Status' => $request->Status,
           
        ]);
        //echo 'kkkkk'; die;
        return redirect($this->route)->withStatus(__('What We Do is added successfully.'));
    }

    public function edit($id){
        $moduleName = $this->moduleName;  
        $Blzgen_promotion = Blz_whatwedo::find($id); 
        return view('admin/BlzInvest/'.$this->view.'/_form', compact('moduleName', 'Blzgen_promotion'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
           
            'description' => 'required',
            'Status' => 'required',
        ]); 
      
	  if ($request->hasFile('image')) {   
            $image = $request->file('image');
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/team');
            $image->move($destinationPath, $imageName);         
            $imageName = $imageName;
        }else{
            $imageName = '';
        } 
        $Blzgen_promotion = Blz_whatwedo::find($id);
       
     
        $training = Blz_whatwedo::find($id)->update([
             'image' => $imageName,
            'description' => $request->description,
            'Status' => $request->Status,
        ]);
        
        return redirect($this->route)->withStatus(__('Advisory Request is updated successfully.'));
    }
    public function delete($id){
        $moduleName = $this->moduleName;  
        $Blzgen_promotion = Blz_whatwedo::find($id)->delete();
        return redirect($this->route)->withStatus(__('Team Member is updated successfully.'));
    }
	   //   Team Members Code Start Here  blzinvst_team_members //
	   
	  public function team_lists()
    {        
        $moduleName = 'Team Members';                
        $Blz_team_members = Blz_team_member::where('status',1)->orderBy('id','DESC')->get();
        return view('admin/BlzInvest/'.$this->view.'/team_index', compact('moduleName', 'Blz_team_members'));
    }
	public function team_create()
    {
         $moduleName = 'Team Members'; 
        return view('admin/BlzInvest/'.$this->view.'/team_form',compact('moduleName')); 
    }

    public function team_store(Request $request)
    {
       //echo 'fffffff'; die;
        $request->validate([
		    'name' => 'required',
			'designation' => 'required',
          //  'image' => 'required',
            'description' => 'required',
            'Status' => 'required',
        ]); 
        if ($request->hasFile('image')) {   
            $image = $request->file('image');
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/team');
            $image->move($destinationPath, $imageName);         
            $imageName = $imageName;
        }else{
            $imageName = '';
        } 
        $events = Blz_team_member::create([
            'name' =>  $request->name,
			'designation' => $request->designation,
            'image' => $imageName,
            'description' => $request->description,
            'Status' => $request->Status,
        ]);
        //echo 'kkkkk'; die;
        return redirect('blzinvst_team_members')->withStatus(__('Team Member is added successfully.'));
    }

    public function team_edit($id){
		
        $moduleName = 'Team Members'; 
        $Blzgen_promotion = Blz_team_member::find($id); 
        return view('admin/BlzInvest/'.$this->view.'/team_editform', compact('moduleName', 'Blzgen_promotion'));
    }

    public function team_update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required',
			'designation' => 'required',
          //  'image' => 'required',
            'description' => 'required',
            'Status' => 'required',
        ]); 
      
	   if ($request->hasFile('image')) {   
            $image = $request->file('image');
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/team');
            $image->move($destinationPath, $imageName);         
            $imageName = $imageName;
        }else{
            $imageName = '';
        } 
        $Blzgen_promotion = Blz_team_member::find($id);
       
     
        $training = Blz_team_member::find($id)->update([
		    'name' =>  $request->name,
			'designation' => $request->designation,
            'image' => $imageName,
            'description' => $request->description,
            'Status' => $request->Status,
        ]);
        
        return redirect('blzinvst_team_members')->withStatus(__('Team Member updated successfully.'));
    }
    public function team_delete($id){
         $moduleName = 'Team Members'; 
        $Blzgen_promotion = Blz_team_member::find($id)->delete();
        return redirect('blzinvst_team_members')->withStatus(__('Team Member is updated successfully.'));
    }
	
	// Other Resources Code Start Here //
	
	
	  public function resource_lists()
    {        
        $moduleName = 'Resources';                
        $Blz_Resources = Blz_resources::where('status',1)->orderBy('id','DESC')->get();
        return view('admin/BlzInvest/'.$this->view.'/resources_index', compact('moduleName', 'Blz_Resources'));
    }
	public function resource_create()
    {
         $moduleName = 'Resources'; 
        return view('admin/BlzInvest/'.$this->view.'/resources_form',compact('moduleName')); 
    }

    public function resource_store(Request $request)
    {
       
        $request->validate([
		    'name' => 'required',
			'links' => 'required',
            'Status' => 'required',
        ]); 
        
        $events = blz_resources::create([
            'name' =>  $request->name,
			'links' => $request->links,
           
            'Status' => $request->Status,
        ]);
        //echo 'kkkkk'; die;
        return redirect('blzinvst_resources')->withStatus(__('Resources Data is added successfully.'));
    }

    public function resource_edit($id){
		
        $moduleName = 'Resources'; 
        $Blzgen_Resources = Blz_resources::find($id); 
        return view('admin/BlzInvest/'.$this->view.'/resources_editform', compact('moduleName', 'Blzgen_Resources'));
    }

    public function resource_update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required',
			'links' => 'required',
         
            'Status' => 'required',
        ]); 
      
        $Blzgen_promotion = Blz_resources::find($id);
       
     
        $training = Blz_resources::find($id)->update([
		    'name' =>  $request->name,
			'links' => $request->links,
           
            'Status' => $request->Status,
        ]);
        
        return redirect('blzinvst_resources')->withStatus(__('Resources Data updated successfully.'));
    }
    public function resource_delete($id){
         $moduleName = 'Resources'; 
        $Blzgen_promotion = Blz_resources::find($id)->delete();
        return redirect('blzinvst_resources')->withStatus(__('Resources Data is updated successfully.'));
    }
	
}
