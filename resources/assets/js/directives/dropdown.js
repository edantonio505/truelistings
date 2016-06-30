angular.module('App')
.directive('dropdown', function(){
	return {
        restrict: 'C',
        link: function() {
           $('.ui.dropdown').dropdown();
        }
    };
});