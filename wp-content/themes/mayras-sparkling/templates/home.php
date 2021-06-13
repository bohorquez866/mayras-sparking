<?php
/* Template Name: Template - Home*/
get_header(); ?>
<!-- Banner -->
<section class="home-swiper home-swiper1">

    <div class="arrow prev prev1"> <i class="icon-arrow-black"></i> </div>
    <div class="arrow next next1"><i class="icon-arrow-black"></i> </div>
    <div class="swiper-pagination swiper-pagination-swiper"></div>
    <ul class="swiper-wrapper">
        <?php if( have_rows('slider_banner_inicio') ): $a = 0  ?>
        <?php while( have_rows('slider_banner_inicio') ): the_row(); $a++ ?>
        <li class="swiper-slide">
            <div class="swiper-item" style="background-image: url('<?php the_sub_field( 'imagen_fondo_inicio'); ?>');">
                <article>
                    <h2><?php the_sub_field( 'titulo_banner_inicio'); ?></h2>
                    <span><?php the_sub_field( 'texto_banner_inicio'); ?></span>
                    <a href="<?php echo esc_url( home_url( '/services' ) ); ?>">
                        <?php the_field( 'label_banner_inicio'); ?>
                    </a>

                </article>
            </div>
        </li>
        <?php endwhile; ?>
        <?php endif; ?>
    </ul>

</section>
<!-- About -->
<section class="home-about">
    <div class="home-about-content">
        <?php
            $title = get_field('titulo_about_inicio');
            $title_array = explode('/', $title);
            $first_word = $title_array[0];
            $second_word = $title_array[1];
        ?>
        <div class="home-about-imgs">
            <?php if( have_rows('lista_about_inicio') ): $b = 0  ?>
            <?php while( have_rows('lista_about_inicio') ): the_row(); $b++ ?>
            <figure>
                <img src="<?php the_sub_field( 'imagen_about_inicio'); ?>" alt="<?php echo $second_word; ?>">
            </figure>
            <?php endwhile; ?>
            <?php endif; ?>
        </div>
        <div class="home-about-info">
            <h1>
                <p><?php echo $first_word; ?></p> <strong><?php echo $second_word; ?></strong>
            </h1>
            <p><?php the_field( 'texto_about_inicio'); ?></p>
            <a href="<?php echo esc_url( home_url( '/services' ) ); ?>"><?php the_field( 'label_contact_inicio'); ?></a>
        </div>
    </div>
</section>
<!-- Services -->
<section class="home-services" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
    <h3>
        <?php
            $title = get_field('titulo_services_inicio');
            $title_array = explode('/', $title);
            $first_word = $title_array[0];
            $second_word = $title_array[1];
        ?>
        <span><?php echo $first_word; ?></span>
        <strong><?php echo $second_word; ?></strong>
    </h3>
    <p><?php the_field( 'texto_services_inicio'); ?></p>
    <div class="swiper-pagination swiper-pagination-service"></div>
    <div class="home-service-swiper">
        <ul class="home-services__list swiper-wrapper">
            <?php
            $args = array( 
                'post_type' => 'service', 
                'post_status' => 'publish',
                'posts_per_page' => -1,
            );
            $wp_query = new WP_Query($args); ?>
            <?php if($wp_query->have_posts()) : $c = 0 ?>
            <?php while ($wp_query->have_posts()) : $wp_query->the_post(); $c++ ?>
            <li class="swiper-slide">
                <figure>
                    <img src="<?php the_field('imagen_servicio_home'); ?>" alt="<?php the_title(); ?>">
                </figure>
                <div class="title-wrapper">
                    <h3><?php the_title(); ?></h3>
                    <p><?php the_excerpt_max_charlength(70); ?></p>
                </div>
                <a
                    href="<?php echo esc_url( home_url( '/services' ) ); ?>#service-<?php echo $c;?>"><?php _e('Read More','mayras'); ?></a>
            </li>
            <?php endwhile; ?>
            <?php endif; ?>
            <?php wp_reset_query(); ?>
        </ul>
    </div>
</section>
<!-- Benefits -->
<?php echo do_shortcode('[benefits_how_we_work]'); ?>
<!-- Contact Us -->
<section class="contact-us-home">
    <?php get_template_part( 'templates/content-form'); ?>
</section>
<?php get_footer(); ?>