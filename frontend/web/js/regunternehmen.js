
$(document).ready(function(){

	$.datepicker.setDefaults($.datepicker.regional["de"]);
	
	$("span.check").click(function(){
		
		$(this).prev().click();
			//alert($(this).prev()[0]);
	});

	$("span.checkone").click(function(){
		
		$(this).prev().prev().click();
			//alert($(this).prev()[0]);
	});


	$("#stellvertreter0").change(function(){
		
		if($("#stellvertreter0:checked").length == 1)
		{
			$(".register-bewerbung-kontakt-teil").css("height" , 828);
			$(".stelcertreter").removeClass("nodisplay");
		}
		else{
			
			$(".register-bewerbung-kontakt-teil").css("height" , 448);
			$(".stelcertreter").removeClass("nodisplay").addClass("nodisplay");
		}
	});
	
	$("#skills .brows-button").click(function(){
		$("<div style='height:15px; border:1px solid black; margin-bottom: 3px; width:90px; float:left; margin-left:3px;'></div>").appendTo($("#skills"));
	});

	$("#stellvertreter0").change();
	$("input[name='UsersBase[fname]']").focus();
	
	
});

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
	
	if($("input[name='CompanyBase[companyname]']").val() == ""){
		$("input[name='CompanyBase[companyname]']").focus();
		alert(fmname_msg);
		return;		
	}
	
	if($("input[name='UsersBase[uname]']").val() == ""){
		$("input[name='UsersBase[uname]']").focus();
		alert(email_msg);
		return;		
	}
	
	if(!validateEmail($("input[name='UsersBase[uname]']").val()))
	{
		$("input[name='UsersBase[uname]']").focus();
		alert(email_invalid_msg);
		return;
	}
		
	if($("#checkcondition:checked").length == 0){
		alert(condition_msg);
		return;
	}
		
	$("#hdncheckmode").val("email_exists");
	$("#hdncheckdata").val($("input[name='UsersBase[uname]']").val());
		
	$.post($("#checkform").attr("action") , $("#checkform").serialize() , function(data){
		if(data != "no"){
			alert(email_exists_msg + " : " + data);
			$("input[name='UsersBase[uname]']").focus();
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

