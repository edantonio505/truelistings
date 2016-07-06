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
		        radius: 700
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
			$scope.reArrange();
		} else {
			$this.hide('blind', {}, speed);
			$this.removeClass('showing-info');
			$scope.reArrange();
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
		var $grid = $('.grid');
		$grid.masonry('destroy');
		var elementsCount = 0;
		var time = 0;
		$http.get(url)
		.success(function(data){
			$scope.properties = data.properties;
			$scope.neighborhoods = data.neighborhoods;
			$scope.selling_points = data.selling_points;
			$scope.amenities = data.amenities;
			$scope.selected_wishes = data.selected_wishes;
			// $scope.setWishesValue();
			$scope.getWishValue();
			window.scrollTo(0, 0);
			elementsCount = Object.keys(data.properties).length;

			if(elementsCount > 10)
			{
				time = 1500;
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

			$timeout(function(){
				$grid.masonry();
			}, 1000);
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



	$scope.getWishValue = function(){
		angular.forEach($scope.selected_wishes, function(value, key){
			if(value[$scope.wish1] != undefined){
				document.getElementById('wish1').value = value[$scope.wish1];
			} else if(value[$scope.wish2] != undefined){
				document.getElementById('wish2').value = value[$scope.wish2];
			} else {
				document.getElementById('wish3').value = value[$scope.wish3];
			}
		});
	};

	$scope.newLocation = function(newLocation){
		$scope.location = newLocation;
		$scope.getNewResults('location', newLocation);
	};


	$scope.getNewResults = function(param, value){
		var $grid = $('.grid');
		$grid.masonry('destroy');
		var newurl = urlChanger.change(document.URL, param, value);
		var elementsCount = 0;
		var time = 0;
		$("#spinner2").fadeIn();
		$http.get(newurl)
		.success(function(data){
			$scope.properties = data.properties;
			window.scrollTo(0, 0);
			elementsCount = Object.keys(data.properties).length;

			$timeout(function(){
				$("#spinner2").fadeOut();
			}, $timeout);

			$timeout(function(){
				$grid.masonry();
			}, 1000);
		});

		// Button-------------------------
		$('.amenities-filter-button').removeClass('selected');
		$scope.buttonFilterSelected = false;
		amenitiesFilterValues = [];
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
			$scope.reArrange();
		} else {
			amenitiesFilterValues.splice(value, 1);
			$this.removeClass('selected');
			$scope.buttonFilterSelected = amenitiesFilterValues.length > 0 ? true : false;
			val = 20 / amenitiesFilterValues.length;
			$scope.reArrange();
		}

		var newArray = [];
		angular.forEach($scope.properties, function(value, key){
			value['recalculated'] = $scope.getMatchValue(value.match, value.calculated_value, value.amenitiesClasses);
			newArray.push(value);
			newArray.sort(function(a, b){return b['recalculated'] - a['recalculated']});
		});
		$scope.properties = newArray;
	}

	$scope.reArrange = function(){
		var $grid = $('.grid');
		$grid.masonry();
		var interval = $interval(function () {
		   $grid.masonry('layout');
		}, 200);
		$timeout(function(){
		    $interval.cancel(interval);
		}, 2000);
	};

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