
function checkNotEmty(item) {
  return item !== "";
}

brainApp.controller('NewAdvController', ['$scope', '$http', '$sce', '$element', function ($scope, $http, $sce, $element) {

	$scope.currentWizardIndex = 1;

	$scope.jobposition = jobposition ;
	$scope.jobposition.taskList = taskList.filter(checkNotEmty);
	$scope.jobposition.skillList = skillList.filter(checkNotEmty);
	$scope.jobposition.jobStartMonth = $scope.jobposition.jobStartMonth + "";
	$scope.jobposition.jobStartYear = $scope.jobposition.jobStartYear + "";
	//$scope.jobposition.jobStartMonth = jobStartMonth;

	$scope.jobposition.branch = "" + $scope.jobposition.branch;
	$scope.jobposition.worktype = "" + $scope.jobposition.worktype;
	
	$scope.allskils = allskils;
	$scope.branchs = branchs;
	$scope.worktypes = worktypes;
	
	$scope.checkcondition = false;
	
	$("#jobpositionexpiredate").datepicker({
        format: "dd.mm.yyyy",
        language: "de",
        autoclose: true,
        todayHighlight: true,
        startDate: new Date(),
        calendarWeeks: true,
        defaultViewDate :jobposition.expiredate,
    });

	
	$scope.setJobstartNow = function(){
		$scope.jobposition.jobStartMonth = "1";
		var d = new Date();
		$scope.jobposition.jobStartYear = d.getFullYear() + "";
	}
	
	$scope.addTask = function(){
		var task = $(".add-text-item.task-text-item").val();
		$(".add-text-item.task-text-item").val("");
		task = $.trim(task);
		if(task === ""){
			return;
		}
		
		$scope.deleteTask(task);
		$scope.jobposition.taskList.push(task);
	}
	
	$scope.deleteTask = function(task){
		var index = $scope.jobposition.taskList.indexOf(task);
		if(index > -1){
			$scope.jobposition.taskList.splice(index, 1);
		}
	}
	
	$scope.addSkill = function(){
		var skill = $(".add-text-item.skill-text-item").val();
		$(".add-text-item.skill-text-item").val("");
		skill = $.trim(skill);
		if(skill === ""){
			return;
		}
		
		$scope.deleteSkill(skill);
		$scope.jobposition.skillList.push(skill);
	}
	
	$scope.deleteSkill = function(skill){
		var index = $scope.jobposition.skillList.indexOf(skill);
		if(index > -1){
			$scope.jobposition.skillList.splice(index, 1);
		}
	}
	
	$scope.otherVacancySelected = function(){
		setTimeout(function(){ $(".other-vacancy").focus(); }, 300);
		
	}

	$scope.cancelAdv = function(){
		window.location = advlisturl;
	}

	$scope.createAdv = function(){
		submitJob();
	}
	
	
	$scope.nextWizard = function(){
		showLastTab();
		
		$('#pills-tab li:last-child a').tab('show');
	}
	
	$('#pills-tab a').on('click', function (e) {
		  e.preventDefault();
		  if($(this).hasClass("active")){
			  return;
		  }
		  
		  $(this).tab('show');
		  if($(this).prop("id") == "step1-tab"){
			  showPrevTab();
		  }
		  if($(this).prop("id") == "step2-tab"){
			  showLastTab();
		  }
		  
	});

	$scope.prevWizard = function(){
		
		showPrevTab();
		
		$('#pills-tab li:first-child a').tab('show');
	}
	
	function showLastTab(){
		var next = $scope.currentWizardIndex + 1;
		
		$(".wizard-item" + $scope.currentWizardIndex).slideUp();
		$(".wizard-item" + next).slideDown();
		
		$scope.currentWizardIndex = next;
		
		setToNavColor();
		
		if($scope.currentWizardIndex == 2){
			$(".nav-button-set .next").hide();
			$(".nav-button-set .buttonapply").show();
			$(".nav-button-set .apply-condition").show();
		}
		if($scope.currentWizardIndex > 1){
			$(".nav-button-set .prev").show();
			$(".nav-button-set .cancel").hide();
		}

	}

	function showPrevTab(){
		var next = $scope.currentWizardIndex - 1;
		
		$(".wizard-item" + $scope.currentWizardIndex).slideUp();
		$(".wizard-item" + next).slideDown();
		
		$scope.currentWizardIndex = next;
		
		setToNavColor();
		
		$(".nav-button-set .buttonapply").hide();
		$(".nav-button-set .apply-condition").hide();
		
		if($scope.currentWizardIndex == 1){
			$(".nav-button-set .prev").hide();
			$(".nav-button-set .cancel").show();
		}
		if($scope.currentWizardIndex < 3){
			$(".nav-button-set .next").show();
		}
		
	}

	$("input.calender-icon[name='expiredate']").datepicker({
	        format: "dd.mm.yyyy",
	        language: "de",
	        autoclose: true,
	        todayHighlight: true,
	    });

	$(".wizard-item2").hide();
	$(".wizard-item3").hide();
	$(".nav-button-set .prev").hide();
	$(".nav-button-set .buttonapply").hide();
	$(".nav-button-set .apply-condition").hide();
	
	setToNavColor();	
	
	//$(".add-text-item.skill-text-item").autocomplete({source: allskils});
	
	function setToNavColor()
	{
		var navitem = $(".top-wizard-nave .nav-item")[$scope.currentWizardIndex - 1];
		$(".top-wizard-nave .nav-item").css("color" , "#dddddd");
		$(navitem).css("color" , "black");	
	}
	
	$("span.check").click(function(){
		$(this).prev().click();
	});

	$("span.checkone").click(function(){
		
		$(this).prev().prev().click();
	});


	function submitJob()
	{
		var jobPos = angular.copy($scope.jobposition);
		
		for(obj in jobPos){
			if(typeof jobPos[obj] == "string"){
				jobPos[obj] = $.trim(jobPos[obj]);
			}
		}
		
		jobPos.branch = new Number(jobPos.branch);
		jobPos.worktype = new Number(jobPos.worktype);

		if($("#checkcondition").length == 1 &&  $("#checkcondition:checked").length == 0){
			alert(condition_msg);
			return;
		}
		
		if(checkIsNullOrEmpty(jobPos.title)){
			alert(title_msg);
			return;
		}
		
		if(checkIsNullOrEmpty(jobPos.country)){
			alert(country_msg);
			return;
		}
		
		if(checkIsNullOrEmpty(jobPos.city)){
			alert(city_msg);
			return;
		}
		
		if(checkIsNullOrEmpty(jobPos.postcode)){
			alert(postcode_msg);
			return;
		}
		
		if(checkIsNullOrEmpty(jobPos.comments)){
			//alert(comment_msg);
			//return;
		}
		
		if(checkIsNullOrZero(jobPos.vacancy)){
			alert(vacancy_msg);
			return;
		}
		
		if(checkIsNullOrZero(jobPos.branch)){
			alert(branch_msg);
			return;
		}

		if(checkIsNullOrZero(jobPos.worktype)){
			alert(worktype_msg);
			return;
		}
		
		if(checkIsNullOrEmpty(jobPos.jobStartMonth) || checkIsNullOrEmpty(jobPos.jobStartYear) || checkIsNullOrZero(jobPos.duration)){
			alert(jobdate_msg);
			return;
		}
		
		if(checkIsNullOrZero(jobPos.jobStartMonth) || checkIsNullOrZero(jobPos.jobStartYear)){
			alert(jobdate_msg);
			return;
		}
		
		if(checkIsNullOrEmpty(jobPos.expiredate)){
			alert(expire_msg);
			return;
		}
		
		if(jobPos.skillList.length === 0){
			alert(skill_msg);
			return;
		}
		
		if(jobPos.taskList.length === 0){
			alert(task_msg);
			return;
		}

		
		$http({
	        method : "POST",
	        headers: {
	        	'Content-type': 'application/json; charset=UTF-8',
	        },
	        url : advsaveurl,
	        data : jobPos
	    }).then(function successCallback(response) {
	    	if(response.data.msg === 'ok'){
	    		window.location = advlisturl;
	    	}
	    	
	    }, function errorCallback(response) {
	        
	        alert("error:\n\n" +  response);
	        $scope.debug = response;
	        //$scope.test = response.data;
	    });
	}	
	
}]);






