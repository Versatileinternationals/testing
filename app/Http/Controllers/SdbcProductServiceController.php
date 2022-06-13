<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductServices;
use App\Models\ServiceCategory;
use Excel;

class SdbcProductServiceController extends Controller
{
    public $route="product_services";
    public $view ="ProductServices";
    public $moduleName = 'Product Services';

    public function index()
    {  
          	
        $moduleName = $this->moduleName;  
                     	
        $ProductService = ServiceCategory::with(['ServiceCategory'])->orderBy('id','DESC')->get();
        return view('admin/Admb2b/'.$this->view.'/index', compact('moduleName','ProductService'));
    }

    public function create()
    {
		
        $moduleName = $this->moduleName;  
         $service_category = ServiceCategory::where('status',1)->get();
       // $brand = Brand::where('status',1)->get();
        //$products = Product::where('status',1)->orderBy('id','DESC')->get();
        return view('admin/Admb2b/'.$this->view.'/form',compact('moduleName','service_category'));
    }

    public function store(Request $request)
    {
   
        $request->validate([
            'category' => 'required',    
            'description' => 'required',          
            'Status'=> 'required',
        ]); 
     
       
        
        $product = ProductServices::create([
           
            'category' => $request->category,
            'description' => $request->description,
            
        ]);
        
        
       
        return redirect($this->route)->withStatus(__('Product Services is added successfully.'));
    }

    public function edit($id){
        $moduleName = $this->moduleName;  
        $product = Product::find(decrypt($id));
        $category = Category::where('status',1)->get();
        $brand = Brand::where('status',1)->get();
        $products = Product::where('id','!=',decrypt($id))->where('status',1)->orderBy('id','DESC')->get();
        $product->specification = ProductSpecification::where('product_id', decrypt($id))->get();
       
        $subcategory = SubCategory::where('category_id',$product->category_id)->get();
        return view('admin/'.$this->view.'/_form', compact('moduleName', 'product','category', 'products','subcategory', 'brand' ));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required',    
            'category_id' => 'required',          
            'subcategory_id' => 'required',          
            'sku' =>  'required|unique:products,sku,'.$id,  
            'brand' => 'required',          
            'sale_price' => 'required',          
            'regular_price' => 'required',          
            'short_description' => 'required',          
            'description' => 'required',          
            'stock' => 'required', 
            'minimum_stock' => 'required',         
            'page_title' => 'required',          
            'page_description' => 'required',          
            'page_keywords' => 'required',    
            'max_order_qty' => 'required',        
            'key' => 'required|array',   
            'value' => 'required|array',    
            'key.*' => 'required',   
            'value.*' => 'required',  
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
        if(isset($request->allow_customer_review)){
            $allow_customer_review = 1;
        } 
        else{
            $allow_customer_review = 0;
        }
        if(isset($request->sold_avaliable)){
            $sold_avaliable = 1;
        } 
        else{
            $sold_avaliable = 0;
        }
        if(isset($request->allow_return)){
            $allow_return = 1;
        } 
        else{
            $allow_return = 0;
        }
        if($request->related_product == ""){
            $related_product = "";
        }
        else{
            $related_product =implode(',',$request->related_product);
        }
     
        $product = Product::find($id)->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'sku' => $request->sku,
            'brand' => $request->brand,
            'sale_price' => $request->sale_price,
            'regular_price' => $request->regular_price,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'stock' => $request->stock,
            'minimum_stock' => $request->minimum_stock,
            'page_title' => $request->page_title,
            'page_description' => $request->page_description,
            'page_keywords' => $request->page_keywords,
            'sale_start_date' => $request->sale_start_date,
            'sale_end_date' => $request->sale_end_date,
            'weight' => $request->weight,
            'length' => $request->length,
            'width' => $request->width,
            'height' => $request->height,
            'colors' => $request->colors,
            'tags' => $request->tags,
            'status' => $request->status,
            'shipping_class' => $request->shipping_class,
            'purchase_note' => $request->purchase_note,
            'button_text' => $request->button_text,
            'main_image' => $main_image,
            'max_order_qty' => $request->max_order_qty,
            'allow_customer_review' => $allow_customer_review,
            'sold_avaliable' => $sold_avaliable,
            'allow_return' => $allow_return,
            'related_product' => $related_product,
            'added_by' => auth()->user()->id,
        ]);
        
        $specification = ProductSpecification::where('product_id', $id)->get();
        foreach ($specification as $value) {
           $value->delete();
        }
        foreach ($request->key as $key => $value) {
            ProductSpecification::create([
                'product_id' => $id,
                'title' => $value,
                'value' => $request->value[$key],
            ]);
        }
       
        return redirect($this->route)->withStatus(__('Product is updated successfully.'));
    }


    public function view($id){
        $moduleName = $this->moduleName;  
        $product = Product::with(['category', 'subcategory','brandData'])->find(decrypt($id));
        $product->related_products = Product::with(['brandData'])->whereIn('id',array_filter(explode(',',$product->related_product)))->where('status',1)->orderBy('id','DESC')->get();
   
        return view('admin/'.$this->view.'/view', compact('moduleName', 'product'));
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
