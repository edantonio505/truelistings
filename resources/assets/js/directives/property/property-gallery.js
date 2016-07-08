'use strict';

angular.module('App')

    .directive('propertyGallery', ['$rootScope', function( $rootscope ){
        // Runs during compile
        return {
            restrict: 'A', // E = Element, A = Attribute, C = Class, M = Comment

            scope: true,

            templateUrl: 'views/directives/property/property-gallery.html',

            controller: function($scope, $element, $attrs, $transclude) {

            },

            link: function( $scope, iElm ) {
                iElm.imagesLoaded( function() {
                    iElm.find('.gallery-loader').hide();
                    iElm.find('.slick-slider').css('visibility', 'visible');
                });

            }
        };
    }]);