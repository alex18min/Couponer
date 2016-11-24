app.controller('excelCtrl', ['$scope', 'Upload', excelCtrl]);

function excelCtrl($scope, Upload) {

    $scope.exportExcel = function (element, filename) {

        var today = new Date();

        var dd = today.getDate();
        var mm = today.getMonth() + 1; //January is 0!
        var yyyy = today.getFullYear();
        var hh = today.getHours();
        var ii = today.getMinutes();

        if (dd < 10) {
            dd = '0' + dd
        }

        if (mm < 10) {
            mm = '0' + mm
        }

        if (hh < 10) {
            hh = '0' + hh
        }

        if (ii < 10) {
            ii = '0' + ii
        }

        today = dd + '_' + mm + '_' + yyyy + '_' + hh + '_' + ii;
        filename = filename + '_' + today + '.xls';

        var blob = new Blob([document.getElementById(element).innerHTML], {
            type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;charset=utf-8"
        });

        blob.upload = Upload.upload({
            url: 'fileUploader.php',
            method: 'POST',
            file: blob,
            sendFieldsAs: 'form',
            fields: {
                type: 'excel',
                nome: filename
            }
        });

        blob.upload.then(function (response) {
            saveAs(blob, filename);
        });

    }
}