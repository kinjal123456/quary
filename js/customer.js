$(document).ready(function() {
	$("#customerform").validate({
        debug: false,
        onsubmit: true,
        onfocusout: false,
        onkeyup: false,
        rules: {//START OF CUSTOMER BASIC FIELDS
			'zoneid': {
				required: true
			},
			'firstnm': {
				required: true
			},
			'lastnm': {
				required: true
			},
			'phoneno': {
				required: true,
				number: true
			},
			'custemail': {
				required: true
			},
			'custpwd': {
				required: true
			},
			'empname[]':{
            	checkempname: true
            },
			'empdesignation[]':{
            	checkempdesignation: true
            },
			'empmob[]':{
            	checkempmob: true
            },//START OF ADDITIONAL LAST FIELDS
			'explosive_dockey': {
				required: true
			},
			'explosive_licenceno': {
				required: true
			},
			'explosive_occupiernm': {
				required: true
			},
			'explosive_issuedate': {
				required: true
			},
			'explosive_expirydate': {
				required: true
			},
			'capacity_srno[]':{
            	checkcapacitysrno: true,
				checkvalidcapacitysrno: true
            },
			'capacity_explosivenm[]':{
            	checkcapacityexpnm: true
            },
			'capacity_class[]':{
            	checkcapacityclass: true
            },
			'capacity_division[]':{
            	checkcapacitydivision: true
            },
			'capacity_qty[]':{
            	checkcapacityqty: true
            },
			'capacity_unit[]':{
            	checkcapacityunit: true
            },
			'capacity_notimes[]':{
            	checkcapacitynotimes: true
            },
			'short_doc_key[]':{
            	checkshortdockey: true
            },
			'short_licenceno[]':{
            	checkshortlicenceno: true
            },
			'short_name[]':{
            	checkshortname: true
            },
			'short_issuedate[]':{
            	checkshortissuedate: true
            },
			'short_expirydate[]':{
            	checkshortexpirydate: true
            },
			'detailname[]':{
            	checkdetailname: true
            },
            'emailid[]':{
            	checkdetailids: true
            },
            'addpassword[]':{
            	checkdetailpwd: true
            },//START OF ADDITIONAL BILLS FIELDS
			'user[]':{
            	checkuser: true
            },
            'billname[]':{
            	checkbillname: true
            },
            'billamt[]':{
            	checkbillamount: true,
				checkvalidbillamount: true
            },
            'notes[]':{
            	checknote: true
            }
        },
        messages: {
			'zoneid': {//START OF CUSTOMER BASIC FIELDS
				required: "Please select zone."
			},
			'firstnm': {
				required: "Please enter firstname."
			},
			'lastnm': {
				required: "Please enter lastname."
			},
			'phoneno': {
				required: "Please enter phone number.",
				number: "Please enter digits only."
			},
			'custemail': {
				required: "Please enter email."
			},
			'custpwd': {
				required: "Please enter password."
			},
			'empname[]':{
            	checkempname: "Please enter Employee name."
            },
			'empdesignation[]':{
            	checkempdesignation: "Please enter Employee designation."
            },
			'empmob[]':{
            	checkempmob: "Please enter Employee mobile."
            },//START OF ADDITIONAL LAST FIELDS
			'explosive_dockey': {
				required: "Please enter explosive document key."
			},
			'explosive_licenceno': {
				required: "Please enter explosive licence number."
			},
			'explosive_occupiernm': {
				required: "Please enter explosive occupier name."
			},
			'explosive_issuedate': {
				required: "Please enter explosive issue date."
			},
			'explosive_expirydate': {
				required: "Please enter explosive expiry date."
			},
			'capacity_srno[]':{
            	checkcapacitysrno: "Please enter capacity sr no.",
				checkvalidcapacitysrno: "Please enter capacity sr no in number."
            },
			'capacity_explosivenm[]':{
            	checkcapacityexpnm: "Please select capacity explosive name."
            },
			'capacity_class[]':{
            	checkcapacityclass: "Please enter capacity class."
            },
			'capacity_division[]':{
            	checkcapacitydivision: "Please enter capacity division."
            },
			'capacity_qty[]':{
            	checkcapacityqty: "Please enter capacity quantity in number."
            },
			'capacity_unit[]':{
            	checkcapacityunit: "Please select capacity unit."
            },
			'capacity_notimes[]':{
            	checkcapacitynotimes: "Please enter capacity number of times in number."
            },
			'short_doc_key[]':{
            	checkshortdockey: "Please enter short fire document key."
            },
			'short_licenceno[]':{
            	checkshortlicenceno: "Please enter short fire licence number."
            },
			'short_name[]':{
            	checkshortname: "Please enter short fire name."
            },
			'short_issuedate[]':{
            	checkshortissuedate: "Please enter short fire issue date."
            },
			'short_expirydate[]':{
            	checkshortexpirydate: "Please enter short fire expiry date."
            },
			'detailname[]':{
            	checkdetailname: "Please enter detail name."
            },
            'emailid[]':{ 
            	checkdetailids: "Please enter ID."
            },
            'addpassword[]':{
            	checkdetailpwd: "Please enter password."
            },//START OF ADDITIONAL BILLS FIELDS
			'user[]':{
            	checkuser: "Please select user."
            },
            'billname[]':{
            	checkbillname: "Please enter bill name."
            },
            'billamt[]':{
            	checkbillamount: "Please enter bill amount.",
				checkvalidbillamount: "Please enter valid bill amount."
            },
            'notes[]':{
            	checknote: "Please enter note."
            }
        },
        showErrors: validationError,
        submitHandler: validationSuccess
    });
	
	$('.tab_container > a').click(function(){
		$('.tab_container > a').removeClass('active_tab');
		$('.hiddencomponent').val('');
		$(this).addClass('active_tab');
		$('.tab_content_container > div').css('display', 'none')
		if($(this).attr('id')=="general"){
			$('#generalid').val(1);
			$('#gencontent').css('display', 'block');
		}else if($(this).attr('id')=="additional"){
			$('#additionalid').val(1);
			$('#addcontent').css('display', 'block');
		}else if($(this).attr('id')=="bills"){
			$('#billid').val(1);
			$('#billcontent').css('display', 'block');
		}else if($(this).attr('id')=="registers"){
			$('#regcontent').css('display', 'block');
		}else if($(this).attr('id')=="notes"){
			$('#noteid').val(1);
			$('#notescontent').css('display', 'block');
		}

	});
	
	$('.icon_gen_emp').on("click", function(){
		makegenempClone();
	});
	
	$('.icon_add_additional').on("click", function(){
		makeaddClone();
	});
	
	$('.icon_add_capacity').on("click", function(){
		makecapacityClone();
	});
	
	$('.icon_add_short').on("click", function(){
		makeshortClone();
	});
	
	$('.icon_add_bill').on("click", function(){
		makebillClone();
	});
	
	$('.icon_add_note').on("click", function(){
		makenoteClone();
	});
	
	$('.genemplisting').on('click', '.icon_delete', function(){
		if($('table#appendgenempcontent tr.genemp').length>1){
			$('table#appendgenempcontent tr.genemp:last').remove();
		}

    });
	
	$('.addlisting').on('click', '.icon_delete', function(){
		if($('table#appendaddcontent tr.add').length>1){
			$('table#appendaddcontent tr.add:last').remove();
		}

    });
	
	$('.capacitylisting').on('click', '.icon_delete', function(){
		if($('table#appendcapacitycontent tr.capacity').length>1){
			$('table#appendcapacitycontent tr.capacity:last').remove();
		}

    });
	
	$('.shortlisting').on('click', '.icon_delete', function(){
		if($('table#appendshortcontent tr.short').length>1){
			$('table#appendshortcontent tr.short:last').remove();
		}

    });
	
	$('.billslisting').on('click', '.icon_delete', function(){
		if($('table#appendbillcontent tr.bills').length>1){
			$('table#appendbillcontent tr.bills:last').remove();
		}

    });
	
	$('.noteslisting').on('click', '.icon_delete', function(){
		if($('table#appendnotecontent tr.notes').length>1){
			$('table#appendnotecontent tr.notes:last').remove();
		}

    });
	
	$('#generalid').val(1);
});

//Employee name
jQuery.validator.addMethod('checkempname', function(value, element){
    valdateflag=1;
    if($('.empname').length>1){
        validateflag=0;
        $('input.empname').each(function(index) {
			if(index>0){
				var value = $(this).val();
				if(value==""){validateflag=1;}
			}
        });
    }
    if(validateflag==0){return true;} else{ return false;}
});

//Employee designation
jQuery.validator.addMethod('checkempdesignation', function(value, element){
    valdateflag=1;
    if($('.empdesignation').length>1){
        validateflag=0;
        $('input.empdesignation').each(function(index) {
			if(index>0){
				var value = $(this).val();
				if(value==""){validateflag=1;}
			}
        });
    }
    if(validateflag==0){return true;} else{ return false;}
});

//Employee mobile
jQuery.validator.addMethod('checkempmob', function(value, element){
    valdateflag=1;
    if($('.empmob').length>1){
        validateflag=0;
        $('input.empmob').each(function(index) {
			if(index>0){
				var value = $(this).val();
				if(value==""){validateflag=1;}
			}
        });
    }
    if(validateflag==0){return true;} else{ return false;}
});

//Capacity sr no
jQuery.validator.addMethod('checkcapacitysrno', function(value, element){
    valdateflag=1;
    if($('.capacity_srno').length>1){
        validateflag=0;
        $('input.capacity_srno').each(function(index) {
			if(index>0){
				var value = $(this).val();
				if(value==""){validateflag=1;}
			}
        });
    }
    if(validateflag==0){return true;} else{ return false;}
});

//Check valid serial number
jQuery.validator.addMethod('checkvalidcapacitysrno', function(value, element){
	validateflag=1;
	   
    if($('.capacity_srno').length>0){
        validateflag=0;
        $('input.capacity_srno').each(function(index) {
			if(index>0){
				var value = $(this).val();
				if(!isNaN(parseInt(value))==false){validateflag=1;}
			}
        });
    }
    if(validateflag==0){return true;} else{ return false;}
});

//Capacity explosive name
jQuery.validator.addMethod('checkcapacityexpnm', function(value, element){
	validateflag=1;
    if($('select.capacity_explosivenm option:selected').length>0){
        validateflag=0;
        $('select.capacity_explosivenm option:selected').each(function(index) {
        	if(index>0){
		        var value = $(this).val();
		        if(value==""){validateflag=1;}
        	}
        });
    }
    if(validateflag==0){return true;} else{ return false;}
});

//Capacity class
jQuery.validator.addMethod('checkcapacityclass', function(value, element){
    validateflag=1;
    if($('.capacity_class').length>0){
        validateflag=0;
        $('input.capacity_class').each(function(index) {
			if(index>0){
				var value = $(this).val();
				if(value==""){validateflag=1;}
			}
        });
    }
    if(validateflag==0){return true;} else{ return false;}
});

//Capacity devision
jQuery.validator.addMethod('checkcapacitydivision', function(value, element){
    validateflag=1;
    if($('.capacity_division').length>0){
        validateflag=0;
        $('input.capacity_division').each(function(index) {
			if(index>0){
				var value = $(this).val();
				if(value==""){validateflag=1;}
			}
        });
    }
    if(validateflag==0){return true;} else{ return false;}
});


//Capacity quantity
jQuery.validator.addMethod('checkcapacityqty', function(value, element){
    validateflag=1;
    if($('.capacity_qty').length>0){
        validateflag=0;
        $('input.capacity_qty').each(function(index) {
			if(index>0){
				var value = $(this).val();
				if(value=="" || !isNaN(parseInt(value))==false){ validateflag=1; }
			}
        });
    }
    if(validateflag==0){return true;} else{ return false;}
});

//Capacity unit
jQuery.validator.addMethod('checkcapacityunit', function(value, element){
	validateflag=1;
    if($('select.capacity_unit option:selected').length>0){
        validateflag=0;
        $('select.capacity_unit option:selected').each(function(index) {
        	if(index>0){
		        var value = $(this).val();
		        if(value==""){validateflag=1;}
        	}
        });
    }
    if(validateflag==0){return true;} else{ return false;}
});

//Capacity number of times
jQuery.validator.addMethod('checkcapacitynotimes', function(value, element){
    validateflag=1;
    if($('.capacity_notimes').length>0){
        validateflag=0;
        $('input.capacity_notimes').each(function(index) {
			if(index>0){
				var value = $(this).val();
				if(value=="" || !isNaN(parseInt(value))==false){ validateflag=1; }
			}
        });
    }
    if(validateflag==0){return true;} else{ return false;}
});

//Short fire document key
jQuery.validator.addMethod('checkshortdockey', function(value, element){
    validateflag=1;
    if($('.short_doc_key').length>0){
        validateflag=0;
        $('input.short_doc_key').each(function(index) {
			if(index>0){
				var value = $(this).val();
				if(value==""){validateflag=1;}
			}
        });
    }
    if(validateflag==0){return true;} else{ return false;}
});

//Short fire licence number
jQuery.validator.addMethod('checkshortlicenceno', function(value, element){
    validateflag=1;
    if($('.short_licenceno').length>0){
        validateflag=0;
        $('input.short_licenceno').each(function(index) {
			if(index>0){
				var value = $(this).val();
				if(value==""){validateflag=1;}
			}
        });
    }
    if(validateflag==0){return true;} else{ return false;}
});

//Short fire name
jQuery.validator.addMethod('checkshortname', function(value, element){
    validateflag=1;
    if($('.short_name').length>0){
        validateflag=0;
        $('input.short_name').each(function(index) {
			if(index>0){
				var value = $(this).val();
				if(value==""){validateflag=1;}
			}
        });
    }
    if(validateflag==0){return true;} else{ return false;}
});

//Short fire issue date
jQuery.validator.addMethod('checkshortissuedate', function(value, element){
    validateflag=1;
    if($('.short_issuedate').length>0){
        validateflag=0;
        $('input.short_issuedate').each(function(index) {
			if(index>0){
				var value = $(this).val();
				if(value==""){validateflag=1;}
			}
        });
    }
    if(validateflag==0){return true;} else{ return false;}
});

//Short fire expiry date
jQuery.validator.addMethod('checkshortexpirydate', function(value, element){
    validateflag=1;
    if($('.short_expirydate').length>0){
        validateflag=0;
        $('input.short_expirydate').each(function(index) {
			if(index>0){
				var value = $(this).val();
				if(value==""){validateflag=1;}
			}
        });
    }
    if(validateflag==0){return true;} else{ return false;}
});

jQuery.validator.addMethod('checkdetailname', function(value, element){
    validateflag=1;
    if($('.detailname').length>0){
        validateflag=0;
        $('input.detailname').each(function(index) {
			if(index>0){
				var value = $(this).val();
				if(value==""){validateflag=1;}
			}
        });
    }
    if(validateflag==0){return true;} else{ return false;}
});

jQuery.validator.addMethod('checkdetailids', function(value, element){
    validateflag=1;
    if($('.emailid').length>0){
        validateflag=0;
        $('input.emailid').each(function(index) {
			if(index!=2){
				var value = $(this).val();
				if(value==""){validateflag=1;}
			}
        });
    }
    if(validateflag==0){return true;} else{ return false;}
});

jQuery.validator.addMethod('checkdetailpwd', function(value, element){
    validateflag=1;
    if($('.addpassword').length>0){
        validateflag=0;
        $('input.addpassword').each(function(index) {
			if(index!=2){
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

jQuery.validator.addMethod('checknote', function(value, element){
    validateflag=1;
    if($('.notes').length>0){
        validateflag=0;
        $('textarea.notes').each(function(index) {
			if(index>0){
				var value = $(this).val();
				if(value==""){validateflag=1;}
			}
        });
    }
    if(validateflag==0){return true;} else{ return false;}
});

function makegenempClone(){
	$('.templategenemp').show();
    var newentry = $('.templategenemp').clone(false).removeClass('templategenemp')[0].outerHTML;
	$('.templategenemp').hide();
    lastoldelem = $('table#appendgenempcontent tr.genemp:last');
    $(lastoldelem).after(newentry);

    elem = $('table#appendgenempcontent tr.genemp:last');//getting element
}

function makeaddClone(){
	$('.templateadd').show();
    var newentry = $('.templateadd').clone(false).removeClass('templateadd')[0].outerHTML;
	$('.templateadd').hide();
    lastoldelem = $('table#appendaddcontent tr.add:last');
    $(lastoldelem).after(newentry);

    elem = $('table#appendaddcontent tr.add:last');//getting element
}

function makecapacityClone(){
	$('.templatecapacity').show();
    var newentry = $('.templatecapacity').clone(false).removeClass('templatecapacity')[0].outerHTML;
	$('.templatecapacity').hide();
    lastoldelem = $('table#appendcapacitycontent tr.capacity:last');
    $(lastoldelem).after(newentry);

    elem = $('table#appendcapacitycontent tr.capacity:last');//getting element
}

function makeshortClone(){
	$('.templateshort').show();
    var newentry = $('.templateshort').clone(false).removeClass('templateshort')[0].outerHTML;
	$('.templateshort').hide();
    lastoldelem = $('table#appendshortcontent tr.short:last');
    $(lastoldelem).after(newentry);

    elem = $('table#appendshortcontent tr.short:last');//getting element
}

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

function makenoteClone(){
	$('.templatenotes').show();
	var newentry = $('.templatenotes').clone(false).removeClass('templatenotes')[0].outerHTML;
	$('.templatenotes').hide();
	lastoldelem = $('table#appendnotecontent tr.notes:last');
	$(lastoldelem).after(newentry);

	elem = $('table#appendnotecontent tr.notes:last');//getting element
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
		if(responseText.generalid == 'success') {
			if(responseText.genstatus == 'success' || responseText.custempstatus == 'success') {
				$("#notify").notification({caption: "Customer general information updated successfully.", type:"information", onhide:function(){
					location.reload(true);
				}});
			}else if(responseText.genstatus == 'custexists'){//if customer email address is exists
				$("#notify").notification({caption: "Customer email already exists in the system.", type:"warning", sticky:true});
			}else {
				$("#notify").notification({caption: "Unable to save customer general information.", type:"warning", sticky:true});
			}
		}else if(responseText.additionalid == 'success'){
			if(responseText.explosivestatus == 'success' || responseText.capacitystatus == 'success' || responseText.shortstatus == 'success' || responseText.addstatus == 'success'){
				$("#notify").notification({caption: "Customer additional information updated successfully.", type:"information", onhide:function(){
					location.reload(true);
				}});
			}else {
				$("#notify").notification({caption: "Unable to save customer additional information.", type:"warning", sticky:true});
			}
		}else if(responseText.billid == 'success'){
			if(responseText.billstatus == 'success'){
				$("#notify").notification({caption: "Customer's bill(s) updated successfully.", type:"information", onhide:function(){
					location.reload(true);
				}});
			}else if(responseText.billstatus == 'billexists'){
				$("#notify").notification({caption: "Customer bill already exists for this user.", type:"warning", sticky:true});
			}else {
				$("#notify").notification({caption: "Unable to save customer bills information.", type:"warning", sticky:true});
			}
		}else if(responseText.noteid == 'success'){
			if(responseText.notestatus == 'success'){
				$("#notify").notification({caption: "Customer's note(s) updated successfully.", type:"information", onhide:function(){
					location.reload(true);
				}});	
			}else {
				$("#notify").notification({caption: "Unable to save customer notes information.", type:"warning", sticky:true});
			}
		}else {
			$("#notify").notification({caption: "Unable to save information.", type:"warning", sticky:true});
		}
	}
	else {
		$("#notify").notification({caption: "Unable to communicate with server.", type:"warning", sticky:true});
    }
}