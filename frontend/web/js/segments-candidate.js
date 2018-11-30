/**
 * 
 */

$(document).ready(function(){
  $(".weiter_lesen").hide();
  $(".weiter_btn").click(function(e){
    $(".weiter_lesen").show();
    $(".weiter_btn").hide();
    $(".close_btn").show();
  });
  $(".close_btn").click(function(e){
    $(".weiter_lesen").hide();
    $(".weiter_btn").show();
    $(".close_btn").hide();
    $('html, body').animate({
                            scrollTop: $(".was_wir_machen").offset().top
                        }, 1000);
  });

  $(".hiddenj2j").hide();
  var active_part =  $(".square .inner");
  var id = $(".square .inner").attr('id');
  
  $(".square .inner").click(function(e){
    active_part.removeClass("cycle_active");
    $(".hiddenj2j.content_"+id).hide();
    $(".recruitment_hidden").hide();
    $(this ).addClass("cycle_active");
    id = $( this ).attr('id');
    $(".hiddenj2j.content_"+id).fadeIn(500);
    active_part = $( this );
    e.stopPropagation();
  });

  $(".square2 .inner").click(function(e) {
    active_part.removeClass("cycle_active2");
    $(".hiddenj2j.content_"+id).hide();
    $(".recruitment_hidden").hide();
    $(this ).addClass("cycle_active2");
    id = $( this ).attr('id');
    $(".hiddenj2j.content_"+id).fadeIn(500);
    active_part = $( this );
    e.stopPropagation();
  });

  $(".square3 .inner").click(function(e){
    active_part.removeClass("cycle_active3");
    $(".hiddenj2j.content_"+id).hide();
    $(".recruitment_hidden").hide();
    $(this ).addClass("cycle_active3");
    id = $( this ).attr('id');
    $(".hiddenj2j.content_"+id).fadeIn(500);
    active_part = $( this );
    e.stopPropagation();
  });
/*
  $(".content-center").click(function(e){
    active_part.removeClass("cycle_active");
    $(".hiddenj2j.content_"+id).hide();
  });*/
  $(document).click(function(e) {
    active_part.removeClass("cycle_active");
    active_part.removeClass("cycle_active2");
    active_part.removeClass("cycle_active3");
    $(".hiddenj2j.content_"+id).hide();
    $(".recruitment_hidden").fadeIn(500);
  });
});
