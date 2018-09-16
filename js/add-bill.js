$(document).ready(function() {
	$("#billform").validate({
        debug: false,
        onsubmit: true,
        onfocusout: false,
        onkeyup: false,
        rules: {
			//START OF ADDITIONAL BILLS FIELDS
			'cust[]':{
            	checkcustomer: true
            },
			'user[]':{
            	checkuser: true
            },
            'billname[]':{
            	checkbillname: true
            },
            'billamt[]':{
            	checkbillamount: true,
				checkvalidbillamount: true
            }
        },
        messages: {
			//START OF ADDITIONAL BILLS FIELDS
			'cust[]':{
            	checkcustomer: "Please select customer."
            },
			'user[]':{
            	checkuser: "Please select user."
            },
            'billname[]':{
            	checkbillname: "Please enter bill name."
            },
            'billamt[]':{
            	checkbillamount: "Please enter bill amount.",
				checkvalidbillamount: "Please enter valid bill amount."
            }
        },
        showErrors: validationError,
        submitHandler: validationSuccess
    });
	
	$('.icon_add_bill').on("click", function(){
		makebillClone();
	});
	
	$('.billslisting').on('click', '.icon_delete', function(){
		if($('table#appendbillcontent tr.bills').length>1){
			$('table#appendbillcontent tr.bills:last').remove();
		}

    });
});

jQuery.validator.addMethod('checkcustomer', function(value, element){
    validateflag=1;
    if($('select.cust option:selected').length>0){
        validateflag=0;
        $('select.cust option:selected').each(function(index) {
        	if(index>0){
		        var value = $(this).val();
		        if(value==""){validateflag=1;}
        	}
        });
    }
    if(validateflag==0){return true;} else{ return false;}
});

jQuery.validator.addMethod('checkuser', function(value, element){
    validateflag=1;
    if($('select.user option:selected').length>0){
        validateflag=0;
        $('select.user option:selected').each(function(index) {
        	if(index>0){
		        var value = $(this).val();
		        if(value==""){validateflag=1;}
        	}
        });
    }
    if(validateflag==0){return true;} else{ return false;}
});

jQuery.validator.addMethod('checkbillname', function(value, element){
    validateflag=1;
    if($('.billname').length>0){
        validateflag=0;
        $('input.billname').each(function(index) {
			if(index>0){
				var value = $(this).val();
				if(value==""){validateflag=1;}
			}
        });
    }
    if(validateflag==0){return true;} else{ return false;}
});

jQuery.validator.addMethod('checkbillamount', function(value, element){
    validateflag=1;
    if($('.billamt').length>0){
        validateflag=0;
        $('input.billamt').each(function(index) {
			if(index>0){
				var value = $(this).val();
				if(value==""){validateflag=1;}
			}
        });
    }
    if(validateflag==0){return true;} else{ return false;}
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

function makebillClone(){
	var numofbills=$('table#appendbillcontent tr.noofbills').length-1;
	
	//if(numofbills<2){
		$('.template').show();
		var newentry = $('.template').clone(false).removeClass('template')[0].outerHTML;
		$('.template').hide();
		lastoldelem = $('table#appendbillcontent tr.bills:last');
		$(lastoldelem).after(newentry);

		elem = $('table#appendbillcontent tr.bills:last');//getting element
	/*}else {
		$(".icon_add_bill").hide();
	}*/
}

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
	 $('#billform').ajaxSubmit({
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
		if(responseText.billid == 'success'){
			if(responseText.billstatus == 'success'){
				$("#notify").notification({caption: "Customer's bill(s) updated successfully.", type:"information", onhide:function(){
					location.reload(true);
				}});
			}else if(responseText.billstatus == 'billexists'){
				$("#notify").notification({caption: "Customer bill already exists for this user.", type:"warning", sticky:true});
			}else {
				$("#notify").notification({caption: "Unable to save customer bills information.", type:"warning", sticky:true});
			}
		}else {
			$("#notify").notification({caption: "Unable to save information.", type:"warning", sticky:true});
		}
	}
	else {
		$("#notify").notification({caption: "Unable to communicate with server.", type:"warning", sticky:true});
    }
}