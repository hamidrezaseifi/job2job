/**
 * 
 */

$(document).ready(function(){
  $(".weiter_lesen").hide();
  $(".weiter_btn").click(function(){
    $(".weiter_lesen").show();
    $(".weiter_btn").hide();
    $(".close_btn").show();
  });
  $(".close_btn").click(function(){
    $(".weiter_lesen").hide();
    $(".weiter_btn").show();
    $(".close_btn").hide();
    $('html, body').animate({
                            scrollTop: $(".was_wir_machen").offset().top
                        }, 1000);
  });

  $(".hidden").hide();
  var active_part =  $(".square .inner");
  var id = $(".square .inner").attr('id');
  
  $(".square .inner").click(function(){
    active_part.removeClass("cycle_active");
    $(".hidden.content_"+id).hide();
    $(".recruitment_hidden").hide();
    $(this ).addClass("cycle_active");
    id = $( this ).attr('id');
    $(".hidden.content_"+id).fadeIn(500);
    active_part = $( this );
    event.stopPropagation();
  });

  $(".square2 .inner").click(function() {
	  if($(this ).hasClass("cycle_active2")){
		  window.location.href = $(this ).data("link");
	  }
    active_part.removeClass("cycle_active2");
    $(".hidden.content_"+id).hide();
    $(".recruitment_hidden").hide();
    $(this ).addClass("cycle_active2");
    id = $( this ).attr('id');
    $(".hidden.content_"+id).fadeIn(500);
    active_part = $( this );
    event.stopPropagation();
  });

  $(".square3 .inner").click(function(){
    active_part.removeClass("cycle_active3");
    $(".hidden.content_"+id).hide();
    $(".recruitment_hidden").hide();
    $(this ).addClass("cycle_active3");
    id = $( this ).attr('id');
    $(".hidden.content_"+id).fadeIn(500);
    active_part = $( this );
    event.stopPropagation();
  });
/*
  $(".content-center").click(function(){
    active_part.removeClass("cycle_active");
    $(".hidden.content_"+id).hide();
  });*/
  $(document).click(function() {
    active_part.removeClass("cycle_active");
    active_part.removeClass("cycle_active2");
    active_part.removeClass("cycle_active3");
    $(".hidden.content_"+id).hide();
    $(".recruitment_hidden").fadeIn(500);
  });
});
