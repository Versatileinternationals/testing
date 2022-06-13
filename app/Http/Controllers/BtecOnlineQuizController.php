<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlzOnlineQuiz;

class BtecOnlineQuizController extends Controller
{

    public $route="online_quiz";
    public $view ="OnlineQuiz";
    public $moduleName = 'Online Quiz';

    public function index()
    {     
          
        $moduleName = $this->moduleName;                
        $BlzOnlineQuiz = BlzOnlineQuiz::where('status',1)->orderBy('id','DESC')->get();
		
        return view('admin/BlzInvest/'.$this->view.'/index',compact('moduleName','BlzOnlineQuiz'));
    }

    public function create()
    {
        $moduleName = $this->moduleName;   
       $BlzOnlineQuiz = BlzOnlineQuiz::where('status',1)->orderBy('id','DESC')->get();        
        return view('admin/BlzInvest/'.$this->view.'/form', compact('moduleName','BlzOnlineQuiz'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',  
            'questions'	 => 'required', 		
            'exam_from' => 'required', 
            'exam_to' => 'required', 
            'duration' => 'required',   			
            'Status' => 'required',
        ]);  
        
       
        
        $BlzOnlineQuiz = BlzOnlineQuiz::create([
             'title' => $request->title, 
            'questions'	 =>  $request->questions,		
            'exam_from' =>  $request->exam_from,
            'exam_to' =>  $request->exam_to,
            'duration' =>    $request->duration,			
            'Status' =>  $request->Status,
        ]);
              
        return redirect($this->route)->withStatus(__('Online Quiz Data is added successfully.'));
    }
    
    public function edit($id)
    {
        $moduleName = $this->moduleName;  
        $BlzOnlineQuiz = BlzOnlineQuiz::find($id);     
      
        return view('admin/BlzInvest/'.$this->view.'/_form', compact('moduleName', 'BlzOnlineQuiz'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Title' => 'required',  
            'Video'	 => 'required', 		
            'VideoCategory' => 'required',     
            'Status' => 'required',
        ]);  
        
       
        $BlzOnlineQuiz = BlzOnlineQuiz::find($id)->update([
           'Title' => $request->Title,
            'Video' => $request->Video,
            'VideoCategory' => $request->VideoCategory,
            'VideoDescription' => $request->VideoDescription, 
            
            'Status' => $request->Status,
        ]);
        return redirect($this->route)->withStatus(__('Online Quiz is updated successfully.'));
    }
     public function delete($id)
	{
        $moduleName = $this->moduleName;  
        $BlzOnlineQuiz = BlzOnlineQuiz::find($id)->delete();
        return redirect($this->route)->withStatus(__('Online Quiz Data delete successfully.'));
    }
}