




brainApp.controller('JobPosController', ['$scope', '$http', '$sce', '$element', function ($scope, $http, $sce, $element) {

	$.datepicker.setDefaults($.datepicker.regional["de"]);
	$scope.isJob2Job = isJob2Job;
	$scope.companyId = companyId;
	$scope.jobposition = {skillList:jobskills , taskList:jobtasks, };

	$scope.setJob2Job = function(isJ2J){
		$scope.isJob2Job = isJ2J;

	    $("#jobpositionbase-companyid").val($scope.isJob2Job ? job2JobId : $scope.companyId);
	    $("#jobpositionbase-company").html($scope.isJob2Job ? job2JobTitle : "");
	};

	$scope.browsCompany = function()
	{
		//$("#txtbrowscompany").prop("readonly" , false);
		//$("#txtbrowscompany").val("");
		//$(".listcontainer .list").html("");
		//$("#dvbrowscompany").dialog({modal: true, width: 300, height: 400, title: "Unternehmen-Liste ..."});
	};
	
	$scope.submitForm = function()
	{
		$("#jobposform").submit();
	};
	
	$("#dvbrowscompany").hide();

	$("#jobstartdate.calender-icon").datepicker({
	      changeMonth: true,
	      changeYear: true,
	      minDate: "0D"
	    });

	$("#expiredate.calender-icon").datepicker({
	      changeMonth: true,
	      changeYear: true,
	      minDate: "5D"
	    });
	
	$('#commentstext').froalaEditor({
	      toolbarButtons: ['bold', 'italic', 'underline', 'fontSize', '|', 'formatUL', 'formatOL', 'paragraphStyle', 
			        		'|', 'paragraphFormat', 'align', '|', 'insertHR', '|', 'undo', 'redo'],
	      toolbarButtonsXS: ['bold', 'italic' , 'underline'],
	      language: 'de',
	      theme: 'gray',
	      height: 150,
	    });

	
	$scope.enterSkillKeyboard = function(keyEvent) {
		  if (keyEvent.which === 13){
			  $scope.addSkill();
		  }
	}
	
	$scope.enterTaskKeyboard = function(keyEvent) {
		  if (keyEvent.which === 13){
			  $scope.addTask();
		  }
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
	
	$(".add-text-item.skill-text-item").autocomplete({source: allskils});
	
	
	function selectCompany(id, name)
	{
		$("#jobpositionbase-company").html(name);
		$("#jobpositionbase-companyid").val(id);
	}

	

	function clearCompany()
	{
		var txt = $("#companytext");
		var itemid = $("#companyid");
		var p = txt.parent();
		var remove = findRemoveBottun(txt);

		$("#jobpositionbase-companyid").val(0);
		$("#jobpositionbase-company").html("");
		
		$("a.remove").hide();
	}

	function findRemoveBottun(textObject)
	{
		var p = textObject.parent();
		return p.children("a.remove");	
	}

	function searchList(textinput)
	{
		var text = $.trim($(textinput).val());
		var div = $(textinput).parent().parent().parent();
		var form = $(textinput).parent();
		var listul = div.children(".listcontainer").children(".list");
		//alert(form.attr("action"));
		//return;
		listul.html("");
		if(text == "") return;
		
		$(textinput).prop("readonly" , true);
		$(".loading").show();
		$.get(form.attr("action") + "?name=" + text, function(data){ 
			listul.html(data);
			$(textinput).prop("readonly" , false);
			$(".loading").hide();
			if(listul.children("li").length > 0){
				listul.children("li").addClass("ui-widget-content");
				listul.selectable({selected: function( event, ui ) {
					var selid = $(ui.selected).data("id");
					var selname = $(ui.selected).html();
					$("#jobpositionbase-companyid").val(selid);
					$("#jobpositionbase-company").html(selname);
					$("a.remove").show();
					$("#dvbrowscompany").dialog("close");
				}});
			}
			
			$(textinput).focus();
		}).fail(function() {
			$(textinput).prop("readonly" , false);
			$(".loading").hide();
			listul.html("Netzwerk Fehler!");
		  });
	}	

}]);




