<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientTestimonial;
use Excel;

class ClientTestimonialsController extends Controller
{
    public $route="clienttestimonials";
    public $view ="ClientTestimonial";
    public $moduleName = 'Client Testimonial';

    public function index()
    {        
	
        $moduleName = $this->moduleName;                
        $ClientTestimonials = ClientTestimonial::where('Status',1)->orderBy('id','DESC')->get();  
        return view('admin/Admb2b/'.$this->view.'/index', compact('moduleName','ClientTestimonials'));
    }

    public function create()
    {
        $moduleName = $this->moduleName;  
       // $category = Category::where('status',1)->get();
       // $brand = Brand::where('status',1)->get();
        //$products = Product::where('status',1)->orderBy('id','DESC')->get();
        return view('admin/Admb2b/'.$this->view.'/form',compact('moduleName'));
    }

    public function store(Request $request)
    {
    
        $request->validate([
            'name' => 'required',    
            'description' => 'required',          
                
        ]); 
     
        
        $Testimonials = ClientTestimonial::create([
            
            'name' => $request->name,
            'designation' => $request->designation,
            'description' => $request->description,
            'country' => $request->country,
            
           
        ]);
        
        
       
        return redirect($this->route)->withStatus(__('Client Testimonial is added successfully.'));
    }

    public function edit($id){
        $moduleName = $this->moduleName;  
       
        //$products = Product::where('id','!=',decrypt($id))->where('status',1)->orderBy('id','DESC')->get();
       $ClientTestimonials = ClientTestimonial::find($id); 
       
       // $subcategory = SubCategory::where('category_id',$product->category_id)->get();
        return view('admin/Admb2b/'.$this->view.'/_form', compact('moduleName', 'ClientTestimonials'));
    }

    public function update(Request $request,$id)
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
		   
           'Status' => $request->status,
        ]);
        
       
        return redirect($this->route)->withStatus(__('Client Testimonial is updated successfully.'));
    }


    public function view($id){
        $moduleName = $this->moduleName;  
        $product = Product::with(['category', 'subcategory','brandData'])->find(decrypt($id));
        $product->related_products = Product::with(['brandData'])->whereIn('id',array_filter(explode(',',$product->related_product)))->where('status',1)->orderBy('id','DESC')->get();
   
        return view('admin/Admb2b/'.$this->view.'/view', compact('moduleName', 'product'));
    }

    public function productgallery($id){
        $moduleName = $this->moduleName;  
        $product = Product::find(decrypt($id));
        return view('admin/'.$this->view.'/gallery', compact('moduleName', 'product'));
    }

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
