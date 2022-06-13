<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlzSelfPaced;

class SelfPacedController extends Controller
{

    public $route="self_paced";
    public $view ="selfpaced";
    public $moduleName = 'SelfPaced';

    public function index()
    {     
          
        $moduleName = $this->moduleName;                
        $selfpaced = BlzSelfPaced::where('status',1)->orderBy('id','DESC')->get();
		
        return view('admin/BlzInvest/'.$this->view.'/index',compact('moduleName','selfpaced'));
    }

    public function create()
    {
        $moduleName = $this->moduleName;   
       $selfpaced = BlzSelfPaced::where('status',1)->orderBy('id','DESC')->get();        
        return view('admin/BlzInvest/'.$this->view.'/form', compact('moduleName','selfpaced'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Title' => 'required',  
           		
            'VideoCategory' => 'required',     
            'Status' => 'required',
        ]);  
        
        if ($request->hasFile('Video')) {   
            $video = $request->file('Video');
            $videoName = uniqid() . '.' . $video->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/upload');
            $video->move($destinationPath, $videoName);         
            $Videos = $videoName;
        }else{
            $Videos = '';
        } 
        
        $selfpaced = BlzSelfPaced::create([
            'Title' => $request->Title,
            'VideoCategory' => $request->VideoCategory,
			'Video' => $Videos,
            'VideoDescription' => $request->VideoDescription,
            'Status' => $request->Status
        ]);
              
        return redirect($this->route)->withStatus(__('SelfPaced Data is added successfully.'));
    }
    
    public function edit($id)
    {
        $moduleName = $this->moduleName;  
        $selfpaced = BlzSelfPaced::find($id);     
      
        return view('admin/BlzInvest/'.$this->view.'/_form', compact('moduleName', 'selfpaced'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Title' => 'required',  
           	
            'VideoCategory' => 'required',     
            'Status' => 'required',
        ]);  
        
       
        $selfpaced = BlzSelfPaced::find($id)->update([
           'Title' => $request->Title,
            'Video' => $request->Video,
            'VideoCategory' => $request->VideoCategory,
            'VideoDescription' => $request->VideoDescription, 
            
            'Status' => $request->Status,
        ]);
        return redirect($this->route)->withStatus(__('Brand is updated successfully.'));
    }
     public function delete($id)
	{
        $moduleName = $this->moduleName;  
        $selfpaced = BlzSelfPaced::find($id)->delete();
        return redirect($this->route)->withStatus(__('SelfPaced Data delete successfully.'));
    }
}