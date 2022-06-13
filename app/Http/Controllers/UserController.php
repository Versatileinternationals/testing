<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Auth;

class UserController extends Controller
{
    
    public $route="users";
    public $view ="users";
    public $moduleName = 'Users';

    public function index(Request $request, $type=null)
    {        
	
        $moduleName = $this->moduleName;
        $view = $this->view;        
        // $users = User::where('id','!=',auth()->user()->id)->with(['roles'])->orderBy('id','DESC')->get();  
        $sql = User::with(['roles'])->where('id','!=',auth()->user()->id);
        if($type != null){
            $sql->where('user_type', $type);
            //$view = $view.'.'.$type;
        }
        $sql->whereHas('roles', function ($query) {
            $query->where('name','!=', 'Customer');
        })->orderBy('id','DESC');
        $users = $sql->get();
       
        
        return view('admin/'.$view.'/index', compact('moduleName', 'users', 'type'));
    }
    
    public function contact(Request $request, $type=null)
    {        
	
        $moduleName = "Contact Us-Query List";
        $view = "contactus";
        $sql = User::with(['roles'])->where('id','!=',auth()->user()->id);
        if($type != null){
            $sql->where('user_type', $type);
            //$view = $view.'.'.$type;
        }
        $sql->whereHas('roles', function ($query) {
            $query->where('name','!=', 'Customer');
        })->orderBy('id','DESC');
        $users = $sql->get();
        $contact=DB::table("contactus")->orderBy('Id','DESC')->paginate(10);
       
        
        return view('admin/'.$view.'/index', compact('moduleName', 'contact', 'users', 'type'));
    }
    
	public function buyers()
    {        
	   
        $moduleName = 'Buyer'; 
            
         $users = User::where('user_type','buyer')->orderBy('id','DESC')->get(); 
        return view('admin/'.$this->view.'/index', compact('moduleName', 'users'));
    }
	
	public function investor()
    {        
	   
        $moduleName = 'Investor'; 
            
         $users = User::where('user_type','investor')->orderBy('id','DESC')->get(); 
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
    
    public function edit($id)
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
            'user_type' => 'admin'
            
        );
        $remember = $request->get('remember');
        if (Auth::attempt($userdata,$remember)) {              
            return redirect()->route('dashboard');                                                                                                             
        } 
        else {            
            return back()->with('error_msg', 'Invalid Username or Password');
        }
    } 
	
	public function logout(Request $request ) {
    $request->session()->flush();
    Auth::logout();
    return Redirect('admin');
    }
}
