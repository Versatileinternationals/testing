<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlzJobs;
use App\Models\BlzJobsPreparedness;

use Excel;

class ExportBlzJobsController extends Controller
{
    public $route="expblz_jobs";
    public $view ="Jobs";
    public $moduleName = 'Jobs Listing';
		// Job Listing Code Start //
		
    public function index()
    {        
        $moduleName = $this->moduleName;                
        
        $BlzJobs = BlzJobs::where('status',1)->orderBy('id','DESC')->get();
        return view('admin/ExportBlz/'.$this->view.'/index', compact('moduleName', 'BlzJobs'));
    }
	 public function create()
    {
        $moduleName = $this->moduleName;  
       // $category = Category::where('status',1)->get();
       // $brand = Brand::where('status',1)->get();
        //$products = Product::where('status',1)->orderBy('id','DESC')->get();
        $BlzJobs = BlzJobs::where('status',1)->orderBy('id','DESC')->get();
        return view('admin/ExportBlz/'.$this->view.'/form',compact('moduleName','BlzJobs'));
    }
	public function store(Request $request)
    {
       
        $request->validate([
            'JobName' => 'required',    
            'JobType' => 'required', 
            'JobAddress' => 'required',        
            'experience' => 'required',          
            'Salary' => 'required',          
                   
        ]); 
        

        $jobs = BlzJobs::create([
            'JobName' => $request->JobName,
            'JobType' => $request->JobType,
            'JobAddress' => $request->JobAddress,
            
            'experience' => $request->experience, 
            'Salary' => $request->Salary,
            'Status' => $request->Status,
        ]);
       // echo 'kkkkk'; die;
        return redirect($this->route)->withStatus(__('Job is added successfully.'));
    }
	public function edit($id){
        $moduleName = $this->moduleName;  
        $BlzJobs = BlzJobs::find($id); 
        return view('admin/ExportBlz/'.$this->view.'/_form', compact('moduleName', 'BlzJobs'));
    }

    public function update(Request $request,$id)
    {
		
        $request->validate([
            'JobName' => 'required',    
            'JobType' => 'required', 
            'JobAddress' => 'required',          
            'experience' => 'required',          
            'Salary' => 'required',          
                     
        ]);  
      
        $BlzJobs = BlzJobs::find($id);
       
        $jobs = BlzJobs::find($id)->update([
           'JobName' => $request->JobName,
            'JobType' => $request->JobType,
            'JobAddress' => $request->JobAddress,
            'experience' => $request->experience, 
            'Salary' => $request->Salary,
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
	 // Job Listing Code End //
	
	
	 // JobsPreparedness Code Start //
    public function JobsPreparednessList()
    {        
        $moduleName = 'Jobs Preparedness';
        $BlzJobsPreparedness = BlzJobsPreparedness::where('status',1)->orderBy('id','DESC')->get();
        return view('admin/ExportBlz/'.$this->view.'/jobprepared_list', compact('moduleName', 'BlzJobsPreparedness'));
    }
	 public function Add_JobPreparedness()
    {
        $moduleName = 'Jobs Preparedness'; 
       
        return view('admin/ExportBlz/'.$this->view.'/addjob_preparedness',compact('moduleName'));
    }
	
	public function store_jobpreparedness(Request $request)
    {
       
        $request->validate([
		
            'job_content' => 'required',    
             
        ]); 
        

        $jobs = BlzJobsPreparedness::create([
            'job_content' => $request->job_content,
            'Status' => $request->Status,
        ]);
        return redirect('JobsPreparedness')->with('status', 'Job Preparedness added successfully.');
        //return redirect($this->route)->withStatus(__('Job is added successfully.'));
    }
	
	public function edit_jobpreparedness($id)
	{
        $moduleName = 'Jobs Preparedness';  
        $BlzJobs = BlzJobsPreparedness::find($id); 
        return view('admin/ExportBlz/'.$this->view.'/_edit_jobpreparedness', compact('moduleName', 'BlzJobs'));
    }

    public function update_jobpreparedness(Request $request,$id)
    {
		
        $request->validate([
            'job_content' => 'required'   
            
        ]);  
      
        $BlzJobs = BlzJobsPreparedness::find($id);
		
		 if ($request->hasFile('job_content')) {   
            $image = $request->file('job_content');
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/upload');
            $image->move($destinationPath, $imageName);         
            $JobImage = $imageName;
        }else{
            $JobImage = '';
        } 
       
        $jobs = BlzJobsPreparedness::find($id)->update([
           'job_content' =>$JobImage,
            'Status' => $request->Status
        ]);
       
        return redirect('expblz_jobsPreparedness')->withStatus(__('Jobs Preparedness is updated successfully.'));
    }
	
	
	public function JobsPreparednessdelete($id)
	{
        $moduleName = $this->moduleName;  
        $BlzJobsPreparedness = BlzJobsPreparedness::find($id)->delete();
        return redirect('expblz_jobsPreparedness')->withStatus(__('Jobs Preparedness is delete successfully.'));
    }
	
	 // JobsPreparedness Code End //
	 
	public function ExternalJobsList()
    {        
        $moduleName = 'External Jobs';
        $ExternalJobsList = BlzJobsPreparedness::where('status',1)->orderBy('id','DESC')->get();
        return view('admin/ExportBlz/'.$this->view.'/externaljob_list', compact('moduleName', 'ExternalJobsList'));
    }
	
	 public function add_extjob()
    {
        $moduleName = 'External Jobs'; 
       
        return view('admin/ExportBlz/'.$this->view.'/addjob_preparedness',compact('moduleName'));
    }
	
	public function store_extjobs(Request $request)
    {
       
        $request->validate([
            'job_content' => 'required',    
        ]); 
        

        $jobs = BlzJobsPreparedness::create([
            'job_content' => $request->job_content,
            'Status' => $request->Status,
        ]);
        return redirect('expblz_externaljobs')->with('status', 'External Jobs  added successfully.');
        //return redirect($this->route)->withStatus(__('Job is added successfully.'));
    }
	
	public function edit_extjobs($id)
	{
        $moduleName = 'External Jobs';  
        $BlzJobs = BlzJobsPreparedness::find($id); 
        return view('admin/ExportBlz/'.$this->view.'/_edit_jobpreparedness', compact('moduleName', 'BlzJobs'));
    }

    public function update_extjobs(Request $request,$id)
    {
		echo "tttt";
		die();
        $request->validate([
            'job_content' => 'required'   
            
        ]);  
      
        $BlzJobs = BlzJobsPreparedness::find($id);
		
		 if ($request->hasFile('job_content')) {   
            $image = $request->file('job_content');
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/upload');
            $image->move($destinationPath, $imageName);         
            $JobImage = $imageName;
        }else{
            $JobImage = '';
        } 
       
        $jobs = BlzJobsPreparedness::find($id)->update([
           'job_content' =>$JobImage,
            'Status' => $request->Status
        ]);
       
	   
        return redirect('expblz_externaljobs')->withStatus(__('External Jobs is updated successfully.'));
    }
	
	
	public function ExternalJobsDelete($id)
	{
        $moduleName = $this->moduleName;  
        $BlzJobsPreparedness = BlzJobsPreparedness::find($id)->delete();
        return redirect('expblz_jobsPreparedness')->withStatus(__('External Jobs is delete successfully.'));
    }
	
	 // JobsPreparedness Code End //
	 
	
    
	
}
