const swiper1 = new Swiper('.swiper1', {
  // Optional parameters
  direction: 'horizontal',
  centeredSlides: false,
  fade: 'true',

  spaceBetween: 20,
  // If we need pagination
  pagination: {
    el: '.swiper-pagination',
    dynamicBullets: true,
  },

  breakpoints: {
    0: {
      slidesPerView: 1,
    },
    520: {
      slidesPerView: 2,
    },
    950: {
      slidesPerView: 3,
    }
  },
});