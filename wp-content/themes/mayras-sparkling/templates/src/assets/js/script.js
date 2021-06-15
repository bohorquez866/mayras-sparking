$burgerMenu = document.querySelectorAll('.burger-menu'),
    $mobileMenu = document.querySelector('.mobile-menu'),
    $spot = document.querySelector(".spot"),
    $navbarMobile = document.querySelector('.navbar-mobile');
/*
 * SLIDERS
 */

if (window.innerWidth > 768) {
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


} else {
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
        slidesPerView: 1,
        spaceBetween: 45,
        speed: 1700,
        effect: "fade",
        fadeEffect: {
            crossFade: true
        },
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
}

//toggle mobiel menu

let toggleModal2 = (trigger, objective, className) => {
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
toggleModal2($burgerMenu, $mobileMenu, 'active');



//INtersection observer for the Navbar mobile
const handleScroll = (entries) => {
    const spotIsVisible = entries[0].isIntersecting;
    if (spotIsVisible) $navbarMobile.classList.remove("active");
    else $navbarMobile.classList.add("active");
};
const options = {
    root: null,
    rootMargin: "0px",
    threshhold: 0,
};
const observer = new IntersectionObserver(handleScroll, options);
observer.observe($spot)

//accordion

var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.maxHeight) {
            panel.style.maxHeight = null;
        } else {
            panel.style.maxHeight = panel.scrollHeight + "px";
        }
    });
}