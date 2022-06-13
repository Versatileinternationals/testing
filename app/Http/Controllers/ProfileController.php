<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProfile;
use App\Models\User;
use Validator;
use Auth;
use Session;

class ProfileController extends Controller
{
    public $route="profile";
    public $view ="profile";
    public $moduleName = 'Profile';

    public function index()
    {        
        $id=Auth::user()->id;
        $moduleName = $this->moduleName;                
        /*
        if(UserProfile::where('user_id', $id)->count() == 0){
            $product = UserProfile::create([
                'user_id' => $id
            ]);
        
        }
        */
        $profile = User::where('id', $id)->first();
        
        return view('admin/'.$this->view.'/_form', compact('moduleName', 'profile'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',     
            'email' => 'required',     
            'phone' => 'required',     
            'address' => 'required',         
            'city' => 'required',            
        ]);  
        $data = $request->all();  
           
        if ($request->hasFile('image')) {   
            $image = $request->file('image');
            $name = uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/upload');
            $image->move($destinationPath, $name);         
            $data['image'] = $name;
        }   
        
        User::find($id)->update($data);        
        return redirect($this->route)->withStatus(__('Profile is updated successfully.'));
    }

}
