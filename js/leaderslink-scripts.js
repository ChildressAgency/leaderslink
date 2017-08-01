jQuery(document).ready(function($){
  $(window).scroll(function(){
    if($(document).scrollTop()){
      $('body').addClass('small-header');
    }
    else{
      $('body').removeClass('small-header');
    }
  });

  if(typeof $.fn.lightSlider == 'function'){
    $('#sliderBar .slider-bar').lightSlider({
      item:3,
      loop:true,
      slideMargin:0,
      pager:false,
      responsive:[
        {
          breakpoint:991,
          settings:{
            item:2
          }
        },
        {
          breakpoint:767,
          settings:{
            item:1
          }
        }
      ]
    });

    $('#testimonialSlider').lightSlider({
      item:1,
      loop:true,
      pager:false,
      controls:false,
      auto:true,
      keyPress:true,
      adaptiveHeight:true,
      pause:5000,
      onAfterSlide:function(el){
        $(window).trigger('resize').trigger('scroll');
      }
    });
  }
});