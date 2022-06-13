@extends('member.trainee.layouts.app')

@section('sidebar')
   @include('member.trainee.layouts.sidebar') 
@endsection

@section('header')
   @include('member.trainee.layouts.header') 
@endsection

@section('content')
<style>
    .form-group{
        margin-bottom:10px;
        margin-left: 15px;
    }
</style>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Container-->
	<div id="kt_content_container" class="container">
		
	<div class="card mb-5 mb-xl-10">
                    <!--begin::Card header-->
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_signin_method">
                        <div class="card-title m-0">
                            <h3 class="fw-bolder m-0">Pre-Assessment </h3>
                        </div>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Content-->
                    <div id="kt_account_settings_signin_method" class="collapse show">
                        <!--begin::Card body-->
                        <div class="card-body border-top p-9">
                            
                            <!--begin::Password-->
                            
                            <!--end::Password-->
                            <!--begin::Notice-->
                            <form method="post" id="form_Data" action="/trainee/pre_assessment_add/{{$pre_assessment_i}}">
                            <?php  $i=1?>
                            @foreach($pre_assessment as $row)
                            <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed p-6">
                                @csrf
                                <span class="svg-icon svg-icon-2tx svg-icon-primary me-4">
                                    <h3>Question <?php echo $i++; ?> :- {{$row->question}}</h3>
                                    <input type="text" name="question" value="{{$row->question}}">
                                    <div class="form-group" id="ans">
   
                                        <input type="radio" name="ans" value="{{$row->option1}}"> <span>{{$row->option1}}</span>
                                      </div>
                                      <div class="form-group">
                                        
                                        <input type="radio" name="ans" value="{{$row->option2}}"> <span>{{$row->option2}}</span>
                                      </div>
                                      <div class="form-group">
                                       
                                        <input type="radio" name="ans" value="{{$row->option3}}"> <span>{{$row->option3}}</span>
                                      </div>
                                      <div class="form-group">
                                        
                                        <input type="radio" name="ans" value="{{$row->option4}}"> <span>{{$row->option4}}</span>
                                      </div>
                                    
                                </span>
                             </div><br>
                             @endforeach
                             <div class="form-group">
                                        
                                        <input type="submit" name="submit" class="btn btn-success">
                                      </div>
                        </form>
                        <!--end::Card body-->
                    </div>
                    <!--end::Content-->
                </div>
                
            </div>
		
	</div>
	<!--end::Container-->
</div>

@endsection


@section('footer')
   @include('member.seller.layouts.footer') 
@endsection