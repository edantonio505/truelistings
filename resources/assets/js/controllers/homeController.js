angular.module('App')
.controller('HomeCtrl', function($scope, $http, API){
	$scope.wish1 = '';
	$scope.wish2 = '';
	$scope.wish3 = '';
	$scope.rooms = '';
	$scope.location = '';
	$scope.progress = 0;
	$scope.roomsChanges = 0;
	$scope.locationChanges = 0;
	$scope.minMaxChanges = 0;
	$scope.wish1Changes = 0;
	$scope.wish2Changes = 0;
	$scope.wish3Changes = 0;
	var id = '';

	$http.get(API+'home')
	.success(function(data){
		$scope.neighborhoods = data.neighborhoods;
		$scope.selling_points = data.selling_points;
	});

	
	
	$('.button_popup').popup({
		on    : 'click',
		closable: true
	}).click(function(){
		id = $(this).attr('data-wish-id');
	});

	$('.rooms .button').click(function(){
		var $this = $(this);
		$('.rooms .button').removeClass('active');
		$this.addClass('active');
		var rooms = $this.attr('data-value');
		$scope.setRooms(rooms);
	});

	$scope.getLocation = function(location){
		$scope.location = location;
		$scope.locationChanges += 1;
		if($scope.locationChanges == 1){
			$scope.checkStatus();
		}
	};

	$scope.setRooms = function(rooms){
		$scope.rooms = rooms;
		$scope.roomsChanges += 1;
		if($scope.roomsChanges == 1){
			$scope.checkStatus();
		}
	};

	// Pick wishes-----------------------------------
	$scope.wish = function(wish, value){
		document.getElementById('wish'+id).value = wish;
		$('.button_popup').popup('hide');
		if(id == 1){$scope.wish1 = value} else if(id == 2){ $scope.wish2 = value} else {$scope.wish3 = value}
	};
	// ----------------------------------------------




	//Progress Handling--------------------------------
	$scope.$watch('min', function(newVal, oldVal){
		if(newVal != oldVal && newVal != undefined && newVal < $scope.max && $scope.max != undefined){
			$scope.minMaxChanges += 1;
			if($scope.minMaxChanges == 1){
				$scope.checkStatus();
			}
		}
	});
	$scope.$watch('max', function(newVal, oldVal){
		if(newVal != oldVal && newVal != undefined && newVal > $scope.min && $scope.min != undefined){
			$scope.minMaxChanges += 1;
			if($scope.minMaxChanges == 1){
				$scope.checkStatus();
			}
		}
	});
	$scope.$watch('wish1', function(newVal, oldVal){
		if(newVal != oldVal && newVal != ''){
			$scope.wish1Changes += 1;
			if($scope.wish1Changes == 1){
				$scope.checkStatus();
			}
		}
	});
	$scope.$watch('wish2', function(newVal, oldVal){
		if(newVal != oldVal && newVal != ''){
			$scope.wish2Changes += 1;
			if($scope.wish2Changes == 1){
				$scope.checkStatus();
			}
		}
	});
	$scope.$watch('wish3', function(newVal, oldVal){
		if(newVal != oldVal && newVal != ''){
			$scope.wish3Changes += 1;
			if($scope.wish3Changes == 1){
				$scope.checkStatus();
			}
		}
	});
	// ---------------------------------------------




	//Check Status----------------------------------
	$scope.checkStatus = function(){
		$('#progress').progress('increment');
		$scope.progress += (100/6);
		if($scope.progress >= 100){
			var l = $scope.location;
			var min = $scope.min;
			var max = $scope.max;
			var b = $scope.rooms;
			var g1 = $scope.wish1;
			var g2 = $scope.wish2;
			var g3 = $scope.wish3;
			location.href = '#/search?min='+min+'&max='+max+'&location='+l+'&beds='+b+'&gq1='+g1+'&gq2='+g2+'&gq3='+g3;
		}
	};
	// ---------------------------------------------
	
});