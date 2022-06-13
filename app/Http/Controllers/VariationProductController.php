<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VariationProduct;
use App\Models\Product;

class VariationProductController extends Controller
{
    public $route="variation-product";
    public $view ="variation";
    public $moduleName = 'Variation Product';

    public function index()
    {        
        $moduleName = $this->moduleName;                
        $variation = VariationProduct::orderBy('id','DESC')->get();  
       
        return view('admin/'.$this->view.'/index', compact('moduleName', 'variation'));
    }

    public function create()
    {
        $moduleName = $this->moduleName;   
        $product = Product::where('status',1)->orderBy('id','DESC')->get();    
        return view('admin/'.$this->view.'/form', compact('moduleName','product'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',     
            'products' => 'required',     
        ]);  
        $data = $request->all();
        $data['name'] = ucfirst($request->name);
        $data['variation_id'] = rand(10000,99999);
        $data['products'] = implode(',',$request->products);
        $combo = VariationProduct::create($data);
              
        return redirect($this->route)->withStatus(__('Variation Product is added successfully.'));
    }
    
    public function edit($id)
    {
        $moduleName = $this->moduleName;  
        $variation = VariationProduct::find(decrypt($id));     
        $product = Product::where('status',1)->orderBy('id','DESC')->get(); 
        return view('admin/'.$this->view.'/_form', compact('moduleName', 'variation','product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',  
            'products' => 'required',                                                  
        ]);  
        $data = $request->all();  
        $data['name'] = ucfirst($request->name);   
        $data['products'] = implode(',',$request->products);
        VariationProduct::find($id)->update($data);        
        return redirect($this->route)->withStatus(__('Variation Product is updated successfully.'));
    }
}
