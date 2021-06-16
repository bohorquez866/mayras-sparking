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


/*
 *accordion
 */


// var acc = document.getElementsByClassName("accordion");
// var i;

// for (i = 0; i < acc.length; i++) {
//     acc[i].addEventListener("click", function() {
//         this.classList.toggle("active");
//         var panel = this.nextElementSibling;
//         if (panel.style.maxHeight) {
//             panel.style.maxHeight = null;
//         } else {
//             panel.style.maxHeight = panel.scrollHeight + "px";
//         }
//     });
// }


const accordion = document.querySelectorAll('.services_lists_items');

if (accordion) {
    accordion.forEach(acc => {
        const accordionItems = acc.querySelectorAll('.services_lists_item');
        accordionItems.forEach((item) => {
            const title = item.querySelector('.accordion');

            title.addEventListener('click', (e) => {

                const opened_item = acc.querySelector('.active');
                // Toggle current item
                toggle_item(item);
                // Close earlier opened item if exists
                if (opened_item && opened_item !== item) {
                    toggle_item(opened_item);
                }
            });
        });
        const toggle_item = (item) => {
            const body = item.querySelector('.panel');
            if (item.classList.contains('active')) {
                body.removeAttribute('style');
                item.classList.remove('active');
            } else {
                body.style.height = body.scrollHeight + 'px';
                item.classList.add('active');
            }
        }
        toggle_item(accordionItems[0]);

    });
}


/*
 * Tabs
 */

function openCity(evt, cityName) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tab-content");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(cityName).style.display = "flex";
    evt.currentTarget.className += " active";
}


var ids, tablinks;
tablinks = document.querySelectorAll('.tablinks');
var hashOriginal = window.location.hash;
var hash = hashOriginal.replace('#', '');
for (let i = 0; i < tablinks.length; i++) {
    tablinks[i].setAttribute('id', `${i + 1}`);
}
ids = tablinks.forEach(tab => {
    if (tab.id == hash) {
        let result = tab;
        result.click();
    } else if (hash == '') {
        tablinks[0].click();
    }
});