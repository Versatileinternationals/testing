<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrainningStream;
use App\Models\TrainningCourse;


class TrainningCourseController extends Controller
{
    public $route="trainning_course";
    public $view ="TrainningCourse";
    public $moduleName = 'Training Course';

    public function index()
    {        
        $moduleName = $this->moduleName;                
        
		$Streams = TrainningCourse::join('BlzInvest_Trainning_Stream', 'BlzInvest_Trainning_Stream.id', '=', 'Trainning_Course.stream_id')->get(['Trainning_Course.Course_Name', 'BlzInvest_Trainning_Stream.name', 'Trainning_Course.Status','Trainning_Course.id']);
       	
        return view('admin/'.$this->view.'/index', compact('moduleName', 'Streams'));
    }
    
    public function getData(Request $request)
    {        
		
		$data = TrainningCourse::where('stream_id',$request->stream_id)->get()->pluck('Course_Name','id')->toArray();
           
        return $data;
        
    }

    public function create()
    {
        $moduleName = $this->moduleName;   
        $Streams = TrainningCourse::orderBy('id','DESC')->get();        
        return view('admin/'.$this->view.'/form', compact('moduleName','Streams'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'stream_id' => 'required',     
            'Course_Name' => 'required',
             'Status' => 'required',
        ]);  
        $data = $request->all();
        $data['stream_id'] = $request->stream_id;
       
       // $data['added_by'] = auth()->user()->id;
        
        $banner = TrainningCourse::create($data);
       
        return redirect($this->route)->withStatus(__('Stream is added successfully.'));
    }
    
    public function edit($id)
    {
        $moduleName = $this->moduleName;  
        $Courses = TrainningCourse::find($id);     
        $Streams = TrainningStream::orderBy('id','DESC')->get();    
        return view('admin/'.$this->view.'/_form', compact('moduleName', 'Courses','Streams'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Course_Name' => 'required', 
             'stream_id' => 'required',    			
                   	
            'Status' => 'required',            
        ]);  
       // $data = $request->all(); 

       $product = TrainningCourse::find($id)->update([

            'Course_Name' => $request->Course_Name,
            'stream_id' => $request->stream_id,
            'Status' => $request->Status,
           
        ]);

        
	   
       // $data['name'] = ucfirst($request->name);   
        
        //TrainningCourse::find($id)->update($data);        
        return redirect($this->route)->withStatus(__('Course is updated successfully.'));
    }
    public function delete($id){
        $moduleName = $this->moduleName;  
        $Streams = TrainningCourse::find(encrypt($id))->delete();
        return redirect($this->route)->withStatus(__('Stream is delete successfully.'));
    }
}
