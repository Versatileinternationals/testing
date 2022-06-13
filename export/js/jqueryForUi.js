

$(document).ready(function (){
	// variable declarations
	var totalCharForCompDesc = 350;
	var totalCharForIndustryServiced = 400;
	
	/*$(window).load(function() { // makes sure the whole site is loaded
		$('#status').fadeOut(); // will first fade out the loading animation
		$('#preloader').delay(50).fadeOut(100); // will fade out the white DIV that covers the website.
		$('body').delay(50).css({'overflow':'visible'});
	});
*/

	/*** START OF PRELOADER *******/
	$(window).on('load', function() {
		if ($('#preloader').length) {
			$('#preloader').delay(100).fadeOut('slow', function() {
				$(this).remove();

			});
		}
	});

	//displaying preloader while form is processing
	$('form').submit(function(event) {
		$('#preloader-container').html('<div id="preloader"></div>');
	});

	//add prelaoder when clicking on a link
	$('.show-preloader').click(function(event) {
		$('#preloader-container').html('<div id="preloader"></div>');
	});
	/********* END OF PRELAODER ***********/


	// shows remaining characters for industry serviced
	$("#industry-serviced").keydown(function(){

		var charLeft = totalCharForIndustryServiced - $(this).val().length;
		var text = '';

		if (charLeft <= 50){

			text = '<span class="text-danger font-weight-bold">'+charLeft+'</span>';

		}else if (charLeft <= 100){

			text = '<span class="font-weight-bold" style="color:#ff7700;">'+charLeft+'</span>';

		}else if (charLeft <= 150){

			text = '<span class="font-weight-bold" style="color:#ff9d00">'+charLeft+'</span>';

		}else{
		
			text = '<span class="text-dark font-weight-bold">'+charLeft+'</span>';

		} 
		$("#industry-serviced-count").html("Characters left: " + text);
		
	});

	$("#industry-serviced").keyup(function(){

		var charLeft = totalCharForIndustryServiced - $(this).val().length;
		var text = '';

		if (charLeft <= 50){

			text = '<span class="text-danger font-weight-bold">'+charLeft+'</span>';

		}else if (charLeft <= 100){

			text = '<span class="font-weight-bold" style="color:#ff7700;">'+charLeft+'</span>';

		}else if (charLeft <= 150){

			text = '<span class="font-weight-bold" style="color:#ff9d00">'+charLeft+'</span>';

		}else{
		
			text = '<span class="text-dark font-weight-bold">'+charLeft+'</span>';

		} 
		$("#industry-serviced-count").html("Characters left: " + text);
		
	});
	//Event handlers Start
	$("#comp-desc").keydown(function(){

		var charLeft = totalCharForCompDesc - $(this).val().length;
		var text = '';

		if (charLeft <= 50){

			text = '<span class="text-danger font-weight-bold">'+charLeft+'</span>';

		}else if (charLeft <= 100){

			text = '<span class="font-weight-bold" style="color:#ff7700;">'+charLeft+'</span>';

		}else if (charLeft <= 150){

			text = '<span class="font-weight-bold" style="color:#ff9d00">'+charLeft+'</span>';

		}else{
		
			text = '<span class="text-dark font-weight-bold">'+charLeft+'</span>';

		} 
		$("#comp-desc-count").html("Characters left: " + text);
		
	});

	$("#comp-desc").keyup(function(){

		var charLeft = totalCharForCompDesc - $(this).val().length;
		var text = '';

		if (charLeft <= 50){

			text = '<span class="text-danger font-weight-bold">'+charLeft+'</span>';

		}else if (charLeft <= 100){

			text = '<span class="font-weight-bold" style="color:#ff7700;">'+charLeft+'</span>';

		}else if (charLeft <= 150){

			text = '<span class="font-weight-bold" style="color:#ff9d00">'+charLeft+'</span>';

		}else{
		
			text = '<span class="text-dark font-weight-bold">'+charLeft+'</span>';

		} 
		$("#comp-desc-count").html("Characters left: " + text);
		
	});

/*********** Tool tip for dynamic elements **********/

	$("body").tooltip({
	    selector: '[data-toggle="tooltip"]'
	});

/*********** FOR COMPANY REGISTRATION ***************/
	$("#company-email").keyup(function(){

		var email = $('#company-email').val();

		$("#company-account-email").val(email);
		
	});
	
	$(".c-type-radio").click(function(){

		var icon = $(this).parent().find('i');
		var radioId = $(this).attr('id');

		//removes all selected icons
		$('.c-type-radio').parent().find('i').removeClass('text-primary');

		if($(this).is(':checked')){

			icon.addClass('text-primary');

		}else{

			icon.removeClass('text-primary');

		}


		if (radioId == 'c-service'){

			$("#add-comp-fields").fadeIn(500).attr('hidden', false).css('display', '');
			$('.service-field').attr('required', true);

		}else{
			$("#add-comp-fields").attr('hidden', true);

		}

		//$("#add-comp-fields").empty().fadeOut(2000);
		
	});
	
/********** FOR COMPANY REGISTRATION ADDITIONAL FIELDS FOR SERVICES ***************/




/********** FOR COMPANY REGISTRATION ADDITIONAL FIELDS FOR MUSIC ***************/


/******************************* Add Music Audio*******************************************/


$(".audio-upload").on('change', function(e){

        var audio = event.target.files;
	var audioSize = ((audio[0].size/1024)/1024).toFixed(4);
	
        if (typeof audio[0].name == "undefined") {

                alert('Invalid mp3 file!');

	//validating size
        }else if(audioSize <= 0){ //mb

                alert('Invalid audio size! Please try another audio');

        }else if(audioSize > 1){ //mb

                alert('Invalid audio size! Must be less than 1MB, please try another audio file.');

	}else if (audio[0].type !== 'audio/mpeg' && audio[0].type !== 'audio/mp3'){

                alert('Invalid audio file type! Audio must be in mp3 format, please try another audio file.');

	}else{
		//so far validation is correct

		$("#audio-preview-src").attr("src", URL.createObjectURL(audio[0]));
		$("#audio-preview").load();

		var duration = 0; 
		
		$('#audio-preview')[0].onloadedmetadata = function(){

			duration = $('#audio-preview')[0].duration;

			//validating audio duration
			if (duration > 35){
				$('#remove-audio').click();
				alert('Audio duration is greater than 35 seconds.');

			}else{

				//showing remove button
				$('#remove-audio').show();

			}

		};

        }



  });

$('#browse-audio').click(function(e){
      $('.audio-upload').click();
});

$('#remove-audio').click(function(e){
	//we will be removing the audio from the input
      e.preventDefault();
      
      $('#audio-preview-src').attr("src","");
      $("#audio-preview").load();//loads the new audio scr
      $(".audio-upload").val(null);

      $(this).hide();

});

/*********************** Audio for adding audio *************/
/*********************** Play/Pause audio for view music *************/

$('.play-audio').click(function(e){
      e.preventDefault();
      var icon = $(this);
      var audio = icon.find("audio");

      if (icon.hasClass('fa-play')){
	//play audio 
	icon.toggleClass('fa-play fa-pause');
	$(audio)[0].play();

      }else{
	//pause audio
	icon.toggleClass('fa-pause fa-play');
	$(audio)[0].pause();

      }
      

});

$('.audio-preview').on('ended',function(e){
      e.preventDefault();

      var icon = $(this).parent();
      $(icon).toggleClass('fa-pause fa-play');

});

/*********************** end of play/pause               *************/

/********************** navigation from on page to another page that contains a tag ****/
$(function() {
	//selecting tab
	var activeTab = window.location.hash;
	if (activeTab) {
		$(activeTab)[0].click();
	}

});
////////// End of navigation //////////
});
