const swiper1 = new Swiper('.swiper1', {
  // Optional parameters
  direction: 'horizontal',
  loop: true,
  centeredSlides: false,
  fade: 'true',

  spaceBetween: 20,
  grabCursor: true,

  // If we need pagination
  pagination: {
    el: '.swiper-pagination',
    dynamicBullets: true
  },

  // Navigation arrows
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },

  // And if we need scrollbar
  scrollbar: {
    el: '.swiper-scrollbar',
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

const swiper2 = new Swiper('.swiper2', {
  // Optional parameters
  direction: 'horizontal',
  loop: true,
  centeredSlides: false,
  fade: 'true',

  spaceBetween: 20,
  grabCursor: true,

  // If we need pagination
  pagination: {
    el: '.swiper-pagination',
    dynamicBullets: true
  },

  // Navigation arrows
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },

  // And if we need scrollbar
  scrollbar: {
    el: '.swiper-scrollbar',
  },

  breakpoints: {
    0: {
      slidesPerView: 2,
      centeredSlides: true,
    },
    520: {
      slidesPerView: 3,
      centeredSlides: true,
    },
    950: {
      slidesPerView: 6,
    }
  },
});