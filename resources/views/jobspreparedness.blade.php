@extends('layouts.app')


@section('header')
     @include('layouts.header')
@endsection



@section('content')
    <!-- Content Code Start -->

    <article>
        <div class="sectionTopBannner sectioneventsJobs">
            <div class="container">
                <h2>Job Preparedness</h2>
            </div>
        </div>


        <div class="sectionGreen text-white">
            <div class="container">
                <h2 class="mb-2">Job Preparedness</h2>
                <h4 class="text-white mb-4">Are you looking to join online trainer </h4>
                @php
                $i = 0
                @endphp
                @foreach($JobPreLists as $JobPreList)
                <div class="row rowVideos mb-4">
                    @if($i%2!=0)
                    <div class="col-md-5">
                        <p>{{$JobPreList->description}}</p>
                    </div>
                    <div class="col-md-7">
                        <div class="boxVideo">
                            <iframe width="100%" height="400" src="https://www.youtube.com/embed/{{$JobPreList->youtube_video}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                    @else
                    <div class="col-md-7">
                        <div class="boxVideo">
                            <iframe width="100%" height="400" src="https://www.youtube.com/embed/{{$JobPreList->youtube_video}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <p>{{$JobPreList->description}}</p>
                    </div>
                    @endif
                </div>
                @php
                $i++
                @endphp
                @endforeach
                
                <p class="text-center pt-2">
                    <a href="#" class="btn btn-secondary btn-white">View All <i class="fas fa-sort-down"></i></a>
                </p>
            </div>
        </div>
        
      



    </article>

    <!-- Content Code End -->


    
@endsection



@section('footer')
    @include('layouts.footer')
@endsection

