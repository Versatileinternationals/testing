@extends('member.seller.layouts.app')

@section('sidebar')
   @include('member.seller.layouts.sidebar') 
@endsection

@section('header')
   @include('member.seller.layouts.header') 
@endsection

@section('content')


<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-fluid">
        <div class="d-flex flex-column flex-lg-row">
            <!--begin::Aside-->
            <div class="flex-column flex-md-row-auto w-100 w-lg-250px w-xxl-275px">
                <!--begin::Nav-->
                <div
                    class="card mb-6 mb-xl-9"
                    data-kt-sticky="true"
                    data-kt-sticky-name="account-settings"
                    data-kt-sticky-offset="{default: false, lg: 300}"
                    data-kt-sticky-width="{lg: '250px', xxl: '275px'}"
                    data-kt-sticky-left="auto"
                    data-kt-sticky-top="100px"
                    data-kt-sticky-zindex="95"
                >
                    <!--begin::Card body-->
                    <div class="card-body py-10 px-6">
                        
                        <!--begin::Menu-->
                        <ul id="kt_account_settings" class="nav nav-flush menu menu-column menu-rounded menu-title-gray-600 menu-bullet-gray-300 menu-state-bg menu-state-bullet-primary fw-bold fs-6 mb-2">
                            <li class="menu-item px-3 pt-0 pb-1">
                                <a href="#kt_account_settings_overview" data-kt-scroll-toggle="true" class="menu-link px-3 nav-link active">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-vertical"></span>
                                    </span>
                                    <span class="menu-title">Overview</span>
                                </a>
                            </li>
                            <li class="menu-item px-3 pt-0 pb-1">
                                <a href="#kt_account_settings_signin_method" data-kt-scroll-toggle="true" class="menu-link px-3 nav-link">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-vertical"></span>
                                    </span>
                                    <span class="menu-title">Sign-in Method</span>
                                </a>
                            </li>
                            <li class="menu-item px-3 pt-0 pb-1">
                                <a href="#kt_account_settings_profile_details" data-kt-scroll-toggle="true" class="menu-link px-3 nav-link">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-vertical"></span>
                                    </span>
                                    <span class="menu-title">Profile Details</span>
                                </a>
                            </li>
                            <li class="menu-item px-3 pt-0 pb-1">
                                <a href="#kt_account_profile_update" data-kt-scroll-toggle="true" class="menu-link px-3 nav-link">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-vertical"></span>
                                    </span>
                                    <span class="menu-title">Profile Update</span>
                                </a>
                            </li>
                            
                          <!--  <li class="menu-item px-3 pt-0">
                                <a href="#kt_account_settings_deactivate" data-kt-scroll-toggle="true" class="menu-link px-3 nav-link">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-vertical"></span>
                                    </span>
                                    <span class="menu-title">Deactivate Account</span>
                                </a>
                            </li>-->
                        </ul>
                        <!--end::Menu-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Nav-->
            </div>
            <!--end::Aside-->
            <!--begin::Layout-->
            <div class="flex-md-row-fluid ms-lg-12">
                <!--error msg -->
                @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                <strong>{{ $message }}</strong>
                </div>
                @endif
                @if ($message = Session::get('succ'))
                <div class="alert alert-success alert-block">
                <strong>{{ $message }}</strong>
                </div>
                @endif
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
                </ul>
                </div>
                @endif
                <!--error msg -->
                <!--begin::Overview-->
                <div class="card mb-5 mb-xl-10" id="kt_account_settings_overview" data-kt-scroll-offset="{default: 100, md: 125}">
                    <!--begin::Card header-->
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_overview">
                        <div class="card-title">
                            <h3 class="fw-bolder m-0">Overview</h3>
                        </div>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Content-->
                    <div id="kt_account_settings_overview" class="collapse show">
                        <!--begin::Card body-->
                        <div class="card-body border-top p-9">
                            <div class="d-flex align-items-start flex-wrap">
                                <div class="d-flex flex-wrap">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-125px mb-7 me-7 position-relative">
                                        <img src="{{url('assets/images/upload/'.$member->image)}}" alt="image" />
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Profile-->
                                    <div class="d-flex flex-column">
                                        <div class="fs-2 fw-bolder mb-1">{{$sellerData->company}}</div>
                                        <a href="#" class="text-gray-400 text-hover-primary fs-6 fw-bold mb-5">{{$member->email}}</a>
                                        <div class="badge badge-light-success text-success fw-bolder fs-7 me-auto mb-3 px-4 py-3">Default</div>
                                    </div>
                                    <!--end::Profile-->
                                </div>
                                
                            </div>
                            <!--begin::Row-->
                         
                            <!--end::Row-->
                            <!--begin::Notice-->

                            <!--end::Notice-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Overview-->
                <!--begin::Sign-in Method-->
                <div class="card mb-5 mb-xl-10">
                    <!--begin::Card header-->
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_signin_method">
                        <div class="card-title m-0">
                            <h3 class="fw-bolder m-0">Sign-in Method</h3>
                        </div>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Content-->
                    <div id="kt_account_settings_signin_method" class="collapse show">
                        <!--begin::Card body-->
                        <div class="card-body border-top p-9">
                            
                            <!--begin::Password-->
                            <div class="d-flex flex-wrap align-items-center mb-10">
                                <!--begin::Label-->
                                <div id="kt_signin_password">
                                    <div class="fs-6 fw-bolder mb-1">Password</div>
                                    <div class="fw-bold text-gray-600">************</div>
                                </div>
                                <!--end::Label-->
                                <!--begin::Edit-->
                                <div id="kt_signin_password_edit" class="flex-row-fluid d-none">
                                    <!--begin::Form-->
                                    <form id="kt_signin_change_password" action="{{ url($member->user_type.'/password') }}" method="POST" class="form" novalidate="novalidate">
                                        {{ csrf_field() }}
                                        <div class="row mb-1">
                                            <div class="col-lg-4">
                                                <div class="fv-row mb-0">
                                                    <label for="currentpassword" class="form-label fs-6 fw-bolder mb-3">Current Password</label>
                                                    <input type="password" class="form-control form-control-lg form-control-solid" name="opassword" id="currentpassword" required/>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="fv-row mb-0">
                                                    <label for="newpassword" class="form-label fs-6 fw-bolder mb-3">New Password</label>
                                                    <input type="password" class="form-control form-control-lg form-control-solid" name="password" minlength="6" id="newpassword" required/>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="fv-row mb-0">
                                                    <label for="confirmpassword" class="form-label fs-6 fw-bolder mb-3">Confirm New Password</label>
                                                    <input type="password" class="form-control form-control-lg form-control-solid" name="cpassword" minlength="6" id="confirmpassword" required/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-text mb-5">Password must be at least 8 character and contain symbols</div>
                                        <div class="d-flex">
                                            <button id="kt_password_submit" type="submit" class="btn btn-primary me-2 px-6">Update Password</button>
                                            <button id="kt_password_cancel" type="button" class="btn btn-color-gray-400 btn-active-light-primary px-6" onclick="hidePassword()">Cancel</button>
                                        </div>
                                    </form>
                                    <!--end::Form-->
                                </div>
                                <!--end::Edit-->
                                <!--begin::Action-->
                                <div id="kt_signin_password_button" class="ms-auto">
                                    <button class="btn btn-light btn-active-light-primary" onclick="showPassword()">Reset Password</button>
                                </div>
                                <!--end::Action-->
                            </div>
                            <!--end::Password-->
                            <!--begin::Notice-->
                            <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed p-6">
                                <!--begin::Icon-->
                                <!--begin::Svg Icon | path: icons/duotune/general/gen048.svg-->
                                <span class="svg-icon svg-icon-2tx svg-icon-primary me-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path
                                            opacity="0.3"
                                            d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z"
                                            fill="black"
                                        />
                                        <path
                                            d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z"
                                            fill="black"
                                        />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                <!--end::Icon-->
                                
                            <!--end::Notice-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Content-->
                </div>
                
            </div>
            <div class="card mb-5 mb-xl-10">
                <!--begin::Card header-->
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">Profile Details</h3>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--begin::Card header-->
                <!--begin::Content-->
                <div id="kt_account_settings_profile_details" class="collapse show">
                    <!--begin::Form-->
                    <form id="kt_account_profile_details_form" class="form" action="{{ url($member->user_type.'/profile') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <!--begin::Card body-->
                        <div class="card-body border-top p-9">
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6">@if($member->user_type =='seller') Logo @else Profile Image @endif</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <!--begin::Image input-->
                                    <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('{{asset('assets/images/user/default.png')}}');">
                                        <!--begin::Preview existing avatar-->
                                        @if($member->image!='')
                                        <div class="image-input-wrapper w-125px h-125px" style="background-image: url('{{asset('assets/images/upload/'.$member->image)}}');"></div>
                                        @else
                                        <div class="image-input-wrapper w-125px h-125px" style="background-image: url('{{asset}}');"></div>
                                        @endif
                                        <!--end::Preview existing avatar-->
                                        <!--begin::Label-->
                                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                            <i class="bi bi-pencil-fill fs-7"></i>
                                            <!--begin::Inputs-->
                                            <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                                            <input type="hidden" name="avatar_remove" />
                                            <!--end::Inputs-->
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Cancel-->
                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                        <!--end::Cancel-->
                                        <!--begin::Remove-->
                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                        <!--end::Remove-->
                                    </div>
                                    <!--end::Image input-->
                                    <!--begin::Hint-->
                                    <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                                    <!--end::Hint-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">Company Name</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <!--begin::Row-->
                                    <div class="row">
                                        <!--begin::Col-->
                                        <div class="col-lg-12 fv-row">
                                            <input type="text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" value="{{$sellerData->company}}" name="company_name" placeholder="Name of Company" required/>
                                        </div>
                                        <!--end::Col-->
                                        
                                    </div>
                                    <!--end::Row-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">Full Name</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <!--begin::Row-->
                                    <div class="row">
                                        <!--begin::Col-->
                                        <div class="col-lg-6 fv-row">
                                            <input type="text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" value="{{$member->name}}" name="name" placeholder="First name" required/>
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-lg-6 fv-row">
                                            <input type="text" class="form-control form-control-lg form-control-solid" placeholder="Last name" value="{{$member->last_name}}" name="last_name" required/>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Row-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6">
                                    <span class="required">Email</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Email must be active"></i>
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input type="email" class="form-control form-control-lg form-control-solid" placeholder="Email" value="{{$member->email}}" name="email" required/>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6">
                                    <span class="required">Contact Phone</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Phone number must be active"></i>
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input type="tel" class="form-control form-control-lg form-control-solid" placeholder="Phone number" value="{{$member->phone}}" name="phone" required/>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6">
                                    <span class="required">Address</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Address must be active"></i>
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <textarea class="form-control form-control-lg form-control-solid" placeholder="Address..." name="address" required/>{{$member->address}}</textarea>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6">
                                    <span class="required">City</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="City"></i>
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input type="text" class="form-control form-control-lg form-control-solid" placeholder="City" value="{{$sellerData->store_city}}" name="city" required/>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--<div class="row mb-6">-->
                                <!--begin::Label-->
                            <!--    <label class="col-lg-4 col-form-label fw-bold fs-6">-->
                            <!--        <span>Pincode</span>-->
                            <!--        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Pincode must be active"></i>-->
                            <!--    </label>-->
                                <!--end::Label-->
                                <!--begin::Col-->
                                <!--<div class="col-lg-8 fv-row">-->
                                    <input type="hidden" class="form-control form-control-lg form-control-solid" placeholder="Pincode" value="{{$member->pincode}}" name="pincode" />
                            <!--    </div>-->
                                <!--end::Col-->
                            <!--</div>-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6">
                                    <span class="required">Country</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Country of origination"></i>
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <select name="country" aria-label="Select a Country" data-control="select2" data-placeholder="Select a country..." class="form-select form-select-solid form-select-lg fw-bold">
                                         <option value="">Select a Country...</option>
                                       @foreach ($country as $value)
                                        <option value="{{$value->iso}}"
                                            {{old('country',$member->country) ==$value->iso? 'selected' : ''}}>
                                            {{$value->name}}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6">
                                    <span class="required">Location</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Location of origination"></i>
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                     <select name="location" aria-label="Select a Location" data-control="select2" data-placeholder="Select a location..." class="form-select form-select-solid form-select-lg fw-bold">
                                        <option value="">Select a Location...</option>
                                        <option data-kt-flag="flags/afghanistan.svg" value="BD"{{old('location',$sellerData->location) =="BD"? 'selected' : ''}}>Belize District</option>
                                        <option data-kt-flag="flags/aland-islands.svg" value="CAD"{{old('location',$sellerData->location) =="CAD"? 'selected' : ''}}>Cayo District</option>
                                        <option data-kt-flag="flags/albania.svg" value="CD"{{old('location',$sellerData->location) =="CD"? 'selected' : ''}}>Corozal District</option>
                                        <option data-kt-flag="flags/albania.svg" value="OWD"{{old('location',$sellerData->location) =="OWD"? 'selected' : ''}}>Orange Walk District</option>
                                        <option data-kt-flag="flags/albania.svg" value="SCD"{{old('location',$sellerData->location) =="SCD"? 'selected' : ''}}>Stann Creek District</option>
                                        <option data-kt-flag="flags/albania.svg" value="TD"{{old('location',$sellerData->location) =="TD"? 'selected' : ''}}>Toledo District</option>
                                        
                                    </select>
                                </div>
                                <!--end::Col-->
                            </div>
                            
                            <hr>
                            <div class="row mb-6">
                                @if($sellerData->banner!='')
                                <img src="{{url('assets/images/upload/'.$sellerData->banner)}}" height="150px" width="100%">
                                @endif
                            </div>
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6">
                                    <span class="required">@if($sellerData->banner!='') Update @else Upload @endif Banner</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Banner"></i>
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input type="file" class="form-control form-control-lg form-control-solid" name="banner"/>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6">
                                    <span class="required">Export or Export Ready</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Export Ready"></i>
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <div class="col-lg-4 fv-row" style="float:left; margin-left:20px;">
                                    <input type="radio" value="0" name="export" required/> Export
                                    </div>
                                    <div class="col-lg-4 fv-row" style="float:left; margin-right:50px;">
                                    <input type="radio" value="1" name="export" required/> Export Ready
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6">
                                    <span class="required">Store Name</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Store Name"></i>
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input type="text" class="form-control form-control-lg form-control-solid" placeholder="Store Name" value="{{$sellerData->store_name}}" name="store_name" required/>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6">
                                    <span class="required">Established On</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Established Date"></i>
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input type="date" class="form-control form-control-lg form-control-solid" value="{{$sellerData->est_date}}" name="est_date" required/>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6">
                                    <span class="required">Store Email</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Store Email"></i>
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input type="email" class="form-control form-control-lg form-control-solid" value="{{$sellerData->store_email}}" name="store_email" required/>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6">
                                    <span class="required">Store Fax</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Store Fax"></i>
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input type="text" class="form-control form-control-lg form-control-solid" value="{{$sellerData->fax}}" name="fax"/>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6">
                                    <span class="required">Website Link</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Website Link"></i>
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input type="text" class="form-control form-control-lg form-control-solid" value="{{$sellerData->website_url}}" name="website_url"/>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6">
                                    <span class="required">Whatsapp Number</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Whatsapp Number"></i>
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input type="number" class="form-control form-control-lg form-control-solid" value="{{$sellerData->whatsapp}}" name="whatsapp"/>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6">
                                    <span class="required">Facebook Page</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Facebook"></i>
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input type="text" class="form-control form-control-lg form-control-solid" value="{{$sellerData->facebook}}" name="facebook"/>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6">
                                    <span class="required">Facebook Messanger</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Facebook Messanger"></i>
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input type="text" class="form-control form-control-lg form-control-solid" value="{{$sellerData->messanger}}" name="messanger"/>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6">
                                    <span class="required">Pinterest Link</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Pinterest"></i>
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input type="text" class="form-control form-control-lg form-control-solid" value="{{$sellerData->pinterest}}" name="pinterest"/>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6">
                                    <span class="required">Twitter Link</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Twitter"></i>
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input type="text" class="form-control form-control-lg form-control-solid" value="{{$sellerData->twitter}}" name="twitter"/>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6">
                                    <span class="required">About</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="About"></i>
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <textarea class="form-control form-control-lg form-control-solid" placeholder="Description..." name="description" required>{{$sellerData->description}}</textarea>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6">
                                    <span class="required">Store Address</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="store_address"></i>
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <textarea class="form-control form-control-lg form-control-solid" placeholder="Store Address..." name="store_address" required>{{$sellerData->store_address}}</textarea>
                                </div>
                                <!--end::Col-->
                            </div>
                           
                        </div>
                        <!--end::Card body-->
                        <!--begin::Actions-->
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>
                            <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Save Changes</button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Content-->
                
                
                    
            </div>
                 
            <!--end::Layout-->
            
                            <div class="card mb-5 mb-xl-10" id="kt_account_profile_update" data-kt-scroll-offset="{default: 100, md: 125}">
                    <!--begin::Card header-->
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_update">
                        <div class="card-title">
                            <h3 class="fw-bolder m-0">Profile Update</h3>
                        </div>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Content-->
                    <div id="kt_account_settings_overview" class="collapse show">
                        <form id="kt_account_settings_overview_c" action="{{ url('/profile-update') }}" method="POST" class="form" >
                            @csrf
                            <input type="hidden" name="email" value="{{$member->email}}">
                        <!--begin::Card body-->
                        <div class="card-body border-top p-9">
                            <div class="d-flex align-items-start flex-wrap">
                                <div class="d-flex flex-wrap">
                                    <!--begin::Avatar-->
                                  
                                    <!--end::Avatar-->
                                    <!--begin::Profile-->
                                <ul class="list_radio">
                                <?php  
                                    $seller=DB::table('users')->where(['email'=>$member->email,'user_type'=>'seller'])->get()->toArray();
                                    $buyer=DB::table('users')->where(['email'=>$member->email,'user_type'=>'buyer'])->get()->toArray();
                                    $investor=DB::table('users')->where(['email'=>$member->email,'user_type'=>'investor'])->get()->toArray();
                                    $trainee=DB::table('users')->where(['email'=>$member->email,'user_type'=>'trainee'])->get()->toArray();
                                    //dd($seller);
                                ?>
                                @if(!empty($seller))
                                    <li>
                                        <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="usertype[]" value="seller" id="option1" checked onclick="return false">
                                        <label class="form-check-label" for="option1">As Seller</label>
                                        </div>
                                    </li><br>
                                @else
                                    <li>
                                        <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="usertype[]" value="seller" id="option1">
                                        <label class="form-check-label" for="option1">As Seller</label>
                                        </div>
                                    </li><br>
                                @endif
                                
                                
                                @if(!empty($buyer))
                                    <li>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="usertype[]" value="buyer" id="option2" checked onclick="return false">
                                        <label class="form-check-label" for="option2">As Buyer</label>
                                    </div>
                                    </li><br>
                                @else
                                    <li>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="usertype[]" value="buyer" id="option2" >
                                        <label class="form-check-label" for="option2">As Buyer</label>
                                    </div>
                                    </li><br>
                                @endif
                                
                                
                                
                                @if(!empty($investor))
                                    <li>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="usertype[]" value="investor" id="option4" checked onclick="return false">
                                        <label class="form-check-label" for="option4">As Investor </label>
                                    </div>
                                    </li><br>

                                @else
                                    <li>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="usertype[]" value="investor" id="option4">
                                        <label class="form-check-label" for="option4">As Investor </label>
                                    </div>
                                    </li><br>
                                @endif
                                
                                
                                @if(!empty($trainee))
                                     <li>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="usertype[]" value="trainee" id="option3" checked onclick="return false">
                                        <label class="form-check-label" for="option3">As Trainee</label>
                                    </div>
                                    </li><br>
                                @else
                                    <li>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="usertype[]" value="trainee" id="option3">
                                        <label class="form-check-label" for="option3">As Trainee</label>
                                    </div>
                                    </li><br>
                                @endif
                                
                                </ul>
                                    <!--end::Profile-->
                                </div>
                            </div>
                            <!--begin::Row-->
                         
                            <!--end::Row-->
                            <!--begin::Notice-->

                            <!--end::Notice-->
                        </div>
                        <!--end::Card body-->
                         <!--end::Card body-->
                        <!--begin::Actions-->
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>
                            <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Save Changes</button>
                        </div>
                        </form>
                    </div>
                    <!--end::Content-->
                </div>
        </div>
    </div>
    <!--end::Container-->
</div>

<script>
function showPassword(){
    $('#kt_signin_password').addClass('d-none');
    $('#kt_signin_password_button').addClass('d-none');
    $('#kt_signin_password_edit').removeClass('d-none');
}

function hidePassword(){
    $('#kt_signin_password').removeClass('d-none');
    $('#kt_signin_password_button').removeClass('d-none');
    $('#kt_signin_password_edit').addClass('d-none');
}
</script>

@endsection


@section('footer')
   @include('member.seller.layouts.footer') 
@endsection

