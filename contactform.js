var msg_to_sent = "";

function emailValidation(form_id, email) {
    jQuery(form_id + ' .has-error').hide();
    var emailExp = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    var email_value = email.val();
    if (email_value.match(emailExp)) {
        msg_to_sent += "Email :" + email_value + "\n";
        return true;
    } else {
        email.after('<div class="alert alert-danger has-error">Please Enter Valid Email address</div>');
        return false;
    }
}

function numberValidation(form_id, ph_number) {
    jQuery(form_id + ' .has-error').hide();
    var numbexp = /^[0-9]*$/;
    var pn_value = ph_number.val();
    var f_parent = ph_number.parent().parent().children('label').text();
    if (pn_value.match(numbexp)) {
        msg_to_sent +=  f_parent + " : " + pn_value + "\n";
        return true;
    } else {
        ph_number.after('<div class="alert alert-danger has-error">Please Enter Valid Number</div>');
        return false;
    }
}

function urlValidation(form_id, Web_url) {
    jQuery(form_id + ' .has-error').hide();
    var urlexp = /^(?:(ftp|http|https):\/\/)?(?:[\w-]+\.)+[a-z]{3,6}$/;
    var web_url_value = Web_url.val();
    var f_parent = Web_url.parent().parent().children('label').text();
    if (web_url_value.match(urlexp)) {
        msg_to_sent +=  f_parent + " : " + web_url_value + "\n";
        return true;
    } else {
        Web_url.after('<div class="alert alert-danger has-error">Please Enter Valid URL</div>');
        return false;
    }
}

function noValidation(form_id, form_value) {
	var f_value = form_value.val();
	var f_parent = form_value.parent().parent().children('label').text();
	 msg_to_sent +=  f_parent + " : " + f_value + "\n";
     return true;
}

function validate(form_id) {
    var notempty = /.+/;
    var result = true;
    jQuery(form_id + " .req_field").html('');
    jQuery(form_id + " input[type=text]").each(function () {
        var valid_input = true;
        var req = jQuery(this).hasClass('required');
        var input_value = jQuery(this).val();
        var inputt = jQuery(this).data('vali');
        if (req) {
            if (input_value.match(notempty)) {
                if (inputt !== 'undefined' || inputt !== "") {
                    if (inputt === 'email') {
                        valid_input = (valid_input && emailValidation(form_id, jQuery(this)));
                    }
                    else if (inputt === 'url') {
                        valid_input = (valid_input && urlValidation(form_id, jQuery(this)));
                    }
                    else if (inputt === 'numeric') {
                        valid_input = (valid_input && numberValidation(form_id, jQuery(this)));
                    }
					else if (inputt === 'novalidation') {
                        valid_input = (valid_input && noValidation(form_id, jQuery(this)));
                    }
                }
                result = valid_input;
                return valid_input;
            }
            else {
                jQuery(form_id + " .req_field").html('<div class="alert alert-danger">Please enter the required field </div>');
                result = false;
                return false;
            }
        }
    });
    return result;
}

jQuery(document).ready(function () {

	$(this).find("input#attach_file").change(function () {
		var value = $(this).val().replace( /C:\\fakepath\\/i, "" );
		var parentdiv = jQuery(this).parent().closest(".contactformdiv");
		var inputspan = jQuery(parentdiv).find("span#upload-file");
		jQuery(inputspan).html(value);
			});

    

});

function uploadfile(form_id,allwdsize,allowedExts)
{
		var fileinfo = $(form_id).find('input#attach_file')[0].files[0];
		var filesize = fileinfo.size/(1024*1024);
		var filename = fileinfo.name;
		var type =   filename.substring(filename.indexOf("."));
		var errmsg = "";
		var resultArray = sizeerr = errflag = false;
		if(allowedExts){
		var resultArray = allowedExts.split(',').map(function(allowedExts){return String(allowedExts);});
		}


	   if(allwdsize && filesize > allwdsize)
	   {
	   var sizeerr = errflag = true;
	   errmsg += "Please upload valid file (filesize must be less than " + allwdsize + "Mb";
	   }

	   var res = $.inArray(type,resultArray);
	   if((resultArray) && (res == -1))
	   {
		if(sizeerr)
		{
			errmsg += " and file type must be one of " + allowedExts + ")";
		}
		else
		{
			errmsg += "Please upload valid file(file type must be one of " + allowedExts + ")";
		}
		errflag = true;
	   }else{
	   		errmsg += ")";
	   		}


	   if(errflag)
	   {
	   	alert(errmsg);
	   	return false;
	   }
	   else
	   {
		   return true;
	   }
}
