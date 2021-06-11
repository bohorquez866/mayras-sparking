<!DOCTYPE html>
<html lang="<?php bloginfo('language'); ?>">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, , user-scalable=no">
    <meta charset="<?php bloginfo('charset'); ?>">
    <title><?php bloginfo('name'); ?></title>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url') ?>">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header class="header">
        <nav class="navbar">
            <div class="logo">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <img src="<?php the_field( 'logo', 'options' ); ?>" alt="Logo">
                </a>
            </div>
            <?php wp_nav_menu( array(
                'theme_location' => 'header-menu',
                    'container' => false,
                    'menu_class' => 'navbar__list'
                ));
            ?>
        </nav>
        <div class="header_fixed">
            <ul>
                <li>
                    <a href="mailto:<?php the_field( 'email','options'); ?>"></a>
                </li>
                <li>
                    <a href="tel:<?php the_field( 'telefono','options'); ?>"></a>
                </li>
                <?php echo do_shortcode('[social_media]'); ?>
            </ul>
        </div>
    </header>
    
    <div class="burger-menu">
            <span></span>
            <span></span>
            <span></span>
        </div>

    <nav class="mobile-menu">
        <div class="burger-menu">X</div>
        <div class="logo">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <img src="<?php the_field( 'logo_mobile', 'options' ); ?>" alt="Logo">
            </a>
        </div>
        <?php wp_nav_menu( array(
            'theme_location' => 'header-menu',
                'container' => false,
                'menu_class' => 'navbar__list'
            ));
        ?>
        <div class="footer responsive">
            <ul class="footer__contact responsive">
                <h3>
                    <p>
                        <?php
                        $title = get_field('titulo_contactenos', 'options');
                        $title_array = explode('/', $title);
                        $first_word = $title_array[0];
                        $second_word = $title_array[1];
                    ?>
                        <?php echo $first_word; ?>
                    </p>
                </h3>
                <li>
                    <p><strong> <?php the_field('titulo_telefono','options'); ?></strong>
                        <a href="tel:<?php the_field('telefono','options'); ?>">
                          <?php the_field('telefono','options'); ?>
                        </a>
                    </p>
                    <p> <strong><?php the_field('titulo_email','options'); ?> </strong>
                        <a href="mailto:<?php the_field('email','options'); ?>">
                            <?php the_field('email','options'); ?>
                        </a>
                    </p>
                </li>
                <div class="social-media-footer">
                    <?php echo do_shortcode('[social_media]'); ?>
                </div>
            </ul>
        </div>
    </nav>

    <main class="main_site">