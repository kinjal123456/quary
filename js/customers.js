function deleteCustomer(obj, customerid){
    var answer = confirm('Do you really want to delete this record?.');
    if(answer){
        ajaxUpdate("customers.php", {action: 'customerDelete', customerid:customerid}, function(data){
            hideLoader();
            scrollwindowTop();
            if(data.type=="success") {
                $("#notify").notification({caption:"Customer deleted successfully.", type:"information", sticky:false, onhide:function(){
                    window.location.href="customers.php";
                }});
            }else{
                $("#notify").notification({caption:"Not able to delete the record.", type:"information", sticky:false});
            }
        });
    }
}

$(document).ready(function(){
    $("#uploadcustomerform").validate({
        debug:false, onsubmit: true, onfocusout: false, onkeyup: false,onclick:false,
        rules: {
            file:{
                required:true,
                accept: "xls,xlsx"
            }
        },
        messages: {
            file:{
                required:"Please select file to upload.",
                accept:"Please upload only *.xls / xlsx file."
            }
        },
        showErrors: validationError,
        submitHandler: validationSuccess
    });
});
function validationError(errorMap, errorList) {
    if(errorList.length==0) return;
    var msgs=[];
    for(var err=0;err<errorList.length;err++) {
        msgs.push({ message: errorList[err].message });
    }
    scrollwindowTop();
    $("#notify").notification({caption: "One or more invalid inputs found:", messages: msgs, sticky:true});
}

function validationSuccess(form) {
    showLoader();
    $('#submitbtn').attr('disabled','disabled');
    $('#uploadcustomerform').ajaxSubmit({beforeSubmit:formRequest,
        success:formResponse,
        dataType: 'json'});
}

function formRequest(formData, jqForm, options) {}

function formResponse(responseText, statusText) {
    $('#submitbtn').removeAttr('disabled','disabled');
    hideLoader();
    scrollwindowTop();
    if(statusText == 'success') {
        if(responseText.type == 'success') {
            $('#submitbtn').attr('disabled','disabled');
            $("#notify").notification({caption: "File uploaded successfully.", type:"information",hidedelay:3000, onhide:function(){
                var uploadid=responseText.uploadid;
                $('#uploadid').val(uploadid);
                showLoader();
                $('#customeruploadform').submit();
            }});
        }else {
            $("#notify").notification({caption: "Unable to save information. Please try again.", type:"warning", sticky:true});
        }
    }
    else
        $("#notify").notification({caption: "Unable to communicate with server.", type:"warning", sticky:true});
}

/**
 * Function to open the foreceasted quantity popup
 * @param mpcid
 * @returns html
 */
function condensedmpcforcatedqtyPopup(mpcid){
    ajaxPopup('../libs/common/popup/master-forcast-qty.php?mpcid='+mpcid,function(){configurePopup();});
}