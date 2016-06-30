angular.module('App')
.directive('wishesSearchList', function(){
	return {
        restrict: 'E',
        templateUrl: 'views/directives/wishes-search-list.html'
    };
});