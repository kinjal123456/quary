$(document).ready(function() {
	$("#zoneform").validate({
        debug: false,
        onsubmit: true,
        onfocusout: false,
        onkeyup: false,
        rules: {
            zonename: {
                required: true
            }
        },
        messages: {
            zonename: {
                required: "Please enter zone name."
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
	 $('#zoneform').ajaxSubmit({
	  	success:loginformResponse,
	  	dataType: "json"
	 });
}

function formRequest(formData, jqForm, options) {}

function loginformResponse(responseText, statusText) {
    hideLoader();
    $("#submitbtn").removeAttr("disabled");
	scrollwindowTop();
	
	if(statusText == 'success') {
		if(responseText.type == 'success') {
			$("#submitbtn").attr("disabled","disabled");
			$("#notify").notification({caption: "Zone added successfully.", type:"information", onhide:function(){
				window.location="zones.php";
			}});
		}else if(responseText.type == 'recordexists'){
			$("#notify").notification({caption: "Zone is already exists in the system.", type:"warning", sticky:true});
		}else {
			$("#notify").notification({caption: "Unable to save information.", type:"warning", sticky:true});
		}
	}
	else {
		$("#notify").notification({caption: "Unable to communicate with server.", type:"warning", sticky:true});
    }
}