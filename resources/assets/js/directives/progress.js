angular.module('App')
.directive('progress', function(){
	return {
        restrict: 'C',
        link: function() {
           $('.progress').progress({total: 6});
        }
    };
});