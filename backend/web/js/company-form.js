

brainApp.controller('CompanyController', function ($scope, $http, $sce, $element) {

	$scope.companyModel = companyModel;

	$scope.personaldecisionmaker = personaldecisionmaker;

	$scope.personaldecisionmakerUser = personaldecisionmakerUser;

	$scope.deputy = deputy;

	$scope.deputyUser = deputyUser;

	$scope.showDeputy = !$scope.deputy.isNew;

	$.datepicker.setDefaults($.datepicker.regional["de"]);

    $("input.founddate").datepicker({
	      changeMonth: true,
	      changeYear: true,
	      maxDate: "0D"
    });
    
    $scope.submitForm = function(){
    	var form = $("#companyform")[0];
    	//if (form.checkValidity() === true) {
    		//$("#companyform").submit();
        //}
    	//form.checkValidity();
    	var inputs = $("input[aria-required='true']");
    	var valid = true;
    	for(var i=0; i< inputs.length ; i++){
    		var input = inputs[i];
    		
    		$(input).parent().removeClass("has-error");
    		$(input).attr("aria-invalid" , false); 
    		
    		if (!input.checkValidity()) {
    			valid = false;
    		    $(input).next().html(input.validationMessage);
    		    $(input).parent().addClass("has-error"); 
    		    $(input).attr("aria-invalid" , true); 
    		    
    		    
    		    //alert(input.id);
    		}
    	}
    	
    	if (valid) {
    		$("#companyform").submit();
        }
    	
    };
    
    $("input.petbdate").datepicker({
	      changeMonth: true,
	      changeYear: true,
	      maxDate: "0D"
    });

	$scope.$watch('showDeputy', function (newValue, oldValue, scope) {
	    //alert("new: " + newValue + "\r\nold: " + oldValue);
		
		if($scope.showDeputy){
			
			setTimeout(function(){ 
			    $("input.svbdate").datepicker({
				      changeMonth: true,
				      changeYear: true,
				      maxDate: "0D"
			    });
			    

		}, 500);
			
		}
	});
	

	$("#deleteconnectedcompany").hide();
	$("#newconcompany").hide();

	$("#addconnectedcompany").click(function(){
		$("#newconcompany").dialog({
			width: 350, height: 190, modal: true, title: "Verbundene Unternehmen",
			buttons: [
			          {
				          text: "Hinzufügen",
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


