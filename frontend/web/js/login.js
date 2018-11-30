
brainApp.controller('LoginController', function ($scope, $http, $sce, $element, $mdSidenav) {

	$scope.doLogin = function() {
		//alert("login");
		angular.element('#login-form').submit();
	};
	
	
});