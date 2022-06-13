<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlzVideo;
use Excel;

class BlzInvstVideoUploadController extends Controller
{
    public $route="blzinvst_videoupload";
    public $view ="videoupld";
    public $moduleName = 'Video Upload';

    public function index()
    {        
        $moduleName = $this->moduleName;                
        //$trainings = Product::with(['category','subcategory','brandData'])->orderBy('id','DESC')->get(); 
        $BlzVideo = BlzVideo::orderBy('id','DESC')->get();
        return view('admin/BlzInvest/'.$this->view.'/index', compact('moduleName', 'BlzVideo')); 
       //return view('admin/BlzInvest/'.$this->view.'/index', compact('moduleName'));
    }

    public function create()
    {
       $moduleName = $this->moduleName;  
       return view('admin/BlzInvest/'.$this->view.'/form',compact('moduleName'));
    }

    public function store(Request $request)
    {
       
        if ($request->hasFile('VideoUpload')) {   
            $video = $request->file('VideoUpload');
            $videoName = uniqid() . '.' . $video->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/videos');
            $video->move($destinationPath, $videoName);         
            $TrainingVideos = $videoName;
        }else{
            $TrainingVideos = '';
        } 


        $training = BlzVideo::create([
            'VideoTitle' => $request->VideoTitle,
            'Video' => $TrainingVideos,
			'description' => $request->description,
            'Status' => $request->Status,
        ]);
        //echo 'kkkkk'; die;
        return redirect($this->route)->withStatus(__('Video is added successfully.'));
    }

    public function edit($id){
        $moduleName = $this->moduleName;  
        $BlzVideo = BlzVideo::find($id); 
        return view('admin/BlzInvest/'.$this->view.'/_form', compact('moduleName', 'BlzVideo'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'VideoTitle' => 'required',    
            'Status' => 'required',          
        ]);    
      
        $BlzVideo = BlzVideo::find($id);
       if ($request->hasFile('VideoUpload')) {   
            $video = $request->file('VideoUpload');
            $videoName = uniqid() . '.' . $video->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/upload');
            $video->move($destinationPath, $videoName);         
            $TrainingVideo = $videoName;
        } else{
            $TrainingVideo = $BlzVideo->Video;
        }
     
        $training = BlzVideo::find($id)->update([
           'VideoTitle' => $request->VideoTitle,
           'Video' => $TrainingVideo,
		   'description' => $request->description,
           'Status' => $request->Status,
        ]);
        
        return redirect($this->route)->withStatus(__('Video is updated successfully.'));
    }
    public function delete($id){
        $moduleName = $this->moduleName;  
        $BlzVideo = BlzVideo::find($id)->delete();
        return redirect($this->route)->withStatus(__('Training is updated successfully.'));
    }
}
