(function($){
  function npFillCities(provinceSelect){
    if(!window.ninjapetLocations) return;
    var province = $(provinceSelect).val();
    var citySelect = $(provinceSelect).closest('form').find('.np-city-select');
    if(!citySelect.length) citySelect = $('.np-city-select').first();
    var selected = citySelect.data('selected') || citySelect.val();
    citySelect.empty().append($('<option/>',{value:'',text: province ? 'انتخاب شهر' : 'ابتدا استان را انتخاب کنید'}));
    if(province && ninjapetLocations[province]){
      $.each(ninjapetLocations[province], function(_, city){ citySelect.append($('<option/>',{value:city,text:city,selected:selected===city})); });
    }
  }
  $(document).on('change','.np-province-select',function(){ npFillCities(this); });
  $('.np-province-select').each(function(){ npFillCities(this); });
  $(document).on('click','.pettt-mobile-toggle',function(){ $('.pettt-nav').toggleClass('is-open'); });
  $(document).on('click','[data-pettt-scroll]',function(e){ var target=$(this).attr('href'); if(target && target.charAt(0)==='#'){ e.preventDefault(); $('html,body').animate({scrollTop:$(target).offset().top-90},500); } });
  $(document).on('click','.pettt-like-btn',function(e){ e.preventDefault(); var btn=$(this), id=btn.data('post'); if(!window.petttExplore || !id) return; $.post(petttExplore.ajax,{action:'pettt_like_explore',post_id:id},function(res){ if(res && res.success){ btn.find('b').text(res.data.likes); btn.addClass('is-liked'); } }); });
})(jQuery);
