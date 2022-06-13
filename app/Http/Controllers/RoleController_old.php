<?php

namespace App\Http\Controllers;

use jeremykenedy\LaravelRoles\Models\Permission;
use jeremykenedy\LaravelRoles\Models\Role;
use App\Models\PermissionRole;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public $route="role";
    public $view ="role";
    public $moduleName = 'Role';

    public function index()
    {        
        $moduleName = $this->moduleName;        
        $role = Role::get();
        return view('admin/'.$this->view.'/index', compact('moduleName', 'role'));
    }

    public function create()
    {
        $moduleName = $this->moduleName;  
        $permissions = Permission::get()->groupBy('model');
           
        return view('admin/'.$this->view.'/form', compact('moduleName','permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles',           
            'description' => 'required',          
        ]);  
       
       
        $role = Role::create([
            'name'          => $request->name,                                
            'slug'          => str_slug($request->name),
            'description'   => $request->description,
        ]);
        $permissions = Permission::whereIn('id',$request->permission)->get();        
        foreach ($permissions as $value) {
            $role->attachPermission($value);         
        }
      
        return redirect($this->route)->withStatus(__('Role is added successfully.'));

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $moduleName = $this->moduleName;  
        $role = Role::find(decrypt($id));     
        $permissions = Permission::get()->groupBy('model');
        $existPermissions = PermissionRole::where('role_id', decrypt($id))->pluck('permission_id')->toArray();

        return view('admin/'.$this->view.'/_form', compact('moduleName', 'permissions', 'existPermissions', 'role'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,'.$id,                    
            'description' => 'required',          
        ]);  
        Role::find($id)->update([
            'name'          => $request->name,                       
            'slug'          => str_slug($request->name),
            'description'   => $request->description
        ]);
        $role = Role::find($id);
        $role->syncPermissions($request->permission);
        return redirect($this->route)->withStatus(__('Role is updated successfully.'));
    }

    public function destroy($id)
    {
        //
    }
}
