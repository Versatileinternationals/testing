<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public $route="coupon";
    public $view ="coupon";
    public $moduleName = 'Coupon';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $moduleName = $this->moduleName;                
        $coupon = Coupon::orderBy('id','DESC')->get();  
        return view('admin/'.$this->view.'/index', compact('moduleName', 'coupon'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $moduleName = $this->moduleName;  
        $category = Category::orderBy('id','DESC')->get();    
        $product = Product::orderBy('id','DESC')->get();     
        return view('admin/'.$this->view.'/form', compact('moduleName','category','product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'start_date' => 'required',     
            'end_date' => 'required', 
            'discount' => 'required',     
            'discount_type' => 'required', 
            'max_use' => 'required', 
            'status' => 'required',
            'apply_on' => 'required',
            'product_id' => 'required_if:apply_on,product',
            'category_id' => 'required_if:apply_on,category',
            'min_cart_value' => 'required_if:apply_on,cart',
        ]);  
       
        $data = $request->all();
        $data['title'] = ucfirst($request->title);
        $data['coupon_code'] =  chr(rand(65,90)).chr(rand(65,90)).'-'.rand(9999,100000);
        $data['added_by'] = auth()->user()->id;
        if($request->apply_on == "product"){
            $data['product_id'] = implode('***',$request->product_id);
        }
        if($request->apply_on == "category"){
            $data['category_id'] = implode('***',$request->category_id);
        }
        $coupon = Coupon::create($data);
       
              
        return redirect($this->route)->withStatus(__('Coupon is added successfully.'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $moduleName = $this->moduleName;  
        $coupon = Coupon::find(decrypt($id));     
        $category = Category::orderBy('id','DESC')->get();    
        $product = Product::orderBy('id','DESC')->get(); 
        return view('admin/'.$this->view.'/_form', compact('moduleName', 'coupon','category', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'start_date' => 'required',     
            'end_date' => 'required', 
            'discount' => 'required',     
            'discount_type' => 'required', 
            'max_use' => 'required', 
            'status' => 'required',
            'apply_on' => 'required',
            'product_id' => 'required_if:apply_on,product',
            'category_id' => 'required_if:apply_on,category',
            'min_cart_value' => 'required_if:apply_on,cart',
        ]); 
        
        
      
        $data = $request->all();
        $data['title'] = ucfirst($request->title);
        if($request->apply_on == "product"){
            $data['product_id'] = implode('***',$request->product_id);
        }
        if($request->apply_on == "category"){
            $data['category_id'] = implode('***',$request->category_id);
        }
        Coupon::find($id)->update($data);        
        $data['added_by'] = auth()->user()->id;
        return redirect($this->route)->withStatus(__('Coupon is updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        //
    }
}
