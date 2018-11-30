var is_menu_small = false;
var current_top_menu = null;
var current_sub_menu = null;
var register_choose_show = false;

var brainApp = angular.module('brainApp', ['ngAnimate']);

brainApp.directive('fileModel', ['$parse', function ($parse) {
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
            var model = $parse(attrs.fileModel);
            var modelSetter = model.assign;
            
            element.bind('change', function(){
                scope.$apply(function(){
                    modelSetter(scope, element[0].files[0]);
                });
            });
        }
    };
}]);



brainApp.controller('BodyController', ['$scope', '$http', '$sce', '$element', function ($scope, $http, $sce, $element) {

    //alert($element[0]);
    var body = $element;

    //TestService.doTest(556677);
    
    $("#bewerbersubmenu").data("w", $("#bewerbersubmenu").width());
    $("#mainsubmenu").data("w", $("#mainsubmenu").width());
    $("#unternehmensubmenu").data("w", $("#unternehmensubmenu").width());
    $("#dienstleistungenmenu").data("w", $("#dienstleistungenmenu").width());

    $("#registerchoose").slideUp();
    $("#registerchoose").hide();
    $("#loginbox").slideUp();
    $("#loginbox").hide();
    $("#unternehmenmenu").hide();
    $("#bewerbermenu").hide();
    $("#mainmenu").hide();
    $("#mainsubmenu").slideUp();
    $("#bewerbersubmenu").slideUp();
    $("#unternehmensubmenu").slideUp();
    $("#personalmenu").hide();
    $("#nextjobloading").hide();
    $("#dienstleistungenmenu").hide();


    $scope.loadingshow = false;
    var places = new Array();
    
    $scope.showWhatWeDo = function(part)
    {
    	$("#whatwedopart" + part).slideDown("slow");
    	$("#whatwedoquestion").remove();
    	$(".button-container").remove();

    }

    
    if ($("#searchort").length > 0) {
    	$scope.loadingshow = true;
    	
    	$http.jsonp(placesurl , {jsonpCallbackParam: 'callback'}).then(function(response) {
	        
	    	places = response.data;
	        $("#searchort").autocomplete({ source: places , minLength : 3});
	
	        $scope.loadingshow = false;
	        
	    });
    }

    if ($("#searchtext").length > 0) {
        $("#searchtext").autocomplete({
            minLength: 0, source: function (request, response) {
                response($.ui.autocomplete.filter(
                    skills, extractLast(request.term)));
            },
            focus: function () {
                // prevent value inserted on focus
                return false;
            },
            select: function (event, ui) {
                var terms = split(this.value);
                // remove the current input
                terms.pop();
                // add the selected item
                terms.push(ui.item.value);
                // add placeholder to get the comma-and-space at the end
                terms.push("");
                this.value = terms.join(", ");
                return false;
            }
        });
    }
    
    $scope.dienstleistungenlink_mouseover = function () {
        var link = $("#dienstleistungenlink");
        var l = link.offset().left + link.width() - 5;
        var t = link.offset().top - 5;
        $("#dienstleistungenmenu").css({ left: l, top: t });
        $("#dienstleistungenmenu").slideDown();
    };

    $scope.dienstleistungenmenu_mouseleave = function () {
        $("#dienstleistungenmenu").slideUp();
    };

    $scope.rememberme_click = function () {
        $("input[name='LoginForm[rememberMe]']").val($("#rememberMe:checked").length);
    };

    $scope.doclosemenu = function () {
        close_menu();
    };

    $scope.menulineclick = function () {


        if ($("#menu-line").hasClass("open")) {

            close_menu();
        }
        else {

            current_top_menu = 'mainmenu';
            current_sub_menu = 'mainsubmenu';
            $("#registerchoose").slideUp();
            open_menu();
        }

    };

    $scope.bewerberlinkclick = function () {

        current_top_menu = 'bewerbermenu';
        current_sub_menu = 'bewerbersubmenu';

        open_menu();

    };

    $scope.unternehmenlinkclick = function () {

        current_top_menu = 'unternehmenmenu';
        current_sub_menu = 'unternehmensubmenu';

        open_menu();

    };

    $scope.personalphoto_click = function () {
        show_personal_menu(true);
    };
    

    $(document).mouseup(function (e) {
        var container = $("#loginbox");

        if (!container.is(e.target) // if the target of the click isn't the container...
            && container.has(e.target).length === 0) // ... nor a descendant of the container
        {
            container.slideUp(100);
        }

        container = $(".personalphoto");

        if (!container.is(e.target) // if the target of the click isn't the container...
            && container.has(e.target).length === 0) // ... nor a descendant of the container
        {
            show_personal_menu(false);
        }


    });


    set_mainlogotop_to_mainlogo();

    check_top_menu();

   

    $(window).scroll(function () {
        show_personal_menu(false);
        check_top_menu();
    });

    if (typeof page_animation == "function") {
        page_animation();
    }
    
    if(typeof doScroll == "function"){
    	doScroll();
    }
    

}]);


$(document).ready(function(){
	
	
	
});

function check_top_menu()
{
	if($(window).scrollTop() > 100)
	{
		if(!is_menu_small)
			change_top_menu(true);
		
	}
	else
	{
		if(is_menu_small)
			change_top_menu(false);
	}	
}

function open_menu()
{
	if(current_top_menu == null) return;
	
	$("#menu-line").removeClass("close").addClass("open");
	
	$("body").css("overflow", "hidden");
	
	wpieIn($("#" + current_sub_menu + " div") , 700);
	
	$("#" + current_top_menu).show();
	$("#" + current_sub_menu).slideDown(200);

}

function close_menu()
{
	if(current_top_menu == null) return;
	
	if(register_choose_show) $("#registerchoose").slideUp();
	register_choose_show = false;
	$("#menu-line").removeClass("open").addClass("close");
	$("body").css("overflow", "auto");
	
	wpieOut($("#" + current_sub_menu + " div") , 300);

	$("#" + current_sub_menu).slideUp(300 , function() { $("#" + current_top_menu).hide(); });

	$("#dienstleistungenmenu").slideUp();

}

function wpieIn(item , speed)
{
	
	item.css("width" , 0);
	item.css("left" , 150);
		
	item.animate({
		width: item.parent().data("w") + "px",
		left: "-=150px",
	  }, speed);	
}

function wpieOut(item , speed)
{
	
	item.animate({
		width: "0px",
		left: "+=150px",
	  }, speed);	
}

function change_top_menu(small)
{
	if(small && is_menu_small)
		return;
	
	if(!small && !is_menu_small)
		return;
	
	is_menu_small = small;
	
	if(small)
	{
		$("#langflags").hide(200);
		
		$( ".menu_three_line" ).animate({
			width: "40px"
		  }, 300);	
		
		$( "#mainlogo" ).animate({
			height: "40px",
			width: "100px"
		  }, 50 , function(){
			  set_mainlogotop_to_mainlogo();
		  });	
		
		$( "#mainlogo" ).animate({
			marginTop: "-15px"
		  }, 100 , function(){
			  set_mainlogotop_to_mainlogo();
		  });	
		
		$(".personalphoto").animate({
			marginTop: "-10px",
			marginRight: "5px",
			height: "35px",
			width: "35px",
		  }, 200);	
		
		$( "#topmenu" ).animate({
			height: "50px"
		  }, 300);	
		
		$("#menu-line").animate({
			marginTop: "5px"
		  }, 50);	
	
		
	
	}
	else
	{
		
		$( "#topmenu" ).animate({
			height: "100px"
		  }, 300);	

		$( ".menu_three_line" ).animate({
			width: "60px"
		  }, 300);	
		
		$("#mainlogo").animate({
			marginTop: "0px"
		  }, 100 , function(){
			  set_mainlogotop_to_mainlogo();
		  });	
		
		$( "#mainlogo" ).animate({
			height: "66px",
			width: "165px"
		  }, 50 , function(){
			  set_mainlogotop_to_mainlogo();
		  });	
		
		$(".personalphoto").animate({
			marginTop: "25px",
			marginRight: "0px",
			height: "50px",
			width: "50px",
		  }, 200);	
		
		$("#menu-line").animate({
			marginTop: "20px"
		  }, 50);	

		
		$("#langflags").show(200);
	}
	
}

function set_mainlogotop_to_mainlogo()
{
	$("#mainlogotop").css("left" , $("#mainlogo").offset().left);
	$("#mainlogotop").css("top" , $("#mainlogo").offset().top - $(window).scrollTop());	
	$("#mainlogotop").css("width" , $("#mainlogo").width());	
	$("#mainlogotop").css("height" , $("#mainlogo").height());	
}

function show_login(link)
{
	//alert($(link).width());
	var x = $(link).offset().left - ($("#loginbox").width() - $(link).width() ) ;

	$("#loginbox").css("left" , x);
	$("#loginbox").css("top" , $(link).offset().top + $(link).height() + 5);
	
	$("#loginbox").slideDown(200);

}

function show_choose_register(link)
{

	var x = $(link).offset().left - ( ($("#registerchoose").width() - $(link).width())/2) ;

	$("#registerchoose").css("left" , x);
	$("#registerchoose").css("top" , $(link).offset().top + $(link).height() + 25);
	
	$("#registerchoose").slideDown(200);

	register_choose_show = true;
}

function validateEmail(email) {
	var invalid_chars = ["#" , "'" , "?" , "]" , "[" , "}" , "{" , "/" , "\\" , "&" , "%" , "$" , "§" , "!" , '"'];
	for(var i = 0 ; i<invalid_chars.length ; i++){
		if(("-" + email + "-").indexOf(invalid_chars[i]) > 0){
			return false;
		}	
	}
	
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function show_personal_menu(show)
{
	var td = $(".personalphoto").parent().parent();
	
	if(show){
		td.css("background-color" , "white");
		
		$("#personalmenu").css("top" , td.offset().top + td.height() );
		$("#personalmenu").css("left" , td.offset().left - ($("#personalmenu").width() - td.width()) / 2);
		$("#personalmenu").slideDown();	

	}
	else{
		td.css("background-color" , "transparent");
		
		$("#personalmenu").slideUp();	

	}
		
}

function nextJob(link)
{
	if(typeof nextjobcount == "undefined"){
		nextjobcount = 2;
	}
	var lastindex = $(".index-part-2-in .index-part-2-job_item:last").data("index");
	$("#nextjobloading").show();
	$.get(nextjoburl + "?last=" + lastindex + "&count=" + nextjobcount , function(data){
		$(data).insertBefore($("#afterlastjobpos"));
		$("#nextjobloading").hide();
		//alert(data);
	});
}

function startSearch()
{
	var text = $.trim($("#searchtext").val());
	var ort = $.trim($("#searchort").val());
	
	if(text != "" || ort != ""){ 
		$("#searchform").submit();
	}

}

function split(val) {
    return val.split(/,\s*/);
}

function extractLast(term) {
    return split(term).pop();
}

function scrol_page_new(div, index)
{
	var y = 0;
	switch (index) {
	    case 1:
	    	y = 0;
	        break;
	    case 2:
	    	y = $(".site-about").offset().top - 50;
	    	break;
	    case 3:
	    	y = $(".site-allbranches").offset().top - 50;
	        break;
	    case 4:
	    	y = $("#index-part-3").offset().top - 50;
	        break;
	}
	
	$("html, body").animate({ scrollTop: y }, 300);
}

function start_branch_animation(index)
{
	
	if(index > 6)
		return;
	
	$( ".allbranches-part-4-in-" + index).animate({
		opacity: "1.0"
	  }, 900, function() {
		  
	  });	
}



