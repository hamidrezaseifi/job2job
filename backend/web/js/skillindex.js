
$(document).ready(function(){
	
	$("#dvdialog").hide();
	$("#dvdeleteskill").hide();
	
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

