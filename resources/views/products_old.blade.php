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
                        <h2 class="headingABC"><img src="assets/images/icon-2.png"/>  ABC Nutrition Center</h2>
                        <ul class="listProductMenu"> 
                            <li><a href="#product">Product & Services</a> </li>
                            <li><a href="#aboutUs">About Us</a> </li>
                            <li><a href="#contact">Contact Information</a> </li>
                        </ul>
                    </div>  
                    <div class="col-md-3">
                        <div class="boxBtns">
                            <a href="#" class="btn btn-white"> <i class="fas fa-phone-alt"></i> View Mobile Number</a>
                            <a href="#" class="btn"> <i class="fas fa-envelope"></i> Send Email</a>
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
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer  took a galley of type and scrambled it to make a type specimen book. It has survived not only  five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. 
                </p>
                <p class="text-end pb-5">
                    <a href="#" class="btn btn-secondary">Read More</a>
                </p>
                <div class="row rowEstablished">
                    <div class="col-md-6">
                        <div class="contentEstablished">
                            <i class="fas fa-university"></i>
                            <h5>Established (Year)</h5>
                            <h4>XX/XX/19XX </h4>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="contentEstablished">
                            <i class="fas fa-building"></i>
                            <h5>Sector they belong to</h5>
                            <h4>Lorem Ipsum is simply</h4>
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
                            <p>Phone :860-585-1254</p>
                            <p>Fax : 860-584-1973</p>
                            <p>Email : balesio@amci.com</p>
                            <p>Website : www.amci.com</p>
                            <p>Address : 20 Gear Drive Plymouth Industrial Park<br/> Terryville, CT 06786 United States</p>
                        </div>
                        <div class="boxMap">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3810.426888347402!2d-88.77565658511436!3d17.246570211390594!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f5dd56c2ef61fb5%3A0x49c5ccf58a047897!2sBELTRAIDE!5e0!3m2!1sen!2sin!4v1640879190023!5m2!1sen!2sin" width="100%" height="275" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <h2>Post Your Requirement</h2>
                        <form>
                            <div class="input-area mb-2">
                                <label class="form-label">Product/service</label>
                                <input type="text" class="form-control" placeholder="Enter Product/service">
                            </div>
                            <div class="input-area mb-2">
                                <label class="form-label">Select Seller</label>
                                <input type="text" class="form-control" placeholder="Select Seller ">
                            </div>
                            <div class="input-area mb-2">
                                <label class="form-label">Select Seller</label>
                                <input type="text" class="form-control" placeholder="Select Seller ">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-area mb-2">
                                        <label class="form-label">Quantity</label>
                                        <input type="text" class="form-control" placeholder="Estimated quantity">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-area mb-2">
                                        <label class="form-label">Select Unit</label>
                                        <input type="text" class="form-control" placeholder="Select Unit">
                                    </div>
                                </div>
                            </div>
                            <div class="input-area mb-2">
                                <label class="form-label">Mobile No.</label>
                                <input type="text" class="form-control" placeholder="Mobile No">
                            </div>
                            <div class="input-area mb-4">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" placeholder="Email">
                            </div>
                            <p>
                                <button class="btn btn-white btnFull" type="submit">Get Quotes Now</button>
                            </p>
                        </form>
                    </div>
                </div>
            </div>    
        </div>
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
        <div class="sectionLinks">
            <div class="container">
                <div class="row linkrows">
                    <div class="col-md-4">
                        <h4>Website Link: <a href="#">Click here</a></h4>
                    </div>
                    <div class="col-md-4">
                        <h4>Social Media Link: </h4>
                        <ul class="listSocialMediaNew">
                            <li><a href="#"><i class="fab fa-facebook"></i></a> </li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a> </li>
                            <li><a href="#"><i class="fab fa-linkedin"></i></a> </li>
                            <li><a href="#"><i class="fab fa-pinterest"></i></a> </li>
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



    
@endsection



@section('footer')
    @include('layouts.footer')
@endsection

