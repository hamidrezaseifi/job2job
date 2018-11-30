
$(document).ready(function(){
	
	$('#dvtree').hide();
	
	$.get(rooturl + "listtree" , function(data){
		$("#dvtree").html(data);
		
			var jt = $('#dvtree').on('changed.jstree', function (e, data) {
				
			    var jid = data.selected[0];
			    var dt = data.instance.get_node(jid);
	
			    if(dt.li_attr.skillid == 0)
			    	return;
			    
			    var parentspath = "";
			    $(dt.parents).each(function(index , item){
			    	if(item != "#")
			    		parentspath = data.instance.get_node(item).text + "\\" + parentspath;
			    });
		    
		    parentspath += data.instance.get_node(jid).text;
		    //alert(parentspath + "   " + dt.li_attr.skillid);
		    $("#hdparent").val(dt.li_attr.skillid);
		    $("#txtparent").val(parentspath);
		    $("#dvtree").dialog("close");
		  }).jstree();
		});
});

function select_skill()
{
	$("#dvtree").dialog({title : "Select Parent Skill ..." , width : 400 , height : 600 , 
	modal : true, 	
	});

}