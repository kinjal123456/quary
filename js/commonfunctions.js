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