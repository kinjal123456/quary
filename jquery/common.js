function DownloadPDF(pdfname){
    $('#pdfname').val('');
    $('#pdfname').val(pdfname);
    $('#downloadpdf').submit();
}
function getQuerystring(key, default_)
{
  if (default_==null) default_="";
  key = key.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
  var regex = new RegExp("[\\?&]"+key+"=([^&#]*)");
  var qs = regex.exec(window.location.href);
  if(qs == null)
    return default_;
  else
    return qs[1];
}

function ellipse(text, maxlength) {
	if(text.length>maxlength) {
		return text.substr(0, maxlength) + "...";
	}
	else {
		return text;	
	}
}

function htmlentities (string, quote_style) {
    var hash_map = {}, symbol = '', tmp_str = '', entity = '';
    tmp_str = string.toString();
    
    if (false === (hash_map = this.get_html_translation_table('HTML_ENTITIES', quote_style))) {
       return false;
    }
    hash_map["'"] = '&#039;';
    for (symbol in hash_map) {
        entity = hash_map[symbol];
        tmp_str = tmp_str.split(symbol).join(entity);
    }    
    return tmp_str;
}

function showPopupLoader() {
	relocateModelAreas();
	$("#popupmodel").css("opacity", 0.9);
	$("#popupmodel").show();
	showLoader();
}

function hideCombo(){
	if (($.browser.msie) && parseInt($.browser.version)<7) {
		$("select").css("visibility", "hidden");
	}
}

function showCombo(){
	if (($.browser.msie) && parseInt($.browser.version)<7) {
		$("select").css("visibility", "visible");
	}
}

function popup_hideCombo(){
	if (($.browser.msie) && parseInt($.browser.version)<7) {
		$("#popup select").css("visibility", "hidden");
	}
}

function popup_showCombo(){
	if (($.browser.msie) && parseInt($.browser.version)<7) {
		$("#popup select").css("visibility", "visible");
	}
}

function showPopup() {
	var windowWidth=$(window).width();
	var windowHeight=$(window).height();

	var popupWidth=parseInt($("#popup").width());
	var popupHeight=parseInt($("#popup").height());
	
	var popupLeft=((windowWidth/2) - (popupWidth/2));
	//var popupTop= $(document).scrollTop() + ((windowHeight/2) - (popupHeight/2));
	//var popupTop= 30;
	//var popupTop= $(document).scrollTop() + 30;
	var popupTop = $(document).scrollTop() + (windowHeight - popupHeight)/2;
	
	if(popupTop < 0){
		popupTop = 50;
		bodyHeight = popupHeight + 2*popupTop;
		$("body").css('height', bodyHeight + "px");
	}

	$("#popup").css("left", popupLeft + "px");
	$("#popup").css("top", popupTop + "px");

	//$("#popup").show();
	$("#popup").fadeIn(1000);
}

function hidePopup() {
	hideLoader();
	showCombo();
	$("body").css('height', '100%');
	$("#popupmodel").hide();
	$("#popup").stop().hide();
	$("#popup").html("");
}

function showLoader(type) {
    relocateLoader();
    relocateModelAreasLoader();
    $("#loadermodel").css("opacity", 0.4);
    $("#loadermodel").show();
	$("#loader").stop().fadeIn(500);
}

function hideLoader() {
	$("#loader").stop().hide();
    $("#loadermodel").hide();
}

function relocateObjects() {
	relocateModelAreas();
	relocateLoader();
}

function relocateLoader() {
	var windowWidth=$(window).width();
	var windowHeight=$(window).height();

	var loaderWidth=parseInt($("#loader").css("width"));
	var loaderHeight=parseInt($("#loader").css("height"));

	var loaderLeft=((windowWidth/2) - (loaderWidth/2));
	var loaderTop= $(document).scrollTop() + ((windowHeight/2) - (loaderHeight/2));

	$("#loader").css("left", loaderLeft + "px");
	$("#loader").css("top", loaderTop + "px");
	$("#loader").css("opacity", "0.9");
}

function relocateModelAreas() {
	$("#popupmodel").css("left", "0px");
	$("#popupmodel").css("top", "0px");
	$("#popupmodel").width($(document).width());
	$("#popupmodel").height($(document).height());		
 }

function relocateModelAreasLoader() {
	$("#loadermodel").css("left", "0px");
	$("#loadermodel").css("top", "0px");
	$("#loadermodel").width($(document).width());
	$("#loadermodel").height($(document).height());
 }
 
$(window).scroll(relocateObjects);
$(window).resize(relocateObjects);

function currentDate(){
	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth()+1;//January is 0!
	var yyyy = today.getFullYear();
	if(dd<10){ dd='0'+dd ;}
	if(mm<10){ mm='0'+mm ;}
	var curdate = mm+'-'+dd+'-'+yyyy ;
	return curdate;
}


function InitFlashObj(){
	//Init flash object
	MultiPowUpload = document.getElementById("MultiPowUpload");
}

function loadMultipowUpload(formname, uploadurl, id , width, height, bgcolor, filecount, filetypes){
	//Multipow Uploader intialization
	// Workaroud for bug with Flash inside Form
	if(typeof(filecount)=="undefined" && filecount!="") {
		filecount=-1;
	}
	if(typeof(bgcolor)=="undefined") {
		bgcolor="FFFFFF";
	}
	if(typeof(filetypes)=="undefined"){
		filetypes="All Images(JPEG, JPG, PNG, PDF)|*.png\\;*.jpg\\;*.jpeg\\;*.pdf";
	}
	window.MultiPowUpload = document.forms[formname].MultiPowUpload;
	var params = {
		wmode:"transparent",
		BGColor: "#FFFFFF"
	};
	var attributes = {  
		id: "MultiPowUpload",  
		name: "MultiPowUpload"
	};
	var flashvars = {
		formName: formname,
		listUploadedColor: "#CDFFC1",
		fileTypes: filetypes,
		//maxFileCount:4,
		labelUploadVisible: false,
		backgroundColor: "#" + bgcolor,
		uploadButtonVisible: false,
		customListShowTextInput: false,
		useExternalInterface: true,
        buttonBackgroundColor: "#81c3da",
		buttonTextColor: "#FFFFFF",
		buttonDisabledTextColor: "#000000",
		buttonDisabledBackgroundColor: "#c7c7c7",
		textColor: "#9F9F9F",
		listTextColor: "#c7c7c7",
		listSelectionColor: "#c7c7c7",
		listRollOverColor: "#686868",
		listTextRollOverColor: "#c7c7c7",
		listTextSelectedColor: "#515151",
		uploadUrl: uploadurl
		//uploadButtonheight: "10"
	};
	if(!(typeof swfobject !== 'undefined' && swfobject.getFlashPlayerVersion().major !== 0)){
		$('body').attr('disabled','disabled');
		//alert(id);
		//if(confirm('Dear User, Please install flash player to enable using this page.')){
			$('#'+id).append('<div id="notify_flash_install"></div>');
			$('#notify_flash_install').notification({caption: "Please install flash player to access this utility.", type: "warning", sticky:true});
			//window.location = 'index.php';
		//}
	}
	swfobject.embedSWF("../swf/ElementITMultiPowUpload1.7.swf", id, width, height, "9.0.0", "swf/expressInstall.swf", flashvars, params, attributes);
}

function loadflvplayer(id, src, width, height, menuDisplay, autoStartMovie, playerName){
	if(typeof(autoStartMovie) === 'undefined'){
		autoStartMovie = true;	
	}
	if(typeof(playerName) === 'undefined'){
		playerName = "swf/FLVplayer.swf";	
	}
	
	var flashvars = {
	  flvpFolderLocation: "flvplayer/", 
	  flvpVideoSource: src,
	  flvpWidth: width, 
	  flvpHeight: height,
	  flvpAutoNextVideo: "true",
	  flvpTurnOnCorners: "false",
	  flvpInterfaceDisplay: menuDisplay,
	  flvpInitVolume: 20,
	  flvpInterfaceLayout: "overlay",

	  flvpAutoStartMovie: autoStartMovie
	};
	
	var params = {
	  menu: "true", 
	  allowfullscreen: "true",
	  wmode: "transparent"
	};
	
	swfobject.embedSWF(playerName, id, width, height, "9.0.0", "swf/expressInstall.swf", flashvars, params);
}

function embedswf(id, src, width, height){
	var params = {
	  menu: "true", 
	  allowfullscreen: "true",
	  wmode: "transparent"
	};
	
	swfobject.embedSWF(src, id, width, height, "9.0.0");
	//swfobject.embedSWF(swfUrl, id, width, height, version, expressInstallSwfurl, flashvars, params, attributes, callbackFn);
	//swfobject.embedSWF("swf/FLVplayer.swf", id, width, height, "9.0.0", "swf/expressInstall.swf", flashvars, params);
}

function gotoPrevious(pageurl, form) {
	$("#"+form).attr("action", pageurl);
	$("#"+form).submit();
}

function gotoNext(pageurl, form) {
	$("#"+form).attr("action", pageurl);
	$("#"+form).submit();
}


function scrollTop(){
	var scrollDuration = 200;
	if($("#scrolltop").css("display") == "none"){
		$.scrollTo( (0,0), scrollDuration);
	}
	else{
		var offset= $('#scrolltop').offset();	//alert(offset.left); alert(offset.top);
		$.scrollTo( (offset.left, offset.top), scrollDuration);
		//$.scrollTo( '#scrolltop', scrollDuration);
	}
}
function scrollwindowTop(){
	$(document).scrollTop(0);
}

function scrollToElement(elementid){
    $(document).scrollTop(parseInt($("#"+elementid).offset().top) - 100);
}
 
function validateImagetypes() {
	$("input[type=file]").each(function() {
        jQuery(this).rules("add", {
            accept: "png|gif|jpe?g",
            messages: {
                accept: "Please upload only jpeg, jpg, gif or png images."
            }
        });
    });
}
function validateUrl(url) {
	var regexpr = /^(https?|ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(url);
	
	return regexpr;
}

jQuery.fn.reset = function () {
  $(this).each (function() { this.reset(); });
  return false;
}

function cancelData(){
	window.location=document.URL;
}

function combo_changed(comboid){
    $(comboid).parent('div').find('span').html($(comboid).find("option:selected").html());
}
/****************************print errors************************/
function printError(){
    window.print();
}