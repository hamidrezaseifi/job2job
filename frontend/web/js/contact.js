
var branch_showed = false;

brainApp.controller('ContactController', ['$scope', '$http', '$sce', '$element', function ($scope, $http, $sce, $element) {

	$scope.branch = "hameln";
	$scope.messageIsSent = false;
	$scope.message = {name: '', email: '', title: '', message: ''};
	$scope.messageurl = messageurl;

	$scope.googlemapAddr = {"hameln" : "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2450.71684400714!2d9.353286351957733!3d52.10308467963807!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47ba8ef1e11ac88b%3A0xbd8b0f01b0414903!2sWendenstra%C3%9Fe%204%2C%2031785%20Hameln!5e0!3m2!1sde!2sde!4v1603635537856!5m2!1sde!2sde&q=Job2Job+GmbH",
							"minden" : "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2439.6398283421936!2d8.913258651962554!3d52.30439137967468!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47ba742231ce5ecb%3A0x2974652e4f77444!2sKarolingerring%2062%2C%2032425%20Minden!5e0!3m2!1sde!2sde!4v1603635446294!5m2!1sde!2sde&q=Job2Job+GmbH"};

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

