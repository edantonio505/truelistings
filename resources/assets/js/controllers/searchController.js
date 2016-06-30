angular.module('App')
.controller('SearchCtrl', function(
	$scope, 
	API, 
	PSRVC, 
	$http, 
	$interval, 
	$timeout,
	urlChanger
){
	// ----------------------------------------------------------------
	var url = window.location.href;
	$scope.min = Number(PSRVC.getParams('min', url));
	$scope.max = Number(PSRVC.getParams('max', url));
	$scope.beds = PSRVC.getParams('beds', url);
	$scope.location = PSRVC.getParams('location', url);
	$scope.wish1 = PSRVC.getParams('gq1', url);
	$scope.wish2 = PSRVC.getParams('gq2', url);
	$scope.wish3 = PSRVC.getParams('gq3', url);
	$scope.buttonFilterSelected = false;
	var id = '';
	var url = API+'search?min='+$scope.min+'&max='+$scope.max+'&location='+$scope.location+'&beds='+$scope.beds+'&gq1='+$scope.wish1+'&gq2='+$scope.wish2+'&gq3='+$scope.wish3;
	var amenitiesFilterValues = [];
	var val = 0;


	$scope.colors = {
	    first: {
	        breakpoint: 33.33,
	        color: '#ff5b4d'
	    },
	    second: {
	        breakpoint: 66.66,
	        color: '#ffa54d'
	    },
	    third: {
	        color: '#67bb17'
	    }
	}

	// --------------------------jQuery Functions---------------------------
	$(window).click(function() {
		$('.wish-list').fadeOut(200);
		$('.button_popup').removeClass('visible');
	});


	$('.button_popup').click(function(event){
		var $this = $(this);
		id = $this.attr('data-wish-id');
		var wishlist = $('.wish'+id);
		var otherlist = $('.wish-list');
		var speed = 200;
		event.stopPropagation();

		if($this.hasClass('visible') == false){
			otherlist.fadeOut(speed);
			$('.button_popup').removeClass('visible');
			$this.addClass('visible');
			wishlist.fadeIn(speed);
		} else {
			$this.removeClass('visible');
			wishlist.fadeOut(speed);
		}
	});
	// ---------------------------------------------------------------------

	$scope.getColor = function(match, calculated, amenities) {

		if($scope.buttonFilterSelected == false)
		{
			current = match;
		} else {
			current =  Math.round(val * $scope.getAmenitiesRealValues(amenities)) + calculated;
		}

	    if (current < 33.33) {
	        $scope.currentColor =   $scope.colors.first.color;
	    } else if (current >= $scope.colors.first.breakpoint && current <= $scope.colors.second.breakpoint) {
	        $scope.currentColor =   $scope.colors.second.color;
	    } else {
	        $scope.currentColor = $scope.colors.third.color;
	    }
	    return $scope.currentColor;
	}


	$scope.showMore = function(index, location){
		var $this = $('#'+index+'-more-info-box');
		var moreInfo = $('.more-info-box');
		var speed = 600;
		var $grid = $('.grid');
		$grid.masonry();
		if($this.hasClass('showing-info') == false)
		{	
			/*-------------------------------
				Map Functions
			---------------------------------*/
			var l = location.split(",");
			map = new google.maps.Map(document.getElementById(index+'-map'), {
	          center: {lat: Number(l[0]), lng: Number(l[1])},
	          zoom: 13,
	          scrollwheel: false,
	          disableDefaultUI: true,
	          mapTypeId: google.maps.MapTypeId.ROADMAP
	        });

			var cityCircle = new google.maps.Circle({
		        strokeColor: '#1a8dd8',
		        strokeOpacity: 0.8,
		        strokeWeight: 2,
		        fillColor: '#1a8dd8',
		        fillOpacity: 0.35,
		        map: map,
		        center: {lat: Number(l[0]), lng: Number(l[1])},
		        radius: 1000
		    });

		    google.maps.event.addListenerOnce(map, 'idle', function() {
		        google.maps.event.trigger(map, 'resize');
		        map.setCenter({lat: Number(l[0]), lng: Number(l[1])});
		    });
		    // ================================//
			moreInfo.hide('blind', {}, speed);
			moreInfo.removeClass('showing-info');
			$this.show('blind', {}, speed);
			$this.addClass('showing-info');

			var interval = $interval(function () {
			    $grid.masonry('layout');
			}, 200);

			$timeout(function(){
			    $interval.cancel(interval);
			}, 2000);
		} else {
			$this.hide('blind', {}, speed);
			$this.removeClass('showing-info');
			var interval = $interval(function () {
			    $grid.masonry('layout');
			}, 200);

			$timeout(function(){
			    $interval.cancel(interval);
			}, 2000);
		}	
	};


	$scope.getBaths = function(b){
		if(b > 10)
		{
			return b/10;
		} else {
			return b;
		}
	};

	$scope.getBeds = function(b){
		if(b == 0){
			return 'Studio';
		} else {
			return b;
		}
	};

	$scope.setBeds = function(n){
		$scope.beds = n;
		$scope.getNewResults('beds', n);
	};


	// Get the results from the initial search
	$scope.init = function(){
		var elementsCount = 0;
		var time = 0;
		$http.get(url)
		.success(function(data){
			$scope.properties = data.properties;
			$scope.neighborhoods = data.neighborhoods;
			$scope.selling_points = data.selling_points;
			$scope.amenities = data.amenities;
			$scope.selected_wishes = data.selected_wishes;
			$scope.setWishesValue();
			window.scrollTo(0, 0);
			elementsCount = Object.keys(data.properties).length;

			if(elementsCount > 10)
			{
				time = $timeout;
			} else if(elementsCount > 20)
			{
				time = 3000;
			} else if(elementsCount < 10)
			{
				time = $timeout;
			}

			$timeout(function(){
				$("#spinner").fadeOut();
			}, time);
		});
	};

	// Pick wishes-----------------------------------
	$scope.wish = function(wish, value){
		document.getElementById('wish'+id).value = wish;
		$('.wish-list').fadeOut(200);
		$('.button_popup').removeClass('visible');
		if(id == 1){
			$scope.wish1 = value;
			$scope.getNewResults('gq1', value);
		} else if(id == 2){ 
			$scope.wish2 = value;
			$scope.getNewResults('gq2', value);
		} else {
			$scope.wish3 = value;
			$scope.getNewResults('gq3', value);
		}
	};
	// ----------------------------------------------

	$scope.setWishesValue = function(){
		for(var i = 0; i <= 2; i++)
		{	
			if(i == 0){option = $scope.wish1;} else if(i == 1){option = $scope.wish2;} else {option = $scope.wish3;}
			document.getElementById('wish'+(i+1)).value = $scope.selected_wishes[i][option];
		}
	};

	$scope.newLocation = function(newLocation){
		$scope.location = newLocation;
		$scope.getNewResults('location', newLocation);
	};


	$scope.getNewResults = function(param, value){
		var newurl = urlChanger.change(document.URL, param, value);
		var elementsCount = 0;
		var time = 0;
		
		$http.get(newurl)
		.success(function(data){
			$scope.properties = data.properties;
			$("#spinner2").fadeIn();
			window.scrollTo(0, 0);
			elementsCount = Object.keys(data.properties).length;

			if(elementsCount > 10)
			{
				time = $timeout;
			} else if(elementsCount > 20)
			{
				time = 3000;
			} else if(elementsCount < 10)
			{
				time = $timeout;
			}

			$timeout(function(){
				$("#spinner2").fadeOut();
			}, time);
		});		
	}

	$scope.updateValue = function(value, type){
		if(value != null)
		{
			if(type == 'min' && value < $scope.max)
			{
				$scope.getNewResults(type, value);
			} else if(type == 'max' && value > $scope.min)
			{
				$scope.getNewResults(type, value);
			}
		}
	}

	$scope.amenitiesFilter = function(value){
		var $this = $('#'+value);
		if($this.hasClass('selected') == false)
		{
			$this.addClass('selected');
			amenitiesFilterValues.push(value);
			$scope.buttonFilterSelected = amenitiesFilterValues.length > 0 ? true : false;
			val = 20 / amenitiesFilterValues.length;
		} else {
			amenitiesFilterValues.splice(value, 1);
			$this.removeClass('selected');
			$scope.buttonFilterSelected = amenitiesFilterValues.length > 0 ? true : false;
			val = 20 / amenitiesFilterValues.length;
		}
	}

	$scope.getAmenitiesRealValues =  function(amenities){
		var flag = 0;
		angular.forEach(amenities, function(value, key){
			angular.forEach(amenitiesFilterValues, function(v, k){
				if(v == value){
					flag += 1;
				}
			});
		});
		return flag;
	};


	$scope.getMatchValue = function(match, calculated, amenities){
		if($scope.buttonFilterSelected == false)
		{
			return match;
		} else {
			var newValue =  Math.round(val * $scope.getAmenitiesRealValues(amenities)) + calculated;
			return newValue;
		}
	}

	$scope.init();

});