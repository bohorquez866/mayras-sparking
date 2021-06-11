    </main>
    <footer class="footer">
        <div class="footer__wrapper">
            <figure class="logo">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <img src="<?php the_field( 'logo', 'options' ); ?>" alt="Logo">
                </a>
            </figure>

            <?php wp_nav_menu( array(
                'theme_location' => 'header-menu',
                    'container' => false,
                    'menu_class' => 'footer__links'
                ));
            ?>
            <ul class="footer__contact">
                <li class="footer-title-1">
                    <p>
                        <?php
                            $title = get_field('titulo_contactenos', 'options');
                            $title_array = explode('/', $title);
                            $first_word = $title_array[0];
                            $second_word = $title_array[1];
                        ?>
                        <?php echo $first_word; ?>
                    </p>
                </li>
                <li>
                    <span><?php the_field( 'telefono','options'); ?></span>
                    <a href="tel:<?php the_field( 'titulo_telefono','options'); ?>"><?php the_field( 'titulo_telefono', 'options' ); ?>
                        <?php the_field( 'telefono','options'); ?></a>
                </li>
                <li>
                    <span><?php the_field( 'titulo_email','options'); ?></span>
                    <a href="mailto:<?php the_field( 'email','options'); ?>"><?php the_field( 'titulo_email', 'options' ); ?>
                        <?php the_field( 'email','options'); ?>
                    </a>
                </li>

                <div class="social-footer">
                    <span><?php the_field( 'titulo_email','options'); ?></span>
                    <ul>
                        <?php echo do_shortcode('[social_media]'); ?>
                    </ul>
                </div>
            </ul>
        </div>
    </footer>
    <?php wp_footer(); ?>
    </body>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
    let aos = AOS.init({
    // Global settings:
    disable: false, // accepts following values: 'phone', 'tablet', 'mobile', boolean, expression or function
    startEvent: 'DOMContentLoaded', // name of the event dispatched on the document, that AOS should initialize on
    initClassName: 'aos-init', // class applied after initialization
    animatedClassName: 'aos-animate', // class applied on animation
    useClassNames: false, // if true, will add content of `data-aos` as classes on scroll
    disableMutationObserver: false, // disables automatic mutations' detections (advanced)
    debounceDelay: 50, // the delay on debounce used while resizing window (advanced)
    throttleDelay: 99, // the delay on throttle used while scrolling the page (advanced)
    // Settings that can be overridden on per-element basis, by `data-aos-*` attributes:
    offset: 120, // offset (in px) from the original trigger point
    delay: 0, // values from 0 to 3000, with step 50ms    
    duration: 1000, // values from 0 to 3000, with step 50ms
    easing: 'ease', // default easing for AOS animations
    once: true, // whether animation should happen only once - while scrolling down
    mirror: false, // whether elements should animate out while scrolling past them
    anchorPlacement: 'top-bottom', // defines which position of the element regarding to window should trigger the animation

});
    </script>

    </html>