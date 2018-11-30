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

	$scope.customerCommentsCount = 4;
	$scope.currentCustomerComments = 1;

	setInterval(function(){ 
		
		$scope.currentCustomerComments ++;
		if($scope.currentCustomerComments > $scope.customerCommentsCount){
			$scope.currentCustomerComments = 1;
		}

		$scope.showPaginationContent($scope.currentCustomerComments , null);
	}, 7000);

	checkAnimation();
	
	$(window).scroll(function(){
	    checkAnimation();
	});

	$(window).resize(function(){
		//window.document.title = $(window).width();
	});

	$scope.showPaginationContent = function(index){
		
		$(".pagination2 a.selected").removeClass("selected");
		$('#link' + index).addClass("selected");
		
		$(".pagination-content div.in").removeClass("in");
		$('#item' + index).addClass("in");
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



