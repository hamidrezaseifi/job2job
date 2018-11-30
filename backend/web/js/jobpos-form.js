
$(document).ready(function(){
	
	$.datepicker.setDefaults($.datepicker.regional["de"]);
	
	$("#dvbrowscompany").hide();

	$("#jobstartdate.calender-icon").datepicker({
	      changeMonth: true,
	      changeYear: true,
	      minDate: "0D"
	    });

	$("#expiredate.calender-icon").datepicker({
	      changeMonth: true,
	      changeYear: true,
	      minDate: "5D"
	    });
	
	$('#commentstext').froalaEditor({
	      toolbarButtons: ['bold', 'italic', 'underline', 'fontSize', '|', 'formatUL', 'formatOL', 'paragraphStyle', 
			        		'|', 'paragraphFormat', 'align', '|', 'insertHR', '|', 'undo', 'redo'],
	      toolbarButtonsXS: ['bold', 'italic' , 'underline'],
	      language: 'de',
	      theme: 'gray',
	      height: 150,
	    });
});

function selectCompany(id, name)
{
	$("#jobpositionbase-company").html(name);
	$("#jobpositionbase-companyid").val(id);
}

function browsCompany()
{
	$("#txtbrowscompany").prop("readonly" , false);
	$("#txtbrowscompany").val("");
	$(".listcontainer .list").html("");
	$("#dvbrowscompany").dialog({modal: true, width: 300, height: 400, title: "Unternehmen-Liste ..."});
}

function clearCompany()
{
	var txt = $("#companytext");
	var itemid = $("#companyid");
	var p = txt.parent();
	var remove = findRemoveBottun(txt);

	$("#jobpositionbase-companyid").val(0);
	$("#jobpositionbase-company").html("");
	
	$("a.remove").hide();
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
	$.get(form.attr("action") + "?name=" + text, function(data){ 
		listul.html(data);
		$(textinput).prop("readonly" , false);
		$(".loading").hide();
		if(listul.children("li").length > 0){
			listul.children("li").addClass("ui-widget-content");
			listul.selectable({selected: function( event, ui ) {
				var selid = $(ui.selected).data("id");
				var selname = $(ui.selected).html();
				$("#jobpositionbase-companyid").val(selid);
				$("#jobpositionbase-company").html(selname);
				$("a.remove").show();
				$("#dvbrowscompany").dialog("close");
			}});
		}
		
		$(textinput).focus();
	}).fail(function() {
		$(textinput).prop("readonly" , false);
		$(".loading").hide();
		listul.html("Netzwerk Fehler!");
	  });
}

