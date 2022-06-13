@extends('layouts.app')


@section('header')
     @include('layouts.header')
@endsection



@section('content')
    <article>
        <div class="boxProductDetail">
            <div class="container">
                <div class="row align-items-center rowTopProduct">
                    <div class="col-md-12">
                        <h2 class="headingABC text-center"><img src="{{url('assets/images/icon-2.png') }}"/>  Products</h2>
                        
                    </div>  
                   
                </div>
            </div>
        </div>
       
       <!---- New Product Grid-------------->
        
        
       <div class="productArea text-white " id="product">
            <div class="container">
                <center>
                    <form method="post" action="/seller-profile">
                        @csrf
                        <div class="rowFormFields">
                            
                            <div class="column1">
                                <select class="form-select" name="search" id="search">
                                    <option value="Product">Product Search</option>
								</select>
                            </div>
                            <div class="column2">
                                {{ csrf_field() }}
                                <input type="text" class="typeahead form-control" id="name" name="name" placeholder="Enter Your Search..."/>
                            </div>
                            <div class="column3">
                                <button class="btnSearch" style="height:3rem;">Search Here...</button>
                            </div>
                        </div>
                    </form>
                    </center>
                <h2 class="text-center">FEATURED PRODUCTS</h2>
                <div class="row">
		           @foreach($ProductLists as $ProductList)
                    <div class="col-md-3">
                        <div class="boxProduct" style="margin-bottom:30px;">
                            <a href="{{url('seller-profile/'.base64_encode($ProductList->m_id))}}">
                                <div class="imgProduct">
                                    <img src="{{url('assets/images/upload/'.$ProductList->main_image)}}" alt="" title=""/>
                                </div>
                                <h4>{{$ProductList->name}}</h4>
                            </a>
                        </div>
                    </div>
                    @endforeach     
                          
                <p class="text-center pt-4">
                    <a href="#" class="btn btn-secondary btn-white">View All</a>
                </p>
            </div>    
        </div>
     <!------------------------------------------->
    </article>

    <!-- Content Code End -->



    
@endsection



@section('footer')
    @include('layouts.footer')
@endsection

