$(document).ready(function(){
	$('input').csform();
	
	$("#selectall").on("click", function(){
		if($("#selectall").is(":checked")==true){
			$('.selectcheckbox').attr("checked", "checked").csform.update();
		}else {
			$('.selectcheckbox').removeAttr("checked").csform.update();
		}
	});
	
	$("#popup").draggable({
		"handle": ".popup_dragger",
		containment: 'parent'
	});
});

function manage(offset){
	$("#offset").val(offset);
	$("#filterform").submit();
}
//Delete Zone
function deleteZone(obj, zoneid){
    var answer = confirm('Do you really want to delete this record?.');
    if(answer){
        ajaxUpdate("zones.php", {action: 'zoneDelete', zoneid:zoneid}, function(data){
            hideLoader();
            scrollwindowTop();
            if(data.type=="success") {
                $("#notify").notification({caption:"Zone deleted successfully.", type:"information", sticky:false, onhide:function(){
                    window.location.href="zones.php";
                }});
            }else if(data.type=="recordexist"){
				$("#notify").notification({caption:"Zone is linked with the customer(s).", type:"warning", sticky:true});
			}else{
                $("#notify").notification({caption:"Not able to delete the record.", type:"warning", sticky:false});
            }
        });
    }
}
//Delete multiple zones
function deleteMultipleZones(obj){
	zoneid = new Array;
	$(".selectcheckbox:checked").each(function(index){
		zoneid.push($(this).val());
	});
	if(zoneid.length>0){
		var answer = confirm('Are you sure you want to delete this record(s)?');
		hideLoader();
		if(answer){
			ajaxUpdate("zones.php", {action:"zoneDelete", 'zoneid[]':zoneid}, function(data){
				scrollwindowTop();
				hideLoader();
				if(data.type=="success") {
					$("#notify").notification({caption:"Zones deleted successfully.", type:"information", sticky:false, onhide:function(){
						window.location.href="zones.php";
					}});
				}else if(data.type=="recordexist"){
					$("#notify").notification({caption:"Zone(s) is linked with the customer(s).", type:"warning", sticky:true});
				}else{
					$("#notify").notification({caption:"Not able to delete the file.", type:"warning", sticky:true});
				}
			});
		}
	}else {
		$("#notify").notification({caption:"Please select atleast one record(s) to delete.", type:"warning", sticky:true});
	}
}
//Delete Customer employee
function deleteCustomerEmployee(obj, employeeid, customerid){
    var answer = confirm('Do you really want to delete this record?.');
    if(answer){
        ajaxUpdate("customer.php", {action: 'custEmpDelete', employeeid:employeeid}, function(data){
            hideLoader();
            scrollwindowTop();
            if(data.type=="success") {
                $("#notify").notification({caption:"Employee deleted successfully.", type:"information", sticky:false, onhide:function(){
                    window.location.href="customer.php?custid="+customerid;
                }});
            }else{
                $("#notify").notification({caption:"Not able to delete the record.", type:"warning", sticky:false});
            }
        });
    }
}
//Delete Capacity
function deleteCapacity(obj, capacityid, customerid){
    var answer = confirm('Do you really want to delete this record?.');
    if(answer){
        ajaxUpdate("customer.php", {action: 'capacityDelete', capacityid:capacityid}, function(data){
            hideLoader();
            scrollwindowTop();
            if(data.type=="success") {
                $("#notify").notification({caption:"Capacity deleted successfully.", type:"information", sticky:false, onhide:function(){
                    window.location.href="customer.php?custid="+customerid;
                }});
            }else{
                $("#notify").notification({caption:"Not able to delete the record.", type:"warning", sticky:false});
            }
        });
    }
}
//Delete Short fire
function deleteShortfire(obj, shortfireid, customerid){
    var answer = confirm('Do you really want to delete this record?.');
    if(answer){
        ajaxUpdate("customer.php", {action: 'shortfireDelete', shortfireid:shortfireid}, function(data){
            hideLoader();
            scrollwindowTop();
            if(data.type=="success") {
                $("#notify").notification({caption:"Short fire deleted successfully.", type:"information", sticky:false, onhide:function(){
                    window.location.href="customer.php?custid="+customerid;
                }});
            }else{
                $("#notify").notification({caption:"Not able to delete the record.", type:"warning", sticky:false});
            }
        });
    }
}
//Delete Details
function deleteDetails(obj, detailid, customerid){
    var answer = confirm('Do you really want to delete this record?.');
    if(answer){
        ajaxUpdate("customer.php", {action: 'detailsDelete', detailid:detailid}, function(data){
            hideLoader();
            scrollwindowTop();
            if(data.type=="success") {
                $("#notify").notification({caption:"Details deleted successfully.", type:"information", sticky:false, onhide:function(){
                    window.location.href="customer.php?custid="+customerid;
                }});
            }else{
                $("#notify").notification({caption:"Not able to delete the record.", type:"warning", sticky:false});
            }
        });
    }
}
//Delete Bills
function deleteBills(obj, billid){
    var answer = confirm('Do you really want to delete this record?.');
    if(answer){
        ajaxUpdate("customer-bills-details.php", {action: 'billDelete', billid:billid}, function(data){
            hideLoader();
            scrollwindowTop();
            if(data.type=="success") {
                $("#notify").notification({caption:"Bill deleted successfully.", type:"information", sticky:false, onhide:function(){
                    window.location.href="customer-bills-details.php";
                }});
			}else{
                $("#notify").notification({caption:"Not able to delete the record.", type:"warning", sticky:false});
            }
        });
    }
}
//Delete Register form
function deleteRegisterForm(formname, formid, customerid){
    var answer = confirm('Do you really want to delete this record?.');
    if(answer){
        ajaxUpdate("customer-register-form-"+formname+".php?custid="+customerid, {action: 'registerFormDelete', formid:formid, customerid:customerid}, function(data){
            hideLoader();
            scrollwindowTop();
            if(data.type=="success") {
                $("#notify").notification({caption:"Form deleted successfully.", type:"information", sticky:false, onhide:function(){
                    window.location.href="customer-register-form-"+formname+".php?custid="+customerid;
                }});
            }else{
                $("#notify").notification({caption:"Not able to delete the record.", type:"warning", sticky:false});
            }
        });
    }
}
//Delete Notes
function deletenotes(obj, noteid, customerid){
    var answer = confirm('Do you really want to delete this record?.');
    if(answer){
        ajaxUpdate("customer.php", {action: 'noteDelete', noteid:noteid}, function(data){
            hideLoader();
            scrollwindowTop();
            if(data.type=="success") {
                $("#notify").notification({caption:"Note deleted successfully.", type:"information", sticky:false, onhide:function(){
                    window.location.href="customer.php?custid="+customerid;
                }});
			}else{
                $("#notify").notification({caption:"Not able to delete the record.", type:"warning", sticky:false});
            }
        });
    }
}
//Print Register form
function printRegisterfrom(formid){
	$('input#fromprint[type=hidden]').val(1);
	$('#registerformprint'+formid).attr({
		'target': '_blank',
	}).submit();
}
//Print Bills
function printBills(billid){
	$('input#billprint[type=hidden]').val(1);
	$('#bill_id').val(billid);
	$('#billformprint').attr({
		'action': 'customer-bill-print.php',
		'target': '_blank',
	}).submit();
}
//Update Bill Payment
function updateBillPayment(obj, billid){
	var billpaymentid = $("#paymentstatus"+billid).val();
	
	ajaxUpdate("bills.php", {action: 'billPaymentUpdate', billid:billid, billpaymentid:billpaymentid}, function(data){
		hideLoader();
		scrollwindowTop();
		if(data.type=="success") {
			$("#notify").notification({caption:"Payment status updated successfully.", type:"information", sticky:false, onhide:function(){
				window.location.href="bills.php";
			}});
		}else{
			$("#notify").notification({caption:"Not able to update the record.", type:"warning", sticky:false});
		}
	});
}
//Filter bill by year
function filterYears(){
	$("#filterform").submit();
}
//Filter bill by payment status
function filterPaymentStatus(){
	$("#filterform").submit();
}
//Filter reg by year
function filterRegYears(){
	$("#filterregform").submit();
}
//Filter reg by month
function filterRegMonths(){
	$("#filterregform").submit();
}