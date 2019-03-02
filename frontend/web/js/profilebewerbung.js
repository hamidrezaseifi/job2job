
var photo_file = false;

brainApp.service('bewerberFileUpload', ['$http',  function($http) {
		    
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

brainApp.controller('CandidateContentController', ['$scope', '$http', '$element', '$sce', 'bewerberFileUpload', '$httpParamSerializerJQLike', function ($scope, $http, $element, $sce, bewerberFileUpload, $httpParamSerializerJQLike) {

    $scope.showskillbrower = false;
    $scope.loadingshow = true;
    $scope.workPermissionValue = workPermissionValue + "" ;
    
    $scope.$watch('workPermissionValue', function() {
        if($scope.workPermissionValue == 2){
        	
            setTimeout(() => {
            	$("#workpermissionlimit").datepicker({
                    changeMonth: true,
                    changeYear: true,
                    minDate: "6M", maxDate: "10Y",
                });
    		}, 1000);
        	
        }
    });
    
    
    $scope.addskill = function () {
        var text = $.trim($("#skillbrowstext").val());

        if (text != "") {

            for (var i = 0; i < skills_title.length; i++) {
                if (text.toLowerCase() == skills_title[i].toLowerCase()) {
                    text = skills_title[i];
                    break;
                }
            }

            var exists = false;
            $("#skills .skillitemtext").each(function (index, item) {
                if ($(item).html() == text) {
                    alert(skill_exists_msg);
                    exists = true;
                    return;
                }
            });

            if (exists) return;

            add_skill(text, true);
        }

    };
    
    $.datepicker.setDefaults($.datepicker.regional["de"]);
    $("input[name='UsersBase[bdate]']").datepicker({
        changeMonth: true,
        changeYear: true,
        minDate: "-100Y", maxDate: 2,
    });
    
    $(".hideedit").hide();
    $(".applyedit").hide();

    $("span.check").click(function () {
        $(this).prev().click();
    });

    $("span.checkone").click(function () {

        $(this).prev().prev().click();
    });


    $(".open-close-button").click(function () {

        var stat = $(this).parent().data("status");

        if (stat == "close" || stat == undefined) {

            $(".register-bewerbung-teil").each(function (index, item) {
                if ($(item).data("status") == "open") {
                    toggle_profile_item(false, $(item));
                }

            });

            toggle_profile_item(true, $(this).parent());

        }
        else {

            toggle_profile_item(false, $(this).parent());
        }
    });

    $(".showedit").click(function () {
        toggle_profile_item_edit(true, $(this).parent().parent().parent());
        
        
    });

    $(".hideedit").click(function () {
        toggle_profile_item_edit(false, $(this).parent().parent().parent());
    });

    $("input[name='candidate_photo']").change(function () {
        //sendFile(this.files[0]);
        photo_file = this.files[0];
    });

    $(".applyedit").click(function () {

        if ($(this).parent().parent().children(".items-edit").length > 0) {
            if ($(this).parent().parent().children(".items-edit").children("form").length > 0) {
                var form = $(this).parent().parent().children(".items-edit").children("form");
                var p = $(this).parent().parent();
                var data = form.serialize();
                var dataAr = form.serializeArray();

                var part = form.children("input[name='part']").val();

                if (part == "person") {

                    if ($("input[name='UsersBase[fname]']").val() == "") {
                        $("input[name='UsersBase[fname]']").focus();
                        alert(fname_msg);
                        return;
                    }

                    if ($("input[name='UsersBase[lname]']").val() == "") {
                        $("input[name='UsersBase[lname]']").focus();
                        alert(lname_msg);
                        return;
                    }

                    if ($("input[name='UsersBase[bdate]']").val() == "") {

                        alert(bdate_msg);
                        return;
                    }

                    if ($("input[name='CandidateBase[workpermission]']:checked").length == 1 && $("input[name='CandidateBase[workpermissionlimit]']").val() == "") {

                        alert(workpermission_limit_msg);
                        $("input[name='CandidateBase[workpermissionlimit]']").focus();
                        return;
                    }

                    //data += "&candidate_photo=" + $("input[name='candidate_photo']").val();
                    //alert(photo_file);
                }
                $scope.loadingshow = true;
                
                if (part == "contact") {
                    if (!validateEmail($("input[name='CandidateBase[email]']").val())) {
                        $("input[name='CandidateBase[email]']").focus();
                        $scope.loadingshow = false;
                        alert(email_invalid_msg);
                        return;
                    }
                }
         	   
                //alert(dataAr.length);
                var formData = new FormData();
         	   
                for (var idx in dataAr) {
                	formData.append(dataAr[idx].name, dataAr[idx].value);
                }
                //data = str.join("&");
                //alert(formData);
                //alert(dataAr[0].name + " = " + dataAr[0].value);
                
                $http.post(form.attr("action"), formData, {
              	  transformRequest: angular.identity,
              	  headers: {'Content-Type': undefined}
              	   }).then(function(response){
                       // success callback
              		   $scope.loadingshow = false;
              		   
              		 if(response.data == 'ok'){
              			
            			  if (part == "person") {
                         	
            				  if(typeof $scope.candidate_photo != "undefined"){
            					  bewerberFileUpload.uploadFileToUrl($scope.candidate_photo, 'candidate_photo', form, $scope);	  
            					  return;
            				  }
                         	
                         }
                         else {
                             if (part == "job-cover") {
                            	 if(typeof $scope.candidate_doc != "undefined"){
                            		 bewerberFileUpload.uploadFileToUrl($scope.candidate_doc, 'candidate_doc', form, $scope);
                            		 return;
                            	 }
                             }
                             else {
                                 window.location = window.location;
                             }
                         }
            			 $scope.loadingshow = false;
            			 window.location = window.location;
            			}
            			else{
            				alert("Error : " + response.data);
            				$scope.loadingshow = false;
            			}
              		   
                     }, 
                     function(response){
                       // failure callback
                  	   $scope.loadingshow = false;
                     });
                
                               
         	   
            }
        }
        //alert($(this).parent().parent().children(".items-edit").children("form").html());		
    });


    $("#available_Aktuell_nicht_verfügber , #available_Verfügber").change(function () {

        if ($("#available_Verfügber:checked").length == 0) {
            $("#availability_date_li").remove();
        }
        else {
            if ($("#availability_date_li").length == 0) {
                var ulo = $("#available_Verfügber").parent().parent();
                $(availe_date_row).appendTo(ulo);
                $("input[name='CandidateBase[availablefrom]']").datepicker({
                    changeMonth: true,
                    changeYear: true,
                    minDate: 0, maxDate: "+5Y"
                });
            }
        }
    });

    $("input[name='CandidateBase[jobtype]']").change(function () {
        $(".skillitem").remove();
        load_skills_autocompelete();
    });
    load_skills_autocompelete();

    $scope.browsskills = function () {
        
        $("#clearskillbrows").hide();
        $("#addskill").attr("disabled", "disabled");
        $("#skillbrowser").css("top", $(window).scrollTop());
        $scope.showskillbrower = true;
        $("#skillbrowstext").val("");
        $("#skillbrowstext").focus();
    };

    //$("#skillbrowser").hide();

    $("#skillbrowstext").keypress(function () {
        if ($("#skillbrowstext").val() == "") {
            $("#clearskillbrows").hide();
            $("#addskill").attr("disabled", "disabled");
        }
        else {
            $("#clearskillbrows").show();
            $("#addskill").removeAttr("disabled");
        }
    });

    $("#skillbrowstext").keyup(function () {
        if ($("#skillbrowstext").val() == "") {
            $("#clearskillbrows").hide();
            $("#addskill").attr("disabled", "disabled");
        }
        else {
            $("#clearskillbrows").show();
            $("#addskill").removeAttr("disabled");
        }
    });

    $("#clearskillbrows").click(function () {
        $("#skillbrowstext").val("");
        $("#addskill").attr("disabled", "disabled");
        $("#skillbrowstext").focus();
    });

    $("input[type='file']").change(function () {
        $(this).parent().next().html($(this).val());
    });

    $("#available_Aktuell_nicht_verfügber , #available_Verfügber").change();

    $("input[name='UsersBase[fname]']").focus();

}]);


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

function add_skill(title, clear)
{
	
	$("<div class='skillitem'><input type='hidden' value='" + title + "' name='skills[]' /><span class='skillitemtext'>" + title + "</span><span class='removeskill' onclick='removeskill(this);'></span></div>").appendTo($("#skills"));
	
	if(clear){
		$("#skillbrowstext").val("");	
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
		item.data("status" , "close");
		
		item.children(".open-close-button").children("img.imgopen").show();
		item.children(".open-close-button").children("img.imgclose").hide();	
	}
	else {
		item.children(".register-bewerbung-teil-items-container").slideDown();
		item.data("status" , "open");
		item.children(".open-close-button").children("img.imgopen").hide();
		item.children(".open-close-button").children("img.imgclose").show();
	}
		
	
}

function toggle_profile_item_edit(show, item)
{
	
	if(show){
		item.children(".register-bewerbung-teil-items-container").children(".items-preview").fadeOut("fast" , function(){ 
			item.children(".register-bewerbung-teil-items-container").children(".items-edit").fadeIn("fast", function(){
			});
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

