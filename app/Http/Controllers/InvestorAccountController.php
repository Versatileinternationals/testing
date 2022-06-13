<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Auth;
use Excel;


class InvestorAccountController extends Controller
{
    public $route="investor_account";
    public $view ="investor_account";
    public $moduleName = 'Investor Account';

    public function index()
    {        
        $moduleName = $this->moduleName;                
        $InvestorAccounts = User::where('user_type','investor')->orderBy('id','DESC')->get();  
		
        return view('admin/Admb2b/'.$this->view.'/index', compact('moduleName','InvestorAccounts'));
    }

    public function create()
    {
        $moduleName = $this->moduleName;  
       
        return view('admin/Admb2b/'.$this->view.'/form',compact('moduleName'));
    }

    public function store(Request $request)
    {
    
       $request->validate([
            'name' => 'required',     
            'email' => 'required|unique:users',           
            'phone' => 'required',     
            'phone_code' => 'required',          
              
            'address' => 'required',     
            'gender' => 'required',     
            'status' => 'required',
            'password' => 'required|min:6',     
        ]);  
        $data = $request->all();
        $data['name'] = ucfirst($request->name);
        $data['password'] = Hash::make($request->password);
        $data['user_id'] = rand(10000,99999);
        $data['image'] = 'default.png';
        $data['provider'] = 'LOCAL';
        
        $user = User::create($data);

      
        return redirect($this->route)->withStatus(__('User is added successfully.'));
    }
	public function view($id){
        $moduleName = $this->moduleName;  
        $UserData = User::find($id);
       
        return view('admin/Admb2b/'.$this->view.'/view', compact('moduleName', 'UserData'));
    }
	  public function edit($id)
    {
        $moduleName = $this->moduleName;  
        $user = User::find($id);     
        //$role = Role::where('name','!=','Customer')->get();
      
        return view('admin/Admb2b/'.$this->view.'/_form', compact('moduleName', 'user'));
    }


     public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',                         
            'email' => 'required|unique:users,email,'.$id,                    
            'phone' => 'required',     
            'phone_code' => 'required',          
           // 'role_id' => 'required',     
            'address' => 'required',     
            'gender' => 'required',     
            'status' => 'required',            
        ]);  
        $data = $request->all();  
        $data['name'] = ucfirst($request->name);     
        User::find($id)->update($data);        
        return redirect($this->route)->withStatus(__('User is updated successfully.'));
    }
	  public function acivate_account(Request $request, $id)
    {
        
       $id=decrypt($id);
	   $update = User::find($id);
	   $update->status = '1';
	   $update->save();
      return redirect()->back()->with('success','Your Account Activated Successfully!');  
       // return redirect($this->route)->withStatus(__('Your Account Activated Successfully!'));
    }
   
     public function deacivate_account(Request $request, $id)
    {
        
     
        $id=decrypt($id);
	    $update = User::find($id);
	    $update->status = '0';  
        $update->save();		
		 return redirect()->back()->with('error','Your Account DeActivated Successfully');
        //return redirect($this->route)->withStatus(__('Your Account DeActivated Successfully'));
    }

   
    public function productgallery($id){
        $moduleName = $this->moduleName;  
        $product = Product::find(decrypt($id));
        return view('admin/'.$this->view.'/gallery', compact('moduleName', 'product'));
    }

    
}
