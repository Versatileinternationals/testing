<?php

namespace App\Http\Controllers;

use Validator;
use Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\TrainingPayment;
use App\Models\Training_Registration;
use App\Models\feedback;
use App\Models\TraineeProfile;
use App\Models\Pre_Assessment_Do;
use Illuminate\Support\Facades\Crypt;
use Excel;

class TraineePanelController extends Controller
{
    public $route = "member/trainee/product-details";
    public $view = "product";
    public $moduleName = 'Product';

    public function index()
    {

        $member_id = Session::get('member_id');
        $member = User::find($member_id);
        $user_session =  User::where('id', $member_id)->get();
        if($member_id=="")
        {
         return redirect("/");   
        }else{
        return view('member/trainee/dashboard', compact('member','user_session'));
        }
    }
	
	public function pre_assessment($id)
    {
        $pre_assessment_id=$id;

        $member_id = Session::get('member_id');
        $member = User::find($member_id);
        $user_session =  User::where('id', $member_id)->get();
        if($member_id=="")
        {
         return redirect("/");   
        }else{
        return view('member/trainee/pre_assessment_view', compact('member','user_session','pre_assessment_id'));
        }
    }
     
	 public function pre_assessment_start(Request $request,$id)
    {
       
      $pre_assessment_i=decrypt($id);
      
        $member_id = Session::get('member_id');
        $member = User::find($member_id);
        $user_session =  User::where('id', $member_id)->get();
        if($member_id=="")
        {
         return redirect("/");   
        }else{
         $pre_assessment= DB::table("blz_pre_assesment")->get();
        
        return view('member/trainee/pre_assessment_start', compact('member','user_session','pre_assessment','pre_assessment_i'));
        }
    }
    function pre_assessment_add(Request $request,$id)
    {
        
        // $pre_assessment_i=decrypt($id);
        $member_id = Session::get('member_id');
        $member = User::find($member_id);
        $user_session =  User::where('id', $member_id)->get();
       
        $pre =  new Pre_Assessment_Do;
        $pre->question ="jdbsfjkhs";
        $pre->answer = "jhdhfj";
        $pre->user_id = "1";
       $pre->training_id = "ddd";
       $pre->status = "djjf";
       $pre->percentage ="djfhjd";
      $pre->save();
        // for($i = 0; $i < count($ans); $i++)
        // {
           
        //     $data = array(
        //         'question' =>$question[$i],
        //         'answer'=>$ans[$i],
        //         'user_id'=>"1",
        //         'training_id'=>"dsfjhbs",
        //         'status' =>'dd',
        //         'percentage'=>"60"
        //         );
        // }
        // $insert_data[] = $data;
        //  PreAssessment::insert($insert_data);
            return response()->json([
                'status' => 200,
                'message' => 'Recored successfully'
            ]);
    }
    public function viewsettings()
    {
        $member_id = Session::get('member_id');
        
        if($member_id=="")
        {
         return redirect("/");   
        }else{
            $user_session =  User::where('id', $member_id)->get();
        $member = User::find($member_id);
        if ($member->user_type == 'trainee' && TraineeProfile::where('trainee_id', $member_id)->count() > 0) {
            $sellerData = TraineeProfile::where('trainee_id', $member_id)->first();
        } else {
            $sellerData = NULL;
        }
        $country= DB::table("country")->get();
        return view('member/trainee/settings', compact('user_session','country','member', 'sellerData'));
        }
    }


    public function updateprofile(Request $request)
    {
        $member_id = Session::get('member_id');
        $member = User::find($member_id);

        $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' => 'required',

        ]);

        $data = $request->all();

        if ($request->hasFile('avatar')) {

            $image = $request->file('avatar');

            $name = uniqid() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('/assets/images/upload');

            $image->move($destinationPath, $name);

            $data['image'] = $name;
        }

        $data['name'] = ucfirst($request->name);

        User::find($member->id)->update($data);

        if ($member->user_type == 'trainee') {




            $profile_data['education_level'] = $request->education_level;
            $profile_data['employment_status'] = $request->employment_status;
            $profile_data['description'] = $request->description;
            $profile_data['website_url'] = $request->website_url;
            $profile_data['country'] = $request->country;
            $profile_data['location'] = $request->location;

            if (TraineeProfile::where('trainee_id', $member_id)->count() > 0) {
                TraineeProfile::where('trainee_id', $member_id)->update($profile_data);
            } else {
                TraineeProfile::create($profile_data);
            }
        }

        return back()->with('succ', 'Profile updated successfully!');
    }
    public function add_payment($id)
    {
        $member_id = Session::get('member_id');
        $user_session =  User::where('id', $member_id)->get();
        $member = User::find($member_id);
        $payment = Training_Registration::find(decrypt($id));
        $moduleName = $this->moduleName;
		if($member_id=="")
		{
         return redirect("/");   
        }		else		{
        return view('member/trainee/payment_reciept', compact('user_session','moduleName','payment'));
        }
    }

    public function training_list()
    {
        $member_id = Session::get('member_id');
        //die();
        
if($member_id=="")
        {
         return redirect("/");   
        }else
		{
			
        $member = User::find($member_id);
        $user_session =  User::where('id', $member_id)->get();
		
        $moduleName = $this->moduleName;
        //$TrainingLists = Training_Registration::where('Status',0)->orderBy('id','DESC')->get();
        $TrainingLists = \DB::table('Training_Registration')
            ->join('BlzInvst_training', 'Training_Registration.training_id', '=', 'BlzInvst_training.id')
            ->join('Trainning_Course', 'BlzInvst_training.CourseName', '=', 'Trainning_Course.id')
            ->join('BlzInvest_Trainning_Stream','Trainning_Course.stream_id','=','BlzInvest_Trainning_Stream.id')
            ->select('BlzInvst_training.*','Trainning_Course.Course_Name','BlzInvest_Trainning_Stream.name', 'Training_Registration.first_name','Training_Registration.id','Training_Registration.status')
            ->where('Training_Registration.user_id', $member_id)
            ->get();
            //dd($TrainingLists);
        return view('member/trainee/training_list', compact('member','user_session','moduleName', 'TrainingLists'));
        }
    }
function view_payment()
{
    $member_id = Session::get('member_id');
        $member = User::find($member_id);
        $user_session =  User::where('id', $member_id)->get();
    
    $TrainingLists = \DB::table('Training_Payment')
            ->join('users', 'Training_Payment.user_id', '=', 'users.id')             ->join('BlzInvst_training', 'BlzInvst_training.id', '=', 'Training_Payment.training_id')
            ->select('Training_Payment.*', 'users.name','BlzInvst_training.TrainingName')
            // ->where('Training_Payment.training_id', $member_id)
            ->get();
           
    return view("member/trainee/view_payment", compact('user_session','member','TrainingLists'));
}
    public function payment_reciept_upload(Request $request)

    {

        $member_id = Session::get('member_id');
        $member = User::find($member_id);
        // $payment = TrainingPayment::find(decrypt($id));
        $request->validate([
            // 'Name' => 'required',
            'Upload_Reciept' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'paid_amount' => 'required|numeric',
        ]);

        if ($request->hasFile('Upload_Reciept')) {
            $image = $request->file('Upload_Reciept');
            $name = uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/payment');
            $image->move($destinationPath, $name);
            $main_image = $name;
        }
        $product = TrainingPayment::create([

            // 'Name' => $request->Name,
            'paid_amount' => $request->paid_amount,
            'Upload_Reciept' => $main_image,
            'training_id' => $request->pay_id,
            'user_id' => $member->id,
        ]);
        return redirect('trainee/training_list')->withStatus(__('Product is added successfully.'));
    }


    public function feedback_form(Request $request,$id)

    {

        $member_id = Session::get('member_id');
        $user_session =  User::where('id', $member_id)->get();
        $member = User::find($member_id);
        $moduleName = $this->moduleName;
        $feedback = Training_Registration::find(decrypt($id));
        if($member_id=="")
        {
         return redirect("/");   
        }else{
        return view('member/trainee/feedback_form', compact('user_session','moduleName','feedback'));
        }
    }
    public function feedback_form_do(Request $request)
    {
        $member_id = Session::get('member_id');
        $member = User::find($member_id);
        $feedback = new feedback();
        $feedback->social =  implode(',', (array) $request->input("social"));
        $feedback->professional = $request->input("professional");
        $feedback->information = $request->input("information");
        $feedback->working = $request->input("working");
        $feedback->training = $request->input("training");
        $feedback->forth = $request->input("forth");
        $feedback->Effective = $request->input("Effective");
        $feedback->Practical = $request->input("Practical");
        $feedback->Useful = $request->input("Useful");
        $feedback->skills = $request->input("skills");
        $feedback->acquire = $request->input("acquire");
        $feedback->feed_id = $request->input("feed_id");
        $feedback->user_id = $member_id;
        $feedback->save();
        return redirect('/trainee');
    }
    function MarkSheet()
    {
        $data = $this->get_c_data();
        return view('member/trainee/marksheet')->with("data", $data);;
    }
    function get_c_data()
    {
        $data = DB::table("users")
            ->get();
        return $data;
    }
    function pdf()
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_customer_data_to_html());
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
    function convert_customer_data_to_html()
    {
        $data = $this->get_c_data();
        return view("member/trainee/certificate", compact("data"));
    }

    public function logout(Request $request)
    {
        $id = Session::get('member_id');
        $isOnlineStatus = User::find($id);
        $isOnlineStatus->IsOnline = false;
        $isOnlineStatus->update();
        if (session()->has('member_id')) {
            session()->forget('member_id');
            session()->pull('member_id', null);
        }
        return redirect('/');
    }
}
