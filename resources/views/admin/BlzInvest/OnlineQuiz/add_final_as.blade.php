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
            <div class="card-body">
              <form method="post"  id="quiz_form"class="form theme-form">
                  <input type="hidden" name="course_id" id="course_id" value="{{$trenid->id}}">
                @csrf
                <div class="row" id="AddMorefiled">
                  <div class="col-12">
                    <div class="form-group">
                        <label class="col-form-label"> Question</label>
                        <input class="form-control" type="text"  name="question[]" placeholder="question" id="question">
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label>Option 1</label>
                      <input class="form-control" type="text"  name="option1[]" placeholder="option1" id="option1">
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label>Option 2</label>
                      <input class="form-control" type="text"  name="option2[]" placeholder="option2" id="option2">
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label>Option 3</label>
                      <input class="form-control" type="text"  name="option3[]" placeholder="option3" id="option3">
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label>Option 4</label>
                      <input class="form-control" type="text"  name="option4[]" placeholder="option4" id="option4">
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label>Select Answer</label>
                      <select name="answere[]" id="answere" class="form-control">
                          <option>Select Answer</option>
                          <option value="a">A</option>
                          <option value="b">B</option>
                          <option value="c">C</option>
                          <option value="d">D</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-3">
                      
                      <button type="button" class="btn btn-success" name="addmore" onclick="addRow()" style="margin-top:35px;">Add More</button>
                  </div>
                </div>
                
                <div class="row">
                  <div class="col-12">
                    <div>
                      <button type="submit" class="btn btn-primary me-3">Add</button>
                    </div>
                  </div>
                </div>
				
              </form>
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
                      <label>Select Answer</label>\
                      <select name="answere[]" id="answere" class="form-control">\
                          <option>Select Answer</option>\
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
 
 $(document).on("submit","#quiz_form",function(e)
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
         url:"/blzinvst_final_assesment_sve/"+course_id,
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
                    $("#quiz_form")[0].reset();
                    
                }
         }
     })
 });
</script>
@endsection