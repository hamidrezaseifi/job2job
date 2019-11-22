

brainApp.controller('CandidateController', function ($scope, $http, $sce, $element) {

	$scope.skills = skills;
	resetSkillHidden();

	$.datepicker.setDefaults($.datepicker.regional["de"]);
	$("input.calender-icon").datepicker({
	      changeMonth: true,
	      changeYear: true,
	      //maxDate: "-17Y"
	    });
	
	$scope.enterSkill = function(event) {

		if(event.which == 13) {
			event.preventDefault();	        
			addSkill();	    	 
	        return false;			
		}        
	}
    
    $scope.addSkillButton = function(){    	
    	addSkill();     	
    };
	
    
    $scope.deleteSkill = function(skill){
    	
    	var index = $scope.skills.indexOf(skill);
    	if(index > -1){
        	$scope.skills.splice(index, 1);     
        	resetSkillHidden();    		
    	}
    };
    
    function addSkill(){
    	var skill = $("#skilltext").val();
    	$("#skilltext").val("");
    	skill = $.trim(skill);
    	
    	var index = $scope.skills.indexOf(skill);
    	if(index == -1){
    		$scope.skills.push(skill);
    		resetSkillHidden();
    	}
    }
    
    function resetSkillHidden(){
    	$("#skillhidden").val(JSON.stringify($scope.skills));
    }
   
});

