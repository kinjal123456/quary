$(document).ready(function() {
	$( "#date_of_payment" ).datepicker();
	
	$("#registerform").validate({
        debug: false,onsubmit: true,onfocusout: false,onkeyup: false,
        rules: {
        	name: {
                required: true
            }/*,
            empcode: {
                required: true
            },
            name: {
                required: true
            },
            surname: {
                required: true
            },
            gender: {
                required: true
            },
            secondname: {
                required: true
            },
            dob: {
                required: true
            },
            nationality: {
                required: true
            },
            education: {
                required: true
            },
            doj: {
                required: true
            },
            designation: {
                required: true
            },
            cat_add: {
                required: true
            },
            emptype: {
                required: true
            },
            mobile: {
                required: true
            },
            uan: {
                required: true
            },
            pan: {
                required: true
            },
            esicip: {
                required: true
            },
            lwf: {
                required: true
            },
            aadharno: {
                required: true
            },
            bankacno: {
                required: true
            },
            bankname: {
                required: true
            },
            ifsccode: {
                required: true
            },
            presentadd: {
                required: true
            },
            permanantadd: {
                required: true
            },
            servicebookno: {
                required: true
            },
            dateofexit: {
                required: true
            },
            reasonforexit: {
                required: true
            },
            idmark: {
                required: true
            },
            photo: {
                required: true
            },
            specimensign: {
                required: true
            },
            remark: {
                required: true
            }*/
        },
        messages: {
        	name: {
            	required: "Please enter name."
            }/*,
            empcode: {
            	required: "Please enter employee code."
            },
            name: {
            	required: "Please enter name."
            },
            surname: {
            	required: "Please enter surname."
            },
            dob: {
            	required: "Please enter date of birth."
            },
            gender: {
            	required: "Please select gender."
            },
            secondname: {
            	required: "Please enter father's/spouse name."
            },
            nationality: {
            	required: "Please enter nationality."
            },
            education: {
            	required: "Please enter education."
            },
            doj: {
            	required: "Please enter date of joining."
            },
            designation: {
            	required: "Please enter designation."
            },
            cat_add: {
            	required: "Please select category address."
            },
            emptype: {
            	required: "Please enter type of employeement."
            },
            mobile: {
            	required: "Please enter mobile."
            },
            uan: {
            	required: "Please enter UAN."
            },
            pan: {
            	required: "Please enter PAN."
            },
            esicip: {
            	required: "Please enter ESIC IP."
            },
            lwf: {
            	required: "Please enter LWF."
            },
            aadharno: {
            	required: "Please enter aadhar."
            },
            bankacno: {
            	required: "Please enter bank account number."
            },
            bankname: {
            	required: "Please enter bank name."
            },
            ifsccode: {
            	required: "Please enter branch ifsc code."
            },
            presentadd: {
            	required: "Please enter present address."
            },
            permanantadd: {
            	required: "Please enter permanent address."
            },
            servicebookno: {
            	required: "Please enter service book number."
            },
            dateofexit: {
            	required: "Please enter date of exit."
            },
            reasonforexit: {
            	required: "Please enter reason for exit."
            },
            idmark: {
            	required: "Please enter mark of identification."
            },
            photo: {
            	required: "Please upload photo."
            },
            specimensign: {
            	required: "Please upload specimen signature/thumb."
            },
            remark: {
            	required: "Please enter remark."
            }*/
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
	 $('#registerform').ajaxSubmit({
	  	success:loginformResponse,
	  	dataType: "json"
	 });
}

function formRequest(formData, jqForm, options) {}

function loginformResponse(responseText, statusText) {
    hideLoader();
    $("#submitbtn").removeAttr("disabled");
	if(statusText == 'success') {
		if(responseText.registerstaus == 'success') {
			$("#submitbtn").attr("disabled","disabled");
			$("#notify").notification({caption: "Information updated successfully.", type:"information", onhide:function(){
				window.location="customer-register-form-b.php?custid="+responseText.customerid;
			}});
		}else {
			$("#notify").notification({caption: "Unable to save information.", type:"warning", sticky:true});
		}
	}
	else {
		$("#notify").notification({caption: "Unable to communicate with server.", type:"warning", sticky:true});
    }
}