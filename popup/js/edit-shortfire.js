$(document).ready(function() {
	$("#shortfireform").validate({
        debug: false,
        onsubmit: true,
        onfocusout: false,
        onkeyup: false,
        rules: {
            short_doc_key: {
                required: true
            },
			short_licenceno: {
                required: true
            },
			short_name: {
                required: true
            },
			short_issuedate: {
                required: true
            },
			short_expirydate: {
                required: true
            }
        },
        messages: {
            short_doc_key: {
                required: "Please enter document key."
            },
			short_licenceno: {
                required: "Please enter licence no."
            },
			short_name: {
                required: "Please enter shortfire name."
            },
			short_issuedate: {
                required: "Please enter issue date."
            },
			short_expirydate: {
                required: "Please enter expiry date."
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
	 $('#shortfireform').ajaxSubmit({
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
			$("#notifypopup").notification({caption: "Short fire updated successfully.", type:"information", onhide:function(){
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