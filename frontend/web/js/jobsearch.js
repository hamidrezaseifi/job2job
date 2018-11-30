

brainApp.controller('JobSearchController', ['$scope', '$http', '$sce', '$element', function ($scope, $http, $sce, $element) {
	
	$scope.showItemsContainer = false;
	$scope.nextjobloading = false;
	$scope.isPageTitle = true;
	$scope.loadingSearchShow = false;
	
	$scope.startSearch = function () {

		var text = $.trim($("#searchtext").val());
		var ort = $.trim($("#searchort").val());
		var jt = $.trim($("select[name='jt']").val());
		var wt = $.trim($("select[name='wt']").val());
		var vk = $.trim($("select[name='vk']").val());
		var isclosed = $("#advancedbutton").hasClass("down");
		
		if(isclosed){
			$(".index-jobsearch-box-in .adv").remove();
		}

		if(text != "" || ort != "" || jt > 0 || wt > 0 || vk > 0){ 
			var searchdata = $("#searchform").serialize();
			var url = $("#searchform").attr("action");
			url += "?" + searchdata;
	    	
	    	$scope.loadingSearchShow = true;
	    	
	    	$http.get(url ).then(function(response) {
		        //alert(response.data.title);
		        
	    		$scope.itemsTitle = $sce.trustAsHtml(response.data.title);
	    		$scope.itemsList = response.data.items;
	    		
	    		$scope.loadingSearchShow = false;
	    		$scope.showItemsContainer = true;
	    		$scope.nextjobloading = !response.data.finish;
			    
	    		if($scope.isPageTitle){
	    			$(".jobsearch-top-title").slideUp();
	    			$scope.isPageTitle = false;
	    		}
		    });
		    
		}
		
        

    };
    
	$scope.toggleAdvanced = function () {

		var parent = $(".index-jobsearch-box-in");
		var isclosed = $("#advancedbutton").data("adv") == "noadv";
		
		if(isclosed){
			parent.animate({
				height: "+=80px",
			  }, "fast" , function(){
				  $(".index-jobsearch-box-in .adv").show();
				  $("#advancedbutton").data("adv" , "adv");
				  $("#advancedbutton").html($("#advancedbutton").data("noadvtitle"));
			  });
			
		}
		else{
			$(".index-jobsearch-box-in .adv").hide();
			parent.animate({
				height: "-=80px",
			  }, "fast" , function(){
				  $("#advancedbutton").data("adv" , "noadv");
				  $("#advancedbutton").html($("#advancedbutton").data("advtitle"));
			  });
			
			$("select.adv").prop("selectedIndex", 0);
			
		}

    };
    
    $scope.nextAdvJob = function(){
    	alert("next!");
    }
    
    var isclosed = $("#advancedbutton").hasClass("down");
	if(isclosed){
		$(".index-jobsearch-box-in .adv").hide();
		
	}
	
	
    
}]);


function startAdvSearch()
{
	var text = $.trim($("#searchtext").val());
	var ort = $.trim($("#searchort").val());
	var jt = $.trim($("select[name='jt']").val());
	var wt = $.trim($("select[name='wt']").val());
	var vk = $.trim($("select[name='vk']").val());
	var isclosed = $("#advancedbutton").hasClass("down");
	
	if(isclosed){
		$(".index-jobsearch-box-in .adv").remove();
	}

	if(text != "" || ort != "" || jt > 0 || wt > 0 || vk > 0){ 
		$("#searchform").submit();
	}

}

function nextAdvJob(link)
{
	if(typeof nextjobcount == "undefined"){
		nextjobcount = 2;
	}
	
	var lastqs = $("#lastquery").val();
	var lastindex = $(".index-part-2-in .index-part-2-job_item:last").data("index");
	$("#nextjobloading").show();
	$.get(nextjoburl + "?last=" + lastindex + "&count=" + nextjobcount + lastqs , function(data){
		$(data).insertBefore($("#afterlastjobpos"));
		$("#nextjobloading").hide();
		//alert(data);
	});
}
