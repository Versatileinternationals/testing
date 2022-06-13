<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Imports\ProductImport;
use App\Models\Category;
use App\Models\ProductSpecification;
use App\Models\SubCategory;
use App\Models\Brand;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Quotations;
use App\Models\InvestoProfile;
use App\Models\investor_concept;
use App\Models\Investor_profile_concept;
use Excel;

class InvestorPanelController extends Controller
{
    public $route="member/investor/product-details";

    public $view ="product";

    public $moduleName = 'Product';
    
    
    public function index()
    {    
        $member_id=Session::get('member_id');
        $member=User::find($member_id);
        
        $user_session =  User::where('id', $member_id)->get();
       if($member_id=="")
        {
         return redirect("/");   
        }else{
        return view('member/investor/dashboard',compact('member','user_session'));
        }
    }
    
    public function viewsettings()
    {        
        $member_id=Session::get('member_id');
        $user_session =  User::where('id', $member_id)->get();
        // $sellerData=InvestoProfile::where('Investor_id', $member_id)->first();
        //     dd($member_id);
        
        if($member_id=="")
        {
         return redirect("/");   
        }else{
            $member=User::find($member_id);
        if($member->user_type == 'investor' && InvestoProfile::where('Investor_id', $member_id)->count() > 0){
            
            $sellerData=InvestoProfile::where('Investor_id', $member_id)->first();
            // dd($sellerData);
        }else{
            $sellerData= NULL;
        }
        $country= DB::table("country")->get();
        return view('member/investor/settings',compact('user_session','country','member', 'sellerData'));
        }
    }
    
   
   
   
    public function ProjectProfile()

    {        
        $member_id=Session::get('member_id');
        $user_session =  User::where('id', $member_id)->get();
        $member=User::find($member_id);
        $moduleName = $this->moduleName;                
        $ProjectProfile = Product::with(['category','subcategory','brandData'])->where("m_id",$member_id)->orderBy('id','DESC')->get(); 
        if($member_id=="")
        {
         return redirect("/");   
        }else{
        return view('member/investor/add-project-profile', compact('user_session','moduleName', 'ProjectProfile'));
        }
    }
    
    public function investment_project()

    {        
        $member_id=Session::get('member_id');
        $user_session =  User::where('id', $member_id)->get();
        $member=User::find($member_id);
        
        $moduleName = 'Sellers Quotation Lists';                

        $data = Quotations::where("seller_id",$member_id)->orderBy('id','DESC')->get();  
        if($member_id=="")
        {
         return redirect("/");   
        }else{

        return view('member/investor/add-project-profile', compact('user_session','moduleName', 'data', 'member'));
        }

    }
	public function investment_concept()

    {        
        $member_id=Session::get('member_id');
        $user_session =  User::where('id', $member_id)->get();
        $member=User::find($member_id);
        
        $moduleName = 'Sellers Quotation Lists';                

        $data = Quotations::where("seller_id",$member_id)->orderBy('id','DESC')->get();  
if($member_id=="")
        {
         return redirect("/");   
        }else{
        return view('member/investor/add-concept-profile', compact('user_session','moduleName', 'data', 'member'));
        }

    }
    function investor_Concept_Profile()
    {
        $investor = investor_concept::all();
        if($member_id=="")
        {
         return redirect("/");   
        }else{
        
        return view("member/investor/investor_Concept_Profile",compact("investor"));
        }
    }
    function investment_delete($id)
    {
        $delete=investor_concept::find(decrypt($id));
        $delete->delete();
        if($delete)
        {
        return response()->json([
            'status' => 200,
            'success' => "Record deleted successfully"
            ]);
        }
    }
    function investment_edit($id)
    {
      $edit_investor=investor_concept::find(decrypt($id));
        if($member_id=="")
        {
         return redirect("/");   
        }else{
        return view("member/investor/edit_investor_concept",compact("edit_investor"));
        }
     
    }
    function investment_update(Request $request,$id)
    {
       $validator = Validator::make($request->all(),[
            'Government_name' => 'required',
            'Department' => 'required',
            'LeadPoint' => 'required',
            'job_title' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'mobile' => 'required',
            'concept_name' => 'required',
            'Department_Agency' => 'required',
            'Reference' => 'required',
        ]);
        if($validator->fails())
        {
            return redirect('/investor/create-concept')
                        ->withErrors($validator)
                        ->withInput();
        }
        else{
           $investor_concept = investor_concept::find(decrypt($id));
           $investor_concept->Government_name = $request->input('Government_name');
           $investor_concept->Department = $request->input('Department');
           $investor_concept->LeadPointof = $request->input('LeadPoint');
           $investor_concept->Job_Title = $request->input('job_title');
           $investor_concept->email = $request->input('email');
           $investor_concept->phone = $request->input('phone');
           $investor_concept->mobile = $request->input('mobile');
           $investor_concept->maling_address = $request->input('mailing_address');
           $investor_concept->city = $request->input('city');
           $investor_concept->skyp_id = $request->input('skyp_id');
           $investor_concept->Concept_Name = $request->input('concept_name');
           $investor_concept->Description = $request->input('Description');
           $investor_concept->Marketing_Channels = $request->input('Marketing');
           $investor_concept->Socio_Economic = $request->input('Socio_Economic');
           $investor_concept->Data_Justification = $request->input('data_justification');
           $investor_concept->Agency = $request->input('Department_Agency');
           $investor_concept->Components = $request->input('Components');
           $investor_concept->Reference = $request->input('Reference');
           $investor_concept->update();
           return redirect('/investor/investor_concept_detail')->with('message',"successfull updated");
        }  
    }
	function investment_concept_add(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'Government_name' => 'required',
            'Department' => 'required',
            'LeadPoint' => 'required',
            'job_title' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'mobile' => 'required',
            'concept_name' => 'required',
            'Department_Agency' => 'required',
            'Reference' => 'required',
        ]);
        if($validator->fails())
        {
            return redirect('/investor/create-concept')
                        ->withErrors($validator)
                        ->withInput();
        }
        else{
           $investor_concept = new investor_concept();
           $investor_concept->Government_name = $request->input('Government_name');
           $investor_concept->Department = $request->input('Department');
           $investor_concept->LeadPointof = $request->input('LeadPoint');
           $investor_concept->Job_Title = $request->input('job_title');
           $investor_concept->email = $request->input('email');
           $investor_concept->phone = $request->input('phone');
           $investor_concept->mobile = $request->input('mobile');
           $investor_concept->maling_address = $request->input('mailing_address');
           $investor_concept->city = $request->input('city');
           $investor_concept->skyp_id = $request->input('skyp_id');
           $investor_concept->Concept_Name = $request->input('concept_name');
           $investor_concept->Description = $request->input('Description');
           $investor_concept->Marketing_Channels = $request->input('Marketing');
           $investor_concept->Socio_Economic = $request->input('Socio_Economic');
           $investor_concept->Data_Justification = $request->input('data_justification');
           $investor_concept->Agency = $request->input('Department_Agency');
           $investor_concept->Components = $request->input('Components');
           $investor_concept->Reference = $request->input('Reference');
           $investor_concept->save();
           return redirect('/investor/create-concept')->with('message',"successfull added");
        }
    }
    
    public function updateprofile(Request $request)
    {
        $member_id=Session::get('member_id');
        $member=User::find($member_id);
        
        $request->validate([
            'name' => 'required',  
            'last_name' => 'required',  
            'email' => 'required',                    
            'phone' => 'required',     
                       
        ]);  
        
        $data = $request->all();  
        
        if ($request->hasFile('avatar')) {   

            $image = $request->file('avatar');

            $name = uniqid() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('/assets/images/upload');

            $image->move($destinationPath, $name);         

            $data['image'] = $name;
            

        }  
        
        $data['name'] = ucfirst($request->name);   
        
        User::find($member->id)->update($data);  
        
        if($member->user_type == 'investor'){
            
            if ($request->hasFile('banner')) {   

                $banner = $request->file('banner');
    
                $name1 = uniqid() . '.' . $banner->getClientOriginalExtension();
    
                $destinationPath1 = public_path('/assets/images/upload');
    
                $banner->move($destinationPath1, $name1);         
    
                $profile_data['banner'] = $name1;
                
    
            }
            
            $profile_data['est_date'] = $request->est_date;
            $profile_data['store_name'] = $request->store_name;
            $profile_data['description'] = $request->description;
            $profile_data['fax'] = $request->fax;
            $profile_data['store_email'] = $request->store_email;
            $profile_data['website_url'] = $request->website_url;
            $profile_data['location'] = $request->location;
            $profile_data['country'] = $request->country;
            $profile_data['store_address'] = $request->store_address;
                       
            
            if(InvestoProfile::where('Investor_id', $member_id)->count() > 0) {
                InvestoProfile::where('Investor_id', $member_id)->update($profile_data); 
            }else{
                InvestoProfile::create($profile_data);
            }
             
            
        }
        
        return back()->with('succ', 'Profile updated successfully!');
    }
    
    function investment_profile()
    {
        dd("hello");
        $member_id=Session::get('member_id');
        $member=User::find($member_id);
        if($member->user_type == 'seller' && SellerProfile::where('seller_id', $member_id)->count() > 0){
            $sellerData=SellerProfile::where('seller_id', $member_id)->first();
        }else{
            $sellerData= NULL;
        }
        
        return view('member/investor/settings',compact('member', 'sellerData'));
    }
    public function password(Request $request)
    {
        $request->validate([
            'opassword' => 'required',                         
            'password' => 'required|min:6',                    
            'cpassword' => 'required|min:6'
        ]);  
        
        if($request->password==$request->cpassword){
            
            if(Hash::check($request->opassword, $member->password)){
                $data['password'] = Hash::make($request->password);     
                User::find($member->id)->update($data);        
                return back()->with('succ', 'Password updated successfully!');
            }
            else
            {
                return back()->with('error', 'Wrong current password!');
            }
        
        }
        else
        {
            return back()->with('error', 'Verify password not matched!');
        }
        
    }
    
    public function doLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password'  => 'required|alphaNum|min:3'
        ]);
        
        $user_data = array(
            'email'  => $request->get('email'),
            'password' => $request->get('password')
        );
        
        
        if(Auth::attempt($user_data))
        {
            $member=Auth::User();
            
            if($member->user_type=='seller'){
            
                Session::put('member_id', $member->id);
                return redirect('/seller');
                
            }elseif($member->user_type=='buyer'){
                
                Session::put('member_id', $member->id);
                return redirect('/buyer');
                
            }elseif($member->user_type=='trainee'){
                
                Session::put('member_id', $member->id);
                return redirect('/trainee');
                
            }elseif($member->user_type=='investor'){
                
                Session::put('member_id', $member->id);
                return redirect('/investor');
                
            }else{
                Auth::logout();
                return back()->with('error', 'Choosen User is not allowed!!!');
            }
        }
        else
        {
            return back()->with('error', 'Wrong Login Details');
        }
    }
    
    public function doRegister(Request $request)
    {
        
        if($request->password==$request->cpassword){
            
            $request->validate([
                'name' => 'required',   
                'last_name' => 'required',   
                'email' => 'required|unique:users',           
                'phone' => 'required|min:10|max:10',     
                'password' => 'required|min:6'   
            ]);  
            $data = $request->all();
            $data['name'] = ucfirst($request->name);
            $data['last_name'] = ucfirst($request->last_name);
            $data['password'] = Hash::make($request->password);
            $data['user_id'] = rand(10000,99999);
            $data['image'] = 'default.png';
            $data['provider'] = 'LOCAL';
            
            if(User::create($data))
            {
                return back()->with('succ', 'Registration successfull!!');
            }
            else
            {
                return back()->with('error', 'Please enter details correctly!!');
            }
            
        }
        else
        {
            return back()->with('error', 'Verify password didnot match!!');
        }
        
        
    }
    function investment_create(Request  $request)
    {
        $inve = new Investor_profile_concept();
        $inve->account_type  = $request->account_type;
        $inve->account_team_size  = $request->account_team_size;
        $inve->business_name  = $request->business_name;
        $inve->card_name  = $request->card_name;
        $inve->save();
        return response()->json([
            'status' => 200,
            'success' => "Record successfully added"
            ]);
    }
    public function logout(Request $request) {
        $id= Session::get('member_id');
        $isOnlineStatus=User::find($id);
        $isOnlineStatus->IsOnline = false;
        $isOnlineStatus->update();
        if (session()->has('member_id')) {
            session()->forget('member_id');
            session()->pull('member_id', null);
        }
        return redirect('/');
    }
    
}
