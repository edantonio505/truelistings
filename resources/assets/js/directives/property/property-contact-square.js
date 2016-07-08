'use strict';

angular.module('App')

    .directive('propertyContactSquare', ['$rootScope', function( $rootscope){
        // Runs during compile
        return {
            restrict: 'A', // E = Element, A = Attribute, C = Class, M = Comment

            scope: true,

            templateUrl: 'views/directives/property/property-contact-square.html',

            controller: function($scope, $element, $attrs, $transclude) {

            },

            link: function( $scope, iElm ) {

                $scope.openPropertyContactModal = function () {
                    var inquiryModal = $uibModal.open({
                        animation: true,
                        templateUrl: 'views/directives/property/property-contact-modal.html',
                        controller: 'PropertyContactModalController',
                        windowClass: 'property-contact-modal-show',
                    });
                };
            }
        };
    }])

    .controller('PropertyContactModalController', [

        '$scope',
        '$uibModalInstance',

        function (
            $scope,
            $uibModalInstance
        ) {


            $scope.closePropertyContactModal = function () {
                $uibModalInstance.dismiss('cancel');
            };
    }]);
