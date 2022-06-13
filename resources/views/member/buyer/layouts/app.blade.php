<!DOCTYPE html>

<html lang="en">
	<head>
		
		<meta charset="utf-8" />
		<meta name="description" content="Good admin dashboard live demo. Check out all the features of the admin panel. A large number of settings, additional services and widgets." />
		<meta name="keywords" content="Good, bootstrap, bootstrap 5, admin themes, free admin themes, bootstrap admin, bootstrap dashboard, bootstrap dark mode" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{  'Beltraide' }}</title>
        
		<link rel="shortcut icon" href="{{ asset('member-assets/media/logos/favicon.ico') }}" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Page Vendor Stylesheets(used by this page)-->
		<link href="{{ asset('member-assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('member-assets/plugins/custom/vis-timeline/vis-timeline.bundle.css') }}" rel="stylesheet" type="text/css" />
		<!--end::Page Vendor Stylesheets-->
		<!--begin::Global Stylesheets Bundle(used by all pages)-->
		<link href="{{ asset('member-assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('member-assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
	
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="aside-enabled">
		
		<!--begin::Main-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="page d-flex flex-row flex-column-fluid">
				<!--begin::Aside-->
			    @yield('sidebar')
				<!--end::Aside-->
				<!--begin::Wrapper-->
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
					<!--begin::Header-->
					@yield('header')
					<!--end::Header-->
					<!--begin::Content-->
					@yield('content')
					<!--end::Content-->
					<!--begin::Footer-->
					@yield('footer')
					<!--end::Footer-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		
		</div>
		
		
		
		
		
		
		
		
		
		
		<!--end::Modal - Invite Friend-->
		<!--end::Modals-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<!--begin::Global Javascript Bundle(used by all pages)-->
		<script src="{{ asset('member-assets/plugins/global/plugins.bundle.js') }}"></script>
		<script src="{{ asset('member-assets/js/scripts.bundle.js') }}"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Page Vendors Javascript(used by this page)-->
		<script src="{{ asset('member-assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
		<script src="{{ asset('member-assets/plugins/custom/vis-timeline/vis-timeline.bundle.js') }}"></script>
		<!--end::Page Vendors Javascript-->
		<!--begin::Page Custom Javascript(used by this page)-->
		<script src="{{ asset('member-assets/js/widgets.bundle.js') }}"></script>
		<script src="{{ asset('member-assets/js/custom/widgets.js') }}"></script>
		<script src="{{ asset('member-assets/js/custom/apps/chat/chat.js') }}"></script>
		<script src="{{ asset('member-assets/js/custom/intro.js') }}"></script>
		<script src="{{ asset('member-assets/js/custom/utilities/modals/create-project/type.js') }}"></script>
		<script src="{{ asset('member-assets/js/custom/utilities/modals/create-project/budget.js') }}"></script>
		<script src="{{ asset('member-assets/js/custom/utilities/modals/create-project/settings.js') }}"></script>
		<script src="{{ asset('member-assets/js/custom/utilities/modals/create-project/team.js') }}"></script>
		<script src="{{ asset('member-assets/js/custom/utilities/modals/create-project/targets.js') }}"></script>
		<script src="{{ asset('member-assets/js/custom/utilities/modals/create-project/files.js') }}"></script>
		<script src="{{ asset('member-assets/js/custom/utilities/modals/create-project/complete.js') }}"></script>
		<script src="{{ asset('member-assets/js/custom/utilities/modals/create-project/main.js') }}"></script>
		<script src="{{ asset('member-assets/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
		<script src="{{ asset('member-assets/js/custom/utilities/modals/create-app.js') }}"></script>
		<!--<script src="{{ asset('member-assets/js/custom/utilities/modals/create-campaign.js') }}"></script>-->
		<script src="{{ asset('member-assets/js/custom/utilities/modals/users-search.js') }}"></script>
		<!--end::Page Custom Javascript-->
		<!--end::Javascript-->
		<script src="{{ asset('member-assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('member-assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <!-- Buttons examples -->
        <script src="{{ asset('member-assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('member-assets/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('member-assets/plugins/datatables/jszip.min.js') }}"></script>
        <script src="{{ asset('member-assets/plugins/datatables/pdfmake.min.js') }}"></script>
        <script src="{{ asset('member-assets/plugins/datatables/vfs_fonts.js') }}"></script>
        <script src="{{ asset('member-assets/plugins/datatables/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('member-assets/plugins/datatables/buttons.print.min.js') }}"></script>
        <script src="{{ asset('member-assets/plugins/datatables/buttons.colVis.min.js') }}"></script>
        <!-- Responsive examples -->
        <script src="{{ asset('member-assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('member-assets/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('member-assets/js/jquery.datatable.init.js') }}"></script>
	</body>
	<!--end::Body-->

</html>