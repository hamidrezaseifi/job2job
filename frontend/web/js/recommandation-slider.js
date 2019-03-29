/**
 * 
 */



	var recommandationCount = $(".pagination-content-item").length;
	var recommandationTimeoutMiliseconds = 7000;
	var currentRecommandation = 1;
	var candid_index = 1;
	var company_index = 1;
	
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
		
		removeAllBack();
		
		if(isCandidate){
			$(".recommendations-slider").addClass("das_sagen_kunden_candidate" + candid_index);
			$(".slider2-content").css("float" , "left");
			
			candid_index = candid_index == 1 ? 2 : 1;
		}
		else{
			$(".recommendations-slider").addClass("das_sagen_kunden" + company_index);
			$(".slider2-content").css("float" , "right");
			
			company_index = company_index == 1 ? 2 : 1;
		}		
		
		startRecommandationTimeout();
	}
	
	function removeAllBack(){
		for(var i=1; i<=4; i++){
			$(".recommendations-slider").removeClass("das_sagen_kunden" + i);
			$(".recommendations-slider").removeClass("das_sagen_kunden_candidate" + i);			
		}
	}
	