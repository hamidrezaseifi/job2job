
brainApp.controller('NewAdvController', ['$scope', '$http', '$sce', '$element', function ($scope, $http, $sce, $element) {

	$scope.currentWizardIndex = 1;
	$scope.selectedTaskList = [];
	$scope.selectedSkillList = [];
	$scope.selectedVacance = -1;
	
	$scope.allskils = allskils;
	
	$scope.addTask = function(){
		var task = $(".add-text-item.task-text-item").val();
		$(".add-text-item.task-text-item").val("");
		task = $.trim(task);
		if(task === ""){
			return;
		}
		
		$scope.deleteTask(task);
		$scope.selectedTaskList.push(task);
	}
	
	$scope.deleteTask = function(task){
		var index = $scope.selectedTaskList.indexOf(task);
		if(index > -1){
			$scope.selectedTaskList.splice(index, 1);
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
		$scope.selectedSkillList.push(skill);
	}
	
	$scope.deleteSkill = function(skill){
		var index = $scope.selectedSkillList.indexOf(skill);
		if(index > -1){
			$scope.selectedSkillList.splice(index, 1);
		}
	}
	
	$scope.otherVacancySelected = function(){
		setTimeout(function(){ $(".other-vacancy").focus(); }, 300);
		
	}

	$.datepicker.setDefaults($.datepicker.regional["de"]);
	
	$("input.calender-icon[name='expiredate']").datepicker({
	      changeMonth: true,
	      changeYear: true,
	      minDate: "+5D", maxDate: "+1Y"
	    });

	$(".wizard-item2").hide();
	$(".wizard-item3").hide();
	$(".nav-button-set .prev").hide();
	$(".nav-button-set .buttonapply").hide();
	$(".nav-button-set .apply-condition").hide();
	
	
	$("span.check").click(function(){
		$(this).prev().click();
	});

	$("span.checkone").click(function(){
		
		$(this).prev().prev().click();
	});

	setToNavColor();

	$(".nav-button-set .next").click(function(){
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
	});

	$(".nav-button-set .prev").click(function(){
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
		
	});

	$(".nav-button-set .cancel").click(function(){
		window.location = advlisturl;
	});
	
	$(".nav-button-set .buttonapply").click(function(){

		submitJob();
	});
	
	$(".add-text-item.skill-text-item").autocomplete({source: allskils});
	
	function setToNavColor()
	{
		var navitem = $(".top-wizard-nave .nav-item")[$scope.currentWizardIndex - 1];
		$(".top-wizard-nave .nav-item").css("color" , "#dddddd");
		$(navitem).css("color" , "black");	
	}
	


	function submitJob()
	{
		
		$("div.content input[type='text']").each(function(index , item){
			$(item).val( $.trim($(item).val()) );
		});
		
		$("div.content input[type='number']").each(function(index , item){
			$(item).val( $.trim($(item).val()) );
			$(item).val( new Number($(item).val()) );
		});
		
		$("div.content textarea").each(function(index , item){
			$(item).val( $.trim($(item).val()) );
		});
		
		$("div.content input[name='jobduration']").val()
		
		if($("#checkcondition").length == 1 &&  $("#checkcondition:checked").length == 0){
			alert(condition_msg);
			return;
		}
		
		if($("div.content input[name='title']").val() == ""){
			alert(title_msg);
			return;
		}
		
		if($("div.content select[name='country']").val() == ""){
			alert(country_msg);
			return;
		}
		
		if($("div.content input[name='city']").val() == ""){
			alert(city_msg);
			return;
		}
		
		if($("div.content input[name='postcode']").val() == ""){
			alert(postcode_msg);
			return;
		}
		
		if($("div.content textarea[name='comments']").val() == ""){
			alert(comment_msg);
			return;
		}
		
		if($("div.content select[name='vacancy']").val() == ""){
			alert(vacancy_msg);
			return;
		}
		
		if($("div.content select[name='worktype']").val() == 0){
			alert(worktype_msg);
			return;
		}
		
		if($("div.content select[name='jobstart_month']").val() == 0 || $("div.content select[name='jobstart_year']").val() == 0 
				|| $("div.content input[name='jobduration']").val() == "" || $("div.content input[name='jobduration']").val() == 0 ){
			alert(jobdate_msg);
			return;
		}
		
		if($("div.content input[name='expiredate']").val() == ""){
			alert(expire_msg);
			return;
		}
		
		var selected_skills = "";
		$(".skillholder .item .text").each(function(index , item){
			selected_skills += $.trim($(item).html()) + ", ";
		});


		var jobstartdate = $("div.content select[name='jobstart_year']").val() + "-" + $("div.content select[name='jobstart_month']").val() + "-1";
		
		var formData = new FormData();
		formData.append("job", "true");
		formData.append('_csrf-frontend', $("#formnewadv").children("input[name='_csrf-frontend']").val());
		formData.append("JobpositionBase[title]", $("div.content input[name='title']").val());
		formData.append("JobpositionBase[country]", $("div.content input[name='country']").val());
		formData.append("JobpositionBase[city]", $("div.content input[name='city']").val());
		formData.append("JobpositionBase[postcode]", $("div.content input[name='postcode']").val());
		formData.append("JobpositionBase[comments]", $("div.content textarea[name='comments']").val());
		formData.append("JobpositionBase[expiredate]", $("div.content input[name='expiredate']").val());
		formData.append("JobpositionBase[vacancy]", $("div.content select[name='vacancy']").val());
		formData.append("JobpositionBase[worktype]", $("div.content select[name='worktype']").val());
		formData.append("JobpositionBase[jobstartdate]", jobstartdate);
		formData.append("JobpositionBase[duration]", $("div.content input[name='jobduration']").val());
		formData.append("JobpositionBase[duration]", $("div.content input[name='jobduration']").val());
		formData.append("JobpositionBase[extends]", $("div.content input[name='extends']:checked").length);
		formData.append("skills", selected_skills);

		$.ajax({
			url: $("#formnewadv").attr("action"),
			type: "POST",
			data: formData,
			contentType: false,
			cache: false,
			processData:false,
			success: function(idata)
			{
				if(idata == 'ok'){
					window.location = advlisturl;
				}
				else{
					alert("Error : " + idata);
				}
			}
		});
		
		
	}	
	
}]);






