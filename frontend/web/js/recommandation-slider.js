/**
 * 
 */



	var recommandationCount = $(".pagination-content-item").length;
	var recommandationTimeoutMiliseconds = 7000;
	var currentRecommandation = 1;
	var lastRecommandationWasCandidate = false;

	var recommandationTimeout = 0;
	
	function startRecommandationTimeout(){
		recommandationTimeout = setTimeout(function(){ 
			
			currentRecommandation ++;
			if(currentRecommandation > recommandationCount){
				currentRecommandation = 1;
			}

			showNextRecommandation(currentRecommandation , false);
		}, recommandationTimeoutMiliseconds);
	}
	
	function stopRecommandationTimeout(){
		clearTimeout(recommandationTimeout);
	}
	
	

	function showNextRecommandation(index, isClick){
		
		stopRecommandationTimeout();
		
		currentRecommandation = index;
		
		$(".pagination2 a.selected").removeClass("selected");
		$('#link' + index).addClass("selected");
		
		var isCandidate = $('#link' + index).data("iscandidate") === 1;
		
		
			
		$(".pagination-content div.in").removeClass("in");
		$('#item' + index).addClass("in");
		//.slider2-content
		if(lastRecommandationWasCandidate !== isCandidate){
			lastRecommandationWasCandidate = isCandidate;
			
			if(isCandidate){
				$(".recommendations-slider").removeClass("das_sagen_kunden").addClass("das_sagen_kunden_candidate");
				$(".candidate-recommand-title").show();
				$(".compnay-recommand-title").hide();
				$(".slider2-content").css("float" , "left");
			}
			else{
				$(".recommendations-slider").removeClass("das_sagen_kunden_candidate").addClass("das_sagen_kunden");
				$(".candidate-recommand-title").hide();
				$(".compnay-recommand-title").show();
				$(".slider2-content").css("float" , "right");
			}
		}
		
		
		
		startRecommandationTimeout();
	}
	