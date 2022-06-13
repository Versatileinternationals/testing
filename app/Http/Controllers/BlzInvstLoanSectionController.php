<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlzLoanSection;
use Excel;

class BlzInvstLoanSectionController extends Controller
{
    public $route="blzinvst_loan_section";
    public $view ="LoanSection";
    public $moduleName = 'Loan Section';

    public function index()
    {        
        $moduleName = $this->moduleName;                
        //$trainings = Product::with(['category','subcategory','brandData'])->orderBy('id','DESC')->get();
         $BlzEvent = BlzLoanSection::where('status',1)->orderBy('id','DESC')->get();
        return view('admin/BlzInvest/'.$this->view.'/index', compact('moduleName', 'BlzEvent'));  
    }
    

    public function create()
    {
	
        $moduleName = $this->moduleName;  
      
        return view('admin/BlzInvest/'.$this->view.'/form',compact('moduleName'));
    }

    public function store(Request $request)
    {
       //echo 'fffffff'; die;
        $request->validate([
            'url' => 'required',    
            'image' => 'required',
            'Status' => 'required',       
        ]); 
        
        if ($request->hasFile('image')) {  
           	
            $image = $request->file('image');
			
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/LoanSection');
            $image->move($destinationPath, $imageName);         
            $grantimage = $imageName;
        }else{
            $grantimage = '';
        } 

        $events = BlzLoanSection::create([
            'url' => $request->url,
            'image' => $grantimage,
            'Status' => $request->Status,
        ]);
		
       
		
        return redirect($this->route)->withStatus(__('Loan Section is added successfully.'));
    }

    public function edit($id){
        $moduleName = $this->moduleName;  
        $BlzLoan = BlzLoanSection::find($id); 
        return view('admin/BlzInvest/'.$this->view.'/_form', compact('moduleName', 'BlzLoan'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'url' => 'required',    
           // 'image' => 'required',
            'Status' => 'required',    
        ]); 
      
        $BlzEvent = BlzLoanSection::find($id);
       if ($request->hasFile('image'))
		   {  
           	
            $image = $request->file('image');
			
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/LoanSection');
            $image->move($destinationPath, $imageName);         
            $grantimage = $imageName;
        }else{
            $grantimage = '';
        } 
     
        $training = BlzLoanSection::find($id)->update([
            'url' => $request->url,
            'image' => $grantimage,
            'Status' => $request->Status,
        ]);
        
        return redirect($this->route)->withStatus(__('Loan Section is updated successfully.'));
    }
    public function delete($id){
        $moduleName = $this->moduleName;  
        $BlzEvent = BlzLoanSection::find($id)->delete();
        return redirect($this->route)->withStatus(__('Loan Section is updated successfully.'));
    }
}
