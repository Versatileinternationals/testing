<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Combo;
use App\Models\Product;

class ComboController extends Controller
{
    public $route="combo";
    public $view ="combo";
    public $moduleName = 'Combo';

    public function index()
    {        
        $moduleName = $this->moduleName;                
        $combo = Combo::orderBy('id','DESC')->get();  
        return view('admin/'.$this->view.'/index', compact('moduleName', 'combo'));
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
            'price' => 'required',     
            'products' => 'required',     
            'status' => 'required',
        ]);  
        $data = $request->all();
        $data['name'] = ucfirst($request->name);
        $data['combo_id'] = rand(10000,99999);
        $data['products'] = implode(',',$request->products);
        $data['added_by'] = auth()->user()->id;
        $combo = Combo::create($data);
              
        return redirect($this->route)->withStatus(__('Combo is added successfully.'));
    }
    
    public function edit($id)
    {
        $moduleName = $this->moduleName;  
        $combo = Combo::find(decrypt($id));     
        $combo->product_price = Product::whereIn('id',explode(',',$combo->products))->sum('sale_price');
        $product = Product::where('status',1)->orderBy('id','DESC')->get(); 
        return view('admin/'.$this->view.'/_form', compact('moduleName', 'combo','product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',  
            'price' => 'required',     
            'products' => 'required',                                         
            'status' => 'required',            
        ]);  
        $data = $request->all();  
        $data['name'] = ucfirst($request->name);   
        $data['products'] = implode(',',$request->products);
        $data['added_by'] = auth()->user()->id;
        Combo::find($id)->update($data);        
        return redirect($this->route)->withStatus(__('Combo is updated successfully.'));
    }

    public function getProduct(Request $request){
        $price = Product::whereIn('id',$request->id)->sum('sale_price');
        return $price;
    }

}
