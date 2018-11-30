var ul_showed = false;


$(document).ready(function(){
	
	
	$(".animul").fadeOut();

	
	$(window).scroll(function(){

		if(ul_showed == false){
			
			if($(window).scrollTop() + $(window).height() > $(".anim-container").offset().top - 100)
			{
				setTimeout("start_ul_howwork_animation(1);" , 500);
				setTimeout("start_ul_howwork_animation(2);" , 650);

			}
			
		}

	});

	
});

function start_ul_howwork_animation(index)
{
	$(".animul" + index).fadeIn(800);
	
	$("#hideanimspace").remove();
}