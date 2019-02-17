/**
 * 
 */

brainApp.controller('CandidateController', function ($scope, $http, $sce, $element, $interval) {

	$scope.numberStatictics = [
		{label: "Geschäftskontakte", maxValue:51251, currentValue: 0, stop:false }, 
		{label: "MitarbeiterInnen", maxValue:50, currentValue: 0, stop:false }, 
		{label: "Jahre Erfahrung", maxValue:10, currentValue: 0, stop:false }, 
		{label: "Vermittlungen", maxValue:2193, currentValue: 0, stop:false }, 
		];
	
	$scope.Math = window.Math;
	$scope.lastctiveProcess = "";

	showNextRecommandation(1);

	checkAnimation();
	
	$(window).scroll(function(){
	    checkAnimation();
	});

	$(window).resize(function(){
		//window.document.title = $(window).width();
	});

	$scope.showPaginationContent = function(index, isClick){
		
		showNextRecommandation(index, isClick);		
	}
	
	$(window).on('resize scroll', function(){
		
		checkPiramid();
		checkBoxes();
		
	});
	
	$($(".teaser-box-container")[0]).delay(200).fadeIn();
	$($(".teaser-box-container")[1]).delay(500).fadeIn();
	$($(".teaser-box-container")[2]).delay(800).fadeIn();
	$(".twobox-container .branch-box-company").delay(1100).fadeIn();
	
	$scope.activeProcess = function(item){
		$(".triangle.up").removeClass("up")
		
		if($scope.lastctiveProcess !== item){
			$("."+ item).addClass("up")			
			$scope.lastctiveProcess = item;
		}
		else{
			$scope.lastctiveProcess = "";
		}
		
		$(".showcontent").removeClass("showcontent").hide();
		$(".content_" + $scope.lastctiveProcess).addClass("showcontent").slideDown();
	}
	
	function checkAnimation(){
		
		$("div.slice:not(.start)").each(function(index, item){
			if(isElementInViewport(item)){
				$(item).addClass("start");
			}
		});
		
		$("div.rpiediv:not(.start)").each(function(index, item){
			
			if(isElementInViewport(item)){
				
				$(item).addClass("start");
				startRPieAnimation(item);
				
				//$(item).children("svg").children()[0].setAttribute("d", describeArc(150, 100, 90, 0, 280));
			}
		});

		var statisticDiv = $("div.statistic-anim:not(.start-st)");
		
		
		
		if(statisticDiv.length >0 && isElementInViewport(statisticDiv[0])){
			
			statisticDiv.addClass("start-st");
			$interval(function(){ doAnimateStatistic(); }, 1 ); 
		}

		
		
	}

	function isElementInViewport(elem) {
		
		var docViewTop = $(window).scrollTop();
	    var docViewBottom = docViewTop + $(window).height();

	    var elemTop = $(elem).offset().top;
	    var elemBottom = elemTop + $(elem).height();

	    return (elemTop <= docViewBottom - 50) && (elemBottom > docViewTop + 150);
	}
	
	function doAnimateStatistic(){
		
		for(var i=0; i< $scope.numberStatictics.length; i++){
			
			if($scope.numberStatictics[i].currentValue < $scope.numberStatictics[i].maxValue){
				$scope.numberStatictics[i].currentValue += $scope.numberStatictics[i].maxValue / 1000;
			}
		}
		
		
	}
	
	function checkPiramid(){
		
		if ($(".was_wir_machen_bottom").data("show") == "0" && $(".was_wir_machen_bottom").is( ':in-viewport' ) ) {
			$(".triangle.trapezoid5").delay(1700).fadeIn();
			$(".triangle.trapezoid4").delay(1400).fadeIn();
			$(".triangle.trapezoid3").delay(1100).fadeIn();
			$(".triangle.trapezoid2").delay(800).fadeIn();
			$(".triangle.trapezoid1").delay(500).fadeIn();
			$(".triangle.triangle-up").delay(200).fadeIn();
			$(".was_wir_machen_bottom").data("show" , "1");
		}
		
	}
	
	function checkBoxes(){
		
		if ($(".wir-fordern-ihre-karriere-bottom").data("show") == "0" && $(".wir-fordern-ihre-karriere-bottom").is( ':in-viewport' ) ) {
			$($(".box-karriere")[0]).delay(200).fadeIn();
			$($(".box-karriere")[1]).delay(500).fadeIn();
			$($(".box-karriere")[2]).delay(800).fadeIn();
			$(".wir-fordern-ihre-karriere-bottom").data("show" , "1");
		}
		
	}
	
	checkPiramid();
	checkBoxes();
	
	
});



