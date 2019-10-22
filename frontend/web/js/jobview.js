

brainApp.controller('JobviewController', function ($scope, $http, $sce, $element, $compile) {
	
	$("#callpannel").hide();
	$scope.isFavorite = isFavorite;
	$scope.sending = false;
	$scope.callrequesturl = callrequesturl;
	$scope.sendrequest = {"fullname" : "", "tel": "", "msg": "", };
	
	$scope.getFavImageName = function(id){
		
		if($scope.isFavorite){
			return "favorite_blue.png";	
		}
		else{
			return "favorite_empty_blue.png";
		}
		
	};

	$scope.getSendrequest = function(){
		return JSON.stringify($scope.sendrequest);
	};
	
	$scope.showCallMe = function(){
		
		$("#callpannel .title").hide();
		$("#sendrequestform textarea").val("");
		$("#callpannel").dialog({ width: 360, height: 520, modal: true, title: $("#callpannel .title").html(), show: {
	        effect: "clip",
	        duration: 200
	      },
	      hide: {
	        effect: "fade",
	        duration: 200
	      },
	      open : function(){
	    	  $("#callpannel .sendcontainer").show();
	    	  $("#callpannel .responsecontainer").hide();
	      }
	      });
	};
	
	$scope.isRequestInValid = function(){

		return $.trim($scope.sendrequest.fullname) == "" || $.trim($scope.sendrequest.tel) == "";
		
	};	
	
	$scope.isSendingInValid = function(){

		return $scope.isRequestInValid() || $scope.sending;
		
	};	
	
	$scope.sendCallMe = function(){
		
		if($scope.sending) return;
		
		$scope.sendrequest.fullname = $.trim($scope.sendrequest.fullname);
		$scope.sendrequest.tel = $.trim($scope.sendrequest.tel);
		$scope.sendrequest.msg = $.trim($scope.sendrequest.msg);

		$scope.sending = true;
		
		$http({
	        method : "POST",
	        headers: {
	        	'Content-type': 'application/json; charset=UTF-8',
	        },
	        url : $scope.callrequesturl,
	        data : $scope.sendrequest
	    }).then(function successCallback(response) {
	    	//alert(JSON.stringify(response));
	    	$scope.sending = false;
	    	
	    	if(response.data.res == 'ok'){
	    		$("#callpannel").dialog("close");
	    		$scope.sendrequest = {"fullname" : "", "tel": "", "msg": "", };
	    	}
	    	

	    }, function errorCallback(response) {
	        
	        $scope.textDebug = "error search: " + response;
	        alert("error: " + JSON.stringify(response));
	        //$scope.test = response.data;
	    });

		
		
		
		
	};	
	
	$scope.printjob = function(){
		
		$("#topmenu").hide();
		$("#menu-line").hide();
		$(".jobview-rightpanel").hide();

		$(".jobview-jobpanel").css("width" , "calc(100vw - 60px)");
		$("#mainlogotop").css("position" , "absolute");
		$(".buttonbewerben").hide();
		$(".jobview-favstar").hide();
		
		window.print();
		
		$(".jobview-jobpanel").css("width" , "calc(100vw - 390px)");
		$("#mainlogotop").css("position" , "fixed");
		
		$(".buttonbewerben").show();
		$(".jobview-favstar").show();
		$("#topmenu").show();
		$("#menu-line").show();
		$(".jobview-rightpanel").show();

	}
	
	$scope.toggleFavoriote = function(id){
		$http({
	        method : "GET",
	        url : addtofavurl + "?id=" + id,
	        data : $scope.query
	    }).then(function successCallback(response) {
	    	 	
	    	$scope.isFavorite = !$scope.isFavorite;
	    	
	    }, function errorCallback(response) {
	        
	        alert(response);
	    });
	}

	
	
});




