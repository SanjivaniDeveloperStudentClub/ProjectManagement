(function () {
    $(document).ready(function () {
      var mySwiper = new Swiper(".swiper", {
        autoHeight: true,
        autoplay: {
          delay: 5000,
          disableOnInteraction: false
        },
        speed: 500,
        direction: "horizontal",
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev"
        },
        pagination: {
          el: ".swiper-pagination",
          type: "progressbar"
        },
        loop: false,
        effect: "slide",
        spaceBetween: 30,
        on: {
          init: function () {
            updatePagination(0);
          },
          slideChangeTransitionStart: function () {
            updatePagination(mySwiper.realIndex);
          }
        }
      });
  
      $(".swiper-pagination-custom .swiper-pagination-switch").click(function () {
        var index = $(this).index();
        mySwiper.slideTo(index);
        updatePagination(index);
      });
  
      function updatePagination(index) {
        $(".swiper-pagination-custom .swiper-pagination-switch").removeClass("active");
        $(".swiper-pagination-custom .swiper-pagination-switch").eq(index).addClass("active");
      }
    });
  })();
  