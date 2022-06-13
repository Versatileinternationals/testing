<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlzTrainee;

class BtecTraineeController extends Controller
{
    public $route="trainee";
    public $view ="Trainees";
    public $moduleName = 'Trainees';

    public function index()
    {     
          
        $moduleName = $this->moduleName;                
        $Trainees = BlzTrainee::orderBy('id','DESC')->get();  
        return view('admin/BlzInvest/'.$this->view.'/index', compact('moduleName', 'Trainees'));
    }

    public function create()
    {
        $moduleName = $this->moduleName;           
        return view('admin/BlzInvest/'.$this->view.'/form', compact('moduleName'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',     
            'score' => 'required',
            'courses' => 'required',			
            'Status' => 'required',
        ]);  
        
		$Trainees = BlzTrainee::create([

            'name' => $request->name,
            'score' => $request->score,
			'courses' => $request->courses,
			'cerificates' => $request->cerificates,
			'EmpStatus' => $request->EmpStatus,
            'Status' => $request->Status, 
        ]);

        
        return redirect($this->route)->withStatus(__('Trainees  added successfully.'));
    }
    
    public function edit($id)
    {
        $moduleName = $this->moduleName;  
        $Trainees = BlzTrainee::find($id);     
      
        return view('admin/BlzInvest/'.$this->view.'/_form', compact('moduleName', 'Trainees'));
    }

    public function update(Request $request, $id)
    {
       $request->validate([
            'name' => 'required',     
            'score' => 'required',
            'courses' => 'required',			
            'Status' => 'required',
        ]);  
   
         $Trainees = BlzTrainee::find($id)->update([

            'name' => $request->name,
            'score' => $request->score,
			'courses' => $request->courses,
			'cerificates' => $request->cerificates,
			'EmpStatus' => $request->EmpStatus,
            'Status' => $request->Status, 

        ]);
    
        return redirect($this->route)->withStatus(__('Trainees is updated successfully.'));
    }
     public function delete($id)
	{
        $moduleName = $this->moduleName;  
        $Trainees = BlzTrainee::find($id)->delete();
        return redirect($this->route)->withStatus(__('Trainees  delete successfully.'));
    }
}