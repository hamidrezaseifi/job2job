
$(document).ready(function(){
	
	$.datepicker.setDefaults($.datepicker.regional["de"]);
	$("input[name='CompanyBase[founddate]']").datepicker({
	      changeMonth: true,
	      changeYear: true,
	      
	    });
	
	
	
	$("span.check").click(function(){
		$(this).prev().click();
	});

	$("span.checkone").click(function(){
		
		$(this).prev().prev().click();
	});
	
	$("input[name='CompanyBase[companyname]']").focus();
});

function submitverify()
{
		
	$("input[type='text']").each(function(index , item){
		$(item).val($.trim($(item).val()));
		
		//if(item.verify())
	});
	
	if($("input[name='CompanyBase[companyname]']").val() == ""){
		alert(company_name_msg);
		$("input[name='UsersBase[fname]']").focus();
		return;		
	}
	
	if($("input[name='CompanyBase[founddate]']").val() == ""){
		alert(bdate_msg);
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
	
	if($("input[name='UsersBase[uname]']").val() == ""){
		alert(email_msg);
		$("input[name='UsersBase[uname]']").focus();
		return;		
	}
	
	if(!validateEmail($("input[name='UsersBase[uname]']").val()))
	{
		alert(email_invalid_msg);
		$("input[name='UsersBase[uname]']").focus();
		return;
	}
	
	if($("#password").val() == ""){
		$("#password").focus();
		alert(password_format_msg);
		return;		
	}
	
	if($("#confirm_password").val() == ""){
		$("#confirm_password").focus();
		alert(password_format_msg);
		return;		
	}
	
	if(!$("#password")[0].checkValidity()){
		$("#password").focus();
		alert(password_format_msg);
		return false;
	}
	
	if(!$("#confirm_password")[0].checkValidity()){
		$("#confirm_password").focus();
		alert(password_format_msg);
		return false;
	}
	
	if($("#password").val() != $("#confirm_password").val()){
		$("#password").focus();
		alert(password_confirm_msg);
		return;		
	}

	$("#hdncheckmode").val("email_exists");
	$("#hdncheckdata").val($("input[name='UsersBase[uname]']").val());
		
	$.post($("#checkform").attr("action") , $("#checkform").serialize() , function(data){
		if(data != "no"){
			alert(email_exists_msg);
			alert(data);
			$("input[name='UsersBase[uname]']").focus();
		}
		else {
			$("#btnsubmit").click();
			//$("#verifyform").submit();
			//alert(11111);btnsubmit
		}
	});
	
	
}





