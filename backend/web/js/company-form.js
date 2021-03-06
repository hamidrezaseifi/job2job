
$(document).ready(function(){
	
	$("#dvbrowspdt").hide();

	$.datepicker.setDefaults($.datepicker.regional["de"]);
	$("input.calender-icon").datepicker({
	      changeMonth: true,
	      changeYear: true,
	      maxDate: "0D"
	    });

	$("#deleteconnectedcompany").hide();
	$("#newconcompany").hide();

	$("#addconnectedcompany").click(function(){
		$("#newconcompany").dialog({
			width: 350, height: 170, modal: true, title: "Verbundene Unternehmen",
			buttons: [
			          {
				          text: "Addieren",
				          //class: "glyphicon-plus",
				          click: function(){
						  		var comname = $.trim($("#concompanyname").val());
						  		$("#concompanyname").val("");
						  		if(comname != ""){
									var item = $('<li class="ui-state-default">' + comname + '<input type="hidden" name="connectedcompanies[]" value="' + comname + '" /></li>').appendTo($("#connectedcompanylist"));
									
						  			$("#newconcompany").dialog("close");
							  	}
					      }
				      }
			],
			open: function(){
				$("#concompanyname").focus();
			}
		});
	});

	$("#deleteconnectedcompany").click(function(){
		$("#connectedcompanylist li.ui-selected").remove();
	});
	
	$( "#connectedcompanylist" ).selectable({
		selected: function(){ 
			$("#deleteconnectedcompany").show();
		}
	});
	
});

function browsPdt(isdep)
{
	$("#txtbrowsbrowspdt").data("isdep" , isdep);
	$("#txtbrowsbrowspdt").prop("readonly" , false);
	$("#txtbrowsbrowspdt").val("");
	$(".listcontainer .list").html("");
	$("#dvbrowspdt").dialog({modal: true, width: 300, height: 400, title: "Personalentscheider-Liste ..."});
}

function clearPdt()
{
	selectPdt(0, "");
	
	$("a.removepdt").hide();
}

function clearSv()
{
	selectSV(0, "");
	
	$("a.removesv").hide();
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
	$.get(form.attr("action") + "?name=" + text + "&sv=" + $(textinput).data("isdep"), function(data){ 
		listul.html(data);
		$(textinput).prop("readonly" , false);
		$(".loading").hide();
		if(listul.children("li").length > 0){
			listul.children("li").addClass("ui-widget-content");
			listul.selectable({selected: function( event, ui ) {
				var selid = $(ui.selected).data("id");
				var selname = $(ui.selected).html();
				
				if($(textinput).data("isdep") == 0){
					selectPdt(selid, selname);
					$("a.removepdt").show();
				} else {
					selectSV(selid, selname);
					$("a.removesv").show();
				}
				
				$("#dvbrowspdt").dialog("close");
			}});
		}
		
		$(textinput).focus();
	}).fail(function() {
		$(textinput).prop("readonly" , false);
		$(".loading").hide();
		listul.html("Netzwerk Fehler!");
	  });
}

function selectPdt(id, name)
{
	$("#companybase-pet").html(name);
	$("#companybase-pet-id").val(id);
}

function selectSV(id, name)
{
	$("#companybase-sv").html(name);
	$("#companybase-sv-id").val(id);

}


