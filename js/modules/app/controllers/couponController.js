app.controller('couponCtrl', ['$scope', '$rootScope', 'httpServices', '$log', '$location', '$timeout', couponCtrl]);

function couponCtrl($scope, $rootScope, httpServices, $log, $location, $timeout) {
    $scope.coupon = {};
    $scope.alertDouble = false;
    $scope.couponSuccessAlert = false;

    // FUNZIONE PER RIPULIRE I CAMPI
    $scope.clearAllFields = function () {
        $scope.coupon.email = null;
        $scope.coupon.email_conferma = null;
        $scope.coupon.coupon_number = null;
    };

    // FUNZIONE PER SALVARE UN NUOVO COUPON
    $scope.saveCoupon = function () {

        $scope.coupon.coupon_number = $scope.randomCode();

        httpServices.call('couponController', [], 'insert', [$scope.coupon])
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
                            if (response.data.result == 'doubleEmail') {
                                $scope.alertDouble = true;
                            }
                            if(response.data.result == 'doubleCode'){
                                $scope.coupon.coupon_number = $scope.randomCode();
                                $scope.saveCoupon();
                            }
                            else {
                                $scope.alertDouble = false;
                                $rootScope.currentCouponData = response.data.result;
                                $rootScope.loading = false;
                                $scope.couponSuccessAlert = true;

                            }
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
    $scope.randomCode = function () {
        var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
        var string_length = 8;
        var randomstring = '';
        for (var i=0; i<string_length; i++) {
            var rnum = Math.floor(Math.random() * chars.length);
            randomstring += chars.substring(rnum,rnum+1);
        }
        return randomstring;
    };



    window.onbeforeunload = function () {
        return "Data will be lost if you leave the page, are you sure?";
    };

}