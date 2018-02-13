$(window).scroll(function(){

  var wScroll = $(this).scrollTop();

  $('.logo').css({
    'transform' : 'translate(0px, '+ wScroll /2 +'%)'
  });

  $('.back-bird').css({
    'transform' : 'translate(0px, '+ wScroll /4 +'%)'
  });

  $('.fore-bird').css({
    'transform' : 'translate(0px, -'+ wScroll /20 +'%)'
  });


  if(wScroll > $('.large-window').offset().top - $(window).height()){

  $('.large-window').css({'background-position':'center '+ (wScroll - $('.large-window').offset().top) +'px'});

  var opacity = (wScroll - $('.large-window').offset().top + 400) / (wScroll / 5);

  $('.window-tint').css({'opacity': opacity});

}

});
