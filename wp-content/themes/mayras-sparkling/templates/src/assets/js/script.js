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
            clickable: true

        }
    });

    var swiper = new Swiper(".home-service-swiper", {
        slidesPerView: 4,
        spaceBetween: 40,
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

        },
        autoplay: {
            delay: 4500,
            disableOnInteraction: false,
        },

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



let accordion = document.querySelectorAll('.services_lists_items');


if (window.innerWidth > 768) {
    if (accordion) {
        accordion.forEach(acc => {
            const accordionItems = acc.querySelectorAll('.services_lists_item');
            accordionItems.forEach((item) => {
                const title = item.querySelector('.accordion');

                title.addEventListener('click', (e) => {

                    const opened_item = acc.querySelector('.active');
                    console.log(title);
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
                    body.style.height = 'initial';
                    item.classList.add('active');
                }
            }
            toggle_item(accordionItems[0]);

        });
    }


} else {
    let accordion = document.querySelectorAll('.service-mobile');
    if (accordion) {
        accordion.forEach(acc => {

            var accordionItems = acc.querySelectorAll('.services_lists_item');
            accordionItems.forEach((item, index) => {
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
                    body.style.height = 'initial';
                    item.classList.add('active');
                }
            }
            toggle_item(accordionItems[0]);



        });
    }
}


/*
 * Tabs
 */

function openTab(evt, tabIdentifier) {
    // Declare all variables
    let i, tabcontent, tablinks;

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
    document.getElementById(tabIdentifier).style.display = "flex";
    // console.log(tabIdentifier + ' this is from tab');
    document.getElementById(`${tabIdentifier}`).className += " active";
    evt.currentTarget.className += " active";


}

let minimum = 0,
    tabCounter = 1,
    $nextTabArrow = document.querySelectorAll('.arrow-next-tab'),
    $prevTabArrow = document.querySelectorAll('.arrow-prev-tab');




$nextTabArrow.forEach(next => {

    if (tabCounter > 0 && tabCounter < $nextTabArrow.length) {
        next.addEventListener('click', () => {

            tabCounter++;
            if (tabCounter > $nextTabArrow.length) {
                tabCounter = 1;
            }
            openTab(event, `service-${tabCounter}`);
            let tablinks2 = document.querySelector(`.tablinks#service-${tabCounter}`);
            tablinks2.classList.add('active');

            if (tabCounter == $nextTabArrow.length) {
                tabCounter = minimum;
            }

        })
    }
});

$prevTabArrow.forEach(prev => {

    prev.addEventListener('click', () => {


        tabCounter < 2 ? tabCounter = $prevTabArrow.length : tabCounter--
            openTab(event, `service-${tabCounter}`);
        let tablinks2 = document.querySelector(`.tablinks#service-${tabCounter}`);
        tablinks2.classList.add('active');
    })


});








//tab for mobile grand-parent 

var btns = document.getElementsByClassName('tab');
var items = document.getElementsByClassName('item');
if (items) {
    items[0].classList.add('active');
}

if (items && btns) {


    var myTabs = function myTabs() {
        var _this = this;
        var attribute = this.getAttribute("data-id");

        [...items].forEach(function(element, index, array) {

            console.log(element[0]);
            if (element.getAttribute('id') === attribute) {
                element.classList.add("active");
                [...btns].forEach(function(element, index, array) {
                    element.classList.remove('active');
                });
                _this.classList.add("active");
            } else {
                element.classList.remove("active");
            }
        });
    };
    [...btns].forEach(function(element, index, array) {
        element.addEventListener('click', myTabs);
    });
}



//

let $selectService = document.querySelector('.select-service'),
    $selectServiceItems = document.querySelectorAll('.select-service ul');


$selectService.addEventListener('click', (e) => {
    console.log(e.target.nodeName);

    if (e.target.nodeName == 'H3') {
        $selectService.classList.add('active');
    } else if (e.target.nodeName == 'LI') {
        $selectService.classList.remove('active');

    }


});


let ids, tablinks;
tablinks = document.querySelectorAll('.tablinks');
let hashOriginal = window.location.hash;
let hash = hashOriginal.replace('#', '');
for (let i = 0; i < tablinks.length; i++) {
    tablinks[i].setAttribute('id', `service-${i + 1}`);
}
ids = tablinks.forEach(tab => {
    if (tab.id == hash) {
        let result = tab;
        console.log(result);
        result.click();
    } else if (hash == '') {
        tablinks[0].click();
    }
});