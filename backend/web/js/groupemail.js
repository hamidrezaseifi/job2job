



brainApp.controller('GroupeemailController', function ($scope, $http, $element, $sce, $compile) {

	$scope.loadusersurl = loadusersurl; 
	$scope.loademailtextsurl = loademailtextsurl; 
	$scope.timeoutMilliseconds = 30000;
	$scope.users = [];
	$scope.selectedEmails = {};
	$scope.appliedelectedEmails = {};
	$scope.textList = {};
	$scope.previewTextId = 0;
	
	$scope.selectedTitle = "";
	$scope.selectedText = "";

	$("<button data-toggle='modal' data-target='#usersmodal' type='button' class='browse-receiver form-control'></button><div class='clear'></div>").insertAfter(".field-emailform-receiver input.receiver");
	
	$("<button data-toggle='modal' data-target='#textsmodal' type='button' class='browse-title form-control'></button><div class='clear'></div>").insertAfter(".field-emailform-title input.title");
	
	$compile($("button.browse-receiver"))($scope);
	$compile($("button.browse-title"))($scope);
	
	$scope.$watch('events', function(html) {
  	  
      
    });	

	$scope.previewText = function(id){
		$scope.previewTextId = id;
	}

	$scope.renderPreviewText = function(){
		var text = $scope.textList[$scope.previewTextId] ? $scope.textList[$scope.previewTextId].html : "";
		
		return $sce.trustAsHtml(text);
	}

	$scope.selectText = function(){
		
		if($scope.previewTextId > 0 && $scope.textList[$scope.previewTextId]){
			
			$scope.selectedTitle = $scope.textList[$scope.previewTextId].title;
			$scope.selectedText = $scope.textList[$scope.previewTextId].text;
			
			$("#textsmodal").modal('hide');	
		}
			
	}
	
	$scope.applySelectedEmail = function(){
		
		$scope.appliedelectedEmails = {};
		
		for(email in $scope.selectedEmails){
			if($scope.selectedEmails[email]){
				$scope.appliedelectedEmails[email] = true;
			} 
		}
		
		$("#usersmodal").modal('hide');	
	}

	$scope.allEmailAreSelectedInText = function(){
		
		var text = "";
		
		for(email in $scope.appliedelectedEmails){
			text += email + ", ";
		}
		
		return text;
	}

	$scope.allEmailAreSelected = function(){
		var allSeleted = true;
		for(email in $scope.selectedEmails){
			allSeleted &= $scope.selectedEmails[email]; 
		}
		return allSeleted;
		
		
	}

	$scope.selectAllEmails = function(){
		for(email in $scope.selectedEmails){
			$scope.selectedEmails[email] = $(".select-all-email input:checked").length == 1; 
		}
	}

	$scope.loadUsers = function(){
		
		clearTimeout($scope.timeoutId);
		$scope.isloading = true;
		
		$http({
			  method: 'GET',
			  url: $scope.loadusersurl
			})
			.then(function successCallback(response) {
			    
				//alert("data: " + JSON.stringify(response.data));			    

				$scope.users = response.data;
				
				for(index in $scope.users.candidates){
					$scope.selectedEmails[$scope.users.candidates[index].email] = false;
				}

				for(index in $scope.users.companies){
					var company = $scope.users.companies[index]; 
					for(uindex in company.users){
						
						$scope.selectedEmails[company.users[uindex].email] = false;
					}
				}

				

				//$scope.events = list;
				
				$scope.isloading = false;
				
				
			    
			  }, 
			  function errorCallback(response) {
				  alert("error: " + response.data);
			  });
	};

	$scope.loadTexts = function(){
		
		clearTimeout($scope.timeoutId);
		$scope.isloading = true;
		
		$http({
			  method: 'GET',
			  url: $scope.loademailtextsurl
			})
			.then(function successCallback(response) {
			    
				//alert("data: " + JSON.stringify(response.data));			    

				$scope.textList = response.data.texts;
				
				
				
				$scope.isloading = false;
				
				
			    
			  }, 
			  function errorCallback(response) {
				  alert("error: " + response.data);
			  });
	};
		
		
		
	$scope.loadUsers();	
	
	$scope.loadTexts();	
	
	
		

});




