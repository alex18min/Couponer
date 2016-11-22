var app = angular.module('app', ['core']);

/**
 * APP STARTUP
 */

app.run(function ($rootScope, $location, $log, $http, $window) {

    $rootScope.loading = false;
    $rootScope.error = false;
    $rootScope.specialEvent = false;
    $rootScope.loggedUser = null;
    $rootScope.currentStep = '1';
    $rootScope.currentUser = null;
    $rootScope.section = false;

    /**
     * CHECK IF USER IS LOGGED BEFORE ACCESSING LOGIN-RESTRICTED AREAS
     */

    $rootScope.$on("$routeChangeStart", function (event, next, current) {
        $rootScope.error = null;

        function getCookie(cname) {
            var name = cname + "=";
            var ca = document.cookie.split(';');
            for(var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }

        function checkCookie() {
            var user = getCookie("username");
            if (user != "") {
                TweenMax.to(".backend-icon-container .backend-icon", 1, {right:0});

            } else {
                $location.path("/");
            }
        }

        var cookieChecker = checkCookie();
    });

    /**
     * LOGOUT
     */

    $rootScope.logout = function () {
        $rootScope.loggedUser = null;
        $location.path("/login");
    };

    $rootScope.setSection = function(section){
        $rootScope.section = section;
    };

    $rootScope.goHome = function(){
        $window.location.href = '/';
    };

});



/**
 * APP ROUTING
 */

app.config(function ($routeProvider) {
    $routeProvider


        .when('/', {
            templateUrl: 'views/frontend/coupon.php',
            controller: 'couponCtrl'
        })

        .when('/backend', {
            templateUrl: 'views/frontend/backend.php',
            controller: 'backendCtrl'
        });
});