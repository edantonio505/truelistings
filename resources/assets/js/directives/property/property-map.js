'use strict';

angular.module('App')

    .directive('propertyMap', ['$rootScope', function( $rootscope ){
        // Runs during compile
        return {
            restrict: 'A', // E = Element, A = Attribute, C = Class, M = Comment

            scope: true,

            templateUrl: 'views/directives/property/property-map.html',

            controller: function($scope, $element, $attrs, $transclude) {
                $scope.map = { control: {}, center: { latitude: 45, longitude: -73 }, zoom: 8, options: { scrollwheel: false } };
            },

            link: function( $scope, iElm ) {
                $scope.currentTab = 'map';

                $scope.onClickTab = function (tabId) {
                    $scope.currentTab = tabId;
                }

                $scope.isActiveTab = function(tabId) {
                    return tabId == $scope.currentTab;
                }
            }
        };
    }]);