/**
* Admin Module
*
* Description
*/
var app = angular.module('Admin', ['google.places','angularFileUpload']);

app.config(['$interpolateProvider',function($interpolateProvider) {
	 $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
}]);





