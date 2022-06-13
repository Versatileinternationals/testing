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
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Quotations;
use App\Models\SellerProfile;
use Excel;
use Auth;
use Mail;



class ProductController extends Controller

{

    public $route="product";

    public $view ="product";

    public $moduleName = 'Product';



    public function index()

    {        

        $moduleName = $this->moduleName;                

        $products = Product::with(['category','subcategory','brandData','status'])->where('status','=','Pending')->orderBy('id','DESC')->get();  

        return view('admin/Admb2b/'.$this->view.'/index', compact('moduleName', 'products'));

    }
     public function approved()

    {        

        $moduleName = $this->moduleName;                

        $products = Product::with(['category','subcategory','brandData','status'])->where(['status'=>'1'])->orderBy('created_at','DESC')->get();  

        return view('admin/Admb2b/'.$this->view.'/index', compact('moduleName', 'products'));

    }
	
     public function disapproved()

    {        

        $moduleName = $this->moduleName;                

        $products = Product::with(['category','subcategory','brandData','status'])->where(['status'=>'0'])->orderBy('created_at','DESC')->get();  

        return view('admin/Admb2b/'.$this->view.'/index', compact('moduleName', 'products'));

    }
     public function pending()

    {        

        $moduleName = $this->moduleName;                

        $products = Product::with(['category','subcategory','brandData','status'])->where(['status'=>'Pending'])->orderBy('created_at','DESC')->get();  

        return view('admin/Admb2b/'.$this->view.'/index', compact('moduleName', 'products'));

    }
    
    public function featured(Request $request)
    {        
        echo "rashid";
		die();

    }
    
    // public function featuredsearch(Request $request)
    // {        
    //      dd($request);
    //     $data['moduleName'] = $this->moduleName;

    //      $data['featured'] = Product::where('featured',$request->featured)->update([])->get();
    //      // send data to table view 
    //       return view('admin/Admb2b/'.$this->view.'/table', $data);
    // }

   
    public function ajaxapproved(Request $request)
    {        
         
        $data['moduleName'] = $this->moduleName;

         $data['products'] = Product::where('status',$request->category)->orderBy('created_at','DESC')->get();
         // send data to table view 
          return view('admin/Admb2b/'.$this->view.'/table', $data);
    }

    public function quotation()
    {        
        $moduleName = 'Sellers Quotation Lists';
        $quotations = Quotations::with(['category','subcategory','brandData','status'])->orderBy('created_at','DESC')->get();  
        return view('admin/Admb2b/'.$this->view.'/quotation', compact('moduleName', 'quotations'));
    }
    
    public function create()

    {
      
        $moduleName = $this->moduleName;  
        $category = Category::where('status',1)->get();
        $brand = Brand::where('status',1)->get();
        $products = Product::where('status',1)->orderBy('id','DESC')->get();
        return view('admin/Admb2b/'.$this->view.'/form', compact('moduleName', 'category','brand','products'));

    }



    public function store(Request $request)

    {
  
        $request->validate([

            'name' => 'required',    
            'category_id' => 'required',          
            'subcategory_id' => 'required',          
            'sku' => 'required',          
            'regular_price' => 'required',          
            'description' => 'required',          
            'stock' => 'required', 
            'minimum_stock' => 'required',         
            'main_image' => 'required', 
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

          
        ]);


    

       

        return redirect($this->route)->withStatus(__('Product is added successfully.'));

    }



    public function edit($id){


        $moduleName = $this->moduleName;  

        $product = Product::find(decrypt($id));

        $category = Category::where('status',1)->get();

        $brand = Brand::where('status',1)->get();

        $products = Product::where('id','!=',decrypt($id))->where('status',1)->orderBy('id','DESC')->get();

        $product->specification = ProductSpecification::where('product_id', decrypt($id))->get();

       

        $subcategory = SubCategory::where('category_id',$product->category_id)->get();

        return view('admin/Admb2b/'.$this->view.'/_form', compact('moduleName', 'product','category', 'products','subcategory', 'brand' ));

    }



    public function update(Request $request,$id)

    {
		
 
        $request->validate([
            'name' => 'required',    
            'category_id' => 'required',          
            'subcategory_id' => 'required',          
            'sku' => 'required',          
            'regular_price' => 'required',          
            'description' => 'required',          
            'stock' => 'required', 
            'minimum_stock' => 'required',         
            //'main_image' => 'required', 
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

        

        return redirect($this->route)->withStatus(__('Product is updated successfully.'));

    }





    public function view($id){

        $moduleName = $this->moduleName;  

        $product = Product::with(['category', 'subcategory','brandData'])->find(decrypt($id));

        $product->related_products = Product::with(['brandData'])->whereIn('id',array_filter(explode(',',$product->related_product)))->where('status',1)->orderBy('updated_at','DESC')->get();

   

        return view('admin/Admb2b/'.$this->view.'/view', compact('moduleName', 'product'));

    }



    public function productgallery($id){

        $moduleName = $this->moduleName;  

        $product = Product::find(decrypt($id));

        return view('admin/Admb2b/'.$this->view.'/gallery', compact('moduleName', 'product'));

    }
    
    public function productapprove($id){
        //dd(decrypt($id));
        $productid=(decrypt($id));
        $userid=Product::select('m_id')->where('id','=',$productid)->first();
        $idcheck=$userid->m_id;
        $user=User::select('name','email')->where('id','=',$idcheck)->first();
        $name=$user->name;
        $email=$user->email;
        // dd($email);
        $product = Product::find(decrypt($id))->update(['status'=>1]);
        $moduleName = $this->moduleName;               
        
      
        $products = Product::with(['category','subcategory','brandData'])->orderBy('id','DESC')->get();  
        
        if($product==true){

 
                $subject1 = "beltraide";
                $message1 = "Product Approved Successfully";
                
                $data = ['name'=>$name,'email'=>$email,'subject1'=>$subject1,'message1'=>$message1];
                
                Mail::send('Mail.mailproductapprove', $data, function ($message) use ($data) {
                        $message->to($data['email'],$data['name'] )
                        ->subject('Thanking you from beltraide.in')
                        ->from('beltraide7@gmail.com', 'beltraide');
                });

            return view('admin/Admb2b/'.$this->view.'/index', compact('moduleName', 'products'))->withStatus(__('Product is approved for sales.'));
        }

    }
    
    public function productdisapprove($id){
        $productid=(decrypt($id));
        $userid=Product::select('m_id')->where('id','=',$productid)->first();
        $idcheck=$userid->m_id;
        $user=User::select('name','email')->where('id','=',$idcheck)->first();
        $name=$user->name;
        $email=$user->email;
        // dd($email);
        $product = Product::find(decrypt($id))->update(['status'=>0]);
        $moduleName = $this->moduleName;                
        
        $products = Product::with(['category','subcategory','brandData'])->orderBy('id','DESC')->get();
        
        if($product==true){
                
                $subject1 = "beltraide";
                $message1 = "Product Disapproved ";
                $data = ['name'=>$name,'email'=>$email,'subject1'=>$subject1,'message1'=>$message1];
                
                Mail::send('Mail.mailproductdisapprove', $data, function ($message) use ($data) {
                        $message->from('beltraide7@gmail.com', 'beltraide')
                        ->subject('Thanking you from beltraide.in')
                        ->to($data['email'],$data['name'] );
                });
            
            return view('admin/Admb2b/'.$this->view.'/index', compact('moduleName', 'products'))->withStatus(__('Product is Disapproved for sales.'));
        }

    }
    
    //  public function filter(Product $product, Request $request)
    // {   
        
    //     if($request->ajax() && $request->status == 1)
    //     {
    //         return view('admin/Admb2b/'.$this->view.'/index', [
    //             'products' => $product->where('status',$request->status)->simplePaginate(10)
    //         ])->render();
    //     }

    //     if($request->ajax() && $request->status == 0)
    //     {
    //         return view('admin/Admb2b/'.$this->view.'/index', [
    //             'products' => $product->where('status',$request->status)->simplePaginate(10)
    //         ])->render();
    //     }
 
    //     if($request->ajax() && $request->status == 'Pending')
    //     {
    //         return view('admin/Admb2b/'.$this->view.'/index', [
    //             'products' => $product->where('status',$request->status)->simplePaginate(10)
    //         ])->render();
    //     }
    // }


    public function uploadProductImage(Request $request, $id){

        $images = array_filter(explode(',',Product::find($id)->image));     

        if ($request->hasFile('file')) {            

            $image = $request->file('file');

            $name = uniqid() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('/assets/images/upload');

            $image->move($destinationPath, $name);

            array_push($images,$name);

            Product::find($id)->update(['image'=>implode(',',$images)]);

        }

        return true;

    }



    public function getSubcategory(Request $request){

        $data = SubCategory::where('category_id',$request->category_id)->get()->pluck('name','id')->toArray();

        return $data;

    }



    public function uploadProduct(Request $request){

        $rows = Excel::toArray(new ProductImport, $request->file('file'));

       

        $totalLoops = count($rows[0]);

        

        $loop = 0;

        $headerCheck = array('name', 'sku', 'category', 'subcategory', 'brand', 'sale price', 'regular price', 'description', 'stock', 'minimum stock', 'sale start date', 'sale end date', 'shipping class', 'purchase note', 'page title', 'page keyword', 'page description');

       

        foreach ($rows[0][0] as $key => $row) {

            if (trim($row)) {

                if (!in_array(trim($row), $headerCheck)) {

                    return redirect()->back()->with('error_msg', 'Uploaded file is not Valid Please Download Sample File and try again.');

                }

            }

        }



        $data = array();

        $result = array();

        $check = 1;

        foreach ($rows[0] as $key => $row) {

            $loop++;

            if ($key == 0) { continue; }



            if (trim($row[0]) == '') {

                return redirect()->back()->with('error_msg', 'Product Name is required.');

            }



            if (trim($row[1]) == '') {

                return redirect()->back()->with('error_msg', 'Product SKU is required.');

            }

            else{

                $productsku = Product::where('sku', trim($row[1]))->first();

                if($productsku){

                    return redirect()->back()->with('error_msg', 'The sku has already been taken, Please try another');

                } 

            }



            if (trim($row[2]) == '') {

                return redirect()->back()->with('error_msg', 'Product Category is required.');

            }

            else{

                $category = Category::where('name', trim($row[2]))->first();

                if($category){

                    $cat = $category->id;

                }

                else{

                    return redirect()->back()->with('error_msg', 'Invalid Category Name. Please try another');

                }

            }

            

            if (trim($row[3]) == '') {

                return redirect()->back()->with('error_msg', 'Product Sub category is required.');

            }

            else{

                $scategory = SubCategory::where('name', trim($row[3]))->where('category_id',$cat)->first();

                if($scategory){

                    $sub_category = $scategory->id;

                }

                else{

                    return redirect()->back()->with('error_msg', 'Invalid subcategory name. Please try another');

                }

            }



            if (trim($row[4]) == '') {

                return redirect()->back()->with('error_msg', 'Product Brand is required.');

            }

            else{

                $brand = Brand::where('name', trim($row[4]))->first();

                if($brand){

                    $brand = $brand->id;

                }

                else{

                    return redirect()->back()->with('error_msg', 'Invalid Brand name. Please try another');

                } 

            }



            if (trim($row[5]) == '') {

                return redirect()->back()->with('error_msg', 'Product Sale Price is required.');

            }



            if (trim($row[6]) == '') {

                return redirect()->back()->with('error_msg', 'Product Regular Price is required.');

            }



            if (trim($row[7]) == '') {

                return redirect()->back()->with('error_msg', 'Product Description is required.');

            }



            if (trim($row[8]) == '') {

                return redirect()->back()->with('error_msg', 'Product Stock is required.');

            }



            if (trim($row[12]) == '') {

                return redirect()->back()->with('error_msg', 'Page Title is required.');

            }

            $product_number = rand(10000,99999);

            

            Product::create([

                'product_number' => $product_number,

                'name' => trim($row[0]),

                'sku' => trim($row[1]),

                'category_id' => $cat,

                'subcategory_id' => $sub_category,

                'brand' => $brand,

                'sale_price' => trim($row[5]),

                'regular_price' => trim($row[6]),

                'short_description' => trim($row[7]),

                'stock' => trim($row[8]),

                'minimum_stock' => trim($row[9]),              

                'shipping_class' => trim($row[10]),

                'purchase_note' => trim($row[11]),

                'page_title' => trim($row[12]),

                'page_keyword' => trim($row[13]),

                'page_description' => trim($row[14]),

                'status' => 1,

                'button_text' => 'Add to Cart',

                'added_by' => auth()->user()->id,

            ]);

           

        }



         /* Upload Excel file */

         $file = $request->file('file');

         $fileName = time().'.'.$file->getClientOriginalExtension();

         $file->move(public_path('/assets/products'), $fileName);



      

         return redirect($this->route)->withStatus(__('Product is added successfully in bulk.'));

    

    }

}

