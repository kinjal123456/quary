$(document).ready(function() {
	$("#billform").validate({
        debug: false,
        onsubmit: true,
        onfocusout: false,
        onkeyup: false,
        rules: {
            cust: {
                required: true
            },
			user: {
                required: true
            },
			billname: {
                required: true
            },
			billamt: {
                required: true/*,
				checkvalidbillamount: true*/
            }
        },
        messages: {
            cust: {
                required: "Please select customer."
            },
			user: {
                required: "Please select user."
            },
			billname: {
                required: "Please enter bill name."
            },
			billamt: {
                required: "Please enter bill amount."/*,
				checkvalidbillamount: "Please enter valid bill amount."*/
            }
        },
        showErrors: validationError,
        submitHandler: validationSuccess
    });
});

jQuery.validator.addMethod('checkvalidbillamount', function(value, element){
	validateflag=1;
	var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
	   
    if($('.billamt').length>0){
        validateflag=0;
        $('input.billamt').each(function(index) {
			if(index>0){
				var value = $(this).val();
				if(numberRegex.test(value)==false){validateflag=1;}
			}
        });
    }
    if(validateflag==0){return true;} else{ return false;}
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
	 $('#billform').ajaxSubmit({
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
			$("#notifypopup").notification({caption: "Bills details updated successfully.", type:"information", onhide:function(){
				window.location="customer-bills-details.php";
			}});
		}else {
			$("#notifypopup").notification({caption: "Unable to save information.", type:"warning", sticky:true});
		}
	}
	else {
		$("#notifypopup").notification({caption: "Unable to communicate with server.", type:"warning", sticky:true});
    }
}