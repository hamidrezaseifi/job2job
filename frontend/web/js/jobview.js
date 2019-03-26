var sending = false;


brainApp.controller('JobviewController', function ($scope, $http, $sce, $element, $compile) {
	
	$("#callpannel").hide();
	$scope.isFavorite = isFavorite;
	
	$scope.getFavImageName = function(id){
		
		if($scope.isFavorite){
			return "favorite_blue.png";	
		}
		else{
			return "favorite_empty_blue.png";
		}
		
	};

	$scope.showCallMe = function(){
		
		$("#callpannel .title").hide();
		$("#sendrequestform textarea").val("");
		$("#callpannel").dialog({ width: 450, height: 500, modal: true, title: $("#callpannel .title").html(), show: {
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
		
	$scope.sendCallMe = function(){
		
		
		$("#callpannel .sendbutton").css("color" , "lightgray");
		$("#callpannel .sendbutton").css("cursor" , "default");
		
		if(sending) return;
		
		var jname = $("#sendrequestform input[name='name']");
		var jtel = $("#sendrequestform input[name='tel']");
		var jmsg = $("#sendrequestform textarea");
		
		jname.val($.trim(jname.val()));
		jtel.val($.trim(jtel.val()));
		jmsg.val($.trim(jmsg.val()));
		
		var send = true;
		$("#callpannel .desc2").css("color" , "#888888");
		jname.css("border-color" , "inherit");
		if(jname.val() == ""){
			send = false;
			jname.css("border-color" , "red");
			$("#callpannel .desc2").css("color" , "red");
		}
		
		jtel.css("border-color" , "inherit");
		if(jtel.val() == ""){
			send = false;
			jtel.css("border-color" , "red");
			$("#callpannel .desc2").css("color" , "red");
		}
		
		if(!send){
	  	  	$("#callpannel .sendbutton").css("color" , "rgb(34, 34, 34)");
			$("#callpannel .sendbutton").css("cursor" , "pointer");

			return;
		}
		
		sending = true;
		
		
		
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




