<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlzEvent;
use App\Models\BlzTraining;
use App\Models\Product;
use App\Models\Category;
use App\Models\ClientTestimonial;
use App\Models\BlzFaq;
use App\Models\Brand;
use App\Models\User;
use App\Models\SellerProfile;
use App\Models\Blz_whatwedo;
use App\Models\Blz_team_member;
use App\Models\Blz_resources;
use App\Models\BlzJobsPreparedness;
use App\Models\BlzJobs;
use App\Models\BlzSelfPaced;
use App\Models\Quotations;
use App\Models\BlzLoanSection;
use App\Models\BlzGrantSection;
use App\Models\ProductServices;
use App\Models\TrainningCourse;
use App\Models\TrainningStream;
use App\Models\BlzActiveTraining; 
use App\Models\Event_Registration; 
use App\Models\Training_Registration; 
use App\Models\Request_Assistance;
use App\Models\BlzSellerFaq;   
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    
    public function index()
    {   
        $Session_id = Session::get('member_id');
        $user_session =  User::where('id', $Session_id)->get();
        $EventLists = BlzEvent::where('status',1)->orderBy('id','DESC')->get();
        $TraininginLists = BlzTraining::where('status',1)->where('CourseType',1)->where('TrainingStartDate','>=',DATE('Y-m-d'))->orderBy('id','DESC')->get();
        $ProductLists = Product::where(
                        function($q) {
                            $q->where('status', 1)
                            ->Where('featured', 1);
                        })->orderBy('id','DESC')->get(); 
        $ClientTestimonialLists = ClientTestimonial::where('Status',1)->orderBy('id','DESC')->get();  
        $BrandLists = Brand::orderBy('id','DESC')->get();  
        
        return view('home', compact('user_session','EventLists','TraininginLists','ProductLists','ClientTestimonialLists','BrandLists')); 
    
    }
    public function faq()
    {   
        $Session_id = Session::get('member_id');
        $user_session =  User::where('id', $Session_id)->get();
        $FaqLists = BlzFaq::where('Status',1)->orderBy('id','DESC')->get(); 
        return view('faq_admin', compact('user_session','FaqLists')); 
    
    }
    public function faq_seller()
    {   
        $Session_id = Session::get('member_id');
        $user_session =  User::where('id', $Session_id)->get();
        $FaqLists = BlzSellerFaq::where('Status',1)->orderBy('id','DESC')->get(); 
        return view('faq', compact('user_session','FaqLists')); 
    
    }
    
    public function events_listing()
    {   
        $Session_id = Session::get('member_id');
        $user_session =  User::where('id', $Session_id)->get();
        $EventLists = BlzEvent::where('status',1)->orderBy('id','DESC')->get();
        return view('events_listing', compact('user_session','EventLists')); 
    
    }
    public function events_register($id)
    {   
    	$Session_id = Session::get('member_id');
        $user_session =  User::where('id', $Session_id)->get();
	   	$id=base64_decode($id);
	   	$event_user = User::where('id',$Session_id)->first();
        return view('event_register_form',compact('user_session','event_user')); 
    
    }
	
	public function store_event_regsitration(Request $request)

    {
       
       // $member_id=Session::get('member_id');
        //$member=User::find($member_id);
        
        $request->validate([

            'first_name' => 'required',    
            'email' => 'required',          
            'job_title' => 'required',          
            'organization' => 'required',          
           
        ]); 

     
        
        $trainings = Event_Registration::create([

            
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'country' => $request->country,
            'job_title' => $request->job_title,
            'organization' => $request->organization,
            'event_id' => $request->event_id,
            
           
        ]);
         return redirect()->back()->with('message', 'Event Registration Successfully!');
       
        //return redirect('member/seller/product-details')->withStatus(__('Product is added successfully.'));

    }
    public function store_request_assistance (Request $request)

    {
      
	    $TypeId= base64_decode($request->admin_type);
	  //die();
        $request->validate([

            'name' => 'required',    
            'email' => 'required',          
            'phone' => 'required',   
             

        ]); 

     
        $trainings = Request_Assistance::create([

            
            //'m_id' => $member_id,
            'name' => $request->name,
			'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'business' => $request->business,
            'description' => $request->description,
            'admin_type' => $TypeId,
        ]);

       return redirect()->back()->with('message', 'Request Assistance Successfully!'); 
       // return redirect('member/seller/product-details')->withStatus(__('Product is added successfully.'));

    }
    public function products($cid=NULL)
    {   
        $Session_id = Session::get('member_id');
        $user_session =  User::where('id', $Session_id)->get();
        $ClientTestimonialLists = ClientTestimonial::where('Status',1)->orderBy('id','DESC')->get(); 
        
        $cid=base64_decode($cid);
        
        if($cid){
            $ProductLists = Product::where('status', 1)->where('category_id', $cid)->orderBy('id','DESC')->get(); 
        }else{
            $ProductLists = Product::where('status', 1)->orderBy('id','DESC')->get(); 
        }
        return view('products', compact('user_session','ProductLists','ClientTestimonialLists')); 
    
    }
    
    public function businessdirectory(Request $request,$id=null)
    {   
        $find = User::select('id')->where('user_type','=','seller')->where('name','=',$id)->first();
        if($find != ''){
            $ids = $find->id;
            $product = Product::where('m_id','=',$ids)->first();
            $m_id = $product->m_id;
        }
        else{
            $m_id="";
        }
        
        
        $Session_id = Session::get('member_id');
        $user_session =  User::where('id', $Session_id)->get();
        $ClientTestimonialLists = ClientTestimonial::where('Status',1)->orderBy('id','DESC')->get(); 
        $ProductLists = Product::where('status', 1)->where('featured', 1)->orderBy('id','DESC')->get(); 
        $FaqLists = BlzFaq::where('Status',1)->orderBy('id','DESC')->get(); 
        $BrandLists = Brand::orderBy('id','DESC')->get();  

		$search = $request->search;
		
	    if($search)
	    {
	    $SellerLists= DB::table("users")
                        ->join("seller_profile","users.id","=","seller_profile.seller_id")
                        ->where("users.user_type","seller")
                        ->where("seller_profile.location",$request->search)
                        ->get();
	    }elseif($id)  {
        $SellerLists= DB::table("users")
                        ->join("seller_profile","users.id","=","seller_profile.seller_id")
                        ->where("users.user_type","seller")
                        ->where("users.name",$id)
                        ->get();
	    }else{
	        $SellerLists = User::where('user_type','seller')->where('Status',1)->orderBy('id','DESC')->get();
	    }
        return view('business-directory-beltraide', compact('user_session','ProductLists','m_id','ClientTestimonialLists','FaqLists','BrandLists','SellerLists')); 
    
    }
    
    
    public function Services_search(Request $request)
    {
       
        if($request->get("query"))
        {
            $query = $request->input("query");
            
            $product = DB::table("products")
                    ->join("users","products.m_id","=","users.id")
                    ->join("seller_profile","users.id","=","seller_profile.seller_id")
                    ->select("users.id","users.name as username","users.email","products.name as productsname")
                    ->where('products.name','LIKE',"%{$query}%")
                    ->get();
                    //dd($product);
                    
            $user = DB::table("users")->where('user_type','=','seller')
                    // ->join("products","users.id","=","products.m_id")
                    // ->join("seller_profile","users.id","=","seller_profile.seller_id")
                    ->select("users.id","users.name as username","users.email")
                    ->where('users.name','LIKE',"%{$query}%")
                    ->get();
                     //dd($user);
            
            $output ='<ul class="dropdown" style=" display: block;
            position: relative;
            background: #fff;
            padding: 3px 471px 8px 0px;
            width: 42%;
            margin: auto;
            list-style: none;">';
            if($request->input("search2")=='Users'){
                foreach($user as $row){
                        $output .='<li><a href="/business-directory-beltraide/'.$row->username.'">'.$row->username.'</a></li>';
                }
            }
            elseif($request->input("search2")=='Product'){
                foreach($product as $row){
                    $output .='<li><a href="/business-directory-beltraide/'.$row->username.'">'.$row->productsname.'</a></li>';
                }
            }
            else{
                $output .='<li><a href="/business-directory-beltraide/'.$row->username.'">'.$row->productsname.'</a></li>';
            }
            // foreach($data as $row)
            // {
            //     if($request->search=='Users'){
            //         $output .='<li><a href="/business-directory-beltraide/'.$row->username.'">'.$row->username.'</a></li>';
            //     }
            //     elseif($request->search=='Product'){
            //         $output .='<li><a href="/business-directory-beltraide/'.$row->productsname.'">'.$row->productsname.'</a></li>';
            //     }
            //     else{
            //         $output .='<li><a href="/business-directory-beltraide/'.$row->productsname.'">'.$row->productsname.'</a></li>';
            //     }

            // }
            $output .='</ul>';
            return $output;
        }
    }
      public function Business_Search(Request $request)
    {   

	       $SellerLists= DB::table("seller_profile")
                        ->join("users","seller_profile.seller_id","=","users.id")
                        // ->where("users.user_type","seller")
                        ->where("seller_profile.location",$request->search_area)
                        // ->select("seller_profile.location")
                        ->get(); 

	       return response()->json([
	        'status' => 200,
	        'success' => $SellerLists
	        ]);

    }
    public function exportbelize()
    {   $Session_id = Session::get('member_id');
        $user_session =  User::where('id', $Session_id)->get();
        $WhatwedoLists = Blz_whatwedo::where('status',1)->orderBy('id','DESC')->get();
        $TeamLists = Blz_team_member::where('status',1)->orderBy('id','DESC')->get(); 
        $ResourceLists = Blz_resources::where('status',1)->orderBy('id','DESC')->get(); 
        return view('export_belize', compact('user_session','WhatwedoLists','TeamLists','ResourceLists')); 
    
    }
    public function request_assistance()
    {   
	    $Session_id = Session::get('member_id');
        $user_session =  User::where('id', $Session_id)->get();
        $WhatwedoLists = Blz_whatwedo::where('status',1)->orderBy('id','DESC')->get();
        $TeamLists = Blz_team_member::where('status',1)->orderBy('id','DESC')->get(); 
        $ResourceLists = Blz_resources::where('status',1)->orderBy('id','DESC')->get(); 
        return view('request_assistance_form', compact('user_session','WhatwedoLists','TeamLists','ResourceLists')); 
    
    }
	
	 public function sdbcservices()
    {   
        $Session_id = Session::get('member_id');
        $user_session =  User::where('id', $Session_id)->get();
        $WhatwedoLists = Blz_whatwedo::where('status',1)->orderBy('id','DESC')->get();
        $TeamLists = Blz_team_member::where('status',1)->orderBy('id','DESC')->get(); 
        $ResourceLists = Blz_resources::where('status',1)->orderBy('id','DESC')->get(); 
        return view('sdbc_service', compact('user_session','WhatwedoLists','TeamLists','ResourceLists')); 
    
    }
	 public function belizeinvestservices()
    {   
        $Session_id = Session::get('member_id');
        $user_session =  User::where('id', $Session_id)->get();
        $WhatwedoLists = Blz_whatwedo::where('status',1)->orderBy('id','DESC')->get();
        $TeamLists = Blz_team_member::where('status',1)->orderBy('id','DESC')->get(); 
        $ResourceLists = Blz_resources::where('status',1)->orderBy('id','DESC')->get(); 
        return view('belizeinvest_service', compact('user_session','WhatwedoLists','TeamLists','ResourceLists')); 
    
    }
     public function btecservices()
    {   
        $Session_id = Session::get('member_id');
        $user_session =  User::where('id', $Session_id)->get();
        $WhatwedoLists = Blz_whatwedo::where('status',1)->orderBy('id','DESC')->get();
        $TeamLists = Blz_team_member::where('status',1)->orderBy('id','DESC')->get(); 
        $ResourceLists = Blz_resources::where('status',1)->orderBy('id','DESC')->get(); 
        return view('btec_service', compact('user_session','WhatwedoLists','TeamLists','ResourceLists')); 
    
    }
    
    public function jobs()
    {   
        $Session_id = Session::get('member_id');
        $user_session =  User::where('id', $Session_id)->get();
        $JobPreLists = BlzJobsPreparedness::where('status',1)->orderBy('id','DESC')->get();
        $JobLists = BlzJobs::where('status',1)->orderBy('id','DESC')->get();
        return view('jobs', compact('user_session','JobPreLists','JobLists')); 
    
    }
	
	public function job_detail($id)
    {   
        $id=base64_decode($id);
       $Session_id = Session::get('member_id');
        $user_session =  User::where('id', $Session_id)->get();
        $JobLists = BlzJobs::where('status',1)->where('id', $id)->first();
        return view('job_detail', compact('user_session','JobLists')); 
    
    }
	
	 public function jobs_employment()
    {   
        $Session_id = Session::get('member_id');
        $user_session =  User::where('id', $Session_id)->get();
        $JobPreLists = BlzJobsPreparedness::where('status',1)->orderBy('id','DESC')->get();
        //$JobLists = BlzJobs::where('status',1)->orderBy('id','DESC')->get();
        return view('jobspreparedness', compact('user_session','JobPreLists')); 
    
    }
	
	public function seller_profile($id)
    {   
        $id=base64_decode($id);
        $Session_id = Session::get('member_id');
        $user_id = User::where('name',$id)->select('id')->first();
        $user_session =  User::where('id', $Session_id)->get();
        $SellerProfile = SellerProfile::where('seller_id',$id)->first();
        $SellerData = User::where('id',$id)->first();
        //$SellerData = User::where('name',$id)->first();
        //dd($user_id);
        //  $SellerProfile =  DB::table("users")
        //                         ->join("seller_profile",'users.id',"=","seller_profile.seller_id")
        //                         // ->select("seller_profile.id","seller_profile.*","users.image")
        //                         ->where('seller_profile.seller_id',$id)
        //                         ->first();
        $ClientTestimonialLists = ClientTestimonial::where('Status',1)->orderBy('id','DESC')->get(); 
        $ProductLists = Product::where('status', 1)->where('m_id', $id)->orderBy('id','DESC')->get(); 
        return view('seller_profile', compact('user_session','ProductLists','ClientTestimonialLists','SellerData','SellerProfile')); 
    
    }
    
    public function selfpaced()
    {   
        $Session_id = Session::get('member_id');
        $user_session =  User::where('id', $Session_id)->get();
	    $Stream=TrainningStream::where('status',1)->orderBy('id','DESC')->get();
        $SelfPacedLists = BlzActiveTraining::where('Training_Type',1)->orderBy('id','DESC')->get();
        
        return view('self-paced', compact('user_session','SelfPacedLists','Stream')); 
    
    } 


	
	 public function activetraining()
    {   
        $Session_id = Session::get('member_id');
        $user_session =  User::where('id', $Session_id)->get();
	    $Stream=TrainningStream::where('status',1)->orderBy('id','DESC')->get();
        $ActiveTraining = BlzActiveTraining::where('Training_Type',2)->orderBy('id','DESC')->get();
		
        return view('active_training', compact('user_session','ActiveTraining','Stream')); 
    
    }
	
	public function training_detail($id)
    {   
        $id1=base64_decode($id);
        $Session_id = Session::get('member_id');
        $user_session =  User::where('id', $Session_id)->get();
        $TrainingDetails = BlzActiveTraining::where('status',1)->where('id', $id1)->first();
        $events = array();
            $events[] = [
                'id'   => $TrainingDetails->id,
                'title' => $TrainingDetails->TrainingName,
                'start' => $TrainingDetails->TrainingStartDate,
                'end' => $TrainingDetails->TrainingStartDate,
                'description'=>strip_tags($TrainingDetails->TrainingDescription),
            ];
        return view('training_detail',['user_session'=>$user_session,'TrainingDetails'=>$TrainingDetails,'events'=>$events]); 
    
    }
	public function selfpaced_detail($id)
	
    { 
	  $Session_id = Session::get('member_id');
        $user_session =  User::where('id', $Session_id)->get();
		$id=base64_decode($id);
        $TrainingDetails = BlzSelfPaced::where('status',1)->where('id', $id)->first();
        return view('selfpaced_detail', compact('user_session','TrainingDetails')); 
    
    }
	public function training_registration($id)
    {   
	    $Session_id = Session::get('member_id');
        $user_session =  User::where('id', $Session_id)->get();
	   	$id=base64_decode($id);
	    //$Stream=TrainningStream::where('status',1)->orderBy('id','DESC')->get();
        $user = User::where('id',$Session_id)->first();
        
         return view('training_register_form',compact('user_session','user')); 
        
   
    }
	public function store_training_regsitration(Request $request)

    {
        
       // dd($request->all());
       // $member_id=Session::get('member_id');
        //$member=User::find($member_id);
        
        $request->validate([

            'first_name' => 'required', 
			'last_name' => 'required', 	
            'email' => 'required', 
			'age' => 'required',
			'gender' => 'required', 
			'learn_topic' => 'required',
			
            //'phone' => 'required',   
             

        ]); 
        $Session_id = Session::get('member_id');
        // return $Session_id;
        $trainings = Training_Registration::create([

            //'product_number' => rand(10000,99999),
            'training_id' =>$request->training_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'street_address' => $request->street_address,
            'phone' => $request->phone,
            'gender' => $request->gender,        
            'ethnicity' => $request->ethnicity,
            'business_name' => $request->business_name,
			'ownership_type' => $request->ownership_type,
			
            'business_register' => $request->business_register,           
            'establishment_year' => $request->establishment_year,
            'current_focus' => $request->current_focus,
            'city' => $request->city,       
            'age' => $request->age,
            'learn_topic' => $request->learn_topic,
            'industry' => $request->industry,
            'current_employement' => $request->current_employement,
			'higest_education' => $request->higest_education,
			'user_id' => $Session_id,
            
        ]);

       return redirect()->back()->with('message', 'Training Registration Successfully!'); 
       // return redirect('member/seller/product-details')->withStatus(__('Product is added successfully.'));

    }
    
	 public function supportservices()
    {   
        $Session_id = Session::get('member_id');
        $user_session =  User::where('id', $Session_id)->get();
	    //$Stream=TrainningStream::where('status',1)->orderBy('id','DESC')->get();
        //$SelfPacedLists = BlzSelfPaced::where('status',1)->orderBy('id','DESC')->get();
        return view('support_service',compact('user_session')); 
    
    }
	 public function trainning_calender()
    {   
        $Session_id = Session::get('member_id');
        $user_session =  User::where('id', $Session_id)->get();
	    $Stream=TrainningStream::where('status',1)->orderBy('id','DESC')->get();
        $SelfPacedLists = BlzSelfPaced::where('status',1)->orderBy('id','DESC')->get();
        $events = array();
        $eventDetails =BlzActiveTraining::all();
        foreach($eventDetails as $eventDetail)
        {
            $events[] = [
                'id'   => $eventDetail->id,
                'title' => $eventDetail->Title,
                'start' => $eventDetail->created_at,
                'end' => $eventDetail->updated_at,
                
            ];
        }
        return view('trainning_calender',['user_session'=>$user_session,'SelfPacedLists'=>$SelfPacedLists,'Stream'=>$Stream,'EventDetails'=>$events]); 
    
    }
	
    public function finance_access()
    {   
        $Session_id = Session::get('member_id');
        $user_session =  User::where('id', $Session_id)->get();
        $GrantSection = BlzGrantSection::where('status',1)->orderBy('id','DESC')->get();
		$LoanSection = BlzLoanSection::where('status',1)->orderBy('id','DESC')->get();
        return view('finance-access',compact('user_session','GrantSection','LoanSection')); 
    
    }
	public function services()
    {   
        $Session_id = Session::get('member_id');
        $user_session =  User::where('id', $Session_id)->get();
        $SellerLists = ProductServices::where('Status',1)->orderBy('id','DESC')->get();  
        return view('services',compact('user_session','SellerLists')); 
    
    }
	public function seller_services()
    {   $Session_id = Session::get('member_id');
        $user_session =  User::where('id', $Session_id)->get();
        $SellerLists = ProductServices::where('Status',1)->orderBy('id','DESC')->get();   
        return view('seller_services',compact('user_session','SellerLists')); 
    
    }
	public function product_category()
    {   
	    $Session_id = Session::get('member_id');
        $user_session =  User::where('id', $Session_id)->get();
        $CategoryLists = Category::where('status', 1)->orderBy('id','DESC')->get(); 
        return view('product_sector', compact('user_session','CategoryLists')); 
        
    }
	 public function events_detail($id)
    {   
        
	    $id=base64_decode($id);
	    $Session_id = Session::get('member_id');
        $user_session =  User::where('id', $Session_id)->get();
        $events = array();
        $eventDetails =BlzEvent::where('status',1)->where('id', $id)->first();
            $events[] = [
                'id'   => $eventDetails->id,
                'title' => $eventDetails->EventName,
                'start' => $eventDetails->StartDate,
                'end' => $eventDetails->EndDate,
            ];
        return view('events_detail',['user_session'=>$user_session,'EventDetails'=>$events,'eventDetail'=>$eventDetails]); 
    
    }
	
	
    public function storeRequirements(Request $request){
        
        $request->validate([
            'seller_id' => 'required',
            
            'company' => 'required',
            
            'name' => 'required',  
            
            'service' => 'required',   

            'qty' => 'required',          
            
            'unit' => 'required',          

            'phone' => 'required',          

            'email' => 'required'

        ]); 
        
        $product = Quotations::insert([

            'date' => date('Y-m-d'),
            
            'name' => $request->name,
            
            'seller_id' => $request->seller_id,
            
            'company_name' => $request->company,
            
            'service' => $request->service,

            'qty' => $request->qty,
            
            'unit' => $request->unit,

            'phone' => $request->phone,

            'email' => $request->email,
            
            'created_at' => now(),
            
            'updated_at' => now()

        ]);
        
        return redirect('seller-profile/'.base64_encode($request->seller_id))->with('succ', 'Requirement Submitted Successfully !');;
        
    }
	 public function selfpacedsubmit(Request $request)
    {   
        $Session_id = Session::get('member_id');
        $user_session =  User::where('id', $Session_id)->get();
        $StreamName=$request->StreamName;
	    $CourseName=$request->CourseName;
	    $CourseType=$request->CourseType;
	    
	    $Stream=TrainningStream::where('status',1)->orderBy('id','DESC')->get();
		
	    if($StreamName!='' && $CourseName!='' && $CourseType!=''){
	        $SelfPacedLists = BlzActiveTraining::where('Status',1)->where('StreamName', $StreamName)->where('CourseName', $CourseName)->where('CourseType', $CourseType)->orderBy('id','DESC')->get();
	       
	    }
		elseif($StreamName!='' && $CourseName!=''){
	        $SelfPacedLists = BlzActiveTraining::where('Status',1)->where('StreamName', $StreamName)->where('CourseName', $CourseName)->orderBy('id','DESC')->get();
	    }elseif($StreamName!='' && $CourseType!=''){
	        $SelfPacedLists = BlzActiveTraining::where('Status',1)->where('StreamName', $StreamName)->where('CourseType', $CourseType)->orderBy('id','DESC')->get();
	    }elseif($CourseName!='' && $CourseType!=''){
	        $SelfPacedLists = BlzActiveTraining::where('Status',1)->where('CourseName', $CourseName)->where('CourseType', $CourseType)->orderBy('id','DESC')->get();
	    }elseif($StreamName!=''){
	        $SelfPacedLists = BlzActiveTraining::where('Status',1)->where('StreamName', $StreamName)->orderBy('id','DESC')->get();
	    }elseif($CourseName!=''){
	        $SelfPacedLists = BlzActiveTraining::where('Status',1)->where('CourseName', $CourseName)->orderBy('id','DESC')->get();
	    }elseif($CourseType!=''){
	        $SelfPacedLists = BlzActiveTraining::where('Status',1)->where('CourseType', $CourseType)->orderBy('id','DESC')->get();
	    }else{
	        $SelfPacedLists = BlzActiveTraining::where('Status',1)->orderBy('id','DESC')->get();
	    }
       // print_r($SelfPacedLists);
		//die();
        return view('self-paced', compact('user_session','SelfPacedLists','Stream')); 
    
    }
	
	public function activetrainingsubmit(Request $request)
    {   
        $Session_id = Session::get('member_id');
        $user_session =  User::where('id', $Session_id)->get();
        $StreamName=$request->StreamName;
	    $CourseName=$request->CourseName;
	    $CourseType=$request->CourseType;
	    
	    $Stream=TrainningStream::where('status',1)->orderBy('id','DESC')->get();
		
	    
	    if($StreamName!='' && $CourseName!='' && $CourseType!=''){
	        $ActiveTraining = BlzActiveTraining::where('Status',1)->where('StreamName', $StreamName)->where('CourseName', $CourseName)->where('CourseType', $CourseType)->orderBy('id','DESC')->get();
	    }elseif($StreamName!='' && $CourseName!=''){
	        $ActiveTraining = BlzActiveTraining::where('Status',1)->where('StreamName', $StreamName)->where('CourseName', $CourseName)->orderBy('id','DESC')->get();
	    }elseif($StreamName!='' && $CourseType!=''){
	        $ActiveTraining = BlzActiveTraining::where('Status',1)->where('StreamName', $StreamName)->where('CourseType', $CourseType)->orderBy('id','DESC')->get();
	    }elseif($CourseName!='' && $CourseType!=''){
	        $ActiveTraining = BlzActiveTraining::where('Status',1)->where('CourseName', $CourseName)->where('CourseType', $CourseType)->orderBy('id','DESC')->get();
	    }elseif($StreamName!=''){
	        $ActiveTraining = BlzActiveTraining::where('Status',1)->where('StreamName', $StreamName)->orderBy('id','DESC')->get();
	    }elseif($CourseName!=''){
	        $ActiveTraining = BlzActiveTraining::where('Status',1)->where('CourseName', $CourseName)->orderBy('id','DESC')->get();
	    }elseif($CourseType!=''){
	        $ActiveTraining = BlzActiveTraining::where('Status',1)->where('CourseType', $CourseType)->orderBy('id','DESC')->get();
	    }else{
	        $ActiveTraining = BlzActiveTraining::where('Status',1)->orderBy('id','DESC')->get();
	    }
        
        return view('active_training', compact('user_session','ActiveTraining','Stream')); 
    
    }
    
    //serching
 
    
    public function contactus(Request $request){
        $request->validate([
            'name' => 'required',
            
            'email' => 'required',
            
            'mobile' => 'required',  
            
            'message' => 'required'

        ]); 
        
        $contact = DB::table('contactus')->insert([
            'name' => $request->name,
            
            'email' => $request->email,
            
            'mobile_no' => $request->mobile,
            
            'message' => $request->message,
            ]);
        if($contact==true){
            return back()->with('succ','Query Submitted Successfully.');
        }
        else{
            return back()->with('error', 'Some error occured while submitting.');
        }
    }
	public function autocomplete(Request $request)
    {
        $input = $request->all();

        $data = Country::select("nicename")
                ->where("nicename","LIKE","%{$input['query']}%")
                ->get();
   
      $countries = [];
      
      if(count($data) > 0){

            foreach($data as $country){
                $countries[] = $country->nicename;
            }
        }        
        return response()->json($countries);
    }

    
}
