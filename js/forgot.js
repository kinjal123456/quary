$(document).ready(function() {
	$("#forgotform").validate({
        debug: false,
        onsubmit: true,
        onfocusout: false,
        onkeyup: false,
        rules: {
            forgotemail: {
                required: true,
                email: true
            }
        },
        messages: {
            forgotemail: {
                required: "Please enter email address.",
                email: "Please enter a valid email address."
            }
        },
        showErrors: validationForgotError,
        submitHandler: validationForgotSuccess
    });
});

function validationForgotError(errorMap, errorList){
	if(errorList.length==0) return;
	var msgs=[];
	for(var err=0;err<errorList.length;err++) {
	    msgs.push({ message: errorList[err].message });
    }
	$("#forgetnotify").notification({caption: "One or more invalid inputs found.", type:"warning", sticky:false});
    $("#username").focus();
}

function validationForgotSuccess(){
	 showLoader();
	 $("#forgotbtn").attr("disabled","disabled");
	 $('#forgotform').ajaxSubmit({
	  	success:forgotformResponse,
	  	dataType: "json"
	 });
}

function formRequest(formData, jqForm, options) {}

function forgotformResponse(responseText, statusText) {
    hideLoader();
    $("#forgotbtn").removeAttr("disabled");
	if(statusText == 'success') {
		if(responseText.type == 'success') {
			$("#forgotbtn").attr("disabled","disabled");
			$("#forgetnotify").notification({caption: "Email sent successfully.", type:"information", onhide:function(){
				window.location="index.php";
			}});
		}
        else if(responseText.type == 'notexist'){
            $("#forgetnotify").notification({caption: "Email address does not exist.", type:"warning", sticky:false});
        }
        else {
			$("#forgetnotify").notification({caption: "Unable to send an email.", type:"warning", sticky:false});
		}
	}
	else{
		$("#forgetnotify").notification({caption: "Unable to communicate with server.", type:"warning", sticky:false});
    }
}