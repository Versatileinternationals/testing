@extends('admin.layouts.light.master')
@section('title', 'Online Quiz List')

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
 <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
 <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
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
                     <!--<button class="btn btn-primary" type="button" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal">Add New</button>-->
                  </div>
               </div>             
           </div>
           <div class="card-body">
             <div class="table-responsive">
              
              <?php //print_r($BlzTrainingin); ?>
               <table class="table data-tables" >
                  <thead class="table-light">
                     <tr>
                        <th>#</th>
                        <th>Content</th>
                        <th>Image</th>                     
                        <th>Video</th>            
                        <th>Audio</th>            
                                    
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody id="tbody">
      <!--               @foreach ($BlzOnlineQuiz as $value)-->
      <!--               <tr>-->
      <!--                  <td>{{$value->id}}</td>-->
						<!--<td>{{$value->title}}</td>-->
      <!--                  <td>{{$value->questions}}</td>-->
						
      <!--                  <td>{{$value->exam_to}}</td>-->
      <!--                  <td>{{$value->exam_from}}</td>-->
						<!--<td>{{$value->duration}}</td>-->
      <!--                  <td>{{$value->Status}}</td>-->
      <!--                  <td>-->
      <!--                     <a href='{{url('blzinvst_online_quiz/'.($value->id))}}' class='btn btn-primary btn-sm'> <i class="fa fa-edit"></i></a>-->
      <!--                     <a href='{{url('blzinvst_online_quiz/delete/'.($value->id))}}' class='btn btn-primary btn-sm'> <i class="fa fa-trash"></i></a>-->
      <!--                  </td>-->
      <!--               </tr>-->
      <!--               @endforeach-->
                  </tbody>
               </table>
             </div>
           </div>
         </div>
       </div>
   </div>
</div>


  <!-- Simple demo-->
                  
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Module Create</h5>
                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                              <div id="error"></div>
                               <form id="model_tri" method="post">
                                   
                              <div class="form-group">
                                <label for="exampleInputEmail1">Select Course</label>
                                @csrf
                               <select class="form-control" name="course" id="course">
                                   <option>Select Course</option>
                                   @foreach($Course as $courses)
                                   <option value="{{$courses->id}}">{{$courses->Course_Name}}</option>
                                   @endforeach
                               </select>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputPassword1">Module Name</label>
                                <input type="text" class="form-control" id="model_name" name="model_name">
                              </div>
                               <div class="form-group">
                                <label for="exampleInputPassword1">Topic Name</label>
                                <input type="text" class="form-control" id="topic_name" name="topic_name">
                              </div>
                            
                          </div>
                          <div class="modal-footer">
                            <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-secondary" type="submit">Save</button>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    
                     <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Module Edit</h5>
                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                              <div id="error"></div>
                               <form id="model_tri" method="post">
                                   
                              <div class="form-group">
                                <label for="exampleInputEmail1">Select Course</label>
                                @csrf
                               <select class="form-control course" name="course" id="course">
                                   <option>Select Course</option>
                                   @foreach($Course as $courses)
                                   <option value="{{$courses->id}}">{{$courses->Course_Name}}</option>
                                   @endforeach
                                   
                               </select>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputPassword1">Module Name</label>
                                <input type="text" class="form-control model_name" id="model_name" name="model_name">
                              </div>
                               <div class="form-group">
                                <label for="exampleInputPassword1">Topic Name</label>
                                <input type="text" class="form-control topic_name" id="topic_name" name="topic_name">
                              </div>
                            
                          </div>
                          <div class="modal-footer">
                            <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-secondary" type="submit">Save</button>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <meta name="csrf-token" content="{{ csrf_token() }}">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    $(document).on("submit","#model_tri",function(e)
    {
       e.preventDefault(); 
    var course = $("#course").val();
    var topic_name = $("#topic_name").val();
    var model_name = $("#model_name").val();
       $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        $.ajax({
            type:"POST",
            url:"/blzinvst_add_training_module",
            data:{course:course,topic_name:topic_name,model_name:model_name},
            success:function(data)
            {
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
                    Command: toastr["success"](data.success)
                    $("#model_tri")[0].reset();
                    $("#exampleModal").modal("hide");
                    fetch_users_list();
                }
            }
        })
        
    });
    fetch_users_list();
     function fetch_users_list() {
    $.ajax({
      type: "GET",
      url: "/blzinvst_content_list_fetch",
      dataType: "json",
      success: function(data) {
        if (data.status == 200) {
          $("#tbody").html("");
          i = 1;
          $.each(data.success, function(key, item) {
            $("#tbody").append('<tr><td>' + i + '</td>\
                <td>' + item.conten + '</td>\
                <td><img src="images/Audio_image/'+item.image+'" style="height:80px;width:80px;"></td>\
                <td><video width="150" height="150" controls>\
                  <source src="/images/video/'+item.video+'" type="video/mp4">\
                </video></td>\
                <td><audio controls>\
                  <source src="images/Recorded_Audio/'+item.audio+'" type="audio/ogg">\
                </audio></td>\
                <td>\
                 <button class="btn btn-danger btn-sm"  id="delete" value="' + item.id + '">Delete</button>\
                 \
                </td></tr>');
            i++;
          });
         
          $('#usersMytable').DataTable();
        }
      }
    });
  }
//   <button class="btn btn-primary btn-sm" id="Edit" value="' + item.id + '">Edit</button>\
  $(document).on("click","#delete",function(e)
  {
      e.preventDefault();
      var delete_id = $(this).val();
    //   alert(delete_id)
    if(confirm("are you sure you want to delete ?"))
    {
 $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
      $.ajax({
         type:"POST",
         url:"/blzinvst_content_delete/"+delete_id,
         success:function(data)
         {
           if(data.status == 200)
           {
               alert(data.success);
               fetch_users_list();
           }
         }
      });
    } 
  });
  
  $(document).on("click","#Edit",function()
  {
     var edit_id = $(this).val();
     $("#editModal").modal("show");
     
     $.ajax({
         type:"GET",
         url:"/blzinvst_edit/"+edit_id,
         dataType:"json",
         success:function(data)
         {
             console.log(data);
             if(data.status == 200)
             {
                 $(".course").val(data.success.course);
                 $(".model_name").val(data.success.model_name);
                 $(".topic_name").val(data.success.topic_name);
                 $("#edit_id").val(edit_id);
             }
         }
     })
     
  })
</script>
@endsection