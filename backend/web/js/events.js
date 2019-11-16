



brainApp.controller('EventsController', function ($scope, $http, $element, $sce) {

	$scope.lastlogid = 0;
	$scope.eventsurl = eventsurl;
	$scope.isloading = false;
	$scope.timeoutId = false;
	$scope.timeoutMilliseconds = 30000;
	$scope.events = [];

	$scope.$watch('events', function(html) {
  	  //alert(ele.html());
      
      
      //$compile(ele.contents())(scope);
      
    });	
	
	$scope.loadnext = function(){
		
		clearTimeout($scope.timeoutId);
		$scope.isloading = true;
		
		$http({
			  method: 'GET',
			  url: $scope.eventsurl + $scope.lastlogid
			})
			.then(function successCallback(response) {
			    
				//alert("data: " + response.data);			    
				var list = response.data;
				for(o in list){
					list[o].desc = $sce.trustAsHtml(list[o].desc);
				}
				$scope.events = list;
				
				$scope.isloading = false;
				
				$scope.timeoutId = setTimeout(function(){ $scope.loadnext(); }, $scope.timeoutMilliseconds);
			    
			  }, 
			  function errorCallback(response) {
				  alert("error: " + response.data);
			  });
	};
		
		
		/*$.getJSON( "nextlog?lastid=" + lastlogid , function( data ) {

			$("#imgloading").hide();
			  $.each( data, function( index, item ) {
			    	$('<div class="logdiv">' + item.desc + '</div>').insertAfter(".lastlog");
			    	lastlogid = item.id;
			  });

			  setTimeout(function(){ loadnext(); }, 30000);
		});*/
		
	$scope.loadnext();
	
		

});




