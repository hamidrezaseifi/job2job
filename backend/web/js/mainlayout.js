var is_menu_small = false;
var current_top_menu = null;
var current_sub_menu = null;
var register_choose_show = false;

var brainApp = angular.module('brainApp', ['ngAnimate', 'ngMaterial']);

brainApp.config(appconfig);

function appconfig($httpProvider){
    $httpProvider.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    $httpProvider.defaults.headers.common['X-CSRF-Token'] = $('meta[name="csrf-token"]').attr('content');
}

brainApp.controller('BodyController', function ($scope, $http, $sce, $element) {

	
});



