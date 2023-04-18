$(document).ready(function(){
    $('.input-group input').focus(function(){
      me = $(this) ;
      $("label[for='"+me.attr('id')+"']").addClass("animate-label");
    }) ;
    $('.input-group input').blur(function(){
      me = $(this) ;
      if ( me.val() == ""){
        $("label[for='"+me.attr('id')+"']").removeClass("animate-label");
      }
    })
  })