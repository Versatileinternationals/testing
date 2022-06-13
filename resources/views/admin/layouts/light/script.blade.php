<script src="{{asset('assets/js/jquery-3.5.1.min.js')}}"></script>
<!-- Bootstrap js-->
<script src="{{asset('assets/js/bootstrap/popper.min.js')}}"></script>

<script src="{{asset('assets/js/bootstrap/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap/bootstrap.js')}}"></script>
<script src="{{url('assets/js/bootstrap/bootstrap-tagsinput.min.js')}}"></script>  
<!-- feather icon js-->
<script src="{{asset('assets/js/icons/feather-icon/feather.min.js')}}"></script>
<script src="{{asset('assets/js/icons/feather-icon/feather-icon.js')}}"></script>
<!-- Sidebar jquery-->
<script src="{{asset('assets/js/config.js')}}"></script>
<!-- Plugins JS start-->
@yield('script')
<script src="{{asset('assets/js/sidebar-menu.js')}}"></script>
<script src="{{asset('assets/js/tooltip-init.js')}}"></script>
<script src="{{asset('assets/js/owlcarousel/owl.carousel.js')}}"></script>
<script src="{{asset('assets/js/ecommerce.js')}}"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script>
<script src="{{asset('assets/js/notify/bootstrap-notify.min.js')}}"></script>
<script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
<script src="{{asset('assets/js/select2/select2-custom.js')}}"></script>
<script src="{{asset('assets/js/dropzone/dropzone.js')}}"></script>
<script src="{{asset('assets/js/dropzone/dropzone-script.js')}}"></script>


<!--<script src="{{asset('assets/js/calendar/app.js')}}"></script>-->
<!--<script src="{{asset('assets/js/calendar/tooltip-init.js')}}"></script>-->
<!--    <script src="{{asset('assets/js/calendar/tui-code-snippet.min.js')}}"></script>-->
<!--    <script src="{{asset('assets/js/calendar/tui-time-picker.min.js')}}"></script>-->
<!--    <script src="{{asset('assets/js/calendar/tui-date-picker.min.js')}}"></script>-->
<!--    <script src="{{asset('assets/js/calendar/moment.min.js')}}"></script>-->
<!--    <script src="{{asset('assets/js/calendar/chance.min.js')}}"></script>-->
<!--    <script src="{{asset('assets/js/calendar/tui-calendar.js')}}"></script>-->
<!--    <script src="{{asset('assets/js/calendar/calendars.js')}}"></script>-->
<!--    <script src="{{asset('assets/js/calendar/schedules.js')}}"></script>-->
<!--    <script src="{{asset('assets/js/calendar/app.js')}}"></script>-->
<!--    <script src="{{asset('assets/js/tooltip-init.js')}}"></script>-->



<script src="{{asset('assets/js/editor/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('assets/js/editor/ckeditor/ckeditor.custom.js')}}"></script>
<script src="{{asset('assets/js/editor/ckeditor/adapters/jquery.js')}}"></script>
<script src="{{asset('assets/js/editor/ckeditor/styles.js')}}"></script>


<!-- Plugins JS Ends-->
<!-- Theme js-->
<script src="{{asset('assets/js/script.js')}}"></script>
<script src="{{asset('assets/js/theme-customizer/customizer.js')}}"></script>
<script>
    // Get City List 
     
      $(document).ready(function(){
        $('#category_dropdown').change(function(){
           var category_dropdown = $('#category_dropdown').val();
           $('#course_dropdown').html('');
		  
            $.ajax({
              url:'Get_Category/{id}',
              type:'GET',
              data:{myID:category_dropdown},
              dataType: "json",
              success:function(data)
              {
              
                $.each(data, function(key, course_cat)
                 {     
                  // alert(city.city_name)
                  $('#course_dropdown').prop('disabled', false).css('background','aliceblue').append('<option value="'+course_cat.id+'">'+course_cat.name+'</option>');
                });
              }
          });
		  
        });
      });
     
      // Get STADIUM and ADDRESS by CITY
     
      
    </script>  