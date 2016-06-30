angular.module('App')

// Create Service to get Parameters from url get request
.factory('PSRVC', function(){
	var Params = { 
		getParams: function(name, url){
			name = name.replace(/[\[\]]/g, "\\$&");
			var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
			    results = regex.exec(url);
			if (!results) return null;
			if (!results[2]) return '';
			return decodeURIComponent(results[2].replace(/\+/g, " "));
		}
	};
	return Params;
})

.factory('urlChanger', function(API){
	var changer = {
		change: function(url, param, paramVal){
			var newAdditionalURL = "";
		    var tempArray = url.split("?");
		    var baseURL = tempArray[0];
		    var additionalURL = tempArray[1];
		    var temp = "";
		    if (additionalURL) {
		        tempArray = additionalURL.split("&");
		        for (i=0; i<tempArray.length; i++){
		            if(tempArray[i].split('=')[0] != param){
		                newAdditionalURL += temp + tempArray[i];
		                temp = "&";
		            }
		        }
		    }

		    var rows_txt = temp + "" + param + "=" + paramVal;
		    var newurl = baseURL + "?" + newAdditionalURL + rows_txt;	
		    history.pushState('', null, newurl);
		    return API+"search?" + newAdditionalURL + rows_txt;
		}
	};

	return changer;
});