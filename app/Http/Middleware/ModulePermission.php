<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use App\Models\ModulePermission as MPer;
use App\Models\User;
use App\Models\Module;
use Illuminate\Support\Facades\Auth;

class ModulePermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $last = explode("_", \Route::current()->uri, 3);
        $lastt = explode("/", $last[1], 3);
        $first=strtok(\Route::current()->uri,'_');
        $module=Module::where('name',$lastt[0])->where('module',$first)->first();
        if($module != null){
            if($module->role_id == Auth::user()->role_id || Auth::user()->role_id == 1){
                $user_permission=MPer::where('role_id',Auth::user()->role_id)->where('module_id',$module->id)->first();
                if($user_permission == null){
                    return $next($request);
                }
                else{
                    return redirect('dashboard');
                }

            }else{
                return redirect('dashboard');
            }
        }
        return $next($request);
    }
}
