angular.module('App', [
  'ui.router',
  'ngPageTitle',
  'angular-svg-round-progressbar',
  'wu.masonry',
  'slick'
])

/*--------------------------
  API prefix
----------------------------*/
.constant('API', '/api/v1/')


/*---------------------------------------------------
  Routes
----------------------------------------------------*/
.config(function($stateProvider, $urlRouterProvider){

  // Now set up the states
  $stateProvider
    .state('root', {
      url: "",
      abstract: true,
      templateUrl: 'views/layout.html',
      controller: 'MainCtrl'
    })

    /*-----------------------
      Home
    ------------------------*/
    .state('root.home', {
      url: "/",
      data: {pageTitle: "Troocity | Search For new Apartments"},
      views: {
        'container': {
          templateUrl: 'views/pages/home.html',
          controller: 'HomeCtrl'
        }
      }
    })

    /*------------------------
      Search | Search results
    -------------------------*/
    .state('root.search', {
      url: "/search",
      data: {pageTitle: "Search Results"},
      views: {
        'container': {
          templateUrl: 'views/pages/search.html',
          controller: 'SearchCtrl'
        }
      }
    })


    /*------------------------
      Agent Profile
    -------------------------*/
    .state('root.agent-profile', {
      url: "/agent-profile/:id",
      data: {pageTitle: "Agent profile"},
      views: {
        'container': {
          templateUrl: 'views/pages/agent-profile.html',
          controller: 'AgentProfileCtrl'
        }
      }
    })

    
    /*------------------------
      Property Details
    -------------------------*/
    .state('root.property', {
      url: "/property/:id",
      data: {pageTitle: "Property Details"},
      views: {
        'container': {
          templateUrl: 'views/pages/property.html',
          controller: 'PropertyCtrl'
        }
      }
    });


    // For any unmatched url, redirect to /state1
    $urlRouterProvider.otherwise("/");
});