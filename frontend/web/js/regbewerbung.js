
$(document).ready(function(){
	
	$.datepicker.setDefaults($.datepicker.regional["de"]);
	$("input[name='UsersBase[bdate]']").datepicker({
	      changeMonth: true,
	      changeYear: true,
	      
	    });
	
	
	
	$("span.check").click(function(){
		$(this).prev().click();
	});

	$("span.checkone").click(function(){
		
		$(this).prev().prev().click();
	});
	
	$("input[name='CandidateBase[jobtype]']").change(function(){
		if($("input[name='CandidateBase[jobtype]']:checked").length > 0){
			$(".skillitem").remove();
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
	});
	
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
	
	$("#addskill").click(function(){
		var text = $.trim($("#skillbrowstext").val());
		
		if(text != ""){
		
			for(var i=0; i<skills_title.length ; i++ )
			{
				if(text.toLowerCase() == skills_title[i].toLowerCase()){
					text = skills_title[i];
					break;
				}
			}
			
			var exists = false;
			$("#skills .skillitemtext").each(function(index , item){
				if($(item).html() == text){
					alert(skill_exists_msg);
					exists = true;
					return;
				}
			});
			
			if(exists) return;
			$("#skillbrowser").fadeOut();
			
			add_skill(text);
		}
		
	});
	
	$("input[type='file']").change(function(){
		$(this).parent().next().html($(this).val());
	});
	
	$("input[name='UsersBase[fname]']").focus();
});

function add_skill(title)
{
	$("<div class='skillitem'><input type='hidden' value='" + title + "' name='skills[]' /><span class='skillitemtext'>" + title + "</span><span class='removeskill' onclick='removeskill(this);'></span></div>").appendTo($("#skills"));
}

function submitregister()
{
		
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
