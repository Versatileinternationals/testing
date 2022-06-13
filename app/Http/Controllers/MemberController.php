<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
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
use App\Models\SellerProfile;
use App\Models\TraineeProfile;
use App\Models\BuyerProfile;
use App\Models\InvestoProfile;
use Excel;
use Auth;
use Mail;


class MemberController extends Controller
{
    public $route="member/product-details";

    public $view ="product";

    public $moduleName = 'Product';
    
    
    public function index()
    {    
        $member_id=Session::get('member_id');
        $member=User::find($member_id);
        
        return view('member/dashboard',compact('member'));
    }
    
    public function viewsettings()
    {        
        $member_id=Session::get('member_id');
        $member=User::find($member_id);
        if($member->user_type == 'seller' && SellerProfile::where('seller_id', $member_id)->count() > 0){
            $sellerData=SellerProfile::where('seller_id', $member_id)->first();
        }else{
            $sellerData= NULL;
        }
        
        return view('member/settings',compact('member', 'sellerData'));
    }
    
    public function addproduct()
    {       
        $member_id=Session::get('member_id');
        $member=User::find($member_id);
        
        $moduleName = $this->moduleName;  

        $category = Category::where('status',1)->get();

        $brand = Brand::where('status',1)->get();

        $products = Product::where('status',1)->orderBy('id','DESC')->get();

        return view('member/add-product', compact('moduleName', 'category','brand','products','member'));

    }
    
    public function store(Request $request)

    {
        
        $member_id=Session::get('member_id');
        $member=User::find($member_id);
        
        $request->validate([

            'name' => 'required',    

            'category_id' => 'required',          

            'subcategory_id' => 'required',          

            'sku' => 'required|unique:products',          

            //'brand' => 'required',          

            'sale_price' => 'required',          

            'regular_price' => 'required',          

           // 'short_description' => 'required',          

            'description' => 'required',          

            'stock' => 'required', 

            'minimum_stock' => 'required',         

            //'page_title' => 'required',          

            //'page_description' => 'required',          

           // 'page_keywords' => 'required',          

            'main_image' => 'required', 

           // 'key' => 'required|array',   

           // 'value' => 'required|array',    

           // 'key.*' => 'required',   

           // 'value.*' => 'required',   

            'max_order_qty' => 'required',        

        ]); 

     

        if ($request->hasFile('main_image')) {   

            $image = $request->file('main_image');

            $name = uniqid() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('/assets/images/upload');

            $image->move($destinationPath, $name);         

            $main_image = $name;

        }  

        
        $product = Product::create([

            'product_number' => rand(10000,99999),
            
            'm_id' => $member_id,
            
            'name' => $request->name,

            'category_id' => $request->category_id,

            'subcategory_id' => $request->subcategory_id,

            'sku' => $request->sku,

            //'brand' => $request->brand,

            'sale_price' => $request->sale_price,

            'regular_price' => $request->regular_price,

           // 'short_description' => $request->short_description,

            'description' => $request->description,

            'stock' => $request->stock,

            'minimum_stock' => $request->minimum_stock,

            //'page_title' => $request->page_title,

           // 'page_description' => $request->page_description,

           // 'page_keywords' => $request->page_keywords,

           // 'sale_start_date' => $request->sale_start_date,

           // 'sale_end_date' => $request->sale_end_date,

            'weight' => $request->weight,

            'length' => $request->length,

            'width' => $request->width,

            'height' => $request->height,

           // 'colors' => $request->colors,

            'tags' => $request->tags,

            'status' => $request->status,

            //'shipping_class' => $request->shipping_class,

            //'purchase_note' => $request->purchase_note,

           // 'button_text' => $request->button_text,

            'main_image' => $main_image,

            'max_order_qty' => $request->max_order_qty,

           // 'allow_customer_review' => $allow_customer_review,

           // 'sold_avaliable' => $sold_avaliable,

           // 'allow_return' => $allow_return,

           // 'related_product' => $related_product,

           

        ]);

        
        return redirect($member->user_type.'/product-details')->withStatus(__('Product is added successfully.'));

    }
    
    public function edit($id){
        
        $member_id=Session::get('member_id');
        $member=User::find($member_id);
        
        $moduleName = $this->moduleName;  

        $product = Product::find(decrypt($id));

        $category = Category::where('status',1)->get();

        $brand = Brand::where('status',1)->get();

        $products = Product::where('id','!=',decrypt($id))->where('status',1)->orderBy('id','DESC')->get();

        $product->specification = ProductSpecification::where('product_id', decrypt($id))->get();

       

        $subcategory = SubCategory::where('category_id',$product->category_id)->get();

        return view('member/edit-product', compact('moduleName', 'product','category', 'products','subcategory', 'brand' ,'member'));

    }
    
    public function update(Request $request,$id)

    {
        $member_id=Session::get('member_id');
        $member=User::find($member_id);
        
        $request->validate([

            'name' => 'required',    

            'category_id' => 'required',          

            'subcategory_id' => 'required',          

            'sku' =>  'required|unique:products,sku,'.$id,  

            //'brand' => 'required',          

            'sale_price' => 'required',          

            'regular_price' => 'required',          

           // 'short_description' => 'required',          

            'description' => 'required',          

            'stock' => 'required', 

            'minimum_stock' => 'required',         

           // 'page_title' => 'required',          

           // 'page_description' => 'required',          

          //  'page_keywords' => 'required',    

            'max_order_qty' => 'required',        

           

        ]); 

      

        $pro = Product::find($id);

        if ($request->hasFile('main_image')) {   

            $image = $request->file('main_image');

            $name = uniqid() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('/assets/images/upload');

            $image->move($destinationPath, $name);         

            $main_image = $name;

        }  

        else{

            $main_image = $pro->main_image;

        }

        
     

        $product = Product::find($id)->update([

            'name' => $request->name,

            'category_id' => $request->category_id,

            'subcategory_id' => $request->subcategory_id,

            'sku' => $request->sku,

            'brand' => $request->brand,

            'sale_price' => $request->sale_price,

            'regular_price' => $request->regular_price,

            //'short_description' => $request->short_description,

            'description' => $request->description,

            'stock' => $request->stock,

            'minimum_stock' => $request->minimum_stock,

           // 'page_title' => $request->page_title,

           // 'page_description' => $request->page_description,

           // 'page_keywords' => $request->page_keywords,

           // 'sale_start_date' => $request->sale_start_date,

           // 'sale_end_date' => $request->sale_end_date,

            'weight' => $request->weight,

            'length' => $request->length,

            'width' => $request->width,

            'height' => $request->height,

           // 'colors' => $request->colors,

            'tags' => $request->tags,

            'status' => $request->status,

            //'shipping_class' => $request->shipping_class,

            //'purchase_note' => $request->purchase_note,

            //'button_text' => $request->button_text,

            'main_image' => $main_image,

            'max_order_qty' => $request->max_order_qty,

           // 'allow_customer_review' => $allow_customer_review,

           // 'sold_avaliable' => $sold_avaliable,

           // 'allow_return' => $allow_return,

            //'related_product' => $related_product,

           

        ]);


        return redirect($member->user_type.'/product-details')->withStatus(__('Product is updated successfully.'));

    }
    
    public function productdetails()

    {        
        $member_id=Session::get('member_id');
        $member=User::find($member_id);
        
        $moduleName = $this->moduleName;                

        $products = Product::with(['category','subcategory','brandData'])->where("m_id",$member_id)->orderBy('id','DESC')->get();  

        return view('member/product-details', compact('moduleName', 'products', 'member'));

    }
    
    public function quotationslists()

    {        
        $member_id=Session::get('member_id');
        $member=User::find($member_id);
        
        $moduleName = 'Sellers Quotation Lists';                

        $data = Quotations::where("seller_id",$member_id)->orderBy('id','DESC')->get();  

        return view('member/quotationslists', compact('moduleName', 'data', 'member'));

    }
    
    public function updateprofile(Request $request)
    {
        $member_id=Session::get('member_id');
        $member=User::find($member_id);
        
        $request->validate([
            'name' => 'required',  
            'last_name' => 'required',  
            'email' => 'required|unique:users,email,'.$member_id,                    
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
        
        if($member->user_type == 'seller'){
            
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
            
            
            if(SellerProfile::where('seller_id', $member_id)->count() > 0) {
                SellerProfile::where('seller_id', $member_id)->update($profile_data); 
            }else{
                SellerProfile::create($profile_data);
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
    public function do_Login(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password'  => 'required|alphaNum|min:3'
        ]);
        
        $user_data = array(
            'email'  => $request->get('email'),
            'password' => $request->get('password')
        );
          
        // $usertype = DB::table("users")->where('user_type',$request->usertype)->where('email',$request->email)->exists();
          
        if(Auth::attempt($user_data))
        {
            $user=User::select('email_verified_at')->where('email',$request->email)->get();
            if(auth()->user()->email_verified_at==null){
                return redirect('/email/verify');
            }
            else
            {
                $member=Auth::User();
			
                $member_id=Session::get('member_id');
                if(User::where('email',$request->email)->get()->count()==1){ 
				
                    if($member->user_type=='seller'){
						$member= DB::table("users")->where('user_type','seller')->where('email',$request->email)->first();
						 //$userdata = User::where("email",$request->email)->where("user_type",'seller')->get();  
						 
						
                        //if(User::where('email',$request->email))
						if(User::where('email',$request->email)  && $member->status==1)
							{
							
						
                                $isOnlineStatus=User::find($member->id);
                                $isOnlineStatus->IsOnline = true;
                                $isOnlineStatus->update();
                                Session::put('member_id', $member->id);
                                return redirect('/');
                           
                        }
                        else{
							
                            return back()->with('error', 'Seller not approved by Admin!!!');  
                        }
                        
                    }elseif($member->user_type=='buyer'){
                        if($usertype==false){
                            Session::put('member_id', $member->id);
                            $isOnlineStatus=User::find($member->id);
                            $isOnlineStatus->IsOnline = true;
                            $isOnlineStatus->update();
                            return redirect('/');
                        }
                        else{
                            return back()->with('error', 'Choosen User is not allowed!!!');
                        }
                    }elseif($member->user_type=='trainee'){
                        if($usertype==false){
                            Session::put('member_id', $member->id);
		    	        	$isOnlineStatus=User::find($member->id);
                            $isOnlineStatus->IsOnline = true;
                            $isOnlineStatus->update();
                            return redirect('/');
                        }
                        else{
                            return back()->with('error', 'Choosen User is not allowed!!!');
                        }                    
                    }elseif($member->user_type=='investor'){
                        if($usertype==false){
                            Session::put('member_id', $member->id);
		    	        	$isOnlineStatus=User::find($member->id);
                            $isOnlineStatus->IsOnline = true;
                            $isOnlineStatus->update();
                            return redirect('/');
                        }
                        else{
                            return back()->with('error', 'Choosen User is not allowed!!!');
                        }
                    }else{
                        Auth::logout();
                        return back()->with('error', 'Choosen User is not allowed!!!');
                    }
                }
                elseif($email=User::where('email',$request->email)->first())
				{
                    //  return redirect("SwitchToAccount",compact('email'));
                    Session::put('email', $email->id);
                    return view('SwitchToAccount',compact('email'));
                }
                else{
                    Auth::logout();
                    return back()->with('error', 'Not approved by admin!!!');
                }
            }
            
        }
        else
        {
            return back()->with('error', 'Wrong Login Details');
        }
        
    }
     

    // public function SwitchToAccount(Request $request)
    // {
    //     return view('SwitchToAccount');
    // }  
    public function SwitchToAccountLogin(Request $request)
    {
        
        $this->validate($request, [
            'email'   => 'required|email',
            'usertype'   => 'required',
        ]);
        $user_data = array(
            'email'  => $request->get('email'),
            'user_type' => $request->get('usertype')
        );
        
        $usertype = DB::table("users")->where('user_type',$request->usertype)->where('email',$request->email)->exists();
        
        if(Auth::User($user_data))
        {
         if(DB::table("users")->where('user_type',$request->usertype)->where('email',$request->email)->exists())
         {
           if($member= DB::table("users")->where('user_type',$request->usertype)->where('email',$request->email)->first())
           {
            // print_r($member->user_type);die;
            if($member->user_type=='seller'){
                if($member->status==1){
                if($usertype==true){
                $isOnlineStatus=User::find($member->id);
                $isOnlineStatus->IsOnline = true;
                $isOnlineStatus->update();
                
                Session::put('member_id', $member->id);
                return redirect('/');
                }
                else{
                    return redirect('/')->with('error', 'Choosen User is not allowed!!!');
                }
                }
                else{
                    return redirect('/user/login')->with('error', 'User not approved by admin.!!!');
                }
            }
            elseif($member->user_type=='buyer'){
                if($member->status==1){
                if($usertype==true){
                Session::put('member_id', $member->id);
                $isOnlineStatus=User::find($member->id);
                $isOnlineStatus->IsOnline = true;
                $isOnlineStatus->update();
                
                return redirect('/');
                }
                else{
                    return redirect('/')->with('error', 'Choosen User is not allowed!!!');
                }
                }
                else{
                    return redirect('/user/login')->with('error', 'User not approved by admin.!!!');
                }
                
            }elseif($member->user_type=='trainee'){
                if($member->status==1){
                if($usertype==true){
                Session::put('member_id', $member->id);
				$isOnlineStatus=User::find($member->id);
                $isOnlineStatus->IsOnline = true;
                $isOnlineStatus->update();
                return redirect('/');
                }
                else{
                    return redirect('/')->with('error', 'Choosen User is not allowed!!!');
                }
                }
                else{
                    return redirect('/user/login')->with('error', 'User not approved by admin.!!!');
                }
                
            }elseif($member->user_type=='investor'){
                if($member->status==1){
                if($usertype==true){
                Session::put('member_id', $member->id);
				$isOnlineStatus=User::find($member->id);
                $isOnlineStatus->IsOnline = true;
                $isOnlineStatus->update();
                return redirect('/');
                }
                else{
                    return redirect('/')->with('error', 'Choosen User is not allowed!!!');
                }
                }
                else{
                    return redirect('/user/login')->with('error', 'User not approved by admin.!!!');
                }
                
            }else{
                Auth::logout();
                return redirect('/')->with('error', 'Choosen User is not allowed!!!');
            }
        }
    }
    else{
        return redirect('/')->with('error', 'Choosen User is not allowed!!!');
    }
        }
        else
        {
            return redirect("google.com");
        }
    }
    
    
     public function Login_switch(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'usertype'   => 'required',
        ]);
        $user_data = array(
            'email'  => $request->get('email'),
            'user_type' => $request->get('usertype')
        );
        
        if(Auth::User($user_data))
        {
         if(DB::table("users")->where('user_type',$request->usertype)->where('email',$request->email)->exists())
         {
           if($member= DB::table("users")->where('user_type',$request->usertype)->where('email',$request->email)->first())
           {
            
            
            
            if($member->user_type=='seller'){
                if($member->status==1){
               
                $isOnlineStatus=User::find($member->id);
                $isOnlineStatus->IsOnline = true;
                $isOnlineStatus->update();
               
                Session::put('member_id', $member->id);
                return redirect('/seller');
                }
                else{
                    return back()->with('error','Seller not approved by admin.');
                }
            
            }
            elseif($member->user_type=='buyer'){
                if($member->status==1){
               
                Session::put('member_id', $member->id);
                $isOnlineStatus=User::find($member->id);
                $isOnlineStatus->IsOnline = true;
                $isOnlineStatus->update();
                
                return redirect('/buyer');
                }
                else{
                    return back()->with('error','Buyer not approved by admin.');
                }

            }elseif($member->user_type=='trainee'){
                if($member->status==1){
                
                Session::put('member_id', $member->id);
				$isOnlineStatus=User::find($member->id);
                $isOnlineStatus->IsOnline = true;
                $isOnlineStatus->update();
                return redirect('/trainee');
                }
                else{
                    return back()->with('error','Trainee not approved by admin.');
                }

            }elseif($member->user_type=='investor'){
                if($member->status==1){
               
                Session::put('member_id', $member->id);
				$isOnlineStatus=User::find($member->id);
                $isOnlineStatus->IsOnline = true;
                $isOnlineStatus->update();
                return redirect('/investor');
                }
                else{
                    return back()->with('error','Investor not approved by admin.');
                }

            }else{
                //Auth::logout();
                return back()->with('error', 'Choosen User is not allowed!!!');
            }
        }
    }
    else{
        return back()->with('error', 'Choosen User is not allowed!!!');
    }
    
        }
        else
        {
            return redirect("google.com");
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
        
        $user=User::where(['email'=>$request->input('email')])->first();
        dd($user);
        
        
        
        if(Auth::attempt($user_data))
        {
            $member=Auth::User();
            $member_id=Session::get('member_id');
            if($member->user_type=='seller'){
                $isOnlineStatus=User::find($member->id);
                $isOnlineStatus->IsOnline = true;
                $isOnlineStatus->update();
                Session::put('member_id', $member->id);
		        
             
                return redirect('/');
                
            }elseif($member->user_type=='buyer'){
                
                Session::put('member_id', $member->id);
                $isOnlineStatus=User::find($member->id);
                $isOnlineStatus->IsOnline = true;
                $isOnlineStatus->update();
                return redirect('/');
                
            }elseif($member->user_type=='trainee'){
                
                Session::put('member_id', $member->id);
				$isOnlineStatus=User::find($member->id);
                $isOnlineStatus->IsOnline = true;
                $isOnlineStatus->update();
                return redirect('/');
                
            }elseif($member->user_type=='investor'){
                
                Session::put('member_id', $member->id);
				$isOnlineStatus=User::find($member->id);
                $isOnlineStatus->IsOnline = true;
                $isOnlineStatus->update();
                return redirect('/');
                
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
                'phone' => 'required|min:7|max:10',     
                'password' => 'required|min:6', 
                'city' => 'required',
                'address' => 'required',
                'gender' => 'required',
                'age' => 'required',
                'phone'=>'required'
            ]);  
            $data = $request->all();
            $usertype = $request->input("usertype");
            for($count = 0; $count < count($usertype); $count++)
            {
                $data = array(
                    'name'        => ucfirst($request->input("name")),
                    'last_name' => ucfirst($request->input("last_name")),
                    'email' =>  $request->input("email"),
                    'city' =>  $request->input("city"),
                    'address' =>  $request->input("address"),
                    'phone'=>  $request->input("phone"),
                    'gender' =>  $request->input("gender"),
                    'age' =>  $request->input("age"),
                    'password'  => Hash::make($request->input("password")),
                    'user_id' => rand(10000,99999),
                    'image' => 'default.png',
                    'provider' => 'LOCAL',
                    'user_type' => $usertype[$count]
                );
                $emailr = $data['email'];
                $userIdLast=User::create($data)->id;
             
                if(User::where('user_type','seller')->where('id',$userIdLast)->first())
                {
                    $SellerProfile = new SellerProfile();
                    $SellerProfile->seller_id = $userIdLast;
                    $SellerProfile->save();
                }
                if(User::where('user_type','buyer')->where('id',$userIdLast)->first())
                {
                 $BuyerProfile = new BuyerProfile();
                 $BuyerProfile->buyer_id = $userIdLast;
                 $BuyerProfile->save();
                }
                if(User::where('user_type','trainee')->where('id',$userIdLast)->first())
                {
                 $TraineeProfile = new TraineeProfile;
                 $TraineeProfile->trainee_id = $userIdLast;
                 $TraineeProfile->save();
                }
                if(User::where('user_type','investor')->where('id',$userIdLast)->first())
                {
                    $InvestoProfile = new InvestoProfile();
                    $InvestoProfile->Investor_id = $userIdLast;
                    $InvestoProfile->save();
                }
            }
            if($userIdLast)
            {
                $user = new User();
                $name = $request->get('name');
                $email = $request->get('email');
                $subject1 = "beltraide";
                $message1 = "Registraion successfully";
                
                $data = ['name'=>$name,'email'=>$email,'subject1'=>$subject1,'message1'=>$message1];
                
                 Mail::send('mail1', $data, function ($message) use ($data) {
                        $message->to($data['email'],$data['name'] )
                        ->subject('Thanking you from beltraide.in')
                        ->from('beltraide7@gmail.com', 'beltraide');
    });
                       
				return redirect('user/login')->with('succ', 'Registration successfull!! Kindly Check your email for Verification.');
                //return back()->with('succ', 'Registration successfull!!');
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
    
    
    
    
    
    
    
    public function profileupdate(Request $request)
    {
        $seller=User::where('user_type','seller')->where(['email'=>$request->input('email')])->exists();
        $buyer=User::where('user_type','buyer')->where(['email'=>$request->input('email')])->exists();
        $trainee=User::where('user_type','trainee')->where(['email'=>$request->input('email')])->exists();
        $investor=User::where('user_type','investor')->where(['email'=>$request->input('email')])->exists();

        $seller2=Auth::User()->id;
            $user=Auth::User();

            $usertype = $request->input("usertype");
             dd($usertype);
            for($count = 0; $count < count($usertype); $count++)
            {
                $data = array(
                    'name'      => Auth::User()->name,
                    'last_name' => Auth::User()->last_name,
                    'email' =>  $request->input("email"),
                    'city' =>  Auth::User()->city,
                    'address' =>  Auth::User()->address,
                    'phone'=>  Auth::User()->phone,
                    'gender' =>  Auth::User()->gender,
                    'age' => Auth::User()->age,
                    'password'  => Auth::User()->password,
                    'user_id' => rand(10000,99999),
                    'image' => 'default.png',
                    'provider' => 'LOCAL',
                    'user_type' => $usertype[$count]
                );
               
                $emailr = $request->input("email");
                // if($seller==true){
                    // $userIdLast=User::create($data2)->id;
                // }
                // else{
                if(User::where('user_type','=',$usertype)->where('email','=',$emailr)->first()){
                    if($seller==false){
                        $userIdLast=User::create($data)->id;
                    }elseif($buyer==false){
                        $userIdLast=User::create($data)->id;
                    }
                    elseif($trainee==false){
                        $userIdLast=User::create($data)->id;
                    }
                    elseif($investor==false){
                        $userIdLast=User::create($data)->id;
                    }else{
                        echo "some Error.";
                    }
                }else{
                    echo "Some error";
                }
                // }

            if($seller==true){
                if($request->usertype=='trainee'){
                    if($trainee==true){
                        continue;
                    }
                    else{
                        if(User::where('user_type','trainee')->where('id',$userIdLast)->where('email','=',$request->input("email"))->first())
                            {
                             $TraineeProfile = new TraineeProfile;
                             $TraineeProfile->User::create($data)->id;
                             $TraineeProfile->save();
                            }
                    }
                }
                if($request->usertype=='buyer'){
                    if($buyer==true){
                        dd($buyer);
                        continue;
                    }
                    else{
                        if(User::where('user_type','buyer')->where('id',$userIdLast)->where('email','=',$request->input("email"))->first())
                            {
                             $BuyerProfile = new BuyerProfile();
                             $BuyerProfile->User::create($data)->id;
                             $BuyerProfile->save();
                            }
                    }
                }
                if($request->usertype=='investor'){
                    if($investor==true){
                        continue;
                    }
                    else{
                        if(User::where('user_type','investor')->where('id',$userIdLast)->where('email','=',$request->input("email"))->first())
                            {
                            $InvestoProfile = new InvestoProfile();
                            $InvestoProfile->User::create($data)->id;
                            $InvestoProfile->save();
                            }
                    }
                }
              
            }
            elseif($buyer==true){
                if(User::where('user_type','seller')->where('id',$userIdLast)->first())
                {
                    $SellerProfile = new SellerProfile();
                    $SellerProfile->seller_id = $userIdLast;
                    $SellerProfile->save();
                }
                
                if(User::where('user_type','trainee')->where('id',$userIdLast)->first())
                {
                 $TraineeProfile = new TraineeProfile;
                 $TraineeProfile->trainee_id = $userIdLast;
                 $TraineeProfile->save();
                }
                if(User::where('user_type','investor')->where('id',$userIdLast)->first())
                {
                    $InvestoProfile = new InvestoProfile();
                    $InvestoProfile->Investor_id = $userIdLast;
                    $InvestoProfile->save();
                }
                if(User::where('user_type','buyer')->where('id',$userIdLast)->first())
                {
                 $BuyerProfile = new BuyerProfile();
                 $BuyerProfile->buyer_id = $userIdLast;
                 $BuyerProfile->save();
                }
            }
            elseif($trainee==true){
                if(User::where('user_type','seller')->where('id',$userIdLast)->first())
                {
                    $SellerProfile = new SellerProfile();
                    $SellerProfile->seller_id = $userIdLast;
                    $SellerProfile->save();
                }
                if(User::where('user_type','buyer')->where('id',$userIdLast)->first())
                {
                 $BuyerProfile = new BuyerProfile();
                 $BuyerProfile->buyer_id = $userIdLast;
                 $BuyerProfile->save();
                }
                
                if(User::where('user_type','investor')->where('id',$userIdLast)->first())
                {
                    $InvestoProfile = new InvestoProfile();
                    $InvestoProfile->Investor_id = $userIdLast;
                    $InvestoProfile->save();
                }
                if(User::where('user_type','trainee')->where('id',$userIdLast)->first())
                {
                 $TraineeProfile = new TraineeProfile;
                 $TraineeProfile->trainee_id = $userIdLast;
                 $TraineeProfile->save();
                }
            }
            elseif($investor==true){
                if(User::where('user_type','seller')->where('id',$userIdLast)->first())
                {
                    $SellerProfile = new SellerProfile();
                    $SellerProfile->seller_id = $userIdLast;
                    $SellerProfile->save();
                }
                if(User::where('user_type','buyer')->where('id',$userIdLast)->first())
                {
                 $BuyerProfile = new BuyerProfile();
                 $BuyerProfile->buyer_id = $userIdLast;
                 $BuyerProfile->save();
                }
                if(User::where('user_type','trainee')->where('id',$userIdLast)->first())
                {
                 $TraineeProfile = new TraineeProfile;
                 $TraineeProfile->trainee_id = $userIdLast;
                 $TraineeProfile->save();
                }
                if(User::where('user_type','investor')->where('id',$userIdLast)->first())
                {
                    $InvestoProfile = new InvestoProfile();
                    $InvestoProfile->Investor_id = $userIdLast;
                    $InvestoProfile->save();
                }
            }
            else{
                return back()->with('error', 'Already exists.');
            }
            }
            
            if($data)
            {
                $name = $request->get('name');
                $email = $request->get('email');
                $subject1 = "beltraide";
                $message1 = "Registraion successfully";
                
                $data = ['name'=>$name,'email'=>$email,'subject1'=>$subject1,'message1'=>$message1];
                
                Mail::send('mail1', $data, function ($message) use ($data) {
                        $message->to($data['email'],$data['name'] )
                        ->subject('Thanking you from beltraide.in')
                        ->from('beltraide7@gmail.com', 'beltraide');
                });
                       
				return back()->with('succ', 'Registration successfull!! Kindly Check your email.');
                //return back()->with('succ', 'Registration successfull!!');
            }
            else
            {
                return back()->with('error', 'Please enter details correctly!!');
            }
  
        
    }
    
    

    
    public function logout(Request $request) {
        Auth::logout();
        $id= Session::get('member_id');
        $isOnlineStatus=User::find($id);
        $isOnlineStatus->IsOnline = false;
        $isOnlineStatus->update();
        return redirect('/');
    }
    
}
