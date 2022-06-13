<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlzJobs;
use App\Models\BlzJobsPreparedness;
use App\Models\BlzExternalJobs;
use Excel;

class BlzInvstJobsController extends Controller
{
    public $route="blzinvst_jobs";
    public $view ="Jobs";
    public $moduleName = 'Jobs Listing';

    public function index()
    {        
        $moduleName = $this->moduleName;                
        
        $BlzJobs = BlzJobs::orderBy('id','DESC')->get();
        return view('admin/BlzInvest/'.$this->view.'/index', compact('moduleName', 'BlzJobs'));
    }
    
    public function create()
    {
        $moduleName = $this->moduleName;  
       // $category = Category::where('status',1)->get();
       // $brand = Brand::where('status',1)->get();
        //$products = Product::where('status',1)->orderBy('id','DESC')->get();
        $BlzJobs = BlzJobs::where('status',1)->orderBy('id','DESC')->get();
        return view('admin/BlzInvest/'.$this->view.'/form',compact('moduleName','BlzJobs'));
    }

    
    public function store(Request $request)
    {
   
        $request->validate([
            'JobName' => 'required',    
            'JobType' => 'required', 
            'JobAddress' => 'required',          
            'experience' => 'required',          
            'Salary' => 'required', 
            'company_name' => 'required',  			
            'job_skills' => 'required',
            'Status' => 'required', 			 
        ]); 
        
		if ($request->hasFile('JobImage')) {  
           	
            $image = $request->file('JobImage');
			
            $imageName = 'jobs'.time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/jobs');
            $image->move($destinationPath, $imageName);         
            $JobImage = $imageName;
        }else{
            $JobImage = '';
        } 

        $jobs = BlzJobs::create([
            'JobName' => $request->JobName,
            'JobType' => $request->JobType,
            'JobAddress' => $request->JobAddress,
            'experience' => $request->experience, 
            'Salary' => $request->Salary,
			'company_name' => $request->company_name,
			'job_skills' => $request->job_skills,
			'description' => $request->description,
			'JobImage' =>$JobImage,
            'Status' => $request->Status,
        ]);
       
        return redirect('blzinvst_jobs')->withStatus(__('Job is added successfully.'));
    }
  
    public function edit($id){
        $moduleName = $this->moduleName;  
        $BlzJobs = BlzJobs::find($id); 
		
        return view('admin/BlzInvest/'.$this->view.'/_form', compact('moduleName', 'BlzJobs'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'JobName' => 'required',    
            'JobType' => 'required', 
            'JobAddress' => 'required',          
            'experience' => 'required',          
            'Salary' => 'required',          
             'company_name' => 'required',  			
            'job_skills' => 'required',        
        ]);  
      
        $BlzJobs = BlzJobs::find($id);
       
	   if ($request->hasFile('JobImage')) {  
           	
            $image = $request->file('JobImage');
			
            $imageName = 'jobs'.time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/jobs');
            $image->move($destinationPath, $imageName);         
            $JobImage = $imageName;
        }else{
            $JobImage = '';
        } 

     
        $jobs = BlzJobs::find($id)->update([
           'JobName' => $request->JobName,
            'JobType' => $request->JobType,
            'JobAddress' => $request->JobAddress,
            'experience' => $request->experience, 
            'Salary' => $request->Salary,
			'company_name' => $request->company_name,
			'job_skills' => $request->job_skills,
			'description' => $request->description,
			'JobImage' =>$JobImage,
            'Status' => $request->Status,
        ]);
        
        return redirect($this->route)->withStatus(__('Job is updated successfully.'));
    }
    public function delete($id)
	{
        $moduleName = $this->moduleName;  
        $BlzJobs = BlzJobs::find($id)->delete();
        return redirect($this->route)->withStatus(__('Job is delete successfully.'));
    }
	//JobsPreparedness Code Start Here//===================================================================================================
	
	
	
	public function JobsPreparednessList()
    {        
        $moduleName = 'Jobs Preparedness';
        $BlzJobsPreparedness = BlzJobsPreparedness::orderBy('id','DESC')->get();
        return view('admin/BlzInvest/'.$this->view.'/jobprepared_list', compact('moduleName', 'BlzJobsPreparedness'));
    }
	 public function Add_JobPreparedness()
    {
        $moduleName = 'Jobs Preparedness'; 
       
        return view('admin/BlzInvest/'.$this->view.'/addjob_preparedness',compact('moduleName'));
    }
	

	 public function store_jobpreparedness(Request $request)
    {
       
        $request->validate([
           // 'job_content' => 'required',    
            'description' => 'required', 
        ]); 
        
        if ($request->hasFile('job_content')) {   
            $video = $request->file('job_content');
            $videoName = uniqid() . '.' . $video->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/videos');
            $video->move($destinationPath, $videoName);         
            $jobVideos = $videoName;
        }else{
            $jobVideos = '';
        } 
		
        $jobs = BlzJobsPreparedness::create([
            'job_content' => $jobVideos,
			'description'=>$request->description,
			'youtube_video'=>$request->youtube_video,
            'Status' => $request->Status,
        ]);
        return redirect('blzinvst_JobsPreparedness')->with('status', 'Job Preparedness added successfully.');
        //return redirect($this->route)->withStatus(__('Job is added successfully.'));
      }
	  //edit_jobpreparedness
	  public function edit_jobpreparedness($id){
		
        $moduleName = 'Job Preparedness';  
        $BlzJobs = BlzJobsPreparedness::find($id); 
        return view('admin/BlzInvest/'.$this->view.'/editjobpreparedness_form', compact('moduleName', 'BlzJobs'));
    }

    public function update_jobpreparedness(Request $request,$id)
    {
        $request->validate([
           'youtube_video' => 'required',    
            'description' => 'required', 
                    
            'Status' => 'required',          
                     
        ]);  
      
	  if ($request->hasFile('job_content')) {   
            $video = $request->file('job_content');
            $videoName = uniqid() . '.' . $video->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/videos');
            $video->move($destinationPath, $videoName);         
            $jobVideos = $videoName;
        }else{
            $jobVideos = '';
        } 
        $BlzJobs = BlzJobs::find($id);
       
        $jobs = BlzJobsPreparedness::find($id)->update([
            'job_content' => $jobVideos,
			'description'=>$request->description,
			'youtube_video'=>$request->youtube_video,
            'Status' => $request->Status,
        ]);
        
        return redirect('blzinvst_JobsPreparedness')->withStatus(__('Job Preparedness is updated successfully.'));
    }
	public function JobsPreparednessdelete($id)
	{
        $moduleName = $this->moduleName;  
        $BlzJobsPreparedness = BlzJobsPreparedness::find($id)->delete();
        return redirect('blzinvst_JobsPreparedness')->withStatus(__('Job Preparedness is delete successfully.'));
    }
	
	
	
	//End JobsPreparedness Code//====================================================================================================================
	public function ExternalJobsList()
    {        
	
        $moduleName = 'External Jobs';
        $ExternalJobsList = BlzExternalJobs::orderBy('id','DESC')->get();
        return view('admin/BlzInvest/'.$this->view.'/externaljob_list', compact('moduleName', 'ExternalJobsList'));
    }
	
	
	 public function Add_ExternalJobs()
    {
        $moduleName = 'External Jobs'; 
        return view('admin/BlzInvest/'.$this->view.'/addexternal_jobs',compact('moduleName'));
    }
	

	 public function store_externaljobs(Request $request)
    {
       
        $request->validate([
            'external_links' => 'required',    
             'Status' => 'required',  
        ]); 
        
       
        $jobs = BlzExternalJobs::create([
            'external_links' => $request->external_links,
            'Status' => $request->Status,
        ]);
        return redirect('blzinvst_ExternalJobs')->with('status', 'External Jobs  added successfully.');
        
      }
	   public function edit_externaljobs($id){
		  
		
        $moduleName = $this->moduleName;  
        $BlzJobs = BlzExternalJobs::find($id); 
        return view('admin/BlzInvest/'.$this->view.'/editexternaljob_form', compact('moduleName', 'BlzJobs'));
    }
	 
    public function update_externaljobs(Request $request,$id)
    {
       
        $request->validate([
            'external_links' => 'required',    
             'Status' => 'required',  
        ]); 
      
        $BlzJobs = BlzExternalJobs::find($id);
       
        $jobs = BlzExternalJobs::find($id)->update([
           'external_links' => $request->external_links,
            'Status' => $request->Status,
        ]);
        
        return redirect('blzinvst_ExternalJobs')->withStatus(__('Job is updated successfully.'));
    }
	public function ExternalJobsdelete($id)
	{
        $moduleName = $this->moduleName;  
        $BlzJobsPreparedness = BlzExternalJobs::find($id)->delete();
        return redirect('blzinvst_ExternalJobs')->withStatus(__(' External Jobs is delete successfully.'));
    }
	
}
