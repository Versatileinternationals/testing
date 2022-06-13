@extends('layouts.app')


@section('header')
     @include('layouts.header')
@endsection



@section('content')
     <!-- Content Code Start -->
<meta name="csrf-token" content="{{ csrf_token() }}">
    <article>
        <div class="sectionTopBannner sectionBusiness">
            <div class="container">
                <h2>BUSINESS DIRECTORY BELTRAIDE  </h2>
                <h4>Search for products and verified sellers near you </h4>
                <div class="formArea">
                    <form method="POST" action="/business-directory-beltraide">
                        @csrf
                        <div class="rowFormFields">
                            <div class="column1">
                                <select class="form-select" name="search" >
                                    <option value="">All Belize</option>
                                    <option data-kt-flag="flags/afghanistan.svg" value="BD">Belize District</option>
                                    <option data-kt-flag="flags/aland-islands.svg" value="CAD">Cayo District</option>
                                    <option data-kt-flag="flags/albania.svg" value="CD">Corozal District</option>
                                    <option data-kt-flag="flags/albania.svg" value="OWD">Orange Walk District</option>
                                    <option data-kt-flag="flags/albania.svg" value="SCD">Stann Creek District</option>
                                    <option data-kt-flag="flags/albania.svg" value="TD">Toledo District</option>
								
								</select>
								
                            </div>
                            <div class="column1">
                            <select class="form-select" name="search2" id="search">
								    <option value="Users" selected>User Search</option>
                                    <option value="Product">Product Search</option>
								</select>
                            </div>
                            <div class="column2">
                                {{ csrf_field() }}
                                <input type="text" class="typeahead form-control" id="name" name="name" placeholder="Enter Your Search..."/>
                            </div>
                            <div class="column3">
                                <button class="btnSearch">Search Here...</button>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
            <div id="searching_list"></div>
        </div>

        <div class="sectionGray sectionBusinessHub">
            <div class="container">
                <h2 class="text-center text-white">Business Hub/ Business Directory</h2>
                <p class="subheading text-center mb-4 text-white">Contrary to popular belief, Lorem Ipsum is not simply
                    random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000
                    years old </p>
                <div class="row rowBusinessHub">
                    @foreach($SellerLists as $SellerList)
              
                    <div class="col-md-4">
                        <div class="boxBusinessHub">
                            <div class="imgBusinessHub">
                              <a href="{{ url('seller-profile/'.base64_encode($SellerList->id))}}"> <img src="{{url('assets/images/upload/'.$SellerList->banner)}}" alt="" title="" /></a>
                            </div>
                            <div class="contentBusinessHub">
                                <h3>{{$SellerList->name}}</h3>
                                <div class="boxRating">
                                    <ul class="listStar">
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star-half-alt"></i></li>
                                    </ul>
                                    <a href="#" class="linkReview">19 Reviews</a>
                                </div>
                                <h4>{{$SellerList->city}}, {{$SellerList->state}}</h4>
                                <p class="text-center"><a href="#" class="linkBig">View Mobile Number</a></p>
                                <p class="text-center"><a href="{{ url('seller-profile/'.base64_encode($m_id)) }}" class="btn">Contact Company</a></p>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
                <p class="text-center pt-4">
                    <a href="#" class="btn btn-secondary btn-white">View All <i class="fas fa-sort-down"></i></a>
                </p>
            </div>
        </div>
        </div>

        <div class="sectionGreen sectionMadein">
            <div class="container">
                <h2 class="mb-2 text-white text-center">Made in Belize (Export Ready)</h2>
               
            </div>        
            <!--<h2 class="mb-2 text-white text-center">Our Featured Brands </h2>  -->
            <div class="boxLogos">
                <div class="container">
                    <div class="row rowLogos align-items-center text-center">
                        @foreach($BrandLists as $BrandList)
						
						
                        <div class="col-md-2">
                         <a href="{{url('seller-profile/'.base64_encode($BrandList->m_id))}}">  <img src="{{url('assets/images/upload/'.$BrandList->image)}}" alt="" title=""></a>
                        </div>
                        @endforeach
                    </div>
                </div>  
            </div>
            <p class="text-center pt-4">
                <a href="#" class="btn btn-secondary btn-white">View More</a>
            </p>
        </div>
        <div class="sectionGray text-white ">
            <div class="container">
                <h2 class="text-center">FEATURED PRODUCTS</h2>
                <div class="row">
                    @foreach($ProductLists as $ProductList)
                    <div class="col-md-4">
                        <div class="boxEvent boxServices">
                            <a href="#">
                                <div class="imgEvent">
                                    <img src="{{url('assets/images/upload/'.$ProductList->main_image)}}" alt="" title=""/>
                                </div>
                                <h3>{{$ProductList->name}}</h3>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                <p class="text-center pt-4">
                    <a href="#" class="btn btn-secondary btn-white">View All</a>
                </p>
            </div>    
        </div>
        <div class="sectionGreen sectionMadein sectionPostRequirments">
            <div class="container">
                <h2 class="mb-4 text-white text-center">Post Your Requirements</h2>
                <form action="requirements" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-area mb-2">
                                <label class="form-label">Product/service</label>
                                <input type="text" class="form-control" placeholder="Enter Product/service ">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-area mb-2">
                                <label class="form-label">Name </label>
                                <input type="text" class="form-control"  name="seller" placeholder="Name"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-area mb-2">
                                <label class="form-label">Select Seller </label>
                                {{ csrf_field() }}
                                <input list="sellerlist" type="text" class="form-control" id="seller" name="seller" placeholder="Search Seller..."/>
                            </div>
                            <div id="searching_seller"></div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-area mb-2">
                                <label class="form-label">Quantity</label>
                                <input type="text" class="form-control" placeholder="Estimated quantity">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-area mb-2">
                                <label class="form-label">Select Unit</label>
                                <input type="text" class="form-control" placeholder="Select Unit">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-area mb-2">
                                <label class="form-label">Mobile No. </label>
                                <input type="text" class="form-control" placeholder="Mobile No">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-area mb-2">
                                <label class="form-label">Email </label>
                                <input type="text" class="form-control" placeholder="Email">
                            </div>
                        </div>
                    </div>
                    <p class="pt-3">
                        <center><button class="btn btn-white btn" type="submit">Get Quotes Now</button></center>
                    </p>
                </form>
            </div>
        </div>        

        <div class="sectionGray">
            <div class="container">
                <h2 class="text-center text-white mb-3">CLIENT TESTIMONIAL</h2>
                <div class="sliderTestimonials2">
                    @foreach($ClientTestimonialLists as $ClientTestimonialList)
                    <div>
                        <div class="smallTestimonial">
                            <div class="iconQuate"><i class="fas fa-quote-left"></i></div>
                            <p>
                                {{$ClientTestimonialList->description}}
                            </p>
                            <h6>{{$ClientTestimonialList->name}}</h6>
                            <h5>( {{$ClientTestimonialList->designation}} )</h5>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="sectionFAQ">
            <div class="container">
                <h2 class="mb-5">Getting Started FAQ</h2>

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

  

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
$("#name").keyup(function()
{
  var query = $(this).val();
        if(query != '')
        {
         var _token = $('input[name="_token"]').val();
         var search = $("#search").val();
         
         $.ajax({
          url:"/business-directory-beltraide_sear",
          method:"POST",
          data:{query:query, _token:_token, search2:search},
          success:function(data){
              console.log(data);
           $('#searching_list').fadeIn();  
           $('#searching_list').html(data);
          }
         });
        }
  });
  $(document).on('click', 'li', function(){  
        $('#searching_list').val($(this).text());  
        $('#searching_list').fadeOut();  
    }); 


</script>


<script>
$("#seller").keyup(function()
{
  var query = $(this).val();
        if(query != '')
        {
         var _token = $('input[name="_token"]').val();
         $.ajax({
          url:"/business-directory-beltraide_seller",
          method:"POST",
          data:{query:query, _token:_token},
          success:function(data){
              console.log(data);
           $('#searching_seller').fadeIn();  
           $('#searching_seller').html(data);
          }
         });
        }
  });
  $(document).on('click', 'li', function(){  
        $('#searching_seller').val($(this).text());  
        $('#searching_seller').fadeOut();  
    }); 


</script>

<script>
    function getvalue(){
        
    }
</script>
    
@endsection

@section('footer')
    @include('layouts.footer')
	
@endsection

