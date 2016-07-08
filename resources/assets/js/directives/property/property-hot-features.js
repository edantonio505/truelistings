'use strict';

angular.module('App')

    .directive('propertyHotFeatures', ['$rootScope', function( $rootscope ){
        // Runs during compile
        return {
            restrict: 'A', // E = Element, A = Attribute, C = Class, M = Comment

            scope: true,

            templateUrl: 'views/directives/property/property-hot-features.html',

            controller: function($scope, $element, $attrs, $transclude) {

            },

            link: function( $scope, iElm ) {

            }
        };
    }]);