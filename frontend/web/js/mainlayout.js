var is_menu_small = false;
var current_top_menu = null;
var current_sub_menu = null;
var register_choose_show = false;

var brainApp = angular.module('brainApp', ['ngAnimate', 'ngMaterial', 'angular-click-outside', 'ngCookies']);

brainApp.directive('fileModel', ['$parse', function ($parse) {
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
            var model = $parse(attrs.fileModel);
            var modelSetter = model.assign;
            
            element.bind('change', function(){
                scope.$apply(function(){
                    modelSetter(scope, element[0].files[0]);
                });
            });
        }
    };
}]);

brainApp.config(appconfig);
function appconfig($httpProvider){
    $httpProvider.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    $httpProvider.defaults.headers.common['X-CSRF-Token'] = $('meta[name="csrf-token"]').attr('content');
}

brainApp.controller('BodyController', function ($scope, $http, $sce, $element, $mdSidenav, $cookies) {

	$scope.branchs = pageBranches;
	
	$scope.loginIsVisible = false;
	
	//$cookies.remove("accept-cookie-usage");
	
	$scope.acceptUsageCookieVisible = function(){ 
		return $cookies.get("accept-cookie-usage") == undefined || $cookies.get("accept-cookie-usage") == false ;
	}
	
	$scope.acceptUsageCookie = function(){ 
		var now = new Date();
		var expireDate = new Date(now.getFullYear() + 10, now.getMonth(), now.getDate());
		$cookies.put("accept-cookie-usage", new Date(), {'expires': expireDate}); //$cookies->get("accept-cookie-usage");
	}

	$(".text-over-image.text-up-left").delay(100).fadeIn();
	$(".text-over-image.text-up-right").delay(400).fadeIn();
	$(".search-container-over-image").delay(700).fadeIn();
	$(".personal-container-over-image").delay(700).fadeIn();
	
	$("nav li.ubermenu-item").mouseover(function() { 
		$(this).addClass("ubermenu-active");
	});
	
	$("nav li.ubermenu-item").mouseout(function() { 
		$(this).removeClass("ubermenu-active");
	});
	
	$scope.toggleMobileMenu = function(){
		$mdSidenav("leftMenu").toggle();
		 
	};
	
	$scope.closeMobileMenu = function(){
		
		$mdSidenav("leftMenu").close();
		 
	};
	
	$scope.showLogin = function(){
		
		showLoginBox();
		
	};
	
	$scope.hideLogin = function(){
		
		$scope.loginIsVisible = false;
		
		var loginlink = angular.element("#loginlink");
		loginlink.css("background" , "transparent");
	};
	
	$scope.submitLogin = function(){
		$("#loginmodule").submit();
	};
	
	
	function showLoginBox(){
		var loginbox = angular.element("#loginbox");
		var loginlink = angular.element("#loginlink");
		 
		//alert(loginlink.offset().left);
		
		loginbox.css("left" , loginlink.offset().left - 100);
		loginlink.css("background" , loginbox.css("background"));
		
		$scope.loginIsVisible = true;
	}
	//$mdSidenav("leftMenu").close();
});






function polarToCartesian(centerX, centerY, radius, angleInDegrees) {
	  var angleInRadians = (angleInDegrees-90) * Math.PI / 180.0;

	  return {
	    x: centerX + (radius * Math.cos(angleInRadians)),
	    y: centerY + (radius * Math.sin(angleInRadians))
	  };
}

function describeArc(x, y, radius, startAngle, endAngle){

    var start = polarToCartesian(x, y, radius, endAngle);
    var end = polarToCartesian(x, y, radius, startAngle);

    var largeArcFlag = endAngle - startAngle <= 180 ? "0" : "1";

    var d = [
        "M", start.x, start.y, 
        "A", radius, radius, 0, largeArcFlag, 0, end.x, end.y
    ].join(" ");

    return d;       
}
	
function startRPieAnimation(parent){
	
	//$(item).children("svg").children()[0].setAttribute("d", describeArc(150, 100, 90, 0, 280));
	var curdegree = 0;
	var curvalue = 0;
	var value = $(parent).data("value");
	alert(value);
	
	setTimeout(function(){ 
		$(parent).children("svg").children()[0].setAttribute("d", describeArc(150, 100, 90, 0, degree));
		degree ++;
	}, 200);
}

function startRPieAnimation(parent){
	
	//$(item).children("svg").children()[0].setAttribute("d", describeArc(150, 100, 90, 0, 280));
	var value = $(parent).data("value");
	var maxValue = $(parent).data("maxvalue");
	
	setTimeout(function(){ 
		doRPieAnimation(parent, value, 0, maxValue);

	}, 1);
}

function doRPieAnimation(parent, value, curValue, maxValue){
	
	//alert(value + ", " + curValue + ", " + maxValue);
	
	var curdegree = (360 * curValue) / maxValue;
	
	$(parent).children("svg").children()[0].setAttribute("d", describeArc(150, 100, 90, 0, curdegree));
	$(parent).children("div").children("p").children("span").html(curValue);
	
	if(curValue < value){
		curValue ++;
		
		setTimeout(function(){ 
			doRPieAnimation(parent, value, curValue, maxValue);
			degree ++;
		}, 1);
	}
	
	
	
}


