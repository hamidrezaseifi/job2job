
brainApp.controller('LoginController', function ($scope, $http, $sce, $element, $mdSidenav) {

	$scope.isSent = false;
	$scope.requestResetPasswordError = false;
	$scope.resetpasswordemail = "";
	$scope.resetpassurl = resetpassurl;
	
	$scope.doLogin = function() {
		//alert("login");
		angular.element('#login-form').submit();
	};
	
	$scope.requestResetPassword = function() {
		$scope.requestResetPasswordError = false;
		$scope.isSent = false;
		
		var requestData = {request: 'resetpass', 'email': $scope.resetpasswordemail};
		///frontend/site/resetpassword
		
		$http({
	        method : "POST",
	        //headers: {
	        	//'Content-type': 'application/x-www-form-urlencoded',
	        //},
	        url : $scope.resetpassurl,
	        data : requestData,
	    }).then(function successCallback(response) {
	    	//alert( JSON.stringify(response.data));	    	
	    	if(response.data.res === 'noemail'){
	    		$scope.requestResetPasswordError = true;
	    	}
	    	if(response.data.res === 'ok'){
	    		$scope.isSent = true;
	    	}
	    	
	    }, function errorCallback(response) {
	        
	        //alert("error: " + JSON.stringify(response));
	        //$scope.test = response.data;
	    });
		
	};
	
	
});