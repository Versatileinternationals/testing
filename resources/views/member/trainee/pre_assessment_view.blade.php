@extends('member.trainee.layouts.app')

@section('sidebar')
   @include('member.trainee.layouts.sidebar') 
@endsection

@section('header')
   @include('member.trainee.layouts.header') 
@endsection

@section('content')

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Container-->
	<div id="kt_content_container" class="container-fluid">
		
	<div class="row g-5 g-xxl-10">
			<!--begin::Col-->
			
			<!--end::Col-->
			<!--begin::Col-->
			<div class="col-xl-12 col-xxl-12 mb-5 mb-xxl-12">
				<!--begin::Engage widget 2-->
				<div class="card bgi-position-y-bottom bgi-position-x-end bgi-no-repeat bgi-size-cover min-h-250px h-xl-100 bg-gray-200 border-0" style="background-position: 100% 100%;background-size: 500px auto;background-image:url('assets/media/misc/city.png')">
					<!--begin::Body-->
					<div class="card-body d-flex flex-column justify-content-center ps-lg-15 text-center">
						<!--begin::Title-->
						<h3 class="text-gray-600 fs-2qx  mb-4 mb-lg-8">Online Quiz: Laravel Training
						</h3>
						<!--end::Title-->
						<!--begin::Action-->
						<div class="m-0">
							<a href='/trainee/pre_assessment_start/{{$pre_assessment_id}}' class="btn btn-danger fw-bold">Start Pre- Assessment</a>
						</div>
						<!--begin::Action-->
					</div>
					<!--end::Body-->
				</div>
				<!--end::Engage widget 2-->
			</div>
			<!--end::Col-->
		</div>
		
	</div>
	<!--end::Container-->
</div>

@endsection


@section('footer')
   @include('member.seller.layouts.footer') 
@endsection