
brainApp.controller('RegisterController', function ($scope, $http, $sce, $element, $mdSidenav) {

	$scope.active_register = true;

	$scope.registerData = {};
	$scope.registerData.regtype = 1;
	$scope.registerData.accept = false;
	$scope.registerData.gender = "f";
	$scope.registerData.fname = "";
	$scope.registerData.lname = "";
	$scope.registerData.email = "";
	$scope.registerData.password = "";
	$scope.registerData.password2 = "";
	$scope.registerData.tel = "";
	$scope.registerData.street = "";
	$scope.registerData.homenumber = "";
	$scope.registerData.city = "";
	$scope.registerData.postcode = "";
	$scope.registerData.workModel = "0";
	$scope.registerData.branch = "0";
	$scope.registerData.companyname = "";
	
	$scope.registerDataValidation = {};
	$scope.registerDataValidation.accept = true;
	$scope.registerDataValidation.gender = true;
	$scope.registerDataValidation.fname = true;
	$scope.registerDataValidation.lname = true;
	$scope.registerDataValidation.email = true;
	$scope.registerDataValidation.password = true;
	$scope.registerDataValidation.password2 = true;
	$scope.registerDataValidation.tel = true;
	$scope.registerDataValidation.street = true;
	$scope.registerDataValidation.homenumber = true;
	$scope.registerDataValidation.city = true;
	$scope.registerDataValidation.postcode = true;
	$scope.registerDataValidation.workModel = true;
	$scope.registerDataValidation.branch = true;
	$scope.registerDataValidation.companyname = true;
	
	
	$scope.LoginData = {};
	$scope.LoginData.LoginForm = {};
	$scope.LoginData.LoginForm.username = "";
	$scope.LoginData.LoginForm.password = "";
	$scope.LoginData["_csrf-frontend"] = "";
	
	$scope.doLogin = function() {
		angular.element('#loginform').submit();
		
		
	};
	
	
	
	$scope.doRegister = function() {
				
		var msg = doValidateRegisterData();
		if(msg != ""){
			alert(msg);
			return;
		}
		
		$http({
			  method: 'GET',
			  url: emailcheckUrl + $scope.registerData.email
			}).then(function successCallback(response) {
			    
			    if(response.data == 'ok'){
			    	alert(emailExistsMessage);
			    	return;
			    }
			    
			    if(response.data == 'no'){

			    	$("#register-regtype").val($scope.registerData.regtype);
			    	$("#register-gender").val($scope.registerData.gender);
			    	
			    	$("#register-form").submit();
			    }
			    
			    
			  }, function errorCallback(response) {
				  alert("error: " + response.data);
			  });

		
		

	};
	
	$scope.validateRegisterData = function() {
		return doValidateRegisterData() != "";
	}
	
	$scope.validatePassword = function (text) {
	    return (/[A-Z]/.test(text) && /[0-9]/.test(text) && /[a-z]/.test(text) && /[@#$%&!\(\)\"\?\§\=\']/.test(text));
	};
	
	$scope.validateEmail = function (email) {
		  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		  return re.test(email);
	}
	
	function doValidateRegisterData() {
		
		var res = "";
		if(!$scope.registerData.accept){
			res += " -" + acceptMessage + "\n";
		}
		
		if($scope.registerData.regtype == 1){
			$scope.registerDataValidation.workModel = true;
			if($scope.registerData.workModel < 1){
				$scope.registerDataValidation.workModel = false;
				res += " -" + emptypeMessage + "\n";
			}
			
			$scope.registerDataValidation.branch = true;
			if($scope.registerData.branch < 1){
				$scope.registerDataValidation.branch = false;
				res += " -" + branchMessage + "\n";
			}
		}

		if($scope.registerData.regtype == 2){
			$scope.registerDataValidation.companyname = true;
			if($.trim($scope.registerData.companyname).length < 5 || $.trim($scope.registerData.companyname).length > 40){
				$scope.registerDataValidation.companyname = false;
				res += " -" + companynameMessage + "\n";
			}
			
		}

		$scope.registerDataValidation.fname = true;
		if($.trim($scope.registerData.fname).length < 3 || $.trim($scope.registerData.fname).length > 40){
			$scope.registerDataValidation.fname = false;
			res += " -" + fnameMessage + "\n";
		}

		$scope.registerDataValidation.lname = true;
		if($.trim($scope.registerData.lname).length < 3 || $.trim($scope.registerData.lname).length > 40){
			$scope.registerDataValidation.lname = false;
			res += " -" + lnameMessage + "\n";
		}

		$scope.registerDataValidation.email = true;
		if($.trim($scope.registerData.email).length < 3 || $.trim($scope.registerData.email).length > 40 || !$scope.validateEmail($scope.registerData.email)){
			$scope.registerDataValidation.email = false;
			res += " -" + emailMessage + "\n";
		}
		
		$scope.registerDataValidation.password = true;
		if($.trim($scope.registerData.password).length < 6 || $.trim($scope.registerData.password).length > 20 || !$scope.validatePassword($scope.registerData.password)){
			$scope.registerDataValidation.password = false;
			res += " -" + passwordMessage + "\n";
		}
		
		$scope.registerDataValidation.password2 = true;
		if($.trim($scope.registerData.password2).length < 6 || $.trim($scope.registerData.password2).length > 20){
			$scope.registerDataValidation.password2 = false;
			res += " -" + passwordMessage + "\n";
		}
		
		if($scope.registerData.password != $scope.registerData.password2){
			$scope.registerDataValidation.password2 = false;
			res += " -" + password2Message + "\n";
		}

		
		return res;
	};
	
	
});