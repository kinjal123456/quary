$(document).ready(function(){
	$('input, textarea').csform();
});

function manage(offset){
	$("#offset").val(offset);
	$("#filterform").submit();
}
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
                $("#notify").notification({caption:"Not able to delete the record.", type:"information", sticky:false});
            }
        });
    }
}
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
                $("#notify").notification({caption:"Not able to delete the record.", type:"information", sticky:false});
            }
        });
    }
}