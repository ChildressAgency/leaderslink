jQuery(document).ready(function($){
  if(typeof $.fn.lightSlider == 'function'){
    $('#sliderBar .slider').lightSlider({
      item:3,
      loop:true,
      slideMargin:0,
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
  }
});