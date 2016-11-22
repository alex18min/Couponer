app.controller('loginCtrl', ['$scope', '$rootScope', 'httpServices', '$log', '$location', loginCtrl]);

function loginCtrl($scope, $rootScope, httpServices, $log, $location, $window){

    $scope.input = {};
    $scope.input.user = null;
    $scope.input.password = null;

    $scope.login = function(){
        $rootScope.error = false;
        $rootScope.loading = true;

        httpServices.call('usersController', [], 'authenticate', [$scope.input.user, $scope.input.password])
            .then(
                function (response) {

                    if (!response.data.status) {
                        $rootScope.loading = false;
                        $rootScope.error = true;
                        $scope.response.error = 'errore generico';
                       
                    }

                    if (response.data.status == 'error') {
                        $scope.response.error = response.data.message;
                    }
                    else {
                        if (response.data.result) {
                            $rootScope.loggedUser = response.data.result;
                            $rootScope.loading = false;
                            TweenMax.to(".backend-icon-container .backend-icon", 1, {right:0});
                            $location.path("/event");
                            document.cookie = "username=gerla";



                            
                        }
                        else {
                            $rootScope.error = true;
                            $rootScope.loading = false;
                            $log.warn('error', 'nothing happened');
                        }
                    }
                },
                function (response) {
                    $log.warn('error', response);
                }
            );

    }

}