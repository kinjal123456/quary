$(document).ready(function() {
	$("#employeeform").validate({
        debug: false,
        onsubmit: true,
        onfocusout: false,
        onkeyup: false,
        rules: {
            empname: {
                required: true
            },
			empdesignation: {
                required: true
            },
			empmob: {
                required: true
            }
        },
        messages: {
            empname: {
                required: "Please enter name."
            },
			empdesignation: {
                required: "Please enter designation."
            },
			empmob: {
                required: "Please enter mobile."
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
	$("#notifypopup").notification({caption: "One or more invalid inputs found.", messages: msgs, sticky:true});
}

function validationSuccess(){
	 showLoader();
	 $("#submitbtn").attr("disabled","disabled");
	 $('#employeeform').ajaxSubmit({
	  	success:formResponse,
	  	dataType: "json"
	 });
}

function formRequest(formData, jqForm, options) {}

function formResponse(responseText, statusText) {
    hideLoader();
    $("#submitbtn").removeAttr("disabled");
	
	if(statusText == 'success') {
		if(responseText.type == 'success') {
			$("#submitbtn").attr("disabled","disabled");
			$("#notifypopup").notification({caption: "Employee details updated successfully.", type:"information", onhide:function(){
				window.location="customer.php?custid="+$('#customerid').val();
			}});
		}else {
			$("#notifypopup").notification({caption: "Unable to save information.", type:"warning", sticky:true});
		}
	}
	else {
		$("#notifypopup").notification({caption: "Unable to communicate with server.", type:"warning", sticky:true});
    }
}