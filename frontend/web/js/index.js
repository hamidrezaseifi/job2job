/**
 * 
 */

brainApp.controller('IndexController', function ($scope, $http, $sce, $element, $interval) {

	$scope.numberStatictics = [
		{label: "Vermittlungen", maxValue:2000, currentValue: 0, stop:false }, 
		{label: "Zufriedene Kunden", maxValue:385, currentValue: 0, stop:false }, 
		{label: "Aktuelle Mitarbeiter", maxValue:87, currentValue: 0, stop:false }, 
		{label: "Jahre Branchenexpertise", maxValue:17, currentValue: 0, stop:false }, 
		];
	
	$scope.Math = window.Math;

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
	
	$($(".teaser-box-container")[0]).delay(200).fadeIn();
	$($(".teaser-box-container")[1]).delay(500).fadeIn();
	$($(".teaser-box-container")[2]).delay(800).fadeIn();

	
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
		//alert($scope.numberStatictics.length);
		
		for(var i=0; i< $scope.numberStatictics.length; i++){
			//var st = $scope.numberStatictics[i];
			
			//alert(i + ": " + $scope.numberStatictics[i].currentValue);
			
			//var inter = 5000 / st.maxValue;
			
			if($scope.numberStatictics[i].currentValue < $scope.numberStatictics[i].maxValue){
				$scope.numberStatictics[i].currentValue += $scope.numberStatictics[i].maxValue / 1000;
			}
		}
		
		
	}
	
	
});



