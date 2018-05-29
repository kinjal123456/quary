function ajaxCall(interfaceUrl, interfaceID, loaderID, callBack){
	showLoader();
	$.ajax({
		type: "GET",
		url: interfaceUrl,
		cache: false,
		dataType: "html",
		success: function(data, textStatus) {
			if(typeof(interfaceID)=='string') {
				$("#" + interfaceID).hide();
				$("#" + interfaceID).html(data);
				$("#" + interfaceID).fadeIn();
			}
			else {
				//$(interfaceID).hide();
				$(interfaceID).html(data);
			}

			hideLoader();
			
			if(callBack==undefined){
				ajaxCallback(interfaceID);
			}
			else{
				callBack(interfaceID);
			}

		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			hideLoader();			
			//alert("ERROR: " + XMLHttpRequest.statusText + " " + interfaceUrl);
		}
	});
}

function ajaxUpdate(Url, data, callBack){
	showLoader();
	$.ajax({
		type: "POST",
		url: Url,
		cache: false,
		data: data,
		dataType: "json",
		success: callBack,
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			hideLoader();
			//alert("ERROR: " + XMLHttpRequest.statusText + " " + Url);
			//alert("ERROR: " + XMLHttpRequest.errorThrown + " " + Url);
		}
	});
}

function ajaxProgressUpdate(Url, data, callBack){
	$.ajax({
		type: "POST",
		url: Url,
		cache: false,
		data: data,
		dataType: "json",
		success: callBack,
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			hideLoader();
			//alert("ERROR: " + XMLHttpRequest.statusText + " " + Url);
			//alert("ERROR: " + XMLHttpRequest.errorThrown + " " + Url);
		}
	});
}

function ajaxPopup(interfaceUrl, callBack) {
	hideCombo();
	showLoader();
	showPopupLoader();
	$.ajax({
		type: "GET",
		url: interfaceUrl,
		cache: false,
		dataType: "html",
		success: function(data, textStatus) {
			//alert(data);
			$("#popup").html(data);
			
			hideLoader();
			showPopup();
			if(callBack) callBack();
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			hideLoader();
			//alert("ERROR: " + XMLHttpRequest.statusText + " " + interfaceUrl);
		}
	});
}

function ajaxFetch(interfaceUrl, data, callBack){
	showLoader();
	$.ajax({
		type:"POST",
		url:interfaceUrl,
		data:data,
		dataType:"html",
		success:callBack,
		error:function(XMLHttpRequest, textStatus, errorThrown) {
			//hideLoader();
			//alert("ERROR: " + XMLHttpRequest.statusText + " " + interfaceUrl);
		}
	});
}