@extends('admin.layouts.light.master')
@section('title', 'Add Quiz')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>{{$moduleName}}</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">{{$moduleName}}</li>
<li class="breadcrumb-item active">Add</li>
@endsection

@section('content')
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
 <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
          <div class="card">
           
           	
						<!----	Topics Lists------->
              
 
				<div class="card-body">
				<h2 class="text-center">  Topics</h2><br>
				<form method="post"  id="topic_form"class="form theme-form">
                  <input type="hidden" name="course_id" id="course_id" value="{{$trenid->id}}">
                @csrf
                <div class="row" id="AddTopic">
                    <div class="col-8">
                    <div class="form-group">
                                <label for="exampleInputPassword1">Topic Name</label>
                                <input type="text" class="form-control" id="topic_name" name="top_name">
                              </div>
                              </div>
							  
                              <div class="col-4">
                               <div class="form-group">
                                <!--<label for="exampleInputPassword1">Topic Name</label>-->
                                <button type="submit" class="btn btn-success me-3" style="margin-top: 25px;">Add New</button>
                              </div>
							  
                              </div>
						
						</div>
						</form>
		
             <div class="table-responsive">
               <table class="table data-tables table-bordered" >
                  <thead class="table-light">
                     <tr>
                        <th>#</th>
                        <th>Topics</th>
                                                 
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                   
                         @foreach($topic as $topic)
                           <tr>
                        <td>{{$topic->id}}</td>
                        <td>{{$topic->top_name}}</td>
                        <td>
                           <a href='{{url('blzinvst_add_quiz_form/'.(encrypt($topic->id)))}}' class='btn btn-info btn-sm'>Add Quiz</a>
                            <a href='{{url('blzinvst_subtopic/'.(encrypt($trenid->id)))}}' class='btn btn-warning btn-sm'>Add Sub Topic</a>
                             <a href='{{url('blzinvst_subtopic_edit/'.(encrypt($topic->id)))}}' class='btn btn-success btn-sm'><i class="fa fa-pencil"></i></a>
                              <a href='{{url('blzinvst_subtopic_delete/'.(encrypt($topic->id)))}}'onclick="confirm('Delete selected item?')" class='btn btn-primary btn-sm'><i class="fa fa-trash"></i></a>
                        </td>
                        </tr>
                        @endforeach
                     
                    </tbody>
               </table>
             </div>
           </div>
           
     
              
			
           
           
           <div class="card-body">
               <h2 class="text-center"> Sub Topics</h2><br>
             <div class="table-responsive">
               <table class="table data-tables table-bordered" >
                  <thead class="table-light">
                     <tr>
                        <th>#</th>
                        <th>Sub Topics</th>
                                                 
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     
                         @foreach($topicsub as $topicsub)
                         <tr>
                        <td>{{$topicsub->id}}</td></td>
                        <td>{{$topicsub->subtop_name}}</td>
                        <td>
                           <a href='{{url('blzinvst_add_content_form/'.(encrypt($trenid->id)))}}' class='btn btn-primary btn-sm'>Add Content </a>
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
</div>
</div>

@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>

 var i =1;
 
 function addRow()
 {
     i++;
     var div ='<div class="row" id="row'+i+'">\
                  <div class="col-12">\
                    <div class="form-group">\
                        <label class="col-form-label"> Question</label>\
                        <input class="form-control" type="text"  name="question[]" placeholder="question" id="question">\
                    </div>\
                  </div>\
                  <div class="col-3">\
                    <div class="form-group">\
                      <label>Option 1</label>\
                      <input class="form-control" type="text"  name="option1[]" placeholder="option1" id="option1">\
                    </div>\
                  </div>\
                  <div class="col-3">\
                    <div class="form-group">\
                      <label>Option 2</label>\
                      <input class="form-control" type="text"  name="option2[]" placeholder="option2" id="option2">\
                    </div>\
                  </div>\
                  <div class="col-3">\
                    <div class="form-group">\
                      <label>Option 3</label>\
                      <input class="form-control" type="text"  name="option3[]" placeholder="option3" id="option3">\
                    </div>\
                  </div>\
                  <div class="col-3">\
                    <div class="form-group">\
                      <label>Option 4</label>\
                      <input class="form-control" type="text"  name="option4[]" placeholder="option4" id="option4">\
                    </div>\
                  </div>\
                  <div class="col-3">\
                    <div class="form-group">\
                      <label>Select Answere</label>\
                      <select name="answere[]" id="answere" class="form-control">\
                          <option>Select Answere</option>\
                          <option value="a">A</option>\
                          <option value="b">B</option>\
                          <option value="c">C</option>\
                          <option value="d">D</option>\
                      </select>\
                    </div>\
                  </div>\
                  <div class="col-3">\
                      <button type="button" class="btn btn-danger" onclick="deleteRow('+i+')"  style="margin-top:35px;">Remove</button>\
                  </div>\
                </div>';
                $("#AddMorefiled").append(div);
 }
 function deleteRow(id)
 {
     $("#row" + id).remove();
     i--;
 }
 
 $(document).on("submit","#topic_form",function(e)
 {
     e.preventDefault();
     var course_id =$("#course_id").val();
     $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
     $.ajax({
         type:"POST",
         url:"/blzinvst_add_topic/"+course_id,
        //  data:{question:question,option1:option1,option2:option2,option3:option3,option4:option4,answere:answere},
         data:$(this).serialize(),
        //  dataType:"json",
         success:function(data)
         {
             console.log(data)
              if(data.status == 400)
                {
                   var values = '';
                    jQuery.each(data.errors, function(key, value) {
                      values += value + '<br>'
                    });
                Command: toastr["error"](values)
           
                }
                else if(data.status == 200)
                {
                    Command: toastr["success"](data.message)
                    $("#topic_form")[0].reset();
                    
                }
         }
     })
 });
 
 $(document).on("submit","#sub_topic_form",function(e)
 {
     e.preventDefault();
     var course_id =$("#to_id").val();
     $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
     $.ajax({
         type:"POST",
         url:"/blzinvst_add_subtopic/"+course_id,
        //  data:{question:question,option1:option1,option2:option2,option3:option3,option4:option4,answere:answere},
         data:$(this).serialize(),
        //  dataType:"json",
         success:function(data)
         {
             console.log(data)
              if(data.status == 400)
                {
                   var values = '';
                    jQuery.each(data.errors, function(key, value) {
                      values += value + '<br>'
                    });
                Command: toastr["error"](values)
           
                }
                else if(data.status == 200)
                {
                    Command: toastr["success"](data.message)
                    $("#sub_topic_form")[0].reset();
                    
                }
         }
     })
 });
</script>
<script>
    $(". table-border").DataTable();
</script>
@endsection