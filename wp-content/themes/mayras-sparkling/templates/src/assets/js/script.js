/*
 * SLIDERS
 */


var swiper = new Swiper(".home-swiper.home-swiper1", {
    speed: 1700,
    effect: "fade",
    fadeEffect: { crossFade: true },

    navigation: {
        nextEl: ".next1",
        prevEl: ".prev1",
    },

    pagination: {
        el: ` .swiper-pagination`,

    }
});

var swiper = new Swiper(".home-service-swiper", {
    slidesPerView: 4,
    spaceBetween: 45,
    speed: 1700,


    navigation: {
        nextEl: ".next2",
        prevEl: ".prev2",
    },

    // pagination: {
    //     el: ` .swiper-pagination-service`,

    // }
});

var swiper = new Swiper(".banner_slider_prin .swiper-container  ", {
    slidesPerView: 1,
    spaceBetween: 45,
    speed: 1700,
    effect: "fade",
    fadeEffect: { crossFade: true },
    pagination: {
        el: ` .swiper-pagination-benefits`,

    }
});