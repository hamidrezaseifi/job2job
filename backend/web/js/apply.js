
$(document).ready(function(){
	
	$("#dvbrowscompany").hide();
	$("#dvbrowscandidate").hide();
	$("#dvbrowsjobpos").hide();
	
	toggleRemoveBottun($("#companytext"), $("#companyid"));
	toggleRemoveBottun($("#candidatetext"), $("#candidateid"));
	toggleRemoveBottun($("#jobpostext"), $("#jobposid"));

	
});

function filterall()
{
	//alert($("#statusform input[value='-1']").length);
	
	$("#statusform input[name='status']").val($("input[name='statuslist']:checked").val());

	//alert($("#statusform input[name='status']").val());
	$("#statusform input[value='-1']").remove();
	//alert($("#statusform input[name='status']").val());
	$("#statusform").submit();	
}

function browsCompany()
{
	var txt = $("#companytext");
	var itemid = $("#companyid");
	var p = txt.parent();
	var remove = findRemoveBottun(txt);
	//alert(remove.html());
	
	//itemid.val(2);
	//filterall();
	
	$("#dvbrowscompany").dialog({modal: true, width: 300, height: 400, title: "Unternehmen-Liste ..."});
}

function clearCompany()
{
	var txt = $("#companytext");
	var itemid = $("#companyid");
	var p = txt.parent();
	var remove = findRemoveBottun(txt);

	itemid.val(-1);
	filterall();
	
}

function browsCandidate()
{
	var txt = $("#candidatetext");
	var itemid = $("#candidateid");
	var p = txt.parent();
	var remove = findRemoveBottun(txt);
	//alert(remove.html());
	
	$("#dvbrowscandidate").dialog({modal: true, width: 300, height: 400, title: "Bewerber-Liste ..."});

}

function clearCandidate()
{
	var txt = $("#candidatetext");
	var itemid = $("#candidateid");
	var p = txt.parent();
	var remove = findRemoveBottun(txt);
	//alert(remove.html());
	
	itemid.val(-1);
	filterall();

}

function browsJobposition()
{
	var txt = $("#jobpostext");
	var itemid = $("#jobposid");
	var p = txt.parent();
	var remove = findRemoveBottun(txt);
	//alert(remove.html());
	
	$("#dvbrowsjobpos").dialog({modal: true, width: 300, height: 400, title: "Stellenanzeige-Liste ..."});

}

function clearJobposition()
{
	var txt = $("#jobpostext");
	var itemid = $("#jobposid");
	var p = txt.parent();
	var remove = findRemoveBottun(txt);
	//alert(remove.html());
	
	itemid.val(-1);
	filterall();

}

function findRemoveBottun(textObject)
{
	var p = textObject.parent();
	return p.children("a.remove");	
}

function toggleRemoveBottun(textObject, idObject)
{
	var remove = findRemoveBottun(textObject);

	if(idObject.val() > 0){
		remove.show();
	} else {
		remove.hide();
	}	
}

function searchList(textinput, hddid)
{
	var text = $.trim($(textinput).val());
	var div = $(textinput).parent().parent().parent();
	var form = $(textinput).parent();
	var listul = div.children(".listcontainer").children(".list");
	var loadimg = div.children(".listcontainer").children(".loading");
	//alert(form.attr("action"));
	//return;
	listul.html("");
	if(text == "") return;
	
	$(textinput).prop("readonly" , true);
	loadimg.show();
	$.get(form.attr("action") + "?name=" + text, function(data){ 
		listul.html(data);
		$(textinput).prop("readonly" , false);
		loadimg.hide();
		if(listul.children("li").length > 0){
			listul.children("li").addClass("ui-widget-content");
			listul.selectable({selected: function( event, ui ) {
				var selid = $(ui.selected).data("id");
				$("#" + hddid).val(selid);
				filterall();

			}});
		}
		
		$(textinput).focus();
	}).fail(function() {
		$(textinput).prop("readonly" , false);
		loadimg.hide();
		listul.html("Netzwerk Fehler!");
	  });;
}

