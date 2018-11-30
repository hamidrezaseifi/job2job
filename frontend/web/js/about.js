var box1_showed = false;
var box2_showed = false;


$(document).ready(function(){
	
	
	$(".boxcontainer1 .box").fadeOut();
	$(".boxcontainer2 .box").fadeOut();

	
	$(window).scroll(function(){

		if(box1_showed == false && $(".boxcontainer1").length > 0){
			
			if($(window).scrollTop() + $(window).height() > $(".boxcontainer1").offset().top - 100)
			{
				box1_showed = true;
				setTimeout("start_box_animation(1, 1);" , 500);
				setTimeout("start_box_animation(1, 2);" , 650);

			}
			
		}

		if(box2_showed == false && $(".boxcontainer2").length > 0){
			
			
			if($(window).scrollTop() + $(window).height() > $(".boxcontainer2").offset().top - 100)
			{
				box2_showed = true;
				setTimeout("start_box_animation(2, 1);" , 500);
				setTimeout("start_box_animation(2, 2);" , 650);
				setTimeout("start_box_animation(2, 3);" , 700);

			}
			
		}

	});

	
});

function start_box_animation(container, index)
{
	//alert($(".boxcontainer" + container + " .box" + index).length);
	$(".boxcontainer" + container + " .box" + index).fadeIn(800);
	
	
}