@extends('layouts.app')


@section('header')
     @include('layouts.header')
@endsection



@section('content')
     <!-- Content Code Start -->

    <article>
        <div class="sectionTopBannner sectionBusiness">
            <div class="container">
                <h2>Frequently Asked Questions</h2>
               
            </div>
        </div>

        <div class="sectionFAQ">
            <div class="container">
                <h2 class="mb-5">Export Belize Development And Promotion:-</h2>

                <div class="accordion" id="accordionExample">
                    @php
                    $key = 0
                    @endphp
                    @foreach($FaqLists as $FaqList)
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button @if($key !=0){ collapsed }@endif" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$FaqList->id}}" aria-expanded="true" aria-controls="collapseOne">
                           {{$FaqList->Title}}
                        </button>
                      </h2>
                      <div id="collapse{{$FaqList->id}}" class="accordion-collapse collapse @if($key ==0){ show }@endif" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                          <p>{{$FaqList->description}}</p>
                        </div>
                      </div>
                    </div>
                    @php
                    $key++
                    @endphp
                    @endforeach
                    
                </div>
            </div>
        </div>


          <div class="sectionFAQ">
            <div class="container">
                <h2 class="mb-5">Small Business Development:-</h2>

                <div class="accordion" id="accordionExample">
                    @php
                    $key = 0
                    @endphp
                    @foreach($FaqLists as $FaqList)
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button @if($key !=0){ collapsed }@endif" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$FaqList->id}}" aria-expanded="true" aria-controls="collapseOne">
                           {{$FaqList->Title}}
                        </button>
                      </h2>
                      <div id="collapse{{$FaqList->id}}" class="accordion-collapse collapse @if($key ==0){ show }@endif" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                          <p>{{$FaqList->description}}</p>
                        </div>
                      </div>
                    </div>
                    @php
                    $key++
                    @endphp
                    @endforeach
                    
                </div>
            </div>
        </div>
		
		
		
		<div class="sectionFAQ">
            <div class="container">
                <h2 class="mb-5">Investment Generation & Promotion:-</h2>

                <div class="accordion" id="accordionExample">
                    @php
                    $key = 0
                    @endphp
                    @foreach($FaqLists as $FaqList)
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button @if($key !=0){ collapsed }@endif" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$FaqList->id}}" aria-expanded="true" aria-controls="collapseOne">
                           {{$FaqList->Title}}
                        </button>
                      </h2>
                      <div id="collapse{{$FaqList->id}}" class="accordion-collapse collapse @if($key ==0){ show }@endif" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                          <p>{{$FaqList->description}}</p>
                        </div>
                      </div>
                    </div>
                    @php
                    $key++
                    @endphp
                    @endforeach
                    
                </div>
            </div>
        </div>


    </article>

    <!-- Content Code End -->

  
    
@endsection



@section('footer')
    @include('layouts.footer')
@endsection

