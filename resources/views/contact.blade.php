@extends('layouts.app')

@section('header')
   @include('layouts.header') 
@endsection

@section('content')
    <!-- Content Code Start -->
        
    <!-- Content Code Start -->

    <article>
        <div class="boxContactUs">
            <h2 class="text-center">Contact us</h2>
            <div class="boxMap">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3810.426888347402!2d-88.77565658511436!3d17.246570211390594!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f5dd56c2ef61fb5%3A0x49c5ccf58a047897!2sBELTRAIDE!5e0!3m2!1sen!2sin!4v1640879190023!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
            <div class="boxGetinTouch">
                <div class="container">
                    <div class="row rowTouch">
                        <div class="col-md-7">
                            <h3>Get in Touch</h3>
                            <p class="mb-5">Having Questions? Tell us about your Business, Our experts will check all the aspects and call you back to explain how exportersindia.com would help you to get quotes for your Business.</p>
                            <h4><a href="https://www.beltraide.bz/">www.beltraide.bz</a> </h4>
                            <div class="boxAddress">
                                3401 Mountain View Blvd.,
                                Suite 201 Belmopan, Cayo
                                Belize, Central America
                            </div>
                        </div>
                        <div class="col-md-5">
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
                            <h3>Submit Your Query</h3>
                            <form action="contactus" method="Post">
                                @csrf
                                <div class="input-area mb-2">
                                    <label class="form-label">Name* </label>
                                    <input type="text" name="name" class="form-control" placeholder="Your Name" required />
                                </div>
                                <div class="input-area mb-2">
                                    <label class="form-label">Email*</label>
                                    <input type="email" name="email" class="form-control" placeholder="Your Email" required />
                                </div>
                                <div class="input-area mb-2">
                                    <label class="form-label">Mobile No.</label>
                                    <input type="number" name="mobile" class="form-control" pattern="/^-?\d+\.?\d*$/" placeholder="Mobile No" onKeyPress="if(this.value.length==10) return false;" required />
                                </div>
                                <div class="input-area mb-4">
                                    <label class="form-label">Message*</label>
                                    <textarea name="message" class="form-control" rows="5" required> </textarea>
                                </div>
                                <input type="submit" class="btn btn-submit" value="Submit"/>
                            </form>
                        </div>
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


