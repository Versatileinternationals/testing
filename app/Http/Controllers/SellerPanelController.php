<?php

namespace App\Http\Controllers;
use Validator;
use Auth;
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
use Illuminate\Support\Facades\File;
use Excel;

class SellerPanelController extends Controller
{
    public $route="member/seller/product-details";
    public $view ="product";
    public $moduleName = 'Product';
    
    public function index()
    {    
        $member_id=Session::get('member_id');
        $member=User::find($member_id);
        $user_session =  User::where('id', $member_id)->get();
        $sellerData=SellerProfile::where('seller_id', $member_id)->first();
        if($member_id=="")
        {
         return redirect("/");   
        }else{
        return view('member/seller/dashboard',compact('member', 'sellerData','user_session'));
        }
        
    }
    
    public function viewsettings()
    {        
        $member_id=Session::get('member_id');
        if($member_id=="")
        {
         return redirect("/");   
        }else{
            $member=User::find($member_id);
        if($member->user_type == 'seller' && SellerProfile::where('seller_id', $member_id)->count() > 0){
            $sellerData=SellerProfile::where('seller_id', $member_id)->first();
            $user_data = DB::table('users')->select('user_type')->where(['email'=>$member->email ])->get();
        }else{
            $sellerData= NULL;
        }
        $country= DB::table("country")->get();
        $user_session =  User::where('id', $member_id)->get();
          return view('member/seller/settings',compact('member', 'sellerData', 'user_data', 'country','user_session'));
        }
    }
    
    public function addproduct()
    {       
        $member_id=Session::get('member_id');
        $member=User::find($member_id);
        $moduleName = $this->moduleName;  
        $category = Category::where('status',1)->get();
        $brand = Brand::where('status',1)->get();
        $products = Product::where('status',1)->orderBy('id','DESC')->get();
        $user_session =  User::where('id', $member_id)->get();
        $sellerData=SellerProfile::where('seller_id', $member_id)->first();
        if($member_id=="")
        {
         return redirect("/");   
        }else{
        return view('member/seller/add-product', compact('user_session','moduleName','sellerData', 'category','brand','products','member'));
        }
    }
    
    public function store(Request $request)

    {
        
        $member_id=Session::get('member_id');
        $member=User::find($member_id);
        $sellerData=SellerProfile::where('seller_id', $member_id)->first();
        $company=$sellerData->company;
        
        $request->validate([
               
        ]); 

     

        if ($request->hasFile('main_image')) {   
            $image = $request->file('main_image');
            $name = uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/upload');
            $image->move($destinationPath, $name);         
            $main_image = $name;
        }  

        
        $product = Product::insert([
            'product_number' => rand(10000,99999),           
            'm_id' => $member_id,      
            'company_name' => $request->company,
            'name' => $request->name,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'sku' => $request->sku,
            'sale_price' => $request->sale_price,
            'regular_price' => $request->regular_price,
            'description' => $request->description,
            'stock' => $request->stock,
            'minimum_stock' => $request->minimum_stock,
            'weight' => $request->weight,
            'length' => $request->length,
            'width' => $request->width,
            'height' => $request->height,
            'tags' => $request->tags,
            'status' => 'Pending',          
            'main_image' => $main_image,
            'max_order_qty' => $request->max_order_qty,
            'created_at'=>now(),
            'updated_at'=>now()

        ]);

        
        return redirect('seller/product-details')->withStatus(__('Product is added successfully.'));

    }
    
    public function edit($id){
        
        $member_id=Session::get('member_id');
        $user_session =  User::where('id', $member_id)->get();
        $member=User::find($member_id);       
        $moduleName = $this->moduleName;  
        $product = Product::find(decrypt($id));
        $category = Category::where('status',1)->get();
        $brand = Brand::where('status',1)->get();
        $products = Product::where('id','!=',decrypt($id))->where('status',1)->orderBy('id','DESC')->get();
        $product->specification = ProductSpecification::where('product_id', decrypt($id))->get();
        $subcategory = SubCategory::where('category_id',$product->category_id)->get();
        $sellerData=SellerProfile::where('seller_id', $member_id)->first();
        if($member_id=="")
        {
         return redirect("/");   
        }else{
        return view('member/seller/edit-product', compact('user_session','moduleName','sellerData', 'product','category', 'products','subcategory', 'brand' ,'member'));
      }
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
            'sale_price' => 'required',          
            'regular_price' => 'required',          
            'description' => 'required',          
            'stock' => 'required', 
            'minimum_stock' => 'required',         
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
            'weight' => $request->weight,
            'length' => $request->length,
            'width' => $request->width,
            'height' => $request->height,         
            'tags' => $request->tags,
            //'status' => $request->status,
            'main_image' => $main_image,
            'max_order_qty' => $request->max_order_qty,
        ]);

        return redirect('/seller/product-details')->withStatus(__('Product is updated successfully.'));
    }
    public function product_delete($id)
    {
        
        $product = Product::find($id);
        $imagePath = public_path('/assets/images/upload/'. $product->main_image);
        
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }
        $product->delete();
        if ($product) {
            return response()->json([
                'status' => 200,
                'success' => "Record delete successfully"
            ]);
        }
    }
    public function productdetails()

    {        
        $member_id=Session::get('member_id');
        $user_session =  User::where('id', $member_id)->get();
        $member=User::find($member_id);       
        $moduleName = $this->moduleName;   
        $sellerData=SellerProfile::where('seller_id', $member_id)->first();
        $products = Product::with(['category','subcategory','brandData'])->where("m_id",$member_id)->orderBy('id','DESC')->get();  
        if($member_id=="")
        {
         return redirect("/");   
        }else{
        return view('member/seller/product-details', compact('user_session','moduleName','sellerData', 'products', 'member'));
        }
    }
    
    public function quotationslists()

    {        
        $member_id=Session::get('member_id');
        $user_session =  User::where('id', $member_id)->get();
        $member=User::find($member_id);       
        $moduleName = 'Sellers Quotation Lists';   
        $sellerData=SellerProfile::where('seller_id', $member_id)->first();
        $data = Quotations::where("seller_id",$member_id)->orderBy('id','DESC')->get();  
        if($member_id=="")
        {
         return redirect("/");   
        }else{
        return view('member/seller/quotationslists', compact('user_session','moduleName','sellerData', 'data', 'member'));
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
        if($member->user_type == 'seller'){            
            if ($request->hasFile('banner')) {   
                $banner = $request->file('banner');
                $name1 = uniqid() . '.' . $banner->getClientOriginalExtension();
                $destinationPath1 = public_path('/assets/images/upload');   
                $banner->move($destinationPath1, $name1);             
                $profile_data['banner'] = $name1;                    
            }
            $profile_data['company'] = $request->company_name;
            $profile_data['est_date'] = $request->est_date;
            $profile_data['store_name'] = $request->store_name;
            $profile_data['description'] = $request->description;
            $profile_data['fax'] = $request->fax;
            $profile_data['store_country'] = $request->country;
            $profile_data['store_address'] = $request->store_address;
            $profile_data['store_city'] = $request->city;
            $profile_data['location'] = $request->location;
            $profile_data['export'] = $request->export;
            $profile_data['store_email'] = $request->store_email;
            $profile_data['website_url'] = $request->website_url;
            $profile_data['whatsapp'] = $request->whatsapp;
            $profile_data['messanger'] = $request->messanger;
            $profile_data['facebook'] = $request->facebook;
            $profile_data['twitter'] = $request->twitter;
            $profile_data['pinterest'] = $request->pinterest;
            
            
            
            
            if(SellerProfile::where('seller_id', $member_id)->count() > 0) {
                SellerProfile::where('seller_id', $member_id)->update($profile_data); 
                Product::select('company_name')->where('m_id',$member_id)->update(['company_name'=>$request->input('company_name')]);
                
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
