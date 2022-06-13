<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlzQueryList;
use App\Models\Add_Training_Mo;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\AddTopic;
use App\Models\AddSubTopic;
use Excel;

class BlzInvstQueryListsController extends Controller
{
    public $route="QueryList";
    public $view ="QueryList";
    public $moduleName ='Topics';

    public function index()
    {     
          
        $moduleName = $this->moduleName;                
        $faq = BlzQueryList::orderBy('id','DESC')->get();  
        return view('admin/BlzInvest/'.$this->view.'/index', compact('moduleName', 'faq'));
    }
   

    public function create()
    {
        $moduleName = $this->moduleName;           
        return view('admin/BlzInvest/'.$this->view.'/form', compact('moduleName'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',     
            'querys' => 'required',     
            'Status' => 'required',
        ]);  
        
		$QueryLists = BlzQueryList::create([

            'title' => $request->title,
            'querys' => $request->querys,
            'Status' => $request->Status, 
        ]);

        
        return redirect('blzinvst_QueryList')->withStatus(__('QueryList is added successfully.'));
    }
    
    public function edit($id)
    {
        $moduleName = $this->moduleName;  
        $QueryLists = BlzQueryList::find($id);     
      
        return view('admin/BlzInvest/'.$this->view.'/_form', compact('moduleName', 'QueryLists'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',                                          
            'querys' => 'required', 
            'Status' => 'required', 
        ]); 
   
         $QueryLists = BlzQueryList::find($id)->update([

            'title' => $request->title,
            'querys' => $request->querys,
            'Status' => $request->Status,

        ]);
    
        return redirect($this->route)->withStatus(__('QueryList is updated successfully.'));
    }
     public function delete($id)
	{
        $moduleName = $this->moduleName;  
        $QueryLists = BlzQueryList::find($id)->delete();
        return redirect($this->route)->withStatus(__('QueryList is delete successfully.'));
    }
    
    public function Add_Training_Model(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'course' => 'required',
            'model_name' => 'required',
            'topic_name' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {
            $catesub = new Add_Training_Mo;
            $catesub->course =  $request->input('course');
            $catesub->model_name = $request->input('model_name');
            $catesub->topic_name = $request->input('topic_name');
            $catesub->save();
            return response()->json([
                'status' => 200,
                'success' => 'Record added successfully'
            ]);
        }
    }
    public function blzinvst_add_module($id)
    {     
          $ids = decrypt($id);
        $moduleName = $this->moduleName; 
        $topicsub = AddSubTopic::where('training_id',$ids)->get();
        $topic = AddTopic::where('tri_id',$ids)->get();
        $trenid  = DB::table("BlzInvst_training")->where('id',$ids)->first();  
        return view('admin/BlzInvest/OnlineQuiz/add_module', compact('moduleName', 'trenid','topicsub','topic'));
    }
    
    public function Blzinvst_fetch_data()
    {
        // $fetch_data = Add_Training_Mo::all();
       $fetch_data= DB::table("Add_Training_Mos")
                ->join("Trainning_Course","Add_Training_Mos.course","=","Trainning_Course.id")
                ->select("Trainning_Course.Course_Name","Add_Training_Mos.*")
                ->get();
               
         return response()->json([
                'status' => 200,
                'success' => $fetch_data
            ]);
    }
    public function blzinvst_delete($id)
    {
        $delete = Add_Training_Mo::find($id);
        $delete->delete();
        return response()->json([
                'status' => 200,
                'success' => 'Record delete successfully'
            ]);
    }
    public function blzinvst_edit($id)
    {
        $edit = Add_Training_Mo::find($id);
        return response()->json([
                'status' => 200,
                'success' => $edit
            ]);
    }
}
