
var photo_file = false;



brainApp.controller('AppliedJobController', ['$scope', '$http', '$element', '$sce', '$httpParamSerializerJQLike', function ($scope, $http, $element, $sce, $httpParamSerializerJQLike) {

    $scope.showskillbrower = false;
    $scope.loadingshow = true;
    
    //$scope.markedlist = [{id: 1 , jobtitle: "title 1"} , ];
    //bewerberFileUpload.uploadFileToUrl(112299);
    
    var purl = $sce.trustAsResourceUrl(markedadvurl);
    
    
    $http.jsonp(purl , {jsonpCallbackParam: 'callback'}).then(function(response) {
        
        $scope.appliedlist = response.data;
    	
        
        //alert(response.data.length);
        $scope.loadingshow = false;
        
    });
    
    

}]);

