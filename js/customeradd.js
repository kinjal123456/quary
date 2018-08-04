$(document).ready(function() {
	$("#customerform").validate({
        debug: false,
        onsubmit: true,
        onfocusout: false,
        onkeyup: false,
        rules: {
            zoneid: {
                required: true
            },
			fname: {
                required: true
            },
			lname: {
                required: true
            },
			custemail: {
                required: true
            },
			phone: {
                required: true
            },
			licenceno: {
                required: true
            }
        },
        messages: {
            zoneid: {
                required: "Please select zone."
            },
			fname: {
                required: "Please enter firstname."
            },
			lname: {
                required: "Please enter lastname."
            },
			custemail: {
                required: "Please enter email."
            },
			phone: {
                required: "Please enter phone number."
            },
			licenceno: {
                required: "Please enter licence number."
            }
        },
        showErrors: validationError,
        submitHandler: validationSuccess
    });
});

function validationError(errorMap, errorList){
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
	 $('#customerform').ajaxSubmit({
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
		if(responseText.type == 'success') {
			$("#submitbtn").attr("disabled","disabled");
			$("#notify").notification({caption: "Customer added successfully.", type:"information", onhide:function(){
				window.location="customers.php";
			}});
		}else if(responseText.type == 'custexists'){
			$("#notify").notification({caption: "Customer email is already exists in the system.", type:"warning", sticky:true});
		}else {
			$("#notify").notification({caption: "Unable to save information.", type:"warning", sticky:true});
		}
	}
	else {
		$("#notify").notification({caption: "Unable to communicate with server.", type:"warning", sticky:true});
    }
}