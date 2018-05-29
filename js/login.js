$(document).ready(function() {
	$("#loginForm").validate({
        debug: false,
        onsubmit: true,
        onfocusout: false,
        onkeyup: false,
        rules: {
            username: {
                required: true
            },
            password: {
                required: true
            }
        },
        messages: {
            username: {
                required: "Please enter username."
            },
            password: {
                required: "Please enter password."
            }
        },
        showErrors: validationLoginError,
        submitHandler: validationLoginSuccess
    });
});

function validationLoginError(errorMap, errorList){
	if(errorList.length==0) return;
	var msgs=[];
	for(var err=0;err<errorList.length;err++) {
	    msgs.push({ message: errorList[err].message });
    }
	$("#notify").notification({caption: "One or more invalid inputs found.", messages: msgs, sticky:true});
}

function validationLoginSuccess(){
	 showLoader();
	 $("#submitbtn").attr("disabled","disabled");
	 $('#loginForm').ajaxSubmit({
	  	success:loginformResponse,
	  	dataType: "json"
	 });
}

function formRequest(formData, jqForm, options) {}

function loginformResponse(responseText, statusText) {
    hideLoader();
    $("#submitbtn").removeAttr("disabled");
	if(statusText == 'success') {
		if(responseText.type == 'success') {
			$("#submitbtn").attr("disabled","disabled");
			$("#notify").notification({caption: "Login successfully.", type:"information", onhide:function(){
				window.location="zones.php";
			}});
		}else {
			$("#notify").notification({caption: "Invalid username or password.", type:"warning", sticky:true});
		}
	}
	else {
		$("#notify").notification({caption: "Unable to communicate with server.", type:"warning", sticky:true});
    }
}