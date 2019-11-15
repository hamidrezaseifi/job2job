
$(document).ready(function(){
		
	
	$("input[name='UsersBase[bdate]']").datepicker({
        format: "dd.mm.yyyy",
        language: "de",
        autoclose: true,
        todayHighlight: true,
        endDate: new Date(),
    });
	
	
	$("span.check").click(function(){
		$(this).prev().click();
	});

	$("span.checkone").click(function(){
		
		$(this).prev().prev().click();
	});

	$("input[name='UsersBase[fname]']").focus();
});

function add_skill(title)
{
	$("<div class='skillitem'><input type='hidden' value='" + title + "' name='skills[]' /><span class='skillitemtext'>" + title + "</span><span class='removeskill' onclick='removeskill(this);'></span></div>").appendTo($("#skills"));
}

function submitverify()
{
		
	$("input[type='text']").each(function(index , item){
		$(item).val($.trim($(item).val()));
		
		//if(item.verify())
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

	$("#hdncheckmode").val("email_exists");
	$("#hdncheckdata").val($("input[name='CandidateBase[email]']").val());
		
	$.post($("#checkform").attr("action") , $("#checkform").serialize() , function(data){
		if(data != "no"){
			alert(email_exists_msg);
			alert(data);
			$("input[name='CandidateBase[email]']").focus();
		}
		else {
			$("#btnsubmit").click();
			//$("#verifyform").submit();
			//alert(11111);btnsubmit
		}
	});
	
	
}





