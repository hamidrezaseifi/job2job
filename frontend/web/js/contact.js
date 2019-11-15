
var branch_showed = false;

brainApp.controller('ContactController', ['$scope', '$http', '$sce', '$element', function ($scope, $http, $sce, $element) {

	$scope.branch = "hameln";
	$scope.messageIsSent = false;
	$scope.message = {name: '', email: '', title: '', message: ''};
	$scope.messageurl = messageurl;

	$scope.googlemapAddr = {"hameln" : "https://www.google.com/maps/embed/v1/place?key=AIzaSyDiTNNWMEMkS_pNc0OxdVGKjfVIPnxyLKE&q=Job2Job+GmbH",
							"minden" : "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2440.574766522761!2d8.915805716104261!3d52.287421561191096!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47ba76a9de6e956f%3A0x8afe3596539fb3f6!2sLindenstra%C3%9Fe+5%2C+32423+Minden!5e0!3m2!1sde!2sde!4v1558639354151!5m2!1sde!2sde&q=Job2Job+GmbH"};

	$scope.setBranch = function(branch){
		$scope.branch = branch;
		
		$("#googlemap").attr("src" , $scope.googlemapAddr[branch]);
	};
	
	$scope.sendMessage = function(){
		
		if(!isMessageValid()){
			return;
		}
		
		$http({
	        method : "POST",
	        url : $scope.messageurl,
	        data : $scope.message,
	    }).then(function successCallback(response) {
	    	//alert( JSON.stringify(response.data));	    	
	    	if(response.data.res === 'ok'){
	    		$scope.messageIsSent = true;
	    	}
	    	
	    }, function errorCallback(response) {
	        
	    });
		
	};
	
	$scope.resetMessage = function(){
		
		$scope.messageIsSent = false;
		
	};
	
	function isMessageValid(){
		$scope.message.title = $scope.message.title.trim();
		$scope.message.name = $scope.message.name.trim();
		$scope.message.email = $scope.message.email.trim();
		$scope.message.message = $scope.message.message.trim();
		
		var msg = "";
		if($scope.message.name === ''){
			msg += "ungültiger Name!\r\n";
		}
		
		if($scope.message.title === ''){
			msg += "ungültiger Titel!\r\n";
		}

		if($scope.message.email === ''){
			msg += "ungültige E-Mail-Adresse!\r\n";
		}

		if($scope.message.message === ''){
			msg += "ungültige Nachricht!\r\n";
		}
		
		if(msg != ''){
			alert(msg);
			
		}
		
		return msg === '';
	}

}]);

