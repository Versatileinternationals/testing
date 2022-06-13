<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlzEvent;
use Excel;

class BlzInvstEventListingController extends Controller
{
    public $route="blzinvst_events";
    public $view ="EventListing";
    public $moduleName = 'EventListing';

    public function index()
    {        
        $moduleName = $this->moduleName;                
        //$trainings = Product::with(['category','subcategory','brandData'])->orderBy('id','DESC')->get();
         $BlzEvent = BlzEvent::orderBy('id','DESC')->get();
         
        return view('admin/BlzInvest/'.$this->view.'/index', compact('moduleName', 'BlzEvent'));  
    }
    public function calenderlist()
    {        
        $moduleName = $this->moduleName;                
        //$trainings = Product::with(['category','subcategory','brandData'])->orderBy('id','DESC')->get();
         $BlzEvent = BlzEvent::orderBy('id','DESC')->get();
         $events= array();
         foreach($BlzEvent as $BlzEvent)
         {
         $events[] = [
                'id'   => $BlzEvent->id,
                'title' => $BlzEvent->EventName,
                'start' => $BlzEvent->StartDate,
                'end' => $BlzEvent->EndDate,
            ];
         }
        return view('admin/BlzInvest/'.$this->view.'/event_calender', compact('moduleName', 'events'));  
    }

    public function create()
    {
	
        $moduleName = $this->moduleName;  
       // $category = Category::where('status',1)->get();
       // $brand = Brand::where('status',1)->get();
        //$products = Product::where('status',1)->orderBy('id','DESC')->get();
        return view('admin/BlzInvest/'.$this->view.'/form',compact('moduleName'));
    }

    public function store(Request $request)
    {
       //echo 'fffffff'; die;
        $request->validate([
            // 'EventName' => 'required',    
            // 'StartDate' => 'required',
            // 'EndDate' => 'required', 
            // 'EventTime' => 'required', 			
            // 'EventType' => 'required',          
            // 'EventAddress' => 'required',          
            // 'EventImage' => 'required',          
            // 'Description' => 'required',          
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
		
       
		
        return redirect($this->route)->withStatus(__('Event is added successfully.'));
    }

    public function edit($id){
        $moduleName = $this->moduleName;  
        $BlzEvent = BlzEvent::find($id); 
        return view('admin/BlzInvest/'.$this->view.'/_form', compact('moduleName', 'BlzEvent'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            // 'EventName' => 'required',    
            'StartDate' => 'required',
            //'EndDate' => 'required', 
        //     'EventTime' => 'required', 			
        //     'EventType' => 'required',          
        //     'EventAddress' => 'required',          
        //   // 'EventImage' => 'required',          
        //     'Description' => 'required',          
        ]); 
      
        $BlzEvent = BlzEvent::find($id);
       if ($request->hasFile('EventImage')) {   
            $image = $request->file('EventImage');
            $imageName = 'event'.time(). '.' . $image->getClientOriginalExtension();
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
            'Event_fees' => $request->Event_fees,
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
