$(document).ready(function(){
	$('input, textarea').csform();
	
	$("#selectallzones").on("click", function(){
		if($("#selectallzones").is(":checked")==true){
			$('.selectzone').attr("checked", "checked");
		}else {
			$('.selectzone').removeAttr("checked");
		}
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
//Print Register form
function printRegisterfrom(formid){
	$('input#fromprint[type=hidden]').val(1);
	$('#registerformprint'+formid).attr({
		'target': '_blank',
	}).submit();
}