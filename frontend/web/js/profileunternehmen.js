
var photo_file = false;

brainApp.service('companyFileUpload', ['$http',  function($http) {
		    
	this.uploadFileToUrl = function(file, part_name , jForm, $scope) {
		
		
		
	   var formData = new FormData();
	   formData.append(part_name, file);
	   formData.append('MAX_FILE_SIZE', 2242880);
	   formData.append('part', part_name);
	   formData.append('_csrf-frontend', jForm.children("input[name='_csrf-frontend']").val());
	
	   
	   $http.post(jForm.attr("action"), formData, {
	  transformRequest: angular.identity,
	  headers: {'Content-Type': undefined}
	   }).then(function(response){
         // success callback
		   $scope.loadingshow = false;
		   
		   if(response.data == 'ok'){
				window.location = window.location;
			}
			else{
				alert("Error : " + response.data);
			}
		   
       }, 
       function(response){
         // failure callback
    	   $scope.loadingshow = false;
       });
	   
	   
	};
}]);


brainApp.controller('CompanyContentController', ['$scope', '$http', '$element', '$sce', 'companyFileUpload', '$httpParamSerializerJQLike', function ($scope, $http, $element, $sce, companyFileUpload, $httpParamSerializerJQLike) {

	$scope.hasSdp = hasSdp;
	
    $scope.$watch('hasSdp', function() {
        if($scope.hasSdp == true){
        	
            setTimeout(() => {
            	$("input[name='UsersBaseSV[bdate]']").datepicker({
        	        format: "dd.mm.yyyy",
        	        language: "de",
        	        autoclose: true,
        	        todayHighlight: true,
                });
    		}, 500);
        	
        }
    });
    

    
	$("input.calender-icon").datepicker({
        format: "dd.mm.yyyy",
        language: "de",
        autoclose: true,
        todayHighlight: true,  
	});
	
	$(".hideedit").hide();
	$(".applyedit").hide();
	$("#newcompany").hide();
	
	$("span.check").click(function(){
		$(this).prev().click();
	});

	$("span.checkone").click(function(){
		
		$(this).prev().prev().click();
	});



    $(".imgopen").click(function () {

        $(".register-bewerbung-teil").each(function (index, item) {
            toggle_profile_item(false, $(item));

        });

        toggle_profile_item(true, $(this).parent().parent());
    });

    $(".imgclose").click(function () {

        toggle_profile_item(false, $(this).parent().parent());
    });
	
	$(".showedit").click(function(){
		
		toggle_profile_item_edit(true , $(this).parent().parent().parent());		
	});
	
	$(".hideedit").click(function(){
		
		toggle_profile_item_edit(false , $(this).parent().parent().parent());
	});
	
	$("input[name='candidate_photo']").change(function () {
		  //sendFile(this.files[0]);
		photo_file = this.files[0];
	});
	
	$(".applyedit").click(function(){
		
		if($(this).parent().parent().children(".items-edit").length > 0){
			if($(this).parent().parent().children(".items-edit").children("form").length > 0){
				var form = $(this).parent().parent().children(".items-edit").children("form");
				var p = $(this).parent().parent();
				var data = form.serialize();
				
				//alert(form.attr("action"));
				var part = form.children("input[name='part']").val();

				if( part == "company"){

					if($("input[name='CompanyBase[companyname]']").val() == ""){
						alert(company_name_msg);
						$("input[name='CompanyBase[companyname]']").focus();
						return;		
					}
					
					if($("input[name='CompanyBase[founddate]']").val() == ""){
						alert(company_bdate_msg);
						$("input[name='CompanyBase[founddate]']").focus();
						return;		
					}
					
					if($("input[name='CompanyBase[taxid]']").val() == ""){
						
						alert(company_taxid_msg);
						$("input[name='CompanyBase[taxid]']").focus();
						return;		
					}
				}
				
				if( part == "person"){

					//data += "&candidate_photo=" + $("input[name='candidate_photo']").val();
					//alert(photo_file);
				}
				
				if( part == "contact"){
					

					if($("input[name='PersonaldecisionmakerBase[title]']:checked").length == 0){
						alert(anrede_msg);
						return;								
					}
					
					if($("input[name='UsersBase[fname]']").val() == ""){
						alert(fname_msg);
						$("input[name='UsersBase[fname]']").focus();
						return;		
					}
					
					if($("input[name='UsersBase[lname]']").val() == ""){
						alert(lname_msg);
						$("input[name='UsersBase[lname]']").focus();
						return;		
					}
					
					if($("input[name='UsersBase[bdate]']").val() == ""){
						alert(bdate_msg);
						$("input[name='UsersBase[bdate]']").focus();
						return;		
					}

					if(!validateEmail($("input[name='UsersBase[uname]").val()))
					{
						alert(email_invalid_msg);
						$("input[name='UsersBase[uname]").focus();
						return;
					}	
					
					if($("#stellvertreter0:checked").length == 1)
					{
						
						if($("input[name='PersonaldecisionmakerBaseSV[title]']:checked").length == 0){
							alert(anrede_sv_msg);
							return;								
						}
						
						if($("input[name='UsersBaseSV[fname]']").val() == ""){
							alert(fname_sv_msg);
							$("input[name='UsersBaseSV[fname]']").focus();
							return;		
						}
						
						if($("input[name='UsersBaseSV[lname]']").val() == ""){
							$("input[name='UsersBaseSV[lname]']").focus();
							alert(lname_sv_msg);
							return;		
						}
						
						if($("input[name='UsersBaseSV[bdate]']").val() == ""){
							alert(bdate_sv_msg);
							$("input[name='UsersBaseSV[bdate]']").focus();
							return;		
						}

						if(!validateEmail($("input[name='UsersBaseSV[uname]").val()))
						{
							alert(email_sv_invalid_msg);
							$("input[name='UsersBaseSV[uname]").focus();
							return;
						}	
						

					}					
				}
					
				
				$.post(form.attr("action") , data , function(idata){
					//alert(data);
					if(idata == 'ok'){
						if( part == "company"){
							if(typeof $scope.company_logo != "undefined"){
								companyFileUpload.uploadFileToUrl($scope.company_logo, 'company_logo', form, $scope);	  
								return;
							}

							//upload_files('company_logo' , 'company_logo' , form);
						}
						else {
							window.location = window.location;
						}
						
						
						
						
					}
					else{
						alert("Error : " + idata);
					}
					
		
				}).fail(function( jqXHR, textStatus, errorThrown){
					alert("error!  " + jqXHR.responseText )
				});
			}
		}
		//alert($(this).parent().parent().children(".items-edit").children("form").html());		
	});
	

	$("#available_0 , #available_1").change(function(){
		
		if($("#available_1:checked").length == 0)
		{
			$("#availability_date_li").remove();
		}
		if($("#available_1:checked").length == 1)
		{
			//alert(12345);
			//alert($("#available_1").parent().parent().html());
			var ulo = $("#available_1").parent().parent();
			$(availe_date_row).appendTo(ulo);
			$("input[name='CandidateBase[availablefrom]']").datepicker({
			        format: "dd.mm.yyyy",
			        language: "de",
			        autoclose: true,
			        todayHighlight: true,
			});
		}
	});
	
	$("input[name='CandidateBase[jobtype]']").change(function(){
		$(".skillitem").remove();
		load_skills_autocompelete();
	});
	load_skills_autocompelete();
	
	$("#skills .brows-button").click(function(){
		$("#clearskillbrows").hide();
		$("#addskill").attr("disabled", "disabled");
		$("#skillbrowser").css("top" , $(window).scrollTop());
		$("#skillbrowser").fadeIn();
		$("#skillbrowstext").val("");
		$("#skillbrowstext").focus();
	});

	$("#skillbrowser").hide();

	$("#skillbrowstext").keypress(function(){
		if($("#skillbrowstext").val() == ""){
			$("#clearskillbrows").hide();
			$("#addskill").attr("disabled", "disabled");
		}
		else{
			$("#clearskillbrows").show();
			$("#addskill").removeAttr("disabled");
		}
	});
	
	$("#skillbrowstext").keyup(function(){
		if($("#skillbrowstext").val() == ""){
			$("#clearskillbrows").hide();
			$("#addskill").attr("disabled", "disabled");
		}
		else{
			$("#clearskillbrows").show();
			$("#addskill").removeAttr("disabled");
		}
	});
	
	$("#clearskillbrows").click(function(){
		$("#skillbrowstext").val("");
		$("#addskill").attr("disabled", "disabled");
		$("#skillbrowstext").focus();
	});
	
	$("#closeskillbrows").click(function(){
		$("#skillbrowser").fadeOut();
	});
	
	$("input[type='file']").change(function(){
		$(this).parent().next().html($(this).val());
	});


	
	$("#skills .brows-button").click(function(){
		$("#clearskillbrows").hide();
		$("#addskill").attr("disabled", "disabled");
		$("#newcompany").css("top" , $(window).scrollTop());
		$("#newcompany").fadeIn();
		$("#skillbrowstext").val("");
		$("#skillbrowstext").focus();
	});
	
	$("#addskill").click(function(){
		var company = $.trim($("#skillbrowstext").val());
		
		add_skill(company);
		
		$("#skillbrowstext").val("");
	});
	
	$("#closeskillbrows").click(function(){
		$("#newcompany").fadeOut();
	});
	
	$("#stellvertreter0").change();
	$("input[name='UsersBase[fname]']").focus();
	
}]);



function add_skill(title)
{
	
	$("<div class='skillitem'><input type='hidden' value='" + title + "' name='connectedcompanies[]' /><span class='skillitemtext'>" + title + "</span><span class='removeskill' onclick='removeskill(this);'></span></div>").appendTo($("#skills"));
}

function load_skills_autocompelete()
{
	if($("input[name='CandidateBase[jobtype]']:checked").length > 0){
		
		if($(".skillpart").hasClass("nodisplay")){
			$(".skillpart").slideDown("fast");
			$(".skillpart").removeClass("nodisplay");
		}
		//alert(skillurl + "?jt=" + $("input[name='CandidateBase[jobtype]']:checked").val());
		$.getScript(skillurl + "?jt=" + $("input[name='CandidateBase[jobtype]']:checked").val() , function(data){
			
			$("#skillbrowstext").autocomplete({
			      source: skills_title
			    });

		});
	}	
}

function upload_files(fileId , part_name , jForm)
{
	var fileSelect = document.getElementById(fileId); 
	var files = fileSelect.files
	
	if(files.length > 0){
		
		var formData = new FormData();
		formData.append(fileId, files[0], files[0].name);
		formData.append('MAX_FILE_SIZE', 2242880);
		formData.append('part', part_name);
		formData.append('_csrf-frontend', jForm.children("input[name='_csrf-frontend']").val());

		$.ajax({
			url: jForm.attr("action"),
			type: "POST",
			data: formData,
			contentType: false,
			cache: false,
			processData:false,
			success: function(idata)
			{
				if(idata == 'ok'){
					window.location = window.location;
				}
				else{
					alert("Error : " + idata);
				}
			}
		});
		
	}
	else {
		window.location = window.location;
	}	
}

function submitregister()
{
	
	if($("input:checked[name='UsersBase[title]']").length == 0){
		alert(anrede_msg);
		return;
	}
		
	$("input[type='text']").each(function(index , item){
		$(item).val($.trim($(item).val()));
	});
	
	if($("input[name='UsersBase[fname]']").val() == ""){
		$("input[name='UsersBase[fname]']").focus();
		alert(fname_msg);
		return;		
	}
	
	if($("input[name='UsersBase[lname]']").val() == ""){
		$("input[name='UsersBase[lname]']").focus();
		alert(lname_msg);
		return;		
	}
	
	if($("input[name='UsersBase[bdate]']").val() == ""){
		
		alert(bdate_msg);
		return;		
	}
	
	if($("input[name='CandidateBase[email]']").val() == ""){
		$("input[name='CandidateBase[email]']").focus();
		alert(email_msg);
		return;		
	}
	
	if(!validateEmail($("input[name='CandidateBase[email]']").val()))
	{
		$("input[name='CandidateBase[email]']").focus();
		alert(email_invalid_msg);
		return;
	}
	
	if($("input:checked[name='CandidateBase[employment]']").length == 0){
		alert(curstatus_msg);
		return;
	}
		
	if($("input:checked[name='CandidateBase[availability]']").length == 0){
		alert(avail_msg);
		return;
	}
		
	if($("#checkcondition:checked").length == 0){
		alert(condition_msg);
		return;
	}
		
	$("#hdncheckmode").val("email_exists");
	$("#hdncheckdata").val($("input[name='CandidateBase[email]']").val());
		
	$.post($("#checkform").attr("action") , $("#checkform").serialize() , function(data){
		if(data != "no"){
			alert(email_exists_msg);
			$("input[name='CandidateBase[email]']").focus();
		}
		else {
			$("#registerform").submit();
		}
	});
	
	
	//$("#registerform").submit();
}

function clearregister()
{
	$("#registerform")[0].reset();
	$(".file_title").html("");
}

function removeskill(span)
{
	$(span).parent().remove();
}


function toggle_profile_item(show, item)
{
	if(!show){
		toggle_profile_item_edit(false , item);
		item.children(".register-bewerbung-teil-items-container").slideUp();
		item.children(".register-bewerbung-teil-title").children("img.imgopen").show();
		item.children(".register-bewerbung-teil-title").children("img.imgclose").hide();	
	}
	else {
		item.children(".register-bewerbung-teil-items-container").slideDown();
		item.children(".register-bewerbung-teil-title").children("img.imgopen").hide();
		item.children(".register-bewerbung-teil-title").children("img.imgclose").show();
	}
		
	
}

function toggle_profile_item_edit(show, item)
{
	
	if(show){
		item.children(".register-bewerbung-teil-items-container").children(".items-preview").fadeOut("fast" , function(){ 
			item.children(".register-bewerbung-teil-items-container").children(".items-edit").fadeIn("fast");
		});	
		
		item.children(".register-bewerbung-teil-items-container").children(".items-edit-preview-part").children(".showedit").fadeOut("fast" , function(){ 
			item.children(".register-bewerbung-teil-items-container").children(".items-edit-preview-part").children(".hideedit").fadeIn("fast");
			item.children(".register-bewerbung-teil-items-container").children(".items-edit-preview-part").children(".applyedit").fadeIn("fast");
		});	
	}
	else {
		item.children(".register-bewerbung-teil-items-container").children(".items-edit-preview-part").children(".applyedit").fadeOut("fast");
		item.children(".register-bewerbung-teil-items-container").children(".items-edit").fadeOut("fast" , function(){ 
			item.children(".register-bewerbung-teil-items-container").children(".items-preview").fadeIn("fast");
		});
		
		item.children(".register-bewerbung-teil-items-container").children(".items-edit-preview-part").children(".hideedit").fadeOut("fast" , function(){ 
			item.children(".register-bewerbung-teil-items-container").children(".items-edit-preview-part").children(".showedit").fadeIn("fast");
		});	
	}
		
	
}

