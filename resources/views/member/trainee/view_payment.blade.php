<?php error_reporting(0); ?>

@extends('member.trainee.layouts.app')
@section('title', 'Training Lists')

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
        <div class="d-flex flex-column flex-lg-row">

            <div class="flex-md-row-fluid">

                <div class="card mb-5 mb-xl-10">
                    <!--begin::Card header-->
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                        data-bs-target="#kt_account_profile_details" aria-expanded="true"
                        aria-controls="kt_account_profile_details">
                        <!--begin::Card title-->
                        <div class="card-title m-0">
                            <h3 class="fw-bolder m-0">Training Lists</h3>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--begin::Card header-->
                    <!--begin::Content-->
                    <div class="card-body">

                        <div class="table-responsive">

                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive"
                                style="width: 100%;">

                                <thead>

                                    <tr>

                                        <th>Training Name</th>
										<th>Name</th>
                                        <th>Paid Amount</th>
                                        <th>Upload Reciept </th>
                                        <th>Payment Date </th>
                                       
                                    </tr>

                                </thead>

                                <tbody>

                                    @foreach ($TrainingLists as $value)
                                    
                                    <tr>
									     <td>{{$value->TrainingName}}</td>
                                        <td>{{$value->name}}</td>
                                        <td>{{$value->paid_amount}}</td>
                                        <td>
                                            <img src="/assets/images/payment/{{$value->Upload_Reciept}}" style="height:200px;width:200px;">
                                           </td>
                                        <td>{{$value->created_at}}</td>

                                    </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Basic info-->

            </div>
            <!--end::Layout-->
        </div>
    </div>
    <!--end::Container-->
</div>

@endsection


@section('footer')
@include('member.seller.layouts.footer')
@endsection