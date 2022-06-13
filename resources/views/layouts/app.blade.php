<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
	
	    <link rel="apple-touch-icon" sizes="144x144" href="assets/favicon/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="assets/favicon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="assets/favicon/favicon-16x16.png">
		<link rel="manifest" href="assets/favicon/site.webmanifest">
		<link rel="mask-icon" href="assets/favicon/safari-pinned-tab.svg" color="#5bbad5">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- CSRF Token -->
		
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{  'Beltraide' }}</title>
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Bootstrap CDN -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
        <!-- Fontawesome CDN -->
        <link rel="stylesheet" 
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
            integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
            crossorigin="anonymous" />    
        <!-- Custom CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/main.css') }}" />
    </head>
    <body>
        <div id="app">
            @include('layouts.header')
            <main>
                @yield('content')
            </main>
            <footer>
                @include('layouts.footer')
            </footer>
        </div>
    
    
        <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
        
        <script type="text/javascript">
            $(document).ready(function () {
                $('#checkBtn').click(function() {
                    checked = $("input[type=checkbox]:checked").length;

                    if(!checked) {
                       alert("You must check at least one checkbox.");
                    return false;
                    }

                });
            });

        </script>
		
	
        <script type="text/javascript" language="javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" language="javascript" src="{{ asset('assets/js/slick.min.js') }}"></script>
        <script type="text/javascript" language="javascript" src="{{ asset('assets/js/custom.js') }}"></script>
		
        <script type="text/javascript">
        $(document).ready(function(){
            $('.sliderEvents, .sliderServices').slick({
                infinite: true,
    			
                slidesToShow: 3,
                slidesToScroll: 1
            });
            $('.sliderTestimonials').slick({
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1
            });
        });
    	
    	$(document).ready(function(){
            $('.company_slider').slick({
                infinite: true,
    			autoplay: true,
                slidesToShow: 3,
                slidesToScroll: 1
            });
            
        });
        
    </script>
	<script type="text/javascript">
    $(document).ready(function () {
        $('.slider-product').slick({
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 1
        });
        $('.sliderTestimonials2').slick({
            infinite: true,
            slidesToShow: 3,
            arrows: false,
            dots: true,
            slidesToScroll: 1
        });
    });

    </script>


<script type="text/javascript">
    $(document).ready(function () {
        $('.self_video').slick({
            infinite: true,
            slidesToShow: 4,
			autoplay: true,
            slidesToScroll: 1
        });
		$('.sliderTestimonials2').slick({
            infinite: true,
            slidesToShow: 3,
            arrows: false,
            dots: true,
            slidesToScroll: 1
        });
        
    });

</script>

<script>

const togglePassword = document.querySelector("#togglePassword");
const password = document.querySelector("#password");

togglePassword.addEventListener("click", function () {
   
// toggle the type attribute
const type = password.getAttribute("type") === "password" ? "text" : "password";
password.setAttribute("type", type);

// toggle the eye icon
this.classList.toggle('fa-eye');
});
    </script>
	<script>

const togglecPassword = document.querySelector("#togglecPassword");
const cpassword = document.querySelector("#cpassword");

togglecPassword.addEventListener("click", function () {
   
// toggle the type attribute
const type = cpassword.getAttribute("type") === "password" ? "text" : "password";
cpassword.setAttribute("type", type);

// toggle the eye icon
this.classList.toggle('fa-eye');
});
    </script>
@yield('script')	
</body>
</html>
