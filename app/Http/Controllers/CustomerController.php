<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Auth;

class CustomerController extends Controller
{
    //
    public $route="customer";
    public $view ="customer";
    public $moduleName = 'Customers';

    public function index()
    {        
        $moduleName = $this->moduleName;                
        $users = User::with(['roles'])->where('id','!=',auth()->user()->id)->whereHas('roles', function ($query) {
            $query->where('name','=', 'Customer');
        })->orderBy('id','DESC')->get();  
        return view('admin/'.$this->view.'/index', compact('moduleName', 'users'));
    }

    public function create()
    {
        $moduleName = $this->moduleName;           
        return view('admin/'.$this->view.'/form', compact('moduleName'));
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
        $role = Role::where('name','Customer')->first();
        if($role){
            $user->attachRole($role);
            User::find($user->id)->update(['role_id'=>$role->id]);
        }
       
        return redirect($this->route)->withStatus(__('Customer is added successfully.'));
    }
    
    public function edit($id)
    {
        $moduleName = $this->moduleName;  
        $user = User::find(decrypt($id));     
      
        return view('admin/'.$this->view.'/_form', compact('moduleName', 'user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',                         
            'email' => 'required|unique:users,email,'.$id,                    
            'phone' => 'required',     
            'phone_code' => 'required',                     
            'address' => 'required',     
            'gender' => 'required',     
            'status' => 'required',            
        ]);  
        $data = $request->all();  
        $data['name'] = ucfirst($request->name);     
        User::find($id)->update($data);        
        return redirect($this->route)->withStatus(__('Customer is updated successfully.'));
    }

    public function view($id)
    {
        $moduleName = $this->moduleName;  
        $user = User::with(['useraddress'])->find(decrypt($id));     
        
        return view('admin/'.$this->view.'/view', compact('moduleName', 'user'));
    }
    
}
