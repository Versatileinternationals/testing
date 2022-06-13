<?php

namespace App\Http\Controllers;

use jeremykenedy\LaravelRoles\Models\Permission;
use jeremykenedy\LaravelRoles\Models\Role;
use App\Models\PermissionRole;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\ModulePermission as MPer;

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
        $modules=['training'=>'Training','videoupload'=>'Videoupload','events'=>'Events','event_calender'=>'Event Calender','JobsPreparedness'=>'Jobs Preparedness','jobs'=>'Jobs','advisory'=>'Advisory','ExternalJobs'=>'External Jobs','business_resources'=>'Business Resources','businesstmpl'=>'Businesstmpl','online_application'=>'Online Application','faq'=>'Faq','QueryList'=>'Query List','trainee'=>'Trainee','trainning_calender'=>'Trainning Calender','self_paced'=>'Self Paced','online_quiz'=>'Online Quiz'];     
        return view('admin/'.$this->view.'/form', compact('moduleName','permissions','modules'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles',           
            'description' => 'required',          
        ]);
        $last = explode("-",str_slug($request->name), 3)  ;
        $modules=['training'=>'Training','videoupload'=>'Videoupload','events'=>'Events','event_calender'=>'Event Calender','JobsPreparedness'=>'Jobs Preparedness','jobs'=>'Jobs','advisory'=>'Advisory','ExternalJobs'=>'External Jobs','business_resources'=>'Business Resources','businesstmpl'=>'Businesstmpl','online_application'=>'Online Application','faq'=>'Faq','QueryList'=>'Query List','trainee'=>'Trainee','trainning_calender'=>'Trainning Calender','self_paced'=>'Self Paced','online_quiz'=>'Online Quiz'];     
        $role = Role::create([
            'name'          => $request->name,                                
            'slug'          => str_slug($request->name),
            'description'   => $request->description,
        ]);
        // $permissions = Permission::whereIn('id',$request->permission)->get();        
        // foreach ($permissions as $value) {
        //     $role->attachPermission($value);         
        // }
        foreach($modules as $key=>$module){
            $modulerecord=Module::create([
                'name'          => $key,                                
                'view_name'     => $module,
                'role_id'   => $role->id,
                'module'    =>$last[0],
            ]);
        }
        if($request->modulepermission){
            foreach($request->modulepermission as $mp){
                $moduleFind = Module::where('view_name',$mp)->where('module',$last[0])->first();
                $mpermission = MPer::create([
                    'module_id'=>$moduleFind->id,
                    'role_id'=>$moduleFind->role_id,
                ]);
            }
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
        // $role->syncPermissions($request->permission);
        return redirect($this->route)->withStatus(__('Role is updated successfully.'));
    }

    public function destroy($id)
    {
        //
    }

    public function moduleEdit($id)
    {
        $moduleName = 'permissions';  
        $modules = Module::where('role_id',decrypt($id))->get();  
        $modulesId = MPer::where('role_id',decrypt($id))->pluck('module_id')->toArray();  
        $modulesPermission = MPer::where('role_id',decrypt($id))->get();  
        $role = Role::find(decrypt($id));    

        return view('admin/'.$this->view.'/_permission', compact('moduleName','role','modulesPermission','modules','modulesId'));
    }

    public function moduleUpdate(Request $request, $id)
    {
        $modulesPermission = MPer::where('role_id',$id)->delete();
        if($request->permission){
            foreach($request->permission as $val){
                Mper::create([
                    'role_id'=>$id,
                    'module_id'=>$val
                ]);
            }
        }
        return redirect($this->route)->withStatus(__('Permission is updated successfully.'));
    }
}
