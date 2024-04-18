function validation(form_name,button,wait,a,recaptchaResponse)
{
	var form_name = form_name;
	// @ts-ignore
	var btn_name = button;
	// @ts-ignore
	var w_name = wait;
	//$('#'+btn_name).hide();
    //$('#wait_'+w_name).show();
	var $formId = a.parents('form');
	// @ts-ignore
	var formAction = $formId.attr('action');
	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    var phoneReg = /^\(?(\d{3})\)?[- ]?(\d{3})[- ]?(\d{4})$/;
    // @ts-ignore
    var filter = /^(([\w]+:)?\/\/)?(([\d\w]|%[a-fA-f\d]{2,2})+(:([\d\w]|%[a-fA-f\d]{2,2})+)?@)?([\d\w][-\d\w]{0,253}[\d\w]\.)+[\w]{2,4}(:[\d]+)?(\/([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)*(\?(&?([-+_~.\d\w]|%[a-fA-f\d]{2,2})=?)*)?(#([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)?$/;
    // @ts-ignore
    var urlReg = /^(([\w]+:)?\/\/)?(([\d\w]|%[a-fA-f\d]{2,2})+(:([\d\w]|%[a-fA-f\d]{2,2})+)?@)?([\d\w][-\d\w]{0,253}[\d\w]\.)+[\w]{2,4}(:[\d]+)?(\/([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)*(\?(&?([-+_~.\d\w]|%[a-fA-f\d]{2,2})=?)*)?(#([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)?$/;
    var $error = $('<span class="error"></span>');
    $('span.error').remove();
    $('.input-holder').removeClass('error');
    $('.required',$formId).each(function(){
          //alert("hi1");
      	// @ts-ignore
      	var inputVal = $.trim($(this).val());
      	var fieldtitle = $(this).attr("title");
      	// @ts-ignore
      	var fieldname = $(this).attr("name");
      	var $parentTag = $(this).parent();
      	//console.log("value : "+);
      	if(inputVal == '' || inputVal=='-1'){
          if($(this).hasClass('sel') == true) {
            $($parentTag).addClass('error').append($error.clone().text(fieldtitle + '.'));
            $(this).focus();          
            return false;
          }
          else if($(this).hasClass('datetime') == true) {
            $($parentTag).addClass('error').append($error.clone().text('Please Select Your Preferred Date/Time.'));
            $(this).focus();          
            return false;
          }
          else{
            $parentTag.addClass('error').append($error.clone().text('Please Enter Your '+fieldtitle+'.'));
          	$(this).focus();
            return false;
          }
        }
      	if($(this).hasClass('email') == true){
        	if(!emailReg.test(inputVal)){
         		$parentTag.addClass('error').append($error.clone().text('Sorry, You Have Entered an Invalid Email Address.'));
          		$(this).focus();
          		//$('#'+btn_name).show();
            	//$('#wait_'+w_name).hide();
	          	return false;
	        }
	    } 
      	if($(this).hasClass('tel') == true){
        	if(!phoneReg.test(inputVal)){
          		$parentTag.addClass('error').append($error.clone().text('Phone Number Seems Invalid.'));
          		$(this).focus();
          		//$('#'+btn_name).show();
            	//$('#wait_'+w_name).hide();
          		return false;
        	}
      	}
    });
    // All validation complete - Check if any errors exist
    // If has errors
    if ($('span.error').length > 0) {
      $('span.error').each(function(){
        // Set the distance for the error animation
        var distance = 5;
        // Get the error dimensions
        var width = $(this).outerWidth(); 
        // Calculate starting position
        // @ts-ignore
        var start = width + distance;
        // Set the initial CSS
        $(this).show().css({
          display: 'block',
          opacity: 0
        })
        // Animate the error message
        .animate({
          opacity: 1
        }, 'slow');   
      });
    }else {
       // @ts-ignore
       grecaptcha.ready(function () {
            // @ts-ignore
            grecaptcha.execute('6LcNhDQlAAAAAI_FCcN3lIGLmAzvS65NzwLpUMwB', { action: 'contact' }).then(function (token) {
            // @ts-ignore
            document.getElementById(recaptchaResponse).value = token;
            $formId.submit();
            $('#'+button).attr('disabled','disabled');
        });
        });
            //document.form_name.submit();
      // validateCaptchahome5('v-1/verify_captcha_home_form5.php');
    }
	//console.log("action : "+formAction);
}


function validateform(form_name,button,wait,a)
{
	var form_name = form_name;
	// @ts-ignore
	var btn_name = button;
	// @ts-ignore
	var w_name = wait;
	//$('#'+btn_name).hide();
    //$('#wait_'+w_name).show();
	var $formId = a.parents('form');
	// @ts-ignore
	var formAction = $formId.attr('action');
	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    var phoneReg = /^\(?(\d{3})\)?[- ]?(\d{3})[- ]?(\d{4})$/;
    // @ts-ignore
    var filter = /^(([\w]+:)?\/\/)?(([\d\w]|%[a-fA-f\d]{2,2})+(:([\d\w]|%[a-fA-f\d]{2,2})+)?@)?([\d\w][-\d\w]{0,253}[\d\w]\.)+[\w]{2,4}(:[\d]+)?(\/([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)*(\?(&?([-+_~.\d\w]|%[a-fA-f\d]{2,2})=?)*)?(#([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)?$/;
    // @ts-ignore
    var urlReg = /^(([\w]+:)?\/\/)?(([\d\w]|%[a-fA-f\d]{2,2})+(:([\d\w]|%[a-fA-f\d]{2,2})+)?@)?([\d\w][-\d\w]{0,253}[\d\w]\.)+[\w]{2,4}(:[\d]+)?(\/([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)*(\?(&?([-+_~.\d\w]|%[a-fA-f\d]{2,2})=?)*)?(#([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)?$/;
    var $error = $('<span class="error"></span>');
    $('span.error').remove();
    $('.input-holder').removeClass('error');
    $('.required',$formId).each(function(){
          //alert("hi1");
      	// @ts-ignore
      	var inputVal = $.trim($(this).val());
      	var fieldtitle = $(this).attr("title");
      	// @ts-ignore
      	var fieldname = $(this).attr("name");
      	var $parentTag = $(this).parent();
      	//console.log("value : "+);
      	if(inputVal == '' || inputVal=='-1'){
          if($(this).hasClass('sel') == true) {
            $($parentTag).addClass('error').append($error.clone().text(fieldtitle + '.'));
            $(this).focus();          
            return false;
          }
          else if($(this).hasClass('datetime') == true) {
            $($parentTag).addClass('error').append($error.clone().text('Please Select Your Preferred Date/Time.'));
            $(this).focus();          
            return false;
          }
          else{
            $parentTag.addClass('error').append($error.clone().text('Please Enter Your '+fieldtitle+'.'));
          	$(this).focus();
            return false;
          }
        }
      	if($(this).hasClass('email') == true){
        	if(!emailReg.test(inputVal)){
         		$parentTag.addClass('error').append($error.clone().text('Sorry, You Have Entered an Invalid Email Address.'));
          		$(this).focus();
          		//$('#'+btn_name).show();
            	//$('#wait_'+w_name).hide();
	          	return false;
	        }
	    } 
      	if($(this).hasClass('tel') == true){
        	if(!phoneReg.test(inputVal)){
          		$parentTag.addClass('error').append($error.clone().text('Phone Number Seems Invalid.'));
          		$(this).focus();
          		//$('#'+btn_name).show();
            	//$('#wait_'+w_name).hide();
          		return false;
        	}
      	}
    });
    // All validation complete - Check if any errors exist
    // If has errors
    if ($('span.error').length > 0) {
      $('span.error').each(function(){
        // Set the distance for the error animation
        var distance = 5;
        // Get the error dimensions
        var width = $(this).outerWidth(); 
        // Calculate starting position
        // @ts-ignore
        var start = width + distance;
        // Set the initial CSS
        $(this).show().css({
          display: 'block',
          opacity: 0
        })
        // Animate the error message
        .animate({
          opacity: 1
        }, 'slow');   
      });
    }
    /*else {
            $formId.submit();
            $('#'+button).attr('disabled','disabled');
    }*/
	//console.log("action : "+formAction);
}