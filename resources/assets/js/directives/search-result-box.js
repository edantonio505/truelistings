angular.module('App')
.directive('searchResultBox', function(){
	return {
        restrict: 'E',
        templateUrl: 'views/directives/search-result-box.html'
    };
});