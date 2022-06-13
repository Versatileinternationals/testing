<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlzTraining;
use App\Models\TrainningStream;
use App\Models\TrainningCourse;

use Excel;

class BlzInvstTrainingController extends Controller
{
    public $route="blzinvst_training";
    public $view ="trainings";
    public $moduleName = 'Trainings';

    public function index()
    {        
	
        $moduleName = $this->moduleName;                 
       
        //$BlzTrainingins = BlzTraining::where('status',1)->orderBy('id','DESC')->get();
		$BlzTrainingins = \DB::table('BlzInvst_training')
    ->join('BlzInvest_Trainning_Stream', 'BlzInvst_training.StreamName', '=', 'BlzInvest_Trainning_Stream.id')
    ->join('Trainning_Course', 'BlzInvst_training.CourseName', '=', 'Trainning_Course.id')
    ->select('BlzInvst_training.*','BlzInvest_Trainning_Stream.name as Category_Name','Trainning_Course.Course_Name')
   // ->where('scores.student_id', $student->id)
    //->whereBetween('scores.term_id', [1, 3])
    ->get();
        return view('admin/BlzInvest/'.$this->view.'/index', compact('moduleName', 'BlzTrainingins'));
    }
    function All_payment_list()
    {
        $moduleName = $this->moduleName;
        $TrainingLists = \DB::table('Training_Payment')
            ->join('users', 'Training_Payment.user_id', '=', 'users.id')
            ->select('Training_Payment.*', 'users.name')
            // ->where('Training_Payment.training_id', $id)
            ->get();
         return view('admin/BlzInvest/view_all_payment', compact('moduleName','TrainingLists'));
    }
    public function create()
    {
        $moduleName = $this->moduleName;  
        // $category = Category::where('status',1)->get();
        // $brand = Brand::where('status',1)->get();
        $Training_category = TrainningStream::where('status',1)->orderBy('name','ASC')->get();  
         
        return view('admin/BlzInvest/'.$this->view.'/form',compact('moduleName','Training_category'));
    }
   public function Get_Category()
    {
       echo  $id = $_GET['myID'];
	  
       
 
    }

    public function store(Request $request)
    {
       // echo "hello"; die;
    
        $request->validate([
            'CourseName' => 'required',    
            'StreamName' => 'required',          
            'TrainingName' => 'required',   
             'Training_Type' => 'required',				
            'TrainingDuration' => 'required',          
            'TrainingStartDate' => 'required',
            'TrainingDescription' => 'required',          
        ]); 
                  
                  
        $videoName=$TrainingImage='';
     
        if ($request->hasFile('TrainingImage')) {   
            $image = $request->file('TrainingImage');
            $name = uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/upload');
            $image->move($destinationPath, $name);         
            $TrainingImage = $name;
        }
        if ($request->hasFile('TrainingVideo')) {   
            $video = $request->file('TrainingVideo');
            $videoName = uniqid() . '.' . $video->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/upload');
            $video->move($destinationPath, $videoName);         
            $TrainingVideo = $videoName;
        }  
        
        $training = BlzTraining::create([
            'CourseName' => $request->CourseName,
            'StreamName' => $request->StreamName,
            'TrainingName' => $request->TrainingName,
			'CourseType' => $request->CourseType,
			'Training_Type' => $request->Training_Type,
            'TrainingDuration' => $request->TrainingDuration,
            'TrainingStartDate' => $request->TrainingStartDate,
            'trainingFees' => $request->trainingFees,
            'FacilitatorName' => $request->FacilitatorName,
            'FacilitatorDescription' => $request->FacilitatorDescription,
            'TrainingDescription' => $request->TrainingDescription,
            'TrainingImage' => $TrainingImage,
            'TrainingVideo' => $videoName,
            'Status' => 1,
        ]);
       
        return redirect($this->route)->withStatus(__('Training is added successfully.'));
    }

    public function edit($id)
	{
        $moduleName = $this->moduleName; 
        $ids = decrypt($id);
        $BlzTrainingin = BlzTraining::find($ids); 
		
	    $Training_category = TrainningStream::where('status',1)->orderBy('name','ASC')->get(); 
	    $Training_course = TrainningCourse::where('stream_id',$BlzTrainingin->StreamName)->get();
        return view('admin/BlzInvest/'.$this->view.'/_form', compact('moduleName', 'BlzTrainingin','Training_category','Training_course'));
    }

    public function delete($id){
        $moduleName = $this->moduleName;  
        $training = BlzTraining::find($id)->update([
            'Status' => 0,
        ]);
        return redirect($this->route)->withStatus(__('Training is updated successfully.'));
    } 

    public function update(Request $request,$id)
    {
        $request->validate([
            'CourseName' => 'required',    
            'StreamName' => 'required',          
            'TrainingName' => 'required',
            'Training_Type' => 'required',	
            'TrainingDuration' => 'required',          
            'TrainingStartDate' => 'required',
            'TrainingDescription' => 'required',          
        ]);  
        
        $videoName=$TrainingImage='';
        
        $BlzTrainingin = BlzTraining::find($id);
        if ($request->hasFile('TrainingImage')) {   
            $image = $request->file('TrainingImage');
            $name = uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/upload');
            $image->move($destinationPath, $name);         
            $TrainingImage = $name;
        }else{
            $TrainingImage = $BlzTrainingin->TrainingImage;
        }
        if ($request->hasFile('TrainingVideo')) {   
            $video = $request->file('TrainingVideo');
            $videoName = uniqid() . '.' . $video->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/upload');
            $video->move($destinationPath, $videoName);         
            $TrainingVideo = $videoName;
        } else{
            $TrainingVideo = $BlzTrainingin->TrainingVideo;
        }

        $training = BlzTraining::find($id)->update([
            'CourseName' => $request->CourseName,
            'StreamName' => $request->StreamName,
            'TrainingName' => $request->TrainingName,
			'Training_Type' => $request->Training_Type,
			 'CourseType' => $request->CourseType,
            'TrainingDuration' => $request->TrainingDuration,
            'TrainingStartDate' => $request->TrainingStartDate,
            'TrainingDescription' => $request->TrainingDescription,
            'trainingFees' => $request->trainingFees,
            'FacilitatorName' => $request->FacilitatorName,
            'FacilitatorDescription' => $request->FacilitatorDescription,
            'TrainingImage' => $TrainingImage,
            'TrainingVideo' => $TrainingVideo,
            'Status' => 1,
        ]);
        return redirect($this->route)->withStatus(__('Training is updated successfully.'));
    }


    public function view($id){
        $moduleName = $this->moduleName;  
        $product = Product::with(['category', 'subcategory','brandData'])->find(decrypt($id));
        $product->related_products = Product::with(['brandData'])->whereIn('id',array_filter(explode(',',$product->related_product)))->where('status',1)->orderBy('id','DESC')->get();
   
        return view('admin/BlzInvest/'.$this->view.'/view', compact('moduleName', 'product'));
    }

    public function productgallery($id){
        $moduleName = $this->moduleName;  
        $product = Product::find(decrypt($id));
        return view('admin/'.$this->view.'/gallery', compact('moduleName', 'product'));
    }

    public function uploadProductImage(Request $request, $id){
        $images = array_filter(explode(',',Product::find($id)->image));     
        if ($request->hasFile('file')) {            
            $image = $request->file('file');
            $name = uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/upload');
            $image->move($destinationPath, $name);
            array_push($images,$name);
            Product::find($id)->update(['image'=>implode(',',$images)]);
        }
        return true;
    }

    public function getSubcategory(Request $request){
        $data = TrainningStream::where('id',$request->id)->get()->pluck('name','id')->toArray();
        return $data;
    }

    public function uploadProduct(Request $request){
        $rows = Excel::toArray(new ProductImport, $request->file('file'));
       
        $totalLoops = count($rows[0]);
        
        $loop = 0;
        $headerCheck = array('name', 'sku', 'category', 'subcategory', 'brand', 'sale price', 'regular price', 'description', 'stock', 'minimum stock', 'sale start date', 'sale end date', 'shipping class', 'purchase note', 'page title', 'page keyword', 'page description');
       
        foreach ($rows[0][0] as $key => $row) {
            if (trim($row)) {
                if (!in_array(trim($row), $headerCheck)) {
                    return redirect()->back()->with('error_msg', 'Uploaded file is not Valid Please Download Sample File and try again.');
                }
            }
        }

        $data = array();
        $result = array();
        $check = 1;
        foreach ($rows[0] as $key => $row) {
            $loop++;
            if ($key == 0) { continue; }

            if (trim($row[0]) == '') {
                return redirect()->back()->with('error_msg', 'Product Name is required.');
            }

            if (trim($row[1]) == '') {
                return redirect()->back()->with('error_msg', 'Product SKU is required.');
            }
            else{
                $productsku = Product::where('sku', trim($row[1]))->first();
                if($productsku){
                    return redirect()->back()->with('error_msg', 'The sku has already been taken, Please try another');
                } 
            }

            if (trim($row[2]) == '') {
                return redirect()->back()->with('error_msg', 'Product Category is required.');
            }
            else{
                $category = Category::where('name', trim($row[2]))->first();
                if($category){
                    $cat = $category->id;
                }
                else{
                    return redirect()->back()->with('error_msg', 'Invalid Category Name. Please try another');
                }
            }
            
            if (trim($row[3]) == '') {
                return redirect()->back()->with('error_msg', 'Product Sub category is required.');
            }
            else{
                $scategory = SubCategory::where('name', trim($row[3]))->where('category_id',$cat)->first();
                if($scategory){
                    $sub_category = $scategory->id;
                }
                else{
                    return redirect()->back()->with('error_msg', 'Invalid subcategory name. Please try another');
                }
            }

            if (trim($row[4]) == '') {
                return redirect()->back()->with('error_msg', 'Product Brand is required.');
            }
            else{
                $brand = Brand::where('name', trim($row[4]))->first();
                if($brand){
                    $brand = $brand->id;
                }
                else{
                    return redirect()->back()->with('error_msg', 'Invalid Brand name. Please try another');
                } 
            }

            if (trim($row[5]) == '') {
                return redirect()->back()->with('error_msg', 'Product Sale Price is required.');
            }

            if (trim($row[6]) == '') {
                return redirect()->back()->with('error_msg', 'Product Regular Price is required.');
            }

            if (trim($row[7]) == '') {
                return redirect()->back()->with('error_msg', 'Product Description is required.');
            }

            if (trim($row[8]) == '') {
                return redirect()->back()->with('error_msg', 'Product Stock is required.');
            }

            if (trim($row[12]) == '') {
                return redirect()->back()->with('error_msg', 'Page Title is required.');
            }
            $product_number = rand(10000,99999);
            
            Product::create([
                'product_number' => $product_number,
                'name' => trim($row[0]),
                'sku' => trim($row[1]),
                'category_id' => $cat,
                'subcategory_id' => $sub_category,
                'brand' => $brand,
                'sale_price' => trim($row[5]),
                'regular_price' => trim($row[6]),
                'short_description' => trim($row[7]),
                'stock' => trim($row[8]),
                'minimum_stock' => trim($row[9]),              
                'shipping_class' => trim($row[10]),
                'purchase_note' => trim($row[11]),
                'page_title' => trim($row[12]),
                'page_keyword' => trim($row[13]),
                'page_description' => trim($row[14]),
                'status' => 1,
                'button_text' => 'Add to Cart',
                'added_by' => auth()->user()->id,
            ]);
           
        }

         /* Upload Excel file */
         $file = $request->file('file');
         $fileName = time().'.'.$file->getClientOriginalExtension();
         $file->move(public_path('/assets/products'), $fileName);

      
         return redirect($this->route)->withStatus(__('Product is added successfully in bulk.'));
    
    }
}