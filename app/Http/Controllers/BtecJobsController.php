<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlzJobs;
use App\Models\BlzJobsPreparedness;

use Excel;

class BtecJobsController extends Controller
{
    public $route="jobs";
    public $view ="Jobs";
    public $moduleName = 'Jobs Listing';

    public function index()
    {        
        $moduleName = $this->moduleName;                
        
        $BlzJobs = BlzJobs::where('status',1)->orderBy('id','DESC')->get();
        return view('admin/BlzInvest/'.$this->view.'/index', compact('moduleName', 'BlzJobs'));
    }
    public function JobsPreparednessList()
    {        
        $moduleName = 'Jobs Preparedness';
        $BlzJobsPreparedness = BlzJobsPreparedness::where('status',1)->orderBy('id','DESC')->get();
        return view('admin/BlzInvest/'.$this->view.'/jobprepared_list', compact('moduleName', 'BlzJobsPreparedness'));
    }
	public function ExternalJobsList()
    {        
        $moduleName = 'External Jobs';
        $ExternalJobsList = BlzJobsPreparedness::where('status',1)->orderBy('id','DESC')->get();
        return view('admin/BlzInvest/'.$this->view.'/externaljob_list', compact('moduleName', 'ExternalJobsList'));
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

     public function Add_JobPreparedness()
    {
        $moduleName = 'Jobs Preparedness'; 
       
        return view('admin/BlzInvest/'.$this->view.'/addjob_preparedness',compact('moduleName'));
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
	public function JobsPreparednessdelete($id)
	{
        $moduleName = $this->moduleName;  
        $BlzJobsPreparedness = BlzJobsPreparedness::find($id)->delete();
        return redirect($this->route)->withStatus(__('Job is delete successfully.'));
    }
}
