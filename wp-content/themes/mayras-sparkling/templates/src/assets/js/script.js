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