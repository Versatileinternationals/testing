@extends('admin.layouts.light.master')
@section('title', 'Add content')

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
                  <input type="hidden" name="course_id" id="course_id" value="{{$ids}}">
                @csrf
                <div class="row" id="AddMorefiled">
                  <div class="col-12">
                    <div class="form-group">
                        <label class="col-form-label"> Content</label>
                        <input class="form-control" type="text"  name="conten" placeholder="content" id="content">
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label>Video</label>
                      <input class="form-control" type="file"  name="video" placeholder="option1" id="option1">
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label>Audio</label>
                      <input class="form-control" type="file"  name="audio" placeholder="option2" id="option2">
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label>Image</label>
                      <input class="form-control" type="file"  name="image" placeholder="option3" id="option3">
                    </div>
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

 $(document).on("submit","#quiz_form",function(e)
 {
     e.preventDefault();
     var course_id =$("#course_id").val();
     let quiz_form = new FormData($('#quiz_form')[0]);
     $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
     $.ajax({
         type:"POST",
         url:"/blzinvst_add_content_do/"+course_id,
         data:quiz_form,
        contentType: false,
            processData: false,
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