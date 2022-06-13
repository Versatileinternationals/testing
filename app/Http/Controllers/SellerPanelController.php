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
use App\Models\ClientTestimonial;

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
		echo $member_id;
        $user_session =  User::where('id', $member_id)->get();
        $sellerData=SellerProfile::where('seller_id', $member_id)->first();
        if($member_id=="")
        {
         return redirect("/");   
        }
		else
		{
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
	public function add_testimonials()
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
        return view('member/seller/add-testimonial', compact('user_session','moduleName','sellerData','member'));
        }
    }
    public function store_testimonial(Request $request)
    {
      $member_id=Session::get('member_id');
        $request->validate([
            'name' => 'required',    
            'description' => 'required',          
                
        ]); 
     
        
        $Testimonials = ClientTestimonial::create([
            
            'name' => $request->name,
            'designation' => $request->designation,
            'description' => $request->description,
            'country' => $request->country,
            'user_id' => $member_id,
           
        ]);
        
        
       return redirect()->back()->with('message', 'Client Testimonial is added successfully.!');
        //return redirect($this->route)->withStatus(__('Client Testimonial is added successfully.'));
    }
     
	 public function edit_testimonial($id){
       
       $ClientTestimonials = ClientTestimonial::find($id); 
       return view('member/seller/edit-testimonial', compact('ClientTestimonials'));
    }

    public function update_testimonial(Request $request,$id)
    {
        $request->validate([
            'name' => 'required',    
            'designation' => 'required',          
            'description' => 'required',          
            
        ]); 
      
        
        $ClientTestimonials = ClientTestimonial::find($id)->update([
           'name' => $request->name,
           'designation' => $request->designation,
		   'description' => $request->description,
		   'country' => $request->country,
		   
           //'Status' => $request->status,
        ]);
        
        //return redirect()->back()->with('message', 'Client Testimonial is updated successfully.!');
		//return redirect()->route('seller/testimonials')->with('status', 'Client Testimonial is updated successfully.');
        return redirect('seller/testimonials')->withStatus(__('Client Testimonial is updated successfully.'));
    }


	 public function delete_testimonials($id)
	{
         
        $testimonials = ClientTestimonial::find($id)->delete();
       return redirect()->back()->with('message', 'Testimonial Delete Successfully!');
    }
    public function productdetails()

    {        
        $member_id=Session::get('member_id');
        $user_session =  User::where('id', $member_id)->get();
        $member=User::find($member_id);       
        $moduleName = $this->moduleName;   
        $sellerData=SellerProfile::where('seller_id', $member_id)->first();
        $products = Product::with(['category','subcategory','brandData'])->where("m_id",$member_id)->orderBy('id','ASC')->get();  
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
        $moduleName = ' Quotation Lists';   
        $sellerData=SellerProfile::where('seller_id', $member_id)->first();
        $data = Quotations::where("seller_id",$member_id)->orderBy('id','DESC')->get();  
        if($member_id=="")
        {
         return redirect("/");   
        }else{
        return view('member/seller/quotationslists', compact('user_session','moduleName','sellerData', 'data', 'member'));
        }
    }
	public function testimonialslist()

    {        
        $member_id=Session::get('member_id');
        $user_session =  User::where('id', $member_id)->get();
        $member=User::find($member_id);       
        $moduleName = 'Seller Testimonials';   
       
        $ClientTestimonials = ClientTestimonial::where('Status',1)->where('user_id',$member_id)->orderBy('id','DESC')->get(); 
        //print_r($ClientTestimonials);		
        if($member_id=="")
        {
         return redirect("/");   
        }else{
        return view('member/seller/testimonials', compact('user_session','moduleName','member','ClientTestimonials'));
        }
    }
     //  Category  Crud // 
	public function category_list()
    {        
        $member_id=Session::get('member_id');
        $user_session =  User::where('id', $member_id)->get();
        $member=User::find($member_id);       
        $moduleName = 'Category';              
        $category = Category::orderBy('id','DESC')->get();  
        return view('member/seller/category',compact('user_session','moduleName','member','category'));
    }
	public function category_create()
    {
                 
        return view('member/seller/add-category');
    }

    public function category_store(Request $request)
    {
        $request->validate([
            'name' => 'required',     
            'image' => 'required',     
            //'status' => 'required',
        ]);  
        $data = $request->all();
        $data['name'] = ucfirst($request->name);
		$data['status'] = 0;
        $data['category_id'] = rand(10000,99999);
        if ($request->hasFile('image')) {   
            $image = $request->file('image');
			$status=0;
            $name = uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/upload');
            $image->move($destinationPath, $name);         
            $data['image'] = $name;
        }  
        
        $category = Category::create($data);
       
        return redirect()->back()->with('message', 'Category is added successfully.!');        
        //return redirect($this->route)->withStatus(__('Category is added successfully.'));
    }
    
    public function category_edit($id)
    {
        $moduleName = $this->moduleName;  
        $category = Category::find(decrypt($id));     
      
        return view('admin/Admb2b/'.$this->view.'/_form', compact('moduleName', 'category'));
    }

    public function category_update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',                                          
            'status' => 'required',            
        ]);  
        $data = $request->all();  
        $data['name'] = ucfirst($request->name);   
        if ($request->hasFile('image')) {   
            $image = $request->file('image');
            $name = uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/upload');
            $image->move($destinationPath, $name);         
            $data['image'] = $name;
        }   
        Category::find($id)->update($data);        
        return redirect($this->route)->withStatus(__('Category is updated successfully.'));
    }

	
    //  Category  Crud End// 
	
	// SubCategory start//
	public function subcategory_list()
    {        
        $member_id=Session::get('member_id');
        $user_session =  User::where('id', $member_id)->get();
        $member=User::find($member_id);       
        $moduleName = 'Category';              
        $subcategory = SubCategory::with(['category'])->orderBy('id','DESC')->get();  
        return view('member/seller/subcategory', compact('moduleName','user_session','member', 'subcategory'));
    }

    public function subcategory_create()
    {
        $moduleName = $this->moduleName;       
        $category = Category::OrderBy('id','DESC')->get();    
        return view('member/seller/add-subcategory', compact('moduleName', 'category'));
    }

    public function subcategory_store(Request $request)
    {
        $request->validate([
            'name' => 'required', 
            'category_id' => 'required',     
            'image' => 'required',     

        ]);  
        $data = $request->all();
        $data['name'] = ucfirst($request->name);
		$data['status'] = 0;
        $data['subcategory_id'] = rand(10000,99999);
        if ($request->hasFile('image')) {   
            $image = $request->file('image');
            $name = uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/upload');
            $image->move($destinationPath, $name);         
            $data['image'] = $name;
        }  
        
        $category = SubCategory::create($data);
       
         return redirect()->back()->with('message', 'SubCategory is added successfully.!');      
        //return redirect($this->route)->withStatus(__('SubCategory is added successfully.'));
    }
    
    public function subcategory_edit($id)
    {
        $moduleName = $this->moduleName;  
        $subcategory = SubCategory::find(decrypt($id));     
        $category = Category::OrderBy('id','DESC')->get();    
        return view('admin/Admb2b/'.$this->view.'/_form', compact('moduleName', 'category', 'subcategory'));
    }

    public function subcategory_update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',  
            'category_id' => 'required',                                          
            'status' => 'required',            
        ]);  
        $data = $request->all();  
        $data['name'] = ucfirst($request->name);   
        if ($request->hasFile('image')) {   
            $image = $request->file('image');
            $name = uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/upload');
            $image->move($destinationPath, $name);         
            $data['image'] = $name;
        }   
        SubCategory::find($id)->update($data);        
        return redirect($this->route)->withStatus(__('SubCategory is updated successfully.'));
    }
	
	
	// Sub Category End//
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
