/* Gateway Custom JavaScript */

jQuery(document).ready(function($){
	
	/* Remove is active class for notification */
	var path = location.pathname;
	
	
	if (path=="/"){			
		$("#block-sitebranding div.brand a img").hide();
	}
	if( path== "/" || path== "/my-events" ||path== "/documents" ) { 
	  setTimeout(function(){
		$("#main-menu li a#notification").removeClass("is-active");
	/* Remove hypenlink for the username */
		$("#main-menu li a.user-name").removeClass("is-active");
		$("#main-menu li:nth-child(6)").removeClass("active");
	  },500);
	}
		
	/* Set status message inly for form */
		if ((window.location.href.indexOf("form") > -1)||(window.location.href.indexOf("modal") > -1)) {
			$('.region-content .messages--status').css('display','none');
			}
		if (window.location.href.indexOf('documents?') > -1){
				$("#main-menu li #documents-nav").addClass("is-active");
			}
			else if (window.location.href.indexOf('my-notification') > -1){
				$("#main-menu li a#notification").addClass("is-active");
			}
		else{
				$("#main-menu li a#documents-nav").removeClass("is-active");
				$("#main-menu li a#my-events-nav").removeClass("is-active");
				$("#main-menu li a#notification").removeClass("is-active");
			}
			
	/* Hide Acknowledgment section for HR */
		/* if ((window.location.href.indexOf("modal/registration/") > -1)&& (window.location.href.indexOf("submissions") > -1)){
			$("#edit-documents-text-document-comcast-code-of-conduct, #edit-documents-entity-document-comcast-code-of-conduct--wrapper, #edit-documents-text-document-nbcuniversal-solutions, #edit-documents-entity-document-nbcuniversal-solutions--wrapper").css("display","none");
		} */

		//Main menu
		$('#main-menu').smartmenus();
		
		//Mobile menu toggle
		$('.navbar-toggle').click(function(){
		if ($('.region-primary-menu').css('display') == 'none') {
		  var sidebar_height = $("body").height() - 60;
		  $(".sports-events-wrapper .main-header .menu-base-theme").css('min-height', sidebar_height);
		}
			$('.region-primary-menu').toggle();
		if ($('.region-primary-menu').css('display') == 'none') {
		  $(".icon-close").css('display', 'none');
		  $(".icon-bar").css('display', 'block');
		  /*$(".navbar-default .navbar-toggle").css('padding-top', '6px');*/
		}
    else {
      $(".icon-close").css('display', 'block');
      $(".icon-bar").css('display', 'none');
      /*$(".navbar-default .navbar-toggle").css('padding-top', '0px');      */
    }
	});

	//Mobile dropdown menu
	if ( $(window).width() < 770) {
		$(".region-primary-menu li a:not(.has-submenu)").click(function () {
			$('.region-primary-menu').hide();
	    });
	}
	/* $('.country').off();  */// remove all event listeners for this element
	$('.postal-code').off();// remove all event listeners for this element
  $(".postal-code").prop("type", "number");
  $(".postal-code").keydown(function(e){
    var val = $(this).val();
    return AllowNumbersOnly(e, val);
  });
	jQuery('.country').on('change',function(){
		 setTimeout(function(){
			jQuery('.address-line1').val('');
			jQuery('.address-line2').val('');
			jQuery('.locality').val('');		
			jQuery('.administrative-area').val('');
			jQuery('.postal-code').val('');
			jQuery('.address-line1').removeClass('error');
			jQuery('.address-line2').removeClass('error');
			jQuery('.administrative-area').removeClass('error');
			jQuery('.locality').removeClass('error');
			jQuery('.postal-code').removeClass('error');
		 },1000);
	})
//save draft same accodion open functionality
	  $('.webform-button--draft').on('click', function(e) { 
        var drft_id = $(this).attr("id");
		 window.sessionStorage.setItem("acod_save_dft_id", drft_id);

      }); 
	   var draft_num = sessionStorage.getItem("acod_save_dft_id");
	    if(draft_num!=null){
		 setTimeout(function(){
			 $('.webform-container').eq(0).find('.panel-collapse').collapse('hide');
			 $('#'+draft_num).closest('.panel-collapse').collapse('show');		 
			},500);
	        window.sessionStorage.removeItem("acod_save_dft_id");		
			$('.messages--status').css('display', 'block');
	    }
//Web-form Submit button functionality
  
	  $('.webform-button--submit').on('click', function(e) { 
	     var submit_id = $(this).attr("id");
		 window.sessionStorage.setItem("acod_sub_id", submit_id);
		 // Disable things that we don't want to validate.
			$("input").prop('required',false);
			$("select").prop('required',false);
	  });	
	  var acco_submit = sessionStorage.getItem("acod_sub_id");
	    if(acco_submit!=null){	
			setTimeout(function(){
			 $('.webform-container').eq(0).find('.panel-collapse').collapse('hide');
			 $('.has-error').closest('.panel-collapse').collapse('show');		 	 
			},500);				
		  window.sessionStorage.removeItem("acod_sub_id"); 
		  //$('.messages--error').css('display', 'block'); // Do not change the behavior of show/hide error messages, because it is effecting functionality site-wide.
			// Re-enable things that we previously disabled.
			$("input").prop('required',true);
			$("select").prop('required',true);
		}else{
			//$('.messages--error').css('display', 'none'); // Do not change the behavior of show/hide error messages, because it is effecting functionality site-wide.
			$("input").removeClass('error');
			$("select").removeClass('error');
			$("input").prop('required',true);
			$("select").prop('required',true);
		}
		$('#edit-documents-decline-document-form-w-4').click(function() {
			 if ($(this).is(':checked')) {
				 $('input#edit-documents-upload-document-form-w-4-upload').attr('disabled',true);
				 $('.custom-file-upload2').css({'background-color' : 'rgb(215,214,214)', 'cursor' : 'auto'});
				 $('input#edit-documents-upload-document-form-w-4-upload').prop('required',false);
			 }else{
			   $('input#edit-documents-upload-document-form-w-4-upload').attr('disabled',false);
			   $('.custom-file-upload2').css({'background-color' : '#9B9B9B', 'cursor' : 'pointer' });
			 } 

		});
		$('#edit-documents-decline-document-direct-deposit-form').click(function() {
			 if ($(this).is(':checked')) {
				$('input#edit-documents-upload-document-direct-deposit-form-upload').attr('disabled',true);
				$('.custom-file-upload3').css({'background-color' : 'rgb(215,214,214)', 'cursor' : 'auto'});
				$('input#edit-documents-upload-document-direct-deposit-form-upload').prop('required',false);
			 }else{
			   $('input#edit-documents-upload-document-direct-deposit-form-upload').attr('disabled',false);
			   $('.custom-file-upload3').css({'background-color' : '#9B9B9B', 'cursor' : 'pointer' });
			 } 

		});	
	
	  	//open link in new tab
	      $('.event-register-page a').attr("target","_blank");	
		   
        //Check the decline checkbox when page reload		
		 if($('#edit-documents-decline-document-form-w-4').is(':checked')){
		    $('input#edit-documents-upload-document-form-w-4-upload').attr('disabled',true);
			setTimeout(function(){
			$('.custom-file-upload2').css({'background-color' : '#D7D6D6', 'cursor' : 'auto'});
			},500);
		   }
		   
	      if($('#edit-documents-decline-document-direct-deposit-form').is(':checked')){
			  $('input#edit-documents-upload-document-direct-deposit-form-upload').attr('disabled',true);
			   setTimeout(function(){
			  $('.custom-file-upload3').css({'background-color' : '#D7D6D6', 'cursor' : 'auto'});
			  },500);
		  } 
		  
  
		//wrapping the upload buttons in Document Section
		
		$("input[data-drupal-selector='edit-documents-upload-document-form-i-9-upload']" ).wrap( "<label class='custom-file-upload1'>Upload FORM I-9 <img src='"+drupalSettings.base_url+"/themes/custom/gateway_theme/images/upload_icon2x.png' width='18' height='18'></label>" ); 
		
        $("input[data-drupal-selector='edit-documents-upload-document-form-w-4-upload']" ).wrap( "<label class='custom-file-upload2'>Upload FORM W-4 <img src='"+drupalSettings.base_url+"/themes/custom/gateway_theme/images/upload_icon2x.png' width='18' height='18'></label>" );
		
		 $("#edit-documents-entity-document-direct-deposit-form--wrapper").closest('div').find('input[name="files[documents_upload_document_direct_deposit_form][]"]').wrap("<label class='custom-file-upload3'>Upload DIRECT DEPOSIT FORM <img src='"+drupalSettings.base_url+"/themes/custom/gateway_theme/images/upload_icon2x.png' width='18' height='18'></label>"); 
      
      $( "input[data-drupal-selector='edit-documents-upload-i-9-section-2-upload']" ).wrap( "<label class='custom-file-upload4'>Upload Form I-9 Section 2 <img src='"+drupalSettings.base_url+"/themes/custom/gateway_theme/images/upload_icon2x.png' width='25' height='25'></label>" );
      $( "input[data-drupal-selector='edit-documents-upload-list-a-document-upload']" ).wrap( "<label class='custom-file-upload4'>Upload List A Document <img src='"+drupalSettings.base_url+"/themes/custom/gateway_theme/images/upload_icon2x.png' width='25' height='25'></label>" );
      $( "input[data-drupal-selector='edit-documents-upload-list-b-document-upload']" ).wrap( "<label class='custom-file-upload4'>Upload List B Document <img src='"+drupalSettings.base_url+"/themes/custom/gateway_theme/images/upload_icon2x.png' width='25' height='25'></label>" );
      $( "input[data-drupal-selector='edit-documents-upload-list-c-document-upload']" ).wrap( "<label class='custom-file-upload4'>Upload List C Document <img src='"+drupalSettings.base_url+"/themes/custom/gateway_theme/images/upload_icon2x.png' width='25' height='25'></label>" );
	//Disable the decline checkbox after upload image in W-4 upload	
		 var number_file = jQuery('[data-drupal-selector="edit-documents-upload-document-form-w-4-fids"]').val();
			if(number_file != '') {
			  jQuery('#edit-documents-decline-document-form-w-4').attr("disabled", true);
			}else{
			  jQuery('#edit-documents-decline-document-form-w-4').attr("disabled", false);
			}
		
	 //Disable the decline checkbox after upload image in Direct Document upload	
		var number_file = jQuery('[data-drupal-selector=edit-documents-upload-document-direct-deposit-form-fids]').val();
			if(number_file != undefined){
             strVal = number_file.replace(/ /g,',');
			 var total = (strVal.match(/,/g) || []).length;
			}
			if(total >= 1) {
			  jQuery("#edit-documents-entity-document-direct-deposit-form--wrapper").closest('div').find('input[type="file"]').attr('disabled',true);
			}
			if(number_file != '') {
			  jQuery('#edit-documents-decline-document-direct-deposit-form').attr("disabled", true);
			}else{
			  jQuery('#edit-documents-decline-document-direct-deposit-form').attr("disabled", false);
			}
      
      
      //Upload headshot
      $("input[data-drupal-selector='edit-accreditation-headshot-upload']" ).wrap( "<label class='custom-file-upload-headshot'> <img src='"+drupalSettings.base_url+"/themes/custom/gateway_theme/images/headshot.png'></label>" ); 
       
     //Before load page check saved data
		var unsaved = false;
		$(".webform-submission-form :input").change(function(){ //trigers change in all input fields including text type
             unsaved = true;
		  $('.webform-button--draft').on('click', function(e) { 
			 unsaved = false;
		  }); 
          $('.webform-button--submit').on('click', function(e) { 
			 unsaved = false;
		  }); 		  
		});
		function unloadPage(){ 
			if(unsaved){
				return "You have unsaved changes on this page. Do you want to leave this page and discard your changes or stay on this page?";
			}
		}
		window.onbeforeunload = unloadPage;
		setTimeout(function(){
			$("#main-menu .user-name ").parent('li').removeClass('active');
			$("#main-menu .user-name ").removeClass('is-active');
		 },100);
});
function AllowNumbersOnly(e, val) {
  var code = (e.which) ? e.which : e.keyCode;
  if (code > 31 && (code < 48 || code > 57) && (code < 96 || code > 105)) {
    e.preventDefault();
  }
  if(val.length >= 20 && code != 8 && code != 46) {
    e.preventDefault();
  }
}

jQuery(document).ajaxComplete(function() {
  jQuery('.postal-code').off();
  jQuery(".postal-code").prop("type", "number");
  jQuery(".postal-code").keydown(function(e) {
    var val = jQuery(this).val();
    return AllowNumbersOnly(e, val);
  });
  //
  if( jQuery("input[data-drupal-selector='edit-documents-upload-i-9-section-2-upload']").length &&
  !jQuery("input[data-drupal-selector='edit-documents-upload-i-9-section-2-upload']").parent().parent().hasClass('custom-file-upload4')){
    jQuery("input[data-drupal-selector='edit-documents-upload-i-9-section-2-upload']").wrap( "<label class='custom-file-upload4'>Upload Form I-9 Section 2 <img src='"+drupalSettings.base_url+"/themes/custom/gateway_theme/images/upload_icon2x.png' width='25' height='25'></label>" );
  }
  if( jQuery("input[data-drupal-selector='edit-documents-upload-list-a-document-upload']").length &&
  !jQuery("input[data-drupal-selector='edit-documents-upload-list-a-document-upload']").parent().parent().hasClass('custom-file-upload4')){
    jQuery("input[data-drupal-selector='edit-documents-upload-list-a-document-upload']").wrap( "<label class='custom-file-upload4'>Upload List A Document <img src='"+drupalSettings.base_url+"/themes/custom/gateway_theme/images/upload_icon2x.png' width='25' height='25'></label>" );
  }
  if( jQuery("input[data-drupal-selector='edit-documents-upload-list-b-document-upload']").length &&
  !jQuery("input[data-drupal-selector='edit-documents-upload-list-b-document-upload']").parent().parent().hasClass('custom-file-upload4')){
    jQuery("input[data-drupal-selector='edit-documents-upload-list-b-document-upload']").wrap( "<label class='custom-file-upload4'>Upload List B Document <img src='"+drupalSettings.base_url+"/themes/custom/gateway_theme/images/upload_icon2x.png' width='25' height='25'></label>" );
  }
  if( jQuery("input[data-drupal-selector='edit-documents-upload-list-c-document-upload']").length &&
  !jQuery("input[data-drupal-selector='edit-documents-upload-list-c-document-upload']").parent().parent().hasClass('custom-file-upload4')){
    jQuery("input[data-drupal-selector='edit-documents-upload-list-c-document-upload']").wrap( "<label class='custom-file-upload4'>Upload List C Document <img src='"+drupalSettings.base_url+"/themes/custom/gateway_theme/images/upload_icon2x.png' width='25' height='25'></label>" );
  }
	//Disable the decline checkbox after upload image in W-4 upload.
		var number_file = jQuery('[data-drupal-selector="edit-documents-upload-document-form-w-4-fids"]').val();
			if(number_file != '') {
			  jQuery('#edit-documents-decline-document-form-w-4').attr("disabled", true);
			}else{
			  jQuery('#edit-documents-decline-document-form-w-4').attr("disabled", false);
			}
		
	 //Disable the decline checkbox after upload image in Direct Document upload.
		var number_file = jQuery('[data-drupal-selector=edit-documents-upload-document-direct-deposit-form-fids]').val();
		 if(number_file != undefined){
			strVal = number_file.replace(/ /g,',');
			var total = (strVal.match(/,/g) || []).length;
		 }
			if(total >= 1) {
			  jQuery("#edit-documents-entity-document-direct-deposit-form--wrapper").closest('div').find('input[type="file"]').attr('disabled',true);
			}	
			if(number_file != '') {
				jQuery('#edit-documents-decline-document-direct-deposit-form').attr("disabled", true);
			 }else{
				jQuery('#edit-documents-decline-document-direct-deposit-form').attr("disabled", false);
			}
		    if(total >= 2) {
               jQuery('.form-item--error-message').text('Exceeded max of 2 documents.');
            }
	
	
	//I-9 Upload button
		if(jQuery("[data-drupal-selector=edit-documents-upload-document-form-i-9-upload-button]").parent().parent().hasClass('custom-file-upload1')){
			
		}else{
			jQuery( "input[data-drupal-selector='edit-documents-upload-document-form-i-9-upload']" ).wrap( "<label class='custom-file-upload1'>Upload FORM I-9 <img src='"+drupalSettings.base_url+"/themes/custom/gateway_theme/images/upload_icon2x.png' width='25' height='25'></label>" );
		}
	//W-4 Upload button
		if(jQuery("[data-drupal-selector=edit-documents-upload-document-form-w-4-upload]").parent().parent().hasClass('custom-file-upload2')){
			
		}else{
			jQuery( "input[data-drupal-selector='edit-documents-upload-document-form-w-4-upload']" ).wrap( "<label class='custom-file-upload2'>Upload W-4 <img src='"+drupalSettings.base_url+"/themes/custom/gateway_theme/images/upload_icon2x.png' width='25' height='25'></label>" );
		}	
	//Direct Deposit Upload button
	if(jQuery("[id^=edit-documents-upload-document-direct-deposit-form-upload]").parent().parent().hasClass('custom-file-upload3')){
			
		}else{
			jQuery("#edit-documents-entity-document-direct-deposit-form--wrapper").closest('div').find('input[type="file"]').wrap("<label class='custom-file-upload3'>Upload DIRECT DEPOSIT FORM <img src='"+drupalSettings.base_url+"/themes/custom/gateway_theme/images/upload_icon2x.png' width='25' height='25'></label>");
		}
});
