
app.controller('backendCtrl', ['$scope', '$rootScope', 'httpServices', '$log', '$location', backendCtrl]);

function backendCtrl($scope, $rootScope, httpServices, $log, $location){
  
    $scope.openModal = function (id) {
        $('#myModal').modal('show');
        $scope.retrieveSingleClient(id);
    };
    
    $scope.retrieveClientsData = function () {

        $rootScope.loading = true;

        httpServices.call('clientsController', [], 'getAllClients', [])
            .then(
                function (response) {

                    if (!response.data.status) {
                        $scope.response.error = 'errore generico';
                    }

                    if (response.data.status == 'error') {
                        $scope.response.error = response.data.message;
                    }
                    else {
                        if (response.data.result) {

                            $scope.data = response.data.result;
                            $rootScope.loading = false;
                        }
                        else {
                            $log.warn('error', 'nothing happened');
                        }
                    }
                },
                function (response) {
                    $log.warn('error', response);
                }
            );

    };

    $scope.retrieveSingleClient = function (id) {

        $rootScope.loading = true;

        httpServices.call('clientsController', [], 'getSingleClient', [id])
            .then(
                function (response) {

                    if (!response.data.status) {
                        $scope.response.error = 'errore generico';
                    }

                    if (response.data.status == 'error') {
                        $scope.response.error = response.data.message;
                    }
                    else {
                        if (response.data.result) {
                            $scope.currentClientData = response.data.result;
                            $rootScope.loading = false;
                        }
                        else {
                            $log.warn('error', 'nothing happened');
                        }
                    }
                },
                function (response) {
                    $log.warn('error', response);
                }
            );

    };
    

    $scope.saveSingleClient = function () {

        httpServices.call('clientsController', [], 'insertSingle', [$scope.currentClientData])
            .then(
                function (response) {

                    if (!response.data.status) {
                        $scope.response.error = 'errore generico';
                    }

                    if (response.data.status == 'error') {
                        $scope.response.error = response.data.message;
                    }
                    else {
                        if (response.data.result) {
                            $('#myModal').modal('hide');
                            $scope.retrieveClientsData();
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
    };

    $scope.delete = function (id) {

        $rootScope.loading = true;
        var txt;
        var r = confirm("Stai cancellando definitivamente questo cliente, sei sicuro?");
        if (r == true) {
            httpServices.call('clientsController', [], 'remove', [id])
                .then(
                    function (response) {
                        if (response.data.result) {
                            $scope.retrieveClientsData();
                        }
                    },
                    function (response) {
                        $log.warn('error', response);
                    }
                );
        } else {
            txt = "You pressed Cancel!";
        }


    };

    $scope.clearAllFieldsBack = function () {
        $scope.globalSearch.cliente_nome = '';
        $scope.globalSearch.cliente_cognome = '';
        $scope.globalSearch.cliente_email = '';
        $scope.globalSearch.cliente_telefono = '';
        $scope.globalSearch.event.evento_nome = '';
        $scope.globalSearch.cliente_citta = '';

    };


    
}