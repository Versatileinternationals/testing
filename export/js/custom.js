//variables\

var isValid;
var emClicks = 0;
var emCount = 1;

//allows the visibility of a password

function myFunction() {
    var x = document.getElementById("pass");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
}
function displayBothPasswords(){
    var nPass = document.getElementById("newPass");
    var cPass = document.getElementById("conPass");

    if (nPass.type === "password") {
      nPass.type = "text";
      cPass.type = "text";

    } else {
      nPass.type = "password";
      cPass.type = "password";
    }

}
// //used for changing a password outside of the system
// function checkChangePassMatch() {
//   console.log('test');
//   //$('#submit-button').prop('disabled', true);
//   var decimal =  /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,16}$/;//rules that govern what is required of a password
//   var password = $("#newPassword").val();
//   var confirmPassword = $("#confirmPassword").val();

//   if (password != confirmPassword && confirmPassword != ''){
   
//       $('#change-pass-btn').prop('disabled', true);
//       $("#divCheckPasswordMatch").html("<span class='text-danger ml-4'>Passwords do not match!</span>");
  
//   }else if(password == '' || confirmPassword == ''){

//       $("#divCheckPasswordMatch").html(" ");
//       $("#passRequirement").html(" ");
//       $('#change-pass-btn').prop('disabled', true);
  
//   }else{
      
//       $("#divCheckPasswordMatch").html("<span class='text-success ml-4'> Passwords match.</span>");
      
//       if (password.match(decimal)){

//           $("#passRequirement").html(" ");
//           $('#change-pass-btn').prop('disabled', false);

//       }else{

//           $("#passRequirement").html("<span class='text-danger ml-4'>Please meet the requirement stated above!</span>");

//       }
//   }
// }
var readURL = function(input) {
  if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
          $('.avatar').attr('src', e.target.result);
      }
      
      $('#upload-business-logo').show();
      $('#remove-company-logo').show();
      $('#remove-img').show();
      // $('#remove-client-img').show();//displaying remove image button for editing a client
      // $('#remove-appli-img').show(); //displaying remove image button for adding a client

      reader.readAsDataURL(input.files[0]);
  }
}

//on document ready

$(document).ready(function(){

  //Setting bootstrap tooltips 
  $('[data-toggle="tooltip"]').tooltip()

  //disables all inputs inside myprofile form
   $("#myProfile :input").prop("disabled", true);

  //disables all input inside export-market
  //$("#my-export-market-form :input").prop("disabled", true);

  //diables all inputs in myCompanyProfile form
  $("#myCompanyProfile :input").prop("disabled", true);

  // for registration when creating a new password
  //checks the new passsword being entered matches the correct validation
    $( "#newPass" ).keyup(function() {

	var newPass = $(this).val();
	var message = '';
	isValid = 0;//keeps track if all requirements are met for password

	if (newPass != undefined && newPass != ''){
		
		//checking if password has a capital letter
		if (newPass.toLowerCase() != newPass ){
			
			message +='<span class="text-success pl-2"><i class="fa fa-check"></i> A capital (uppercase) letter</span><br>';
			isValid ++;

		}else{

			message += '<span class="text-danger"><i class="fa fa-times"></i> A capital (uppercase) letter</span><br>';	
		}

		//checking if password has a lower case letter
		if (newPass.toUpperCase() != newPass ){
		
			message += '<span class="text-success pl-2"><i class="fa fa-check"></i> A lowercase letter</span><br>';	
			isValid ++;

		}else{

			message += '<span class="text-danger"><i class="fa fa-times"></i> A lowercase letter</span><br>';
		}

		var hasNum = newPass.match(/\d+/g)
		//checking if password has a lower case letter
		if (hasNum != null){
		
			message += '<span class="text-success pl-2"><i class="fa fa-check"></i> A number</span><br>';
			isValid ++;

		}else{

			message += '<span class="text-danger"><i class="fa fa-times"></i> A number</span><br>';
		}

		//checking password length
		if (newPass.length >= 8){
		
			message += '<span class="text-success pl-2"><i class="fa fa-check"></i> Minimum of 8 Characters</span><br>';
			isValid ++;

		}else{

			message += '<span class="text-danger"><i class="fa fa-times"></i> Minimum of 8 Characters</span><br>';

		}
		
		$( "#conPass" ).keyup();
	
		$('#newPassMessage').html(message);
	}else{

		$('#registrationBtn').attr('disabled', true);
		$('#newPassMessage').html('');
		
	}	
	

    });
    //checks if the confirmation password matches the new password
    $( "#conPass" ).keyup(function() {

	var newPass = document.getElementById("newPass").value;
	var conPass = document.getElementById("conPass").value;
	
	var message = '';

	if (conPass != undefined && conPass != ''){

		if (conPass === newPass){
				if(isValid == 4){

					$('#registrationBtn').attr('disabled', false);
					message += '<span class="text-success pl-2"><i class="fa fa-check"></i> Matches new password</span><br>';
				}else{

					message += '<span class="text-danger"><i class="fa fa-exclamation-triangle text-warning"></i> Please ensure that password specifications are met</span><br>';

				}

		}else{

			$('#registrationBtn').attr('disabled', true);
			message += '<span class="text-danger"><i class="fa fa-times"></i> Matches new password</span><br>';
		}
		$('#conPassMessage').html(message);

	}else{
		$('#conPassMessage').html('');

	}
	
    });
  
  //for my export market list
  $('#add-export-market-modal-btn').click(function(e){
	    e.preventDefault();

	    var formData = $('#add-export-market-form').serializeArray();
	    formData.push({ name: 'ajaxRequest', value: 'addToExportMarketList'});

	    $('#add-export-market-modal').modal('hide');

	    $.post( BASE_URL, formData,  function( data ) {

		var data = JSON.parse(data);

		if (data.error === 0){

			$('#export-market-list').append(data.emSelected);

			if (data.displayBtn == 0){
			    $('#export-market-btn-span').empty();
			}

		}else{
			$('#notice-modal-body').text('');
			$('#notice-modal-body').text(data.message);
			$('#notice-modal').modal('show');
			
		}	


	    });


  });
  // for profile edit button clicked
  /*$('#editMyProfile').click(function(e){
    e.preventDefault();

    $(this).hide();
    $("#saveMyProfile").show();
    $("#myProfile :input").prop("disabled", false);

  });
  // for profile save button clicked
  $('#saveMyProfile').click(function(e){
    e.preventDefault();
    
    let url = $('#myProfile').attr('action');
    let data = $('#myProfile').serialize();

    $(this).hide();
    $("#editMyProfile").show();
    $("#myProfile :input").prop("disabled", true);

    $.post( url, data, function( data ) {
      alert(data);
    });
    
  });*/

  //for my company profile edit btn click
  $('#editCompanyProfile').click(function(){

    $(this).hide();
    $("#saveCompanyProfile").show();
    $("#myCompanyProfile :input").prop("disabled", false);
    $("#upload-business-logo").removeClass("disabled");
    $("#remove-company-logo").removeClass("disabled");

  });
  //for my company profile save btn clicked
  $('#saveCompanyProfile').click(function(){
    
    let url = $('#myCompanyProfile').attr('action');
    let data = new FormData(document.getElementById("myCompanyProfile"));

    $(this).hide();
    $("#editCompanyProfile").show();
    $("#myCompanyProfile :input").prop("disabled", true);
    $("#upload-business-logo").addClass("disabled");
    $("#remove-company-logo").addClass("disabled");
    
    $.ajax({
      url: url,  
      type: 'POST',
      data: data,
      success:function(data){
	  	
	  var result = JSON.parse(data);
          if (result.error ==  1){
		$('#notice-modal-body').text('');
		$('#notice-modal-body').text(result.message);
		$('#notice-modal').modal('show');
	  	//alert(result.message);
	  }
      },
      cache: false,
      contentType: false,
      processData: false
  });
    
    
  });

    // when uploading a profile picture of a client
  $(".file-upload").on('change', function(e){

        var files = e.currentTarget.files; // puts all files into an array
        var validSize = 0;
        //call them as such; files[0].size will get you the file size of the 0th file
        var filesize = ((files[0].size/1024)/1024).toFixed(4); // MB

        if (typeof files[0].name != "undefined") { 

            if (filesize <= 2) {
		 readURL(this);
            }else {
		alert('The image uploaded is greater than 2 MB! Please try another image that is 2 MB or less.');
            }

        }else{

		alert('Please upload an Image!');
	}



  });
  // triggered when uploading a clients pic on updating their profile
  $('#upload-business-logo').click(function (e){
      e.preventDefault();
      $('.file-upload').click();
      

  });
  // triggered when uploading a clients pic on updating their profile
  $('#upload-img').click(function (e){
      e.preventDefault();
      $('.file-upload').click();

  });
  $('#remove-img').on('click', function (e){
      e.preventDefault();
      
      $('#display-img').attr("src", BASE_URL+"images/question.png");
      $("#file-upload").val(null);
      $(this).hide();

  });
  $('#remove-company-logo').on('click', function (e){
      e.preventDefault();
      
      $('#business-logo').attr("src", BASE_URL+"images/business_icon.png");
      $('#remove-company-logo').hide();

  });

   //featuring service
  $('#service-list').on('click', '.is-featured', function (e){
    e.preventDefault();

    var obj = {};
    var isFeaturedBtn = $(this);
    var id = $(this).attr('data-serid'); 
    
    var icon = isFeaturedBtn.find(':first-child');

    if (icon.hasClass('text-success') ){
	//was selected now we deselect
	obj =  {ajaxRequest: 'removeFeaturedService', serId: id};
	
    }else{
	//was unselected now we select
	obj =  {ajaxRequest: 'addFeaturedService', serId: id};

    }

    $.post( BASE_URL, obj,  function( data ) {
		
		var result = JSON.parse(data);

		if (result.error === 1){
			$('#notice-modal-body').text('');
			$('#notice-modal-body').text(result.message);
			$('#notice-modal').modal('show');
			//alert(result.message);
		}else{

		    if (icon.hasClass('text-success') ){
			//was selected now we deselect
			icon.toggleClass('text-success text-secondary');
			
		    }else{
			//was unselected now we select
			icon.toggleClass('text-secondary text-success');

		    }

		}

    });
    

  });
   //featuring product
  $('#product-data').on('click', '.is-featured', function (e){
    e.preventDefault();

    var obj = {};
    var isFeaturedBtn = $(this);
    var pid = $(this).attr('data-pid'); 
    
    var icon = isFeaturedBtn.find(':first-child');

    if (icon.hasClass('text-success') ){
	//was selected now we deselect
	obj =  {ajaxRequest: 'removeFeaturedProduct', pId: pid};
	
    }else{
	//was unselected now we select
	obj =  {ajaxRequest: 'addFeaturedProduct', pId: pid};

    }

    $.post( BASE_URL, obj,  function( data ) {
		
		var result = JSON.parse(data);

		if (result.error === 1){
			//alert(result.message);
			$('#notice-modal-body').text('');
			$('#notice-modal-body').text(result.message);
			$('#notice-modal').modal('show');
				
		}else{

		    if (icon.hasClass('text-success') ){
			//was selected now we deselect
			icon.toggleClass('text-success text-secondary');
			
		    }else{
			//was unselected now we select
			icon.toggleClass('text-secondary text-success');

		    }

		}

    });
    

  });
  /// for featuring a company
  $('#company-data').on('click', '.is-featured', function (e){
    e.preventDefault();

    var obj = {};
    var isFeaturedBtn = $(this);
    var cid = $(this).attr('data-cid'); 
    
    var icon = isFeaturedBtn.find(':first-child');

    if (icon.hasClass('text-success') ){
	//was selected now we deselect
	icon.toggleClass('text-success text-secondary');
	obj =  {ajaxRequest: 'removeFeaturedCompany', cId: cid};
	
    }else{
	//was unselected now we select
	icon.toggleClass('text-secondary text-success');
	obj =  {ajaxRequest: 'addFeaturedCompany', cId: cid};

    }

    $.post( BASE_URL, obj,  function( data ) {
		
		var result = JSON.parse(data);

		if (result.error === 1){

			$('#notice-modal-body').text('');
			$('#notice-modal-body').text(result.message);
			$('#notice-modal').modal('show');
			//alert(result.message);

		}

    });
    

  });
// for featuring a sector
  $('#sector-data').on('click', '.is-featured', function (e){
    e.preventDefault();

    var obj = {};
    var isFeaturedBtn = $(this);
    var sid = $(this).attr('data-sid'); 
    
    var icon = isFeaturedBtn.find(':first-child');

    if (icon.hasClass('text-success') ){
	//was selected now we deselect
	obj =  {ajaxRequest: 'removeFeaturedSector', sId: sid};
	
    }else{
	//was unselected now we select
	obj =  {ajaxRequest: 'addFeaturedSector', sId: sid};

    }

    $.post( BASE_URL, obj,  function( data ) {
		
		var result = JSON.parse(data);

		if (result.error === 1){

			$('#notice-modal-body').text('');
			$('#notice-modal-body').text(result.message);
			$('#notice-modal').modal('show');
			//alert(result.message);

		}else{

		    if (icon.hasClass('text-success') ){
			//was selected now we deselect
			icon.toggleClass('text-success text-secondary');
			
		    }else{
			//was unselected now we select
			icon.toggleClass('text-secondary text-success');

		    }

		}

    });
    

  });
 
	

  $('#export-market-btn-span').on('click', '#add-export-market', function (e){
 // $('#add-export-market').on('click', function (e){
  //$('#add-export-market').click(function (e){
    e.preventDefault();

    var data = {};
    var addBtn = $(this);
    var cid = $(this).attr('data-cid'); 	

    if (cid == undefined || cid == ''){
	obj =  {ajaxRequest: 'getAvailableExportMarkets'};
    }else{
        $('#export-c-id').val(cid); 	
	obj =  {ajaxRequest: 'getAvailableExportMarkets', cId: cid};
    }
    $.post( BASE_URL, obj,  function( data ) {
		
		var eMarkets = JSON.parse(data);
		var options = '';

		if (eMarkets.error === 1){

			$('#notice-modal-body').text('');
			$('#notice-modal-body').text(eMarkets.message);
			$('#notice-modal').modal('show');
			//alert(eMarkets.message);

		}else{
			$.each( eMarkets , function(index, eMarket) { 
				options += '<option value="'+ eMarket.id +'">'+  eMarket.name +'</option>';	
			});

			$('#available-export-markets').empty();
			$('#available-export-markets').append(options);
			$('#add-export-market-modal').modal('show');

		}

    });

    
  });

  //removing a export market
  $('#export-market-list').on('click', '.remove-export-market', function (e){
    e.preventDefault();
    let exportMarketListId = $(this).val();
    var removeBtn = $(this);
    var cId = $('#c-id').val();

    if (exportMarketListId != ''){

	$.ajax({
	    url: BASE_URL,
	    type: "POST",
	    data: {
		'id' : exportMarketListId,
		'ajaxRequest' : 'removeExportMarket'
	    },
	    dataType: "json",
	    success: function (data) {


		if(data.error == 0){

		    removeBtn.parent().parent().parent().remove();

		    if ( $('#export-market-btn-span').children().length < 1 ){
			    //adding add export market button only if it doesnt already exist
			    $('#export-market-btn-span').empty();
			    var btn = '<button id="add-export-market" class="btn bs-btn-primary mt-3" data-cid="'+ cId +'">'+
					'<i class="fa fa-plus"></i> Add Export Market'+
				      '</button>';
			    $('#export-market-btn-span').append(btn);

		    }

		}else{

			$('#notice-modal-body').text('');
			$('#notice-modal-body').text(data.message);
			$('#notice-modal').modal('show');
			//alert(data.message);

		}



	    },
	    error: function (error) {
		console.log(`Error ${error}`);
	    },
	    async: false
	});


    }else{

	    removeBtn.parent().parent().parent().remove();
	    
	    if ( $('#export-market-btn-span').children().length > 0 ){
		    //adding add export market button only if it doesnt already exist
		    $('#export-market-btn-span').empty();
		    var btn = '<button id="add-export-market" class="btn bs-btn-primary mt-3">'+
				'<i class="fa fa-plus"></i> Add Export Market'+
			      '</button>';
		    $('#export-market-btn-span').append(btn);

	    }

    } 

  });


/// ADD FEATURED COMPANIES START /////

  //add featured company
  $('#add-featured-company').click(function(e){
    e.preventDefault();
    
    //var company = $(this).attr('data-link');
    $.post( BASE_URL, { ajaxRequest: 'getUnFeaturedCompany'},  function( data ) {

	var options = '';
	var companies = JSON.parse(data);
	
	if (companies.length == 0){

		options += '<option value="0" disabled>No Companies Available</option>';	

	}else{
		$.each( companies , function(index, company) { 
	    
			options += '<option value="'+ company.company_id +'">'+  company.company_name +'</option>';	
		});
	}
	
	
	$('#available-companies').empty();
	$('#available-companies').append(options);

    });


    $('#add-featured-company-modal').modal('show');

  });

  $('#add-featured-company-btn').click(function(e){
    e.preventDefault();

    var formData = $('#featured-company-form').serializeArray();
    formData.push({ name: 'ajaxRequest', value: 'addFeaturedCompany'});
	
    $.post( BASE_URL, formData,  function( data ) {

	var data = JSON.parse(data);

	if (data.error === 0){


		$('#featured-company-list').append('<li class="list-group-item">' +
                                        '<a href="' + BASE_URL + 'company/'+ data.company_url_name +'/'+ data.company_id +'" class="btn btn-link text-primary">'+ 
						data.company_name +
					'</a>'+
                                       	  '<a href="#" class="remove-featured-company float-right btn btn-link text-danger" data-cid="'+ data.company_id +'">'+
					'<i class="fa fa-minus fa-lg"></i></a>'+
			         '</li>');

	}else{

		$('#notice-modal-body').text('');
		$('#notice-modal-body').text(data.message);
		$('#notice-modal').modal('show');
		//alert(data.message);

	}	
        $('#add-featured-company-modal').modal('hide');
    });



  });
  $('#featured-company-list').on('click', '.remove-featured-company', function(e){
        e.preventDefault();
	
	var removeLink = $(this);
	var comId = removeLink.attr('data-cid');

	var data = { ajaxRequest : 'removeFeaturedCompany', cId : comId};
	
	$.post( BASE_URL, data,  function( data ) {

		var data = JSON.parse(data);

		if (data.error === 0){

			removeLink.parent().remove();

		}else{

			$('#notice-modal-body').text('');
			$('#notice-modal-body').text(data.message);
			$('#notice-modal').modal('show');
		//alert(data.message);

		}	

	});
	


  });
////END OF FEATURED COMPANIES ////////

////FOR FEATURED SECTORS /////////////

  //add featured sector
  $('#add-featured-sector').click(function(e){
    e.preventDefault();
    
    //var company = $(this).attr('data-link');
    $.post( BASE_URL, { ajaxRequest: 'getUnFeaturedSector'},  function( data ) {

	var options = '';
	var sectors = JSON.parse(data);

	if (sectors.length == 0){

		options += '<option value="0" disabled>No Sectors Available</option>';	

	}else{
		$.each( sectors , function(index, sector) { 
	    
			options += '<option value="'+ sector.id +'">'+  sector.name +'</option>';	
		});
	}

	$('#available-sectors').empty();
	$('#available-sectors').append(options);

    });

    $('#add-featured-sector-modal').modal('show');

  });

  $('#add-featured-sector-btn').click(function(e){
    e.preventDefault();

    var formData = $('#featured-sector-form').serializeArray();
    formData.push({ name: 'ajaxRequest', value: 'addFeaturedSector'});

    $.post( BASE_URL, formData,  function( data ) {

	var data = JSON.parse(data);

	if (data.error === 0){

		$('#featured-sector-list').append('<li class="list-group-item">' +
                                        '<a href="' + BASE_URL + 'edit/sector/'+ data.sector_id +'" class="btn btn-link text-primary">'+ 
						data.sector_name +
					'</a>'+
                                       	  '<a href="#" class="remove-featured-sector float-right btn btn-link text-danger" data-sid="'+ data.sector_id +'">'+
					'<i class="fa fa-minus fa-lg"></i></a>'+
			         '</li>');

	}else{

		$('#notice-modal-body').text('');
		$('#notice-modal-body').text(data.message);
		$('#notice-modal').modal('show');
		//alert(data.message);

	}	
        $('#add-featured-sector-modal').modal('hide');
    });
  });

  $('#featured-sector-list').on('click', '.remove-featured-sector', function(e){
        e.preventDefault();
	

	var removeLink = $(this);
	var secId = removeLink.attr('data-sid');

	var data = { ajaxRequest : 'removeFeaturedSector', sId : secId};
	
	$.post( BASE_URL, data,  function( data ) {

		var data = JSON.parse(data);

		if (data.error === 0){

			removeLink.parent().remove();

		}else{

			alert(data.message);

		}	
	});
  });



// END FOR FEATURED SECTORS //////////

// START OF FEATURED PRODUCTS ////////

  //add featured product
  $('#add-featured-product').click(function(e){
    e.preventDefault();
    
    //var company = $(this).attr('data-link');
    $.post( BASE_URL, { ajaxRequest: 'getUnFeaturedProducts'},  function( data ) {

	var options = '';
	var products = JSON.parse(data);

	if (products.length == 0){

		options += '<option value="0" disabled>No Products Available</option>';	

	}else{
		$.each( products , function(index, product) { 
	    
			options += '<option value="'+ product.product_id +'">'+  product.product_name +'</option>';	
		});
	}

	$('#available-products').empty();
	$('#available-products').append(options);

    });

    $('#add-featured-product-modal').modal('show');

  });

  $('#add-featured-product-btn').click(function(e){
    e.preventDefault();

    var formData = $('#featured-product-form').serializeArray();
    formData.push({ name: 'ajaxRequest', value: 'addFeaturedProduct'});

    $.post( BASE_URL, formData,  function( data ) {

	var data = JSON.parse(data);

	if (data.error === 0){

		$('#featured-product-list').append('<li class="list-group-item">' +
                                        '<a href="' + BASE_URL + 'products/'+ data.product_url_name  + data.product_id +'" class="btn btn-link text-primary">'+ 
						data.product_name +
					'</a>'+
                                       	  '<a href="#" class="remove-featured-product float-right btn btn-link text-danger" data-pid="'+ data.product_id +'">'+
					'<i class="fa fa-minus fa-lg"></i></a>'+
			         '</li>');

	}else{

		$('#notice-modal-body').text('');
		$('#notice-modal-body').text(data.message);
		$('#notice-modal').modal('show');
		//alert(data.message);

	}	
        $('#add-featured-product-modal').modal('hide');

    });
  });


  $('#featured-product-list').on('click', '.remove-featured-product', function(e){
        e.preventDefault();
	

	var removeLink = $(this);
	var proId = removeLink.attr('data-pid');

	var data = { ajaxRequest : 'removeFeaturedProduct', pId : proId};
	

	$.post( BASE_URL, data,  function( data ) {

		var data = JSON.parse(data);

		if (data.error === 0){

			removeLink.parent().remove();

		}else{

			$('#notice-modal-body').text('');
			$('#notice-modal-body').text(data.message);
			$('#notice-modal').modal('show');
			//alert(data.message);

		}	
	});
  });

// END OF FEATURED PRODUCTS //////////

// START OF BOOKMARK COMPANY FOR BUYER ////////

// for Made in Belize select
  $('.bookmark-company').click(function (e){
    e.preventDefault();

    var obj = {};
    var icon = $(this);
    var cid = $(this).attr('data-cid'); 	

    obj = {ajaxRequest: 'setCompanyBookmark', cId : cid};

    $.post( BASE_URL, obj,  function( data ) {
		
		var result = JSON.parse(data);

		if (result.error === 1){

			$('#notice-modal-body').text('');
			$('#notice-modal-body').text(result.message);
			$('#notice-modal').modal('show');

		}else{

		    //status can be 1 or 0 
		    //1 -> added
		    //0 -> removed 
		    if (icon.hasClass('far fa-bookmark') && result.status == 1){
			//bookmarking the company
			icon.toggleClass('far fa-bookmark fad fa-bookmark');
			
		    }else{
			//unbookmarking the company
			icon.toggleClass('fad fa-bookmark far fa-bookmark');

		    }

		}

    });

    
  });


// END OF BOOKMARK COMPANY //////////

//START OF BUYER INTEREST////

  //MUSIC
  $('.interested-music').click(function (e){
    e.preventDefault();

    var obj = {};
    var icon = $(this);
    var mid = $(this).attr('data-mid'); 	

    obj = {ajaxRequest: 'setInterestedMusic', mId : mid};

    $.post( BASE_URL, obj,  function( data ) {
		
		var result = JSON.parse(data);

		if (result.error === 1){

			$('#notice-modal-body').text('');
			$('#notice-modal-body').text(result.message);
			$('#notice-modal').modal('show');

		}else{

		    //status can be 1 or 0 
		    //1 -> added
		    //0 -> removed 
		    if (icon.hasClass('far') && result.status == 1){
			//bookmarking the company
			icon.toggleClass('far fas');
			
		    }else{
			//unbookmarking the company
			icon.toggleClass('fas far');

		    }
		}
    });
    
  });
  //SERVICES
  $('.interested-service').click(function (e){
    e.preventDefault();

    var obj = {};
    var icon = $(this);
    var sid = $(this).attr('data-sid'); 	

    obj = {ajaxRequest: 'setInterestedService', sId : sid};

    $.post( BASE_URL, obj,  function( data ) {
		
		var result = JSON.parse(data);

		if (result.error === 1){

			$('#notice-modal-body').text('');
			$('#notice-modal-body').text(result.message);
			$('#notice-modal').modal('show');

		}else{

		    //status can be 1 or 0 
		    //1 -> added
		    //0 -> removed 
		    if (icon.hasClass('far') && result.status == 1){
			//bookmarking the company
			icon.toggleClass('far fas');
			
		    }else{
			//unbookmarking the company
			icon.toggleClass('fas far');

		    }
		}
    });
    
  });
// PRODUCT
  $('.interested-product').click(function (e){
    e.preventDefault();

    var obj = {};
    var icon = $(this);
    var pid = $(this).attr('data-pid'); 	

    obj = {ajaxRequest: 'setInterestedProduct', pId : pid};

    $.post( BASE_URL, obj,  function( data ) {
		
		var result = JSON.parse(data);

		if (result.error === 1){

			$('#notice-modal-body').text('');
			$('#notice-modal-body').text(result.message);
			$('#notice-modal').modal('show');

		}else{

		    //status can be 1 or 0 
		    //1 -> added
		    //0 -> removed 
		    if (icon.hasClass('far') && result.status == 1){
			//bookmarking the company
			icon.toggleClass('far fas');
			
		    }else{
			//unbookmarking the company
			icon.toggleClass('fas far');

		    }
		}
    });
    
  });


//END OF BUYER INTEREST ///

  //account request rejection confirmation
  $('.reject-account').click(function(e){
    e.preventDefault();

    var rejectionLink = $(this).attr('data-link');

    $('#confirmRejection').attr('href', rejectionLink);

    $('#rejectAccounatModal').modal('show');

  });

  //DELETING USERS START

  $('.delete-company').click(function(e){
    e.preventDefault();

    var deleteLink = $(this).attr('data-link');
    var cName = $(this).attr('data-cname');

    $('#deleteDefaultTitle').empty();
    $('#deleteDefaultBody').empty();

    $('#deleteDefaultTitle').append('Delete Company?');
    $('#deleteDefaultBody').append('Are you sure you want to <span class="font-weight-bold text-danger">DELETE</span> <span class="font-weight-bold font-italic">'+cName+'</span> ?');

    $('#deleteDefaultHref').attr('href', deleteLink);

    $('#deleteDefaultModal').modal('show');

  });

  $('.delete-buyer').click(function(e){
    e.preventDefault();

    var deleteLink = $(this).attr('data-link');
    var bName = $(this).attr('data-bname');

    $('#deleteDefaultTitle').empty();
    $('#deleteDefaultBody').empty();

    $('#deleteDefaultTitle').append('Delete Buyer?');
    $('#deleteDefaultBody').append('Are you sure you want to <span class="font-weight-bold text-danger">DELETE</span> <span class="font-weight-bold font-italic">'+bName+'</span> ?');

    $('#deleteDefaultHref').attr('href', deleteLink);

    $('#deleteDefaultModal').modal('show');

  });

  $('.delete-admin').click(function(e){
    e.preventDefault();

    var deleteLink = $(this).attr('data-link');
    var bName = $(this).attr('data-name');

    $('#deleteDefaultTitle').empty();
    $('#deleteDefaultBody').empty();

    $('#deleteDefaultTitle').append('Delete Admin?');
    $('#deleteDefaultBody').append('Are you sure you want to <span class="font-weight-bold text-danger">DELETE</span> <span class="font-weight-bold font-italic">'+bName+'</span> ?');

    $('#deleteDefaultHref').attr('href', deleteLink);

    $('#deleteDefaultModal').modal('show');

  });

  $('.delete-su').click(function(e){
    e.preventDefault();

    var deleteLink = $(this).attr('data-link');
    var bName = $(this).attr('data-name');

    $('#deleteDefaultTitle').empty();
    $('#deleteDefaultBody').empty();

    $('#deleteDefaultTitle').append('Delete Super User?');
    $('#deleteDefaultBody').append('Are you sure you want to <span class="font-weight-bold text-danger">DELETE</span> <span class="font-weight-bold font-italic">'+bName+'</span> ?');

    $('#deleteDefaultHref').attr('href', deleteLink);

    $('#deleteDefaultModal').modal('show');

  });

  //END OF DELETE USERS

  $('.delete-market').click(function(e){
    e.preventDefault();

    var deleteLink = $(this).attr('data-link');
    var emName = $(this).attr('data-emname');

    $('#deleteDefaultTitle').empty();
    $('#deleteDefaultBody').empty();

    $('#deleteDefaultTitle').append('Delete Export Market?');
    $('#deleteDefaultBody').append('Are you sure you want to <span class="font-weight-bold text-danger">DELETE</span> <span class="font-weight-bold font-italic">'+emName+'</span> ?');

    $('#deleteDefaultHref').attr('href', deleteLink);

    $('#deleteDefaultModal').modal('show');

  });


  $('.delete-hs-code').click(function(e){
    e.preventDefault();

    var deleteLink = $(this).attr('data-link');
    var hsName = $(this).attr('data-hsname');

    $('#deleteDefaultTitle').empty();
    $('#deleteDefaultBody').empty();

    $('#deleteDefaultTitle').append('Delete HS Code?');
    $('#deleteDefaultBody').append('Are you sure you want to <span class="font-weight-bold text-danger">DELETE</span> <span class="font-weight-bold font-italic">'+hsName+'</span> ?');

    $('#deleteDefaultHref').attr('href', deleteLink);

    $('#deleteDefaultModal').modal('show');

  });
  //deleting service category
  $('.delete-service-cat').click(function(e){
    e.preventDefault();

    var deleteLink = $(this).attr('data-link');
    var sName = $(this).attr('data-name');

    $('#deleteDefaultTitle').empty();
    $('#deleteDefaultBody').empty();

    $('#deleteDefaultTitle').append('Delete Service Category?');
    $('#deleteDefaultBody').append('Are you sure you want to <span class="font-weight-bold text-danger">DELETE</span> <span class="font-weight-bold font-italic">'+sName+'</span> ?');
    
    $('#deleteDefaultHref').attr('href', deleteLink);

    $('#deleteDefaultModal').modal('show');

  });
  //deleting sub service category
  $('.delete-sub-service-cat').click(function(e){
    e.preventDefault();

    var deleteLink = $(this).attr('data-link');
    var sName = $(this).attr('data-name');

    $('#deleteDefaultTitle').empty();
    $('#deleteDefaultBody').empty();

    $('#deleteDefaultTitle').append('Delete Sub Service Category?');
    $('#deleteDefaultBody').append('Are you sure you want to <span class="font-weight-bold text-danger">DELETE</span> <span class="font-weight-bold font-italic">'+sName+'</span> ?');
    
    $('#deleteDefaultHref').attr('href', deleteLink);

    $('#deleteDefaultModal').modal('show');

  });
  //deleting service
  $('.delete-music').click(function(e){
    e.preventDefault();

    var deleteLink = $(this).attr('data-link');
    var sName = $(this).attr('data-name');

    $('#deleteDefaultTitle').empty();
    $('#deleteDefaultBody').empty();

    $('#deleteDefaultTitle').append('Delete Music?');
    $('#deleteDefaultBody').append('Are you sure you want to <span class="font-weight-bold text-danger">DELETE</span> <span class="font-weight-bold font-italic">'+sName+'</span> ?');
    
    $('#deleteDefaultHref').attr('href', deleteLink);

    $('#deleteDefaultModal').modal('show');

  });
  //deleting service
  $('.delete-service').click(function(e){
    e.preventDefault();

    var deleteLink = $(this).attr('data-link');
    var sName = $(this).attr('data-sname');

    $('#deleteDefaultTitle').empty();
    $('#deleteDefaultBody').empty();

    $('#deleteDefaultTitle').append('Delete Service?');
    $('#deleteDefaultBody').append('Are you sure you want to <span class="font-weight-bold text-danger">DELETE</span> <span class="font-weight-bold font-italic">'+sName+'</span> ?');
    
    $('#deleteDefaultHref').attr('href', deleteLink);

    $('#deleteDefaultModal').modal('show');

  });
  $('.delete-sector').click(function(e){
    e.preventDefault();

    var deleteLink = $(this).attr('data-link');
    var sName = $(this).attr('data-sname');

    $('#deleteDefaultTitle').empty();
    $('#deleteDefaultBody').empty();

    $('#deleteDefaultTitle').append('Delete Sector?');
    $('#deleteDefaultBody').append('Are you sure you want to <span class="font-weight-bold text-danger">DELETE</span> <span class="font-weight-bold font-italic">'+sName+'</span> ?');
    
    $('#deleteDefaultHref').attr('href', deleteLink);

    $('#deleteDefaultModal').modal('show');

  });

  $('.delete-faq').click(function(e){
    e.preventDefault();

    var deleteLink = $(this).attr('data-link');
    var bName = $(this).attr('data-name');

    $('#deleteDefaultTitle').empty();
    $('#deleteDefaultBody').empty();

    $('#deleteDefaultTitle').append('Delete Faq?');
    $('#deleteDefaultBody').append('Are you sure you want to <span class="font-weight-bold text-danger">DELETE</span> <span class="font-weight-bold font-italic">'+bName+'</span> ?');

    $('#deleteDefaultHref').attr('href', deleteLink);

    $('#deleteDefaultModal').modal('show');

  });

  //Removing a product, triggers modal 
  $('.delete-product').click(function(e){
    e.preventDefault();

    var deleteLink = $(this).attr('data-link');
    var pName = $(this).attr('data-pname');

    $('#deleteDefaultTitle').empty();
    $('#deleteDefaultBody').empty();

    $('#deleteDefaultTitle').append('Delete Product?');
    $('#deleteDefaultBody').append('Are you sure you want to <span class="font-weight-bold text-danger">DELETE</span> <span class="font-weight-bold font-italic">'+pName+'</span> ?');
    
    $('#deleteDefaultHref').attr('href', deleteLink);

    $('#deleteDefaultModal').modal('show');

  });

  $('#filter-btn').click(function(e){
    e.preventDefault(); 
    
    $('.filter-option').each(function (i, obj){
	
	if ($(obj).hasClass('d-none')){
		//is not displayed yet
		$(obj).toggleClass('d-none d-block');
		$('#filter-btn i').toggleClass('fa-caret-down fa-caret-up');

	}else{
		//is being displayed
		$(obj).toggleClass('d-block d-none');
		$('#filter-btn i').toggleClass('fa-caret-up fa-caret-down');

	}

    });
	
  });
  
});
