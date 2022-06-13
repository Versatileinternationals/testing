<?php

namespace App\Http\Controllers;
use Validator;
use Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
use App\Models\BuyerProfile;
use Excel;

class BuyerPanelController extends Controller
{
    public $route="member/product-details";

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
        return view('member/buyer/dashboard',compact('member','user_session'));
        }
    }
    
    public function viewsettings()
    {        
        $member_id=Session::get('member_id');
	   $user_session =  User::where('id', $member_id)->get();
       
        if($member_id=="")
        {
         return redirect("/");   
        }else{
             $member=User::find($member_id);
        if($member->user_type == 'buyer' && BuyerProfile::where('buyer_id', $member_id)->count() > 0){
            $sellerData=BuyerProfile::where('buyer_id', $member_id)->first();
        }
		else
		{
            $sellerData= NULL;
        }
        $country= DB::table("country")->get();
        return view('member/buyer/settings',compact('user_session','member', 'sellerData','country'));
        }
    }
    
   
    
    public function productdetails()

    {        
        $member_id=Session::get('member_id');
        $member=User::find($member_id);
        $user_session =  User::where('id', $member_id)->get();
        $moduleName = $this->moduleName;                

        $products = Product::with(['category','subcategory','brandData'])->where("m_id",$member_id)->orderBy('id','DESC')->get();  
if($member_id=="")
        {
         return redirect("/");   
        }else{
        return view('member/buyer/product-details', compact('user_session','moduleName', 'products', 'member'));
        }

    }
    
    public function BuyerQuotation()

    {        
        //$member_id=Session::get('member_id');
       // $member=User::find($member_id);
        $moduleName = 'Buyer Quotation Lists';                
        //$data = Quotations::where("buyer_id",$member_id)->orderBy('id','DESC')->get();  
        return view('member/buyer/quotationslists');

    }
    public function BuyerOrder()

    {        
        $member_id=Session::get('member_id');
        $member=User::find($member_id);
        $user_session =  User::where('id', $member_id)->get();
        $moduleName = 'Buyer Order Lists';                
        $data = Quotations::all(); 
        // dd($data);
        if($member_id=="")
        {
         return redirect("/");   
        }else{
        return view('member/buyer/orderlist',compact("data","user_session","member"));
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
        
        if($member->user_type == 'buyer'){
            
            if ($request->hasFile('banner')) {   

                $banner = $request->file('banner');
    
                $name1 = uniqid() . '.' . $banner->getClientOriginalExtension();
    
                $destinationPath1 = public_path('/assets/images/upload');
    
                $banner->move($destinationPath1, $name1);         
    
                $profile_data['banner'] = $name1;
                
    
            }
            
            // $profile_data['est_date'] = $request->est_date;
            // $profile_data['store_name'] = $request->store_name;
            // $profile_data['description'] = $request->description;
            // $profile_data['fax'] = $request->fax;
            // $profile_data['store_email'] = $request->store_email;
            // $profile_data['website_url'] = $request->website_url;
             $profile_data['country'] = $request->country;
              $profile_data['location'] = $request->location;
            
            
            if(BuyerProfile::where('buyer_id', $member_id)->count() > 0) {
                BuyerProfile::where('buyer_id', $member_id)->update($profile_data); 
            }else{
                BuyerProfile::create($profile_data);
            }
             
            
        }
        
        return back()->with('succ', 'Profile updated successfully!');
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
