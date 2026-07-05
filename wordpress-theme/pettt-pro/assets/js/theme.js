(function($){
  $(document).on('click','.pettt-mobile-toggle',function(){ $('.pettt-nav').toggleClass('is-open'); });
  $(document).on('click','[data-pettt-scroll]',function(e){
    var target = $(this).attr('href');
    if(target && target.charAt(0)==='#'){ e.preventDefault(); $('html,body').animate({scrollTop:$(target).offset().top-90},500); }
  });
})(jQuery);
