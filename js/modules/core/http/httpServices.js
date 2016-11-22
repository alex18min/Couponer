core.service('httpServices', ['$http', httpServices]);

function httpServices($http) {

    var httpServices = {};

    httpServices.call = function (callClass, classArgs, callMethod, methodArgs) {
        request = {};
        request.class = callClass;
        request.classArgs = [classArgs];
        request.method = callMethod;
        request.methodArgs = methodArgs;
        return $http({
            method: 'post',
            url: 'ajaxManager.php',
            data: request
        });

    };

    return httpServices;

}

