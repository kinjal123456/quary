$(document).ready(function() {
	$( "#date_of_first_appnt, #vocational_date" ).datepicker();
	
	$("#registerform").validate({
        debug: false,onsubmit: true,onfocusout: false,onkeyup: false,
        rules: {
        	si_no: {
                required: true
            }
        },
        messages: {
        	si_no: {
            	required: "Please enter SI Number."
            }
        },
        showErrors: validationError,
        submitHandler: validationSuccess
    });
});

function validationError(errorMap, errorList){
	scrollwindowTop();
	if(errorList.length==0) return;
	var msgs=[];
	for(var err=0;err<errorList.length;err++) {
	    msgs.push({ message: errorList[err].message });
    }
	$("#notify").notification({caption: "One or more invalid inputs found.", messages: msgs, sticky:true});
}

function validationSuccess(){
	 showLoader();
	 $("#submitbtn").attr("disabled","disabled");
	 $('#registerform').ajaxSubmit({
	  	success:formResponse,
	  	dataType: "json"
	 });
}

function formRequest(formData, jqForm, options) {}

function formResponse(responseText, statusText) {
    hideLoader();
    $("#submitbtn").removeAttr("disabled");
	scrollwindowTop();
	
	if(statusText == 'success') {
		if(responseText.registerstaus == 'success') {
			$("#submitbtn").attr("disabled","disabled");
			$("#notify").notification({caption: "Information updated successfully.", type:"information", onhide:function(){
				window.location="customer-register-form-a-2.php?custid="+responseText.customerid;
			}});
		}else {
			$("#notify").notification({caption: "Unable to save information.", type:"warning", sticky:true});
		}
	}
	else {
		$("#notify").notification({caption: "Unable to communicate with server.", type:"warning", sticky:true});
    }
}