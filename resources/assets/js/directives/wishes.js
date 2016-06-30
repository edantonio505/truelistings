angular.module('App')
.directive('wishes', function(){
	return {
        restrict: 'E',
        templateUrl: 'views/directives/wishes.html'
    };
});