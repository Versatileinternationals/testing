<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use App\Models\Dashboard;
use App\Models\User;
use App\Models\BlzJobs;
use App\Models\Product;

use Auth;

class  DashboardController extends Controller
{
    //
    public $route="dashboard";
    public $view ="dashboard";
    public $moduleName = 'Dashboard';

    public function index(Request $request, $type=null)
    {        
	
        $moduleName = $this->moduleName;
        $view = $this->view;   
		$users =User::count();
		$pending_account =User::where('status','0')->count(); 
        $Online_Users =User::where('IsOnline','1')->count();  		
        $active_jobs=BlzJobs::where('Status','1')->count(); 
        $all_product=Product::count(); 		
		$Online_Users_display=User::where('user_type','!=','admin')->where('IsOnline','1')->get();
        $dasboard = User::whereHas('roles')->count();   
       
        return view('admin/'.$view.'/index', compact('moduleName', 'dasboard','users','pending_account','active_jobs','all_product','Online_Users','Online_Users_display'));
    }
    
	public function buyers()
    {        
	    
        $moduleName = $this->moduleName;        
        // $users = User::where('id','!=',auth()->user()->id)->with(['roles'])->orderBy('id','DESC')->get();  
        $users = User::with(['roles'])->where('id','!=',auth()->user()->id)->whereHas('roles', function ($query) {
            $query->where('name','!=', 'Customer');
        })->orderBy('id','DESC')->get();       
        return view('admin/'.$this->view.'/index', compact('moduleName', 'users'));
    }
	
    public function create(Request $request, $type=null)
    {
        $moduleName = $this->moduleName;  
        $role = Role::where('name','!=','Customer')->get();
          
        return view('admin/'.$this->view.'/form', compact('moduleName','role', 'type'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',     
            'email' => 'required|unique:users',           
            'phone' => 'required',     
            'phone_code' => 'required',          
            'role_id' => 'required',     
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
        $role = Role::find($request->role_id);
        $user->attachRole($role);
      
        return redirect($this->route)->withStatus(__('User is added successfully.'));
    }
    
    public function edit($type,$id)
    {
        $moduleName = $this->moduleName;  
        $user = User::find(decrypt($id));     
        $role = Role::where('name','!=','Customer')->get();
      
        return view('admin/'.$this->view.'/_form', compact('moduleName', 'user', 'role'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',                         
            'email' => 'required|unique:users,email,'.$id,                    
            'phone' => 'required',     
            'phone_code' => 'required',          
            'role_id' => 'required',     
            'address' => 'required',     
            'gender' => 'required',     
            'status' => 'required',            
        ]);  
        $data = $request->all();  
        $data['name'] = ucfirst($request->name);     
        User::find($id)->update($data);        
        return redirect($this->route)->withStatus(__('User is updated successfully.'));
    }


    public function login(Request $request)
    {        
        $userdata = array(
            'email' => $request->email,
            'password' => $request->password,          
        );
        $remember = $request->get('remember');
        if (Auth::attempt($userdata,$remember)) {              
            return redirect()->route('index');                                                                                                             
        } 
        else {            
            return redirect('login')->with('error_msg', 'Invalid Username or Password');
        }
    } 
}
