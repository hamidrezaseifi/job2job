
var branch_showed = false;

brainApp.controller('AllBranchesController', ['$scope', '$http', '$sce', '$element', function ($scope, $http, $sce, $element) {

	
	if(!branch_showed)
	{
		$(".allbranches-part-4-in").css({ opacity: 0.0 });;

		branch_showed = true;
		
		$( ".allbranches-part-4-in").css("animation-play-state" , "running");
		
	}	

}]);

