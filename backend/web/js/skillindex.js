
brainApp.controller('SkillsController', function ($scope, $http, $sce, $element) {

	$scope.showDisabled = true;
	$scope.showActived = true;

	$scope.selctedSkill = false;
	$scope.selctedSkillId = false;
	$scope.selctedSkillStatus = false;

	$scope.isStatusShowed = function(status){
		if(status == 0) {
			return $scope.showDisabled;
		}
		
		return $scope.showActived;
	};

	$scope.toggleShowed = function(status){
		if(status == 'all') {
			$scope.showDisabled = true;
			$scope.showActived = true;
		}

		if(status == 'inactive') {
			$scope.showDisabled = true;
			$scope.showActived = false;
		}

		if(status == 'active') {
			$scope.showDisabled = false;
			$scope.showActived = true;
		}
		
		//alert(status);
	};
	
	$scope.approveSkill = function(id){

		$http({
	        method : "GET",
	       
	        url : approveUrl + "?id=" + id,
	        data : $scope.query
	    }).then(function successCallback(response) {
	    	
	    	$("tr[data-skill='" + id + "'] td").removeClass('tree_status_lock');
	    	$("tr[data-skill='" + id + "'] td:first img.inactived").remove();
	    	$("tr[data-skill='" + id + "'] td a.approve").remove();
	    	$("tr[data-skill='" + id + "'] td.statustitle").html("Aktive");
	    	

	    }, function errorCallback(response) {
	        
	        alert("Fehler beim Genehmegien von Skill!");
	        //$scope.test = response.data;
	    });
		
	}
	
	$scope.editSkill = function(id, title, status){

		$scope.selctedSkill = title;
		$scope.selctedSkillId = id;
		$scope.selctedSkillStatus = status;

		$("#editSkillDialog").modal();
		
	}
	
	$scope.test = function(){

		return $("#skillform").serialize();
		
	}
	
	$scope.saveSelectedSkill = function(){

		var data = [];
		//data[$("#skillform input").attr('name')] = $("#skillform input").val();
		data['SkillsBase'] = {};
		data['SkillsBase']['title'] = $scope.selctedSkill;
		data['SkillsBase']['status'] = $scope.selctedSkillStatus;
		
		//data = [];
		//data[$("#skillform input").attr('name')] = $("#skillform input").val();
		//data['title'] = $scope.selctedSkill;
		//data['status'] = $scope.selctedSkillStatus;
		//data = "title=" + $scope.selctedSkill +"&status=" + $scope.selctedSkillStatus;
		
		data = new FormData();
		
		/*$http({
		    method: 'POST',
		    url: updateUrl + "?id=" + $scope.selctedSkillId,
		    data: $.param({SkillsBase: {title: $scope.selctedSkill, status: $scope.selctedSkillStatus}}), //JSON.stringify(data), //$.param({SkillsBase: data}),
		    headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
		});*/
		
		$http({
	        method : "POST",
	        headers: {
	        	'Content-type': 'application/x-www-form-urlencoded; charset=UTF-8',
	        },
	        url : updateUrl + "?id=" + $scope.selctedSkillId ,
	        data : $.param({SkillsBase: {title: $scope.selctedSkill, status: $scope.selctedSkillStatus}})
	    }).then(function successCallback(response) {
	    	
	    	$("#editSkillDialog").modal('hide');
	    	location.reload();

	    }, function errorCallback(response) {
	        
	        alert("Fehler beim Speichern von Skill!");
	    });
		
		
		
	}
	
	$('#editSkillDialog').on('shown.bs.modal', function (e) {
		$('#editSkillInput').focus();
	})
	
});

function edit_skill(id)
{
	
	$("#dvdialog").load(rooturl + "/update?id=" + id + "&partial=1" , function(data){
		$("#dvdialog").dialog({ title: global_messages["edit skill"] + " ..." , width : 500 , height : 400, modal : true, 
			open : function(){
				$("#skillsbase-title").focus();
			},  });
	});
}

function delete_skill(id)
{
	$("#dvdeleteskill").dialog({ title: global_messages["delete skill"] + " ..." , width : 500 , height : 150, modal : true,  
		buttons:[
				{
					 text : ' ' + global_messages["cancel"],
					 icons : {
					        primary: "button_cancel"
					      },
					 click: function() {
					        $( this ).dialog( "close" );
					      }
				},
		         {
		        	 text : ' ' + global_messages["ok"],
		        	 icons : {
		        	        primary: "button_ok"
		        	      },
		        	 click: function() {
		        		 do_delete_skill(id);
		        	        $( this ).dialog( "close" );
		        	      }
		         },
		         
		         ],
	});
}

function add_sub_skill(id)
{
	$("#dvdialog").load(rooturl + "/create?pid=" + id + "&partial=1" , function(data){
		$("#dvdialog").dialog({ title: "Edit Skill ..." , width : 500 , height : 400, modal : true, 
			open : function(){
				$("#skillsbase-title").focus();
			},});
	});

}

function enable_skill(id)
{
	alert("enable " + id);

}

function disable_skill(id)
{
	alert("disable " + id);

}

function do_edit_skill(id)
{
	$("#skillsbase-title").val($.trim($("#skillsbase-title").val()));
	
	var postdata = $("#frmskill").serialize();
	$.post(rooturl + "update?id=" + id + "&partial=1" , postdata , function(data){ 
		if(data == "ok")
		{
			window.location = rooturl;
		}
		
	});
	
	return false;
}

function do_insert_skill()
{
	$("#skillsbase-title").val($.trim($("#skillsbase-title").val()));
	
	var postdata = $("#frmskill").serialize();
	
	$.post(rooturl + "create?partial=1" , postdata , function(data){ 
		if(data == "ok")
		{
			window.location = rooturl;
		}
		
	});
	
	
	
	
	return false;
}

function do_delete_skill(id)
{
	
	$("#hdndeleteid").val(id);
	$("#frmdeleteskill").submit();
	
	return false;
}

