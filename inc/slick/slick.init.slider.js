$(document).ready(function(){
  var cp = ($(window).width() - 1036) / 2;

  $('.image-slider').slick({
    centerMode: true,
    centerPadding: cp+'px',
    autoplay: true,
    autoplaySpeed: 4000,
    initialSlide: 1,
    arrows: false,
    dots: true,
    pauseOnFocus: false,
    responsive: [
      {
        breakpoint: 800,
        settings: {
          centerPadding: '10%'
        }
      },
      {
        breakpoint: 480,
        settings: {
          centerPadding: '0'
        }
      }
    ]
  });
});