angular.module('App')
.controller('AgentProfileCtrl', function($scope, $http, API, $stateParams){
	$http.get(API+'user-info/'+$stateParams.id)
	.success(function(data){
		$scope.name = data.user.name;
		$scope.email = data.user.email;
		$scope.avatar = data.user.avatar;
	});

});