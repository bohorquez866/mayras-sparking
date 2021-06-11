/*
 * SLIDERS
 */
if (window.innerWidth > 1024) {

    let homeSwiper = new Swiper('.home-swiper1 .container', {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        speed: 1700,
        effect: "fade",
        fadeEffect: { crossFade: true },
        pagination: {
            el: ".swiper-pagination",
        },

        navigation: {
            nextEl: ".next1",
            prevEl: ".prev1",
        },

    });
} else {
    let homeSwiper = new Swiper('.home-swiper1 .container', {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        speed: 1700,
        pagination: {
            el: ".swiper-pagination-swiper",
        },
        effect: "fade",
        fadeEffect: { crossFade: true },
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: ".next1",
            prevEl: ".prev1",
        },

    });
}
if (window.innerWidth < 1024) {
    let homeMenuSwiper = new Swiper('.home-service-swiper', {
        slidesPerView: 1,
        spaceBetween: 50,
        loop: true,
        speed: 1700,
        effect: "fade",
        fadeEffect: {
            crossFade: true
        },
        pagination: {
            el: ".swiper-pagination-service",
        },

        // autoplay: {
        //     delay: 2500,
        //     disableOnInteraction: false,
        // },
        navigation: {
            nextEl: ".next2",
            prevEl: ".prev2",
        },

    });
}

if (window.innerWidth > 1024) {
    let homeTestimoniesSwiper = new Swiper('.home-testimonials-slider', {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        speed: 1700,

        breakpoints: {
            1024: {
                slidesPerView: 3,
                spaceBetween: 20,
            }
        },
        // autoplay: {
        //     delay: 2500,
        //     disableOnInteraction: false,
        // },
        navigation: {
            nextEl: ".next2",
            prevEl: ".prev2",
        },

    });


} else {
    let homeTestimoniesSwiper = new Swiper('.home-testimonials-slider', {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        speed: 1700,
        effect: "fade",
        fadeEffect: { crossFade: true },
        breakpoints: {
            1024: {
                slidesPerView: 3,
                spaceBetween: 20,
            }
        },
        pagination: {
            el: ".swiper-pagination-testimonies",
        },
        // autoplay: {
        //     delay: 2500,
        //     disableOnInteraction: false,
        // },
        navigation: {
            nextEl: ".next2",
            prevEl: ".prev2",
        },

    });
}

let menuSlider = new Swiper('.sliderGeneral', {
    slidesPerView: 1,
    spaceBetween: 20,
    loop: true,
    speed: 1700,
    effect: "fade",
    autoplay: {
        delay: 3000,
        disableOnInteraction: false,
    }
});

let menuResponsiveSlider = new Swiper('.menu-responsive-slider', {
    slidesPerView: 1,
    spaceBetween: 20,
    loop: true,
    speed: 1700,
    effect: "fade",
    fadeEffect: {
        crossFade: true
    },

    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination-about-items",
    },
    navigation: {
        nextEl: ".next2",
        prevEl: ".prev2",
    },

});



/*
 * social fixed Ps 
 */
let fixedContactLabel = document.querySelectorAll('.social-fixed p');
fixedContactLabel.forEach(label => { label.style.display = 'block'; });

/*
 * Toggle Modal 
 */
const $burgerMenu = document.querySelectorAll('.burger-menu'),
    $mobileMenu = document.querySelector('.mobile-menu');

let toggleModal = (trigger, objective, className) => {
    if (trigger) {

        if (trigger.length > 1) {
            trigger.forEach(element => {

                element.addEventListener('click', () => {
                    objective.classList.toggle(className);

                });
            });

        } else if (trigger.length === 1) {
            trigger.addEventListener('click', () => {
                objective.classList.toggle(className);

            })

        }
    }
};


toggleModal($burgerMenu, $mobileMenu, 'active');