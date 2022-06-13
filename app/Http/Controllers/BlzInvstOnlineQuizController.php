<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Models\BlzOnlineQuiz;
use App\Models\QuizAddModel;
use App\Models\Content;
use App\Models\Add_Training_Mo;
use App\Models\TrainningCourse;
use App\Models\PreAssesment;
use App\Models\blz_final_assesment;
use App\Models\AddTopic;
use App\Models\AddSubTopic;
use DB;

class BlzInvstOnlineQuizController extends Controller
{

    public $route="online_quiz";
    public $view ="OnlineQuiz";
    public $moduleName = 'Online Quiz';

    public function index()
    {     
          
        $moduleName = $this->moduleName;                
        $BlzOnlineQuiz = BlzOnlineQuiz::where('status',1)->orderBy('id','DESC')->get();
		$Course = DB::table("Trainning_Course")->get();
		
        return view('admin/BlzInvest/'.$this->view.'/index',compact('moduleName','BlzOnlineQuiz','Course'));
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
        	$ids = decrypt($id);	
        $moduleName = $this->moduleName;  
        $BlzOnlineQuiz = BlzOnlineQuiz::find($ids);     
      
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
    
    public function blzinvst_add_quiz($id)
    {
		
        $moduleName = $this->moduleName;   
           $trenid = DB::table("BlzInvst_training")->where('id',$id)->first(); 
        return view('admin/BlzInvest/'.$this->view.'/add_quiz', compact('moduleName','trenid'));
    }
    
    public function Blzinvst_add_quiz_Do(Request $request,$id)
    {
        
        $validator = Validator::make($request->all(),[
            
            'question.*'    => 'required',
            'option1.*'     => 'required',
            'option2.*'     => 'required',
            'option3.*'     => 'required',
            'option4.*'     => 'required',
            'answere.*'     => 'required',
            
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        }
        else{
            $Course = AddTopic::find($id);
          
            $question = $request->question;
            $option1 = $request->option1;
            $option2 = $request->option2;
            $option3 = $request->option3;
            $option4 = $request->option4;
            $answere = $request->answere;
            
           
            for($count = 0; $count < count($answere); $count++)
            {
                $data = array(
                    'question'        => $question[$count],
                    'option1' => $option1[$count],
                    'option2'     => $option2[$count],
                    'option3'     => $option3[$count],
                    'option4'     => $option4[$count],
                    'answere'     => $answere[$count],
                    'course_id' => $Course->id,
                    
                );
                $insert_data[] = $data;
            }
            QuizAddModel::insert($insert_data);
            
            return response()->json([
                'status' => 200,
                'message' => 'Recored successfully'
            ]);
        }
    }
        public function blzinvst_add_content($id)
    {
		
        $moduleName = $this->moduleName;   
           $trenid = DB::table("BlzInvst_training")->where('id',$id)->first(); 
        return view('admin/BlzInvest/'.$this->view.'/content', compact('moduleName','trenid'));
    }
     public function blzinvst_add_content_do(Request $request,$id)
    {
       
        
        $validator = Validator::make($request->all(), [
            'conten' => 'required',
            // 'audio'    => 'required',
            // 'image'          => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {
            $Audio =  new Content;
            $Audio->conten   = $request->input('conten');
            $Audio->content_id = $id;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '_' . $request->conten . '.' . $extension;
                $file->move('images/Audio_image/', $filename);
                $Audio->image = $filename;
            }
            if ($request->hasFile('audio')) {
                $file = $request->file('audio');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '_' . $request->conten . '.' . $extension;
                $file->move('images/Recorded_Audio/', $filename);
                $Audio->audio = $filename;
            }
            if ($request->hasFile('video')) {
                $file = $request->file('video');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '_' . $request->conten . '.' . $extension;
                $file->move('images/video/', $filename);
                $Audio->video = $filename;
            }

            $Audio->save();
            if ($Audio) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Record added successfully'
                ]);
            }
        }
    }
    
    function blzinvst_quiz_list()
    {
        $moduleName = $this->moduleName;                
        $BlzOnlineQuiz = BlzOnlineQuiz::where('status',1)->orderBy('id','DESC')->get();
		$Course = DB::table("Trainning_Course")->get();
		
        return view('admin/BlzInvest/'.$this->view.'/quiz_list',compact('moduleName','BlzOnlineQuiz','Course'));
    }
    function blzinvst_fetch_data_quiz()
    {
        $fetch = QuizAddModel::all();
        if($fetch)
        {
             return response()->json([
                 'status' => 200,
                 'success' => $fetch
                 ]);
        }
    }
    function blzinvst_quiz_delete($id)
    {
        if(QuizAddModel::where('id',$id)->exists())
        {
            $deleteq = QuizAddModel::find($id);
            $deleteq->delete();
            return response()->json([
                 'status' => 200,
                 'success' =>  "record deleted successfully"
                 ]);
        }
        else
        {
            
        }
    }
    
    function blzinvst_content_list()
    {
         $moduleName = "Content List";                
        $BlzOnlineQuiz = BlzOnlineQuiz::where('status',1)->orderBy('id','DESC')->get();
		$Course = DB::table("Trainning_Course")->get();
		
        return view('admin/BlzInvest/'.$this->view.'/content_list',compact('moduleName','BlzOnlineQuiz','Course'));
    }
    function blzinvst_content_list_fetch()
    {
        $fetch = Content::all();
        return response()->json([
                 'status' => 200,
                 'success' =>  $fetch
                 ]);
    }
    public function blzinvst_pre_assesment($id)
    {
	
	$id = decrypt($id);	
        $moduleName = 'Pre Assesment';   
        $trenid = DB::table("BlzInvst_training")->where('id',$id)->first(); 
        return view('admin/BlzInvest/'.$this->view.'/add_pre_as', compact('moduleName','trenid'));
    }
    
    public function blzinvst_pre_assesment_save(Request $request,$id)
    {
        
        $validator = Validator::make($request->all(),[
            'question.*'    => 'required',
            'option1.*'     => 'required',
            'option2.*'     => 'required',
            'option3.*'     => 'required',
            'option4.*'     => 'required',
            'answere.*'     => 'required',
            // 'conten' => 'required'
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        }
        else{
            $Course = DB::table('BlzInvst_training')->where('id',$id)->first();
          
            $question = $request->question;
            $option1 = $request->option1;
            $option2 = $request->option2;
            $option3 = $request->option3;
            $option4 = $request->option4;
            $answere = $request->answere;
            // $course_id = $Course->id;
            
            // $cont = $catesub->id;
           
            for($count = 0; $count < count($answere); $count++)
            {
                $data = array(
                    'question'        => $question[$count],
                    'option1' => $option1[$count],
                    'option2'     => $option2[$count],
                    'option3'     => $option3[$count],
                    'option4'     => $option4[$count],
                    'answere'     => $answere[$count],
                    'tri_id' => $Course->id,
                    
                );
                $insert_data[] = $data;
            }
            PreAssesment::insert($insert_data);
            return response()->json([
                'status' => 200,
                'message' => 'Recored successfully'
            ]);
        }
    }
	
	 public function blzinvst_final_assesment($id)
    {
		$id = decrypt($id);
        $moduleName = 'Final Assesment';   
        $trenid = DB::table("BlzInvst_training")->where('id',$id)->first(); 
        return view('admin/BlzInvest/'.$this->view.'/add_final_as', compact('moduleName','trenid'));
    }
    
    public function blzinvst_final_assesment_save(Request $request,$id)
    {
        
        $validator = Validator::make($request->all(),[
            'question.*'    => 'required',
            'option1.*'     => 'required',
            'option2.*'     => 'required',
            'option3.*'     => 'required',
            'option4.*'     => 'required',
            'answere.*'     => 'required',
           
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        }
        else{
            $Course = DB::table('BlzInvst_training')->where('id',$id)->first();
          
            
            $question = $request->question;
            $option1 = $request->option1;
            $option2 = $request->option2;
            $option3 = $request->option3;
            $option4 = $request->option4;
            $answere = $request->answere;
            // $course_id = $Course->id;
            
            // $cont = $catesub->id;
           
            for($count = 0; $count < count($answere); $count++)
            {
                $data = array(
                    'question'        => $question[$count],
                    'option1' => $option1[$count],
                    'option2'     => $option2[$count],
                    'option3'     => $option3[$count],
                    'option4'     => $option4[$count],
                    'answere'     => $answere[$count],
                    'ti_id' => $Course->id,
                    
                );
                $insert_data[] = $data;
            }
            blz_final_assesment::insert($insert_data);
            
            return response()->json([
                'status' => 200,
                'message' => 'Recored successfully'
            ]);
        }
    }
     /*==================================*/
    /*------ Delete Audio Here -----*/
    /*==================================*/
    public function blzinvst_Delete_Audio(Request $request, $id)
    {
        if (Content::where("id", $id)->exists()) {
            // if (Content::where("id", $id)->where("status", "Active")->first()) {
                $delete_Audio = Content::find($id);
                $imagePath = public_path('images/Audio_image/' . $delete_Audio->image);
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
                $Path = public_path('images/Recorded_Audio/' . $delete_Audio->audio);
                if (File::exists($Path)) {
                    File::delete($Path);
                }
                $Path = public_path('images/video/' . $delete_Audio->video);
                if (File::exists($Path)) {
                    File::delete($Path);
                }
                $delete_Audio->delete();
                if ($delete_Audio) {
                    return response()->json([
                        "status" => 200,
                        'success' => "Record delete successfully"
                    ]);
                }
            } else {
                return response()->json([
                    "status" => 400,
                    "error" => "Sorry Audio not active"
                ]);
            }
        // } else {
        //     return response()->json([
        //         "status" => 400,
        //         "error" => "Sorry something went wrong"
        //     ]);
        // }
    }
    
    public function blzinvst_add_topic(Request $request,$id)
    {
        
        $validator = Validator::make($request->all(),[
            'top_name'    => 'required',
            
            // 'conten' => 'required'
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        }
        else{
            $Course = DB::table('BlzInvst_training')->where('id',$id)->first();
            $top = new AddTopic();
            $top->top_name = $request->top_name;
            $top->tri_id = $Course->id;
           $top->save();
            return response()->json([
                'status' => 200,
                'message' => 'Recored successfully'
            ]);
        }
    }
    //
     public function blzinvst_update_subtopic(Request $request,$id)
    {
        
        $validator = Validator::make($request->all(),[
            'top_name'    => 'required',
            
            // 'conten' => 'required'
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        }
        else{
            $Course = DB::table('BlzInvst_training')->where('id',$id)->first();
            $top = AddTopic::find($id);
            $top->top_name = $request->top_name;
           
           $top->update();
            $training_id=encrypt($request->training_id);     
           return redirect('blzinvst_add_module/')->withStatus(__('Update successfully.'));
        }
    }
    
	public function blzinvst_subtopic($id)
    {
        $moduleName = $this->moduleName;   
         $id = decrypt($id);
        $moduleName = 'Sub Topics';   
        $trenid = DB::table("BlzInvst_training")->where('id',$id)->first();     
        return view('admin/BlzInvest/'.$this->view.'/add_sub_topic', compact('moduleName','trenid'));
    }
    public function blzinvst_subtopic_edit($id)
    {
        $moduleName = $this->moduleName;   
         $id = decrypt($id);
        $moduleName = 'Edit Topics';   
        // $trenid = DB::table("BlzInvst_training")->where('id',$id)->first();    
        $trenid = AddTopic::find($id);
        return view('admin/BlzInvest/'.$this->view.'/edit_topic', compact('moduleName','trenid'));
    }
	function blzinvst_subtopic_delete($id)
	{
	    $id = decrypt($id);
	    
	    $delete = AddTopic::find($id);
	    $delete->delete();
	    if($delete)
	    {
	        return Redirect()->back()->with(['message' => 'The Message']);
	    }
	}
	public function blzinvst_add_subtopic(Request $request)
    {
		
        $request->validate([
            'subtop_name' => 'required',  
           
        ]);  
        
       
        
        $BlzOnlineQuiz = AddSubTopic::create([
             'subtop_name' => $request->subtop_name,
			 'training_id' => $request->training_id, 	
            
        ]);
        $training_id=encrypt($request->training_id);     
        return redirect('blzinvst_add_module/'.$training_id)->withStatus(__('Online Quiz Data is added successfully.'));
    }
	//
    public function _blzinvst_add_subtopic(Request $request,$id)
    {
        
        $validator = Validator::make($request->all(),[
            'subtop_name'    => 'required',
            
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        }
        else{
            $Course = DB::table('BlzInvst_training')->where('id',$id)->first();
            $top = new AddSubTopic();
            $top->subtop_name = $request->subtop_name;
            $top->tri_id = $Course->id;
            $top->save();
            return response()->json([
                'status' => 200,
                'message' => 'Recored successfully'
            ]);
        }
    }
    public function blzinvst_add_quiz_form($id)
    {
        	$ids = decrypt($id);
        $moduleName = $this->moduleName;  
        $trenid = AddTopic::find($ids);     
      
        return view('admin/BlzInvest/'.$this->view.'/add_quiz', compact('moduleName', 'trenid'));
    }
    public function blzinvst_add_content_form($id)
    {
        $ids = decrypt($id);	
        $moduleName = $this->moduleName;  
        $trenid = AddSubTopic::find($ids);     
      
        return view('admin/BlzInvest/OnlineQuiz/content', compact('moduleName', 'ids'));
    }
    
    
    function blzinvst_fetch_pre_ass_list()
    {
        $moduleName = $this->moduleName;                
        $BlzOnlineQuiz = BlzOnlineQuiz::where('status',1)->orderBy('id','DESC')->get();
		$Course = DB::table("Trainning_Course")->get();
		
        return view('admin/BlzInvest/'.$this->view.'/add_pre_as_list',compact('moduleName','BlzOnlineQuiz','Course'));
    }
    function blzinvst_fetch_pre_ass_list_date()
    {
        $fetch = PreAssesment::all();
        if($fetch)
        {
             return response()->json([
                 'status' => 200,
                 'success' => $fetch
                 ]);
        }
    }
    function blzinvst_pre_delete($id)
    {
        if(PreAssesment::where('id',$id)->exists())
        {
            $deleteq = PreAssesment::find($id);
            $deleteq->delete();
            return response()->json([
                 'status' => 200,
                 'success' =>  "record deleted successfully"
                 ]);
        }
        else
        {
            
        }
    }
    
    
    function blzinvst_final_assesment_list()
    {
        $moduleName = $this->moduleName;                
        $BlzOnlineQuiz = BlzOnlineQuiz::where('status',1)->orderBy('id','DESC')->get();
		$Course = DB::table("Trainning_Course")->get();
		
        return view('admin/BlzInvest/'.$this->view.'/add_final_as_list',compact('moduleName','BlzOnlineQuiz','Course'));
    }
    function blzinvst_final_assesment_data()
    {
        $fetch = blz_final_assesment::all();
        if($fetch)
        {
             return response()->json([
                 'status' => 200,
                 'success' => $fetch
                 ]);
        }
    }
    function blzinvst_final_delete($id)
    {
        if(blz_final_assesment::where('id',$id)->exists())
        {
            $deleteq = blz_final_assesment::find($id);
            $deleteq->delete();
            return response()->json([
                 'status' => 200,
                 'success' =>  "record deleted successfully"
                 ]);
        }
        else
        {
            
        }
    }
}