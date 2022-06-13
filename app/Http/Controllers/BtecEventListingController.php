<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlzEvent;
use Excel;

class BtecEventListingController extends Controller
{
    public $route="btec_events";
    public $view ="EventListing";
    public $moduleName = 'EventListing';

    public function index()
    {        
        $moduleName = $this->moduleName;                
        //$trainings = Product::with(['category','subcategory','brandData'])->orderBy('id','DESC')->get();
         $BlzEvent = BlzEvent::orderBy('id','DESC')->get();
        return view('admin/BtecAdm/'.$this->view.'/index', compact('moduleName', 'BlzEvent'));  
    }
    public function calenderlist()
    {        
        $moduleName = $this->moduleName;                
        //$trainings = Product::with(['category','subcategory','brandData'])->orderBy('id','DESC')->get();
         $BlzEvent = BlzEvent::where('status',1)->orderBy('id','DESC')->get();
        return view('admin/BtecAdm/'.$this->view.'/event_calender', compact('moduleName', 'BlzEvent'));  
    }

    public function create()
    {
        $moduleName = $this->moduleName;  
       // $category = Category::where('status',1)->get();
       // $brand = Brand::where('status',1)->get();
        //$products = Product::where('status',1)->orderBy('id','DESC')->get();
        return view('admin/BtecAdm/'.$this->view.'/form',compact('moduleName'));
    }

    public function store(Request $request)
    {
       //echo 'fffffff'; die;
        $request->validate([
            'EventName' => 'required',    
            'StartDate' => 'required',
            'EndDate' => 'required', 
            'EventTime' => 'required', 			
            'EventType' => 'required',          
            'EventAddress' => 'required',          
            'EventImage' => 'required',          
            'Description' => 'required',          
        ]); 
        
        if ($request->hasFile('EventImage')) {   
            $image = $request->file('EventImage');
            $imageName = 'event'.time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/event');
            $image->move($destinationPath, $imageName);         
            $EventImage = $imageName;
        }else{
            $EventImage = '';
        } 


        $events = BlzEvent::create([
            'EventName' => $request->EventName,
            'StartDate' => $request->StartDate,
            'EndDate' => $request->EndDate, 
            'EventTime' => $request->EventTime, 
            'EventType' => $request->EventType, 
            'Event_fees' => $request->EventFees,
            'EventAddress' => $request->EventAddress,
            'EventImage' => $EventImage,
            'Description' => $request->Description,
            'Status' => $request->Status,
        ]);
        //echo 'kkkkk'; die;
        return redirect($this->route)->withStatus(__('Event is added successfully.'));
    }

    public function edit($id){
        $moduleName = $this->moduleName;  
        $BlzEvent = BlzEvent::find($id); 
        return view('admin/BtecAdm/'.$this->view.'/_form', compact('moduleName', 'BlzEvent'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'EventName' => 'required',    
            'StartDate' => 'required',
            'EndDate' => 'required', 
            'EventTime' => 'required', 			
            'EventType' => 'required',          
            'EventAddress' => 'required',          
           // 'EventImage' => 'required',          
            'Description' => 'required',          
        ]); 
      
        $BlzEvent = BlzEvent::find($id);
       if ($request->hasFile('EventImage')) {   
            $image = $request->file('EventImage');
            $imageName = 'event'.time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/event');
            $image->move($destinationPath, $imageName);         
            $EventImage = $imageName;
        } else{
            $EventImage = $BlzEvent->EventImage;
        }
     
        $training = BlzEvent::find($id)->update([
            'EventName' => $request->EventName,
            'StartDate' => $request->StartDate,
            'EndDate' => $request->EndDate, 
            'EventTime' => $request->EventTime, 
            'EventType' => $request->EventType, 
            'EventAddress' => $request->EventAddress,
            'EventImage' => $EventImage,
            'Description' => $request->Description,
            'Status' => $request->Status,
        ]);
        
        return redirect($this->route)->withStatus(__('Event is updated successfully.'));
    }
    public function delete($id){
        $moduleName = $this->moduleName;  
        $BlzEvent = BlzEvent::find($id)->delete();
        return redirect($this->route)->withStatus(__('Event is updated successfully.'));
    }
}
