@extends('layouts.app')


@section('header')
     @include('layouts.header')
@endsection

@section('content')
    <article>
        <div class="boxProductDetail">
            <div class="container">
                <div class="row align-items-center rowTopProduct">
                    <div class="col-md-9">
					
					    @if($SellerData->image)
							 
                        <h2 class="headingABC"><img src="{{url('assets/images/upload/'.$SellerData->image)}}"/>  {{$SellerProfile->company}}  </h2>
						@endif
                        <ul class="listProductMenu"> 
                            <li><a href="#product">Product & Services</a> </li>
                            <li><a href="#aboutUs">About Us</a> </li>
                            <li><a href="#contact">Contact Information</a> </li>
                        </ul>
                    </div>  
                    <div class="col-md-3">
                        <div class="boxBtns">
                            <a href="tel:+{{$SellerData->phone}}" class="btn btn-white"> <i class="fas fa-phone-alt"></i> View Mobile Number</a>
                            <a href="mailto:{{$SellerData->email}}" class="btn"> <i class="fas fa-envelope"></i> Send Email</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="productArea" id="product">
            <div class="container">
                <div class="slider-product">
                    
                    @foreach($ProductLists as $ProductList)
                    <div>
                        <div class="boxProduct">
                            <a href="#">
                                <div class="imgProduct">
                                    <img src="{{url('assets/images/upload/'.$ProductList->main_image)}}" alt="" title=""/>
                                </div>
                                <h4>{{$ProductList->name}}</h4>
                            </a>
                        </div>
                    </div>
                    @endforeach
                    
                </div>
            </div>
        </div>
        <div class="aboutArea" id="aboutUs">
            <div class="container">
                <h2 class="text-center">About</h2>
                <p>
                    {{$SellerProfile->description}}
                </p>
                <p class="text-end pb-5">
                    <a href="#" class="btn btn-secondary">Read More</a>
                </p>
                <div class="row rowEstablished">
                    <div class="col-md-6">
                        <div class="contentEstablished">
                            <i class="fas fa-university"></i>
                            <h5>Established (Year)</h5>
                            @if($SellerProfile->est_date!='')
                            <h4><span style="color:black;">{{date('d/m/Y',strtotime($SellerProfile->est_date))}} </span></h4>
                            @else
                            <h4><span style="color:black;">XX/XX/19XX </span></h4>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="contentEstablished">
                            <i class="fas fa-building"></i>
                            <h5>Sector they belong to</h5>
                            <h4>Electronics</h4><h4> &nbsp;Food </h4>
                        </div>
                    </div>
                </div>
            </div>    
        </div>    
        <div class="contactArea" id="contact">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <h2>Contact Information</h2>
                        <div class="infoBox">
                            <p>Phone : @if($SellerData->phone!='') {{$SellerData->phone}} @else -- @endif</p>
                            <p>Fax : @if($SellerProfile->fax!='') {{$SellerProfile->fax}} @else -- @endif</p>
                            <p>Email : @if($SellerProfile->email!='') {{$SellerProfile->email}} @else -- @endif</p>
                            <p>Website : @if($SellerProfile->website_url!='') 
                                            <a href="{{$SellerProfile->website_url}}">{{$SellerProfile->website_url}}</a> 
                                        @else -- @endif</p>
                            <p>Address : @if($SellerProfile->store_address!='')
                                            {{$SellerProfile->store_address}}<br/> {{$SellerProfile->store_city}}, {{$SellerProfile->store_country}} - {{$SellerProfile->store_pincode}} 
                                            @else -- @endif</p>
                            <p>
                                <span style="margin:10px 10px"><a href="https://api.whatsapp.com/send?phone=+91{{$SellerProfile->whatsapp}}&amp;text=Hi! This message is sent from website. I have Queries?" target="_blank" rel="noopener noreferrer"><img src="{{asset('assets/images/WhatsApp_icon.png')}}" class="whatsapplink" ></a></span>
                                <!--<span style="margin:10px 10px"><a href="https://www.facebook.com" target="_blank" ><img src="{{asset('assets/images/facebook.png')}}" class="facebooklink" ></a></span>-->
                                <span style="margin:10px 10px; height:40px;"><a href="{{$SellerProfile->messanger}}" target="_blank" ><img src="{{asset('assets/images/Facebook_Messenger_logo_2018.svg.png')}}" class="messangerlink" ></a></span>
                            </p>
                        </div>
                        <div class="boxMap">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3810.426888347402!2d-88.77565658511436!3d17.246570211390594!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f5dd56c2ef61fb5%3A0x49c5ccf58a047897!2sBELTRAIDE!5e0!3m2!1sen!2sin!4v1640879190023!5m2!1sen!2sin" width="100%" height="275" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <h2>Post Your Requirement</h2>
                        
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
                        
                        <form action="{{ url('postrequirements') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="seller_id" value="{{$SellerProfile->seller_id}}">
                            <input type="hidden" name="company" value="{{$SellerProfile->company}}">
                            
                            <div class="input-area mb-2">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter Name" required>
                            </div>
                            <div class="input-area mb-2">
                                <label class="form-label">Product/service</label>
                                <input type="text" class="form-control" name="service" placeholder="Enter Product/service" required>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-area mb-2">
                                        <label class="form-label">Quantity</label>
                                        <input type="number" min="1" class="form-control" onkeypress="return isNumberKey(event,this)" name="qty" placeholder="Estimated quantity" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-area mb-2">
                                        <label class="form-label">Select Unit</label>
                                        <input type="number" min="1" class="form-control" onkeypress="return isNumberKey(event,this)" name="unit" placeholder="Select Unit" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="input-area mb-2">
                                <label class="form-label">Mobile No.</label>
                                <input type="text" class="form-control" name="phone" onkeypress="return isNumberKey(event,this)" placeholder="Mobile No" required>
                            </div>
                            <div class="input-area mb-4">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Email" required>
                            </div>
                            <p>
                                <button class="btn btn-white btnFull" type="submit">Get Quotes Now</button>
                            </p>
                        </form>
                    </div>
                </div>
            </div>    
        </div>
		
		@if(count($ClientTestimonialLists))
        <div class="sectionLightGray">
            <div class="container">
                <h2 class="text-center mb-3">CLIENT TESTIMONIAL</h2>
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
		@endif
        <div class="sectionLinks">
            <div class="container">
                <div class="row linkrows">
                    <div class="col-md-4">
                        <h4>Website Link:   @if($SellerProfile->website_url!='') 
                                                <a href="{{$SellerProfile->website_url}}">{{$SellerProfile->website_url}}</a> 
                                            @else 
                                                -- 
                                            @endif
                        </h4>
                    </div>
                    <div class="col-md-4">
                        <h4>Social Media Link: </h4>
                        <ul class="listSocialMediaNew">
                            <li><a href="https://api.whatsapp.com/send?phone=+91{{$SellerProfile->whatsapp}}&amp;text=Hi! This message is sent from website. I have Queries?" target="_blank" rel="noopener noreferrer"><i class="fab fa-whatsapp"></i></a> </li>
                            @if($SellerProfile->facebook!='') 
                            <li><a href="{{$SellerProfile->facebook}}" target="_blank"><i class="fab fa-facebook"></i></a> </li>
                            @else
                            <li><a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook"></i></a> </li>
                            @endif
                            @if($SellerProfile->twitter!='') 
                            <li><a href="{{$SellerProfile->twitter}}" target="_blank"><i class="fab fa-twitter"></i></a> </li>
                            @else
                            <li><a href="https://twitter.com/i/flow/login" target="_blank"><i class="fab fa-twitter"></i></a> </li>
                            @endif
                            @if($SellerProfile->pinterest!='') 
                            <li><a href="{{$SellerProfile->pinterest}}" target="_blank"><i class="fab fa-pinterest"></i></a> </li>
                            @else
                             <li><a href="https://in.pinterest.com/" target="_blank"><i class="fab fa-pinterest"></i></a> </li>
                            @endif
                            
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h4>Export Ready: <a href="#">Click here</a></h4>
                    </div>
                </div>
            </div>
        </div>
        



    </article>

    <!-- Content Code End -->


<script type="text/javascript">
    $('.nopaste').bind("cut copy paste",function(e) {
         e.preventDefault();
     });
     
    function isNumberKey(evt, obj) {

        var charCode = (evt.which) ? evt.which : event.keyCode
        var value = obj.value;
        var dotcontains = value.indexOf(".") != -1;
        if (dotcontains)
            if (charCode == 46) return false;
        if (charCode == 46) return true;
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }



</script>
    
@endsection



@section('footer')
    @include('layouts.footer')
@endsection

