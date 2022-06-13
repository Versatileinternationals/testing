<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlzTrainee;

class BlzInvstTrainningCalenderController extends Controller
{
    public $route="trainning_calender";
    public $view ="trainning_calender";
    public $moduleName = 'Trainning Calender';

    public function index()
    {     
          
        $moduleName = $this->moduleName;                
        $TrainningCal = BlzTrainee::all();
        // return $TrainningCal;
          $events = array();
        foreach($TrainningCal as $eventDetail)
        {
            $events[] = [
                'id'   => $eventDetail->id,
                'title' => $eventDetail->name,
                'start' => $eventDetail->created_at,
               // 'end' => $eventDetail->updated_at,
                
            ];
        }
        return view('admin/BlzInvest/'.$this->view.'/index',['moduleName'=>$moduleName, 'events'=>$events]);
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
        
		$TrainningCal = BlzTrainee::create([

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
        $TrainningCal = BlzTrainee::find($id);     
      
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
   
         $TrainningCal = BlzTrainee::find($id)->update([

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
        $TrainningCal = BlzTrainee::find($id)->delete();
        return redirect($this->route)->withStatus(__('Trainees  delete successfully.'));
    }
}