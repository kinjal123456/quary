$(document).ready(function() {
	$("#capacityform").validate({
        debug: false,
        onsubmit: true,
        onfocusout: false,
        onkeyup: false,
        rules: {
            capacity_srno: {
                required: true
            },
			capacity_explosivenm: {
                required: true
            },
			capacity_class: {
                required: true
            },
			capacity_division: {
                required: true
            },
			capacity_qty: {
                required: true
            },
			capacity_unit: {
                required: true
            },
			capacity_notimes: {
                required: true
            }
        },
        messages: {
            capacity_srno: {
                required: "Please enter sr no."
            },
			capacity_explosivenm: {
                required: "Please select explosive name."
            },
			capacity_class: {
                required: "Please enter class."
            },
			capacity_division: {
                required: "Please enter division."
            },
			capacity_qty: {
                required: "Please enter quantity."
            },
			capacity_unit: {
                required: "Please select unit."
            },
			capacity_notimes: {
                required: "Please enter number of times."
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
	 $('#capacityform').ajaxSubmit({
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
			$("#notifypopup").notification({caption: "Capacity updated successfully.", type:"information", onhide:function(){
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