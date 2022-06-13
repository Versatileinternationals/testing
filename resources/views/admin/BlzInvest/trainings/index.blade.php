@extends('admin.layouts.light.master')
@section('title', 'Trainning')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>{{$moduleName}}</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">{{$moduleName}}</li>
@endsection
<link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@section('content')
<div class="container-fluid">
   
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
           <div class="card-header">          
               <div class="row">
                  <div class="col-6">
                     <h5>{{$moduleName}}</h5>
                  </div>
                  <div class="col-6 text-right">
                     
                     <a href="{{url('blzinvst_training/create')}}"><button class="btn btn-primary"><i class="fa fa-plus mr-1"></i>New</button></a>
                    
                  </div>
               </div>             
           </div>
           <div class="card-body">
             <div class="table-responsive">
             
              <?php //print_r($BlzTrainingin); ?>
               <table id="tableMy" class="table data-tabless" >
			   <!-- Training Type Filter-->
			   <div class="row">
			    <div class="col-md-4"><select name="" id="trainingdropdown" class="form-control trainingdropdown">
								<option value="">All Course Type</option>
								<option value="Free">Free</option>
								<option value="Paid">Paid</option>
								
								</select>
				</div>
				<div class="col-md-4"><select name="" id="Training_type" class="form-control">
								<option value="">Select Training Type </option>
								<option value="Self-Paced">Self-Paced</option>
								<option value="Instructor Led Training">Instructor Led Training</option>
								
								</select>
				</div>
				</div>
				<!-- Training Type Filter-->
                  <thead class="table-light" id="">
                     <tr>
                        <th>ID</th>
                        <th>Course Name</th>
                        <th>Stream Name</th>
                        <th>Name</th> 
                        <th>Course Type </th> 
                        <th>Training Type </th> 						
                        <th> Duration</th>                            
                        <th> Start Date</th>                            
                        <th> Image</th>                            
                        <th> Video</th>                            
                       <!-- <th> Description</th>    -->                        
                                                
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($BlzTrainingins as $value)
                     <tr>
                        <td>{{$value->id}}</td>
                        <td>{{$value->Course_Name}}</td>
                        <td>{{$value->Category_Name}}</td>
                        <td>{{$value->TrainingName}}</td>
						 <td>@if($value->CourseType==0){{'Free'}} @else {{'Paid'}} @endif</td>
						  <td>@if($value->Training_Type==1){{'Self-Paced'}} @else {{'Instructor Led Training'}} @endif</td>
                        <td>{{$value->TrainingDuration}}</td>
                        <td>{{$value->TrainingStartDate}}</td>
                        <td>
                            @if($value->TrainingImage == "")

                              <img src="{{url('assets/images/noimage.png')}}" class="ïmg table-img">

                           @else

                              <img src='{{URL::asset("assets/images/upload/$value->TrainingImage")}}' class="ïmg table-img">

                           @endif
                        </td> 
                        <td>
                            @if($value->TrainingVideo == "")

                              <img src="{{url('assets/images/noimage.png')}}" class="ïmg table-img">

                           @else

                              <video width="120" height="80" controls>
                                    <source src="{{URL::asset("assets/images/upload/$value->TrainingVideo")}}" type="video/mp4">
                                  
                              </video>

                           @endif
                        </td>
                       <!-- <td>{!!html_entity_decode($value->TrainingDescription)!!} </td>-->
                        <td>
                            <a href='{{url('blzinvst_add_module/'.(encrypt($value->id)))}}'class="btn btn-success btn-sm">Add Topics </a>
                           <a href='{{url('blzinvst_pre_assesment/'.(encrypt($value->id)))}}'class="btn btn-warning btn-sm">Pre-Assessment</a>
                           <a href='{{url('blzinvst_final_assesment/'.(encrypt($value->id)))}}'class="btn btn-info btn-sm">Final Assessment</a>
                           <a href='{{url('blzinvst_training/'.(encrypt($value->id)))}}' class='btn btn-primary btn-sm'> <i class="fa fa-edit"></i></a>
                           <a href='{{url('blzinvst_training/delete/'.(encrypt($value->id)))}}' class='btn btn-primary btn-sm'> <i class="fa fa-trash"></i></a>
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
             </div>
           </div>
         </div>
       </div>
   </div>
</div>
@endsection

@section('script')

<script>    
   @if (Session::has('status'))
      $.notify({ message:'{!! session("status") !!}'},{
         type:'success',
         allow_dismiss:false,  
         icon: 'fa fa-check',                                          
         timer:500,
         delay:500 ,      
         placement:{
            from:'top',
            align:'center'
         },                                      
      });   
   @endif
 
</script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    // $("#filter_Table").DataTable();
</script>
<script>

$(document).ready(function() {
    $("#tableMy").DataTable();
//   var table = $('#filter_Table').DataTable({
//     order: [ [1, "asc"]],
//     buttons: [
//                     'copy', 'csv', 'excel', 'pdf', 'print'
//                 ] 
    
//   });
  
  $('#trainingdropdown').on('change', function() {
	 
    table.columns(4).search(this.value).draw();
  });
  $('#Training_type').on('change', function() {
	 
    table.columns(5).search(this.value).draw();
  });
  
});
</script>
@endsection