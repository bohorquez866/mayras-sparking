<?php
/* Template Name: Template - Services*/
get_header(); ?>
<section class="services_section">
    <div class="services_section_content wrap">

        <?php
            $args = array( 
                'post_type' => 'service', 
                'post_status' => 'publish',
                'posts_per_page' => -1
            );
            $wp_query = new WP_Query($args); ?>
        <?php if($wp_query->have_posts()) : $a = 0 ?>
        <?php while ($wp_query->have_posts()) : $wp_query->the_post(); $a++ ?>



        <div id="service-<?php echo $a ?>" class="container-tab tab-content">
            <!-- Services IMGS -->
            <div class="services_img">
                <div class="services_img_section" id="service-<?php echo $d;?>">
                    <div class="services_img_item">
                        <?php the_post_thumbnail(); ?>
                    </div>
                    <?php if( have_rows('lista_imagenes_servicio') ): $b = 0  ?>
                    <?php while( have_rows('lista_imagenes_servicio') ): the_row(); $b++ ?>
                    <div class="services_img_item">
                        <figure>
                            <img src="<?php the_sub_field('imagen_lista_imagenes_servicio'); ?>" alt="Image Servicio">
                        </figure>
                    </div>
                    <?php endwhile; ?>
                    <?php endif; ?>
                    <div class="services_img_item">
                        <div class="arrow-next-tab icon-arrow2"></div>
                        <div class="arrow-prev-tab icon-arrow2"></div>
                        <img src="<?php the_field('imagen_servicio'); ?>" alt="Image Servicio">
                    </div>
                </div>
            </div>




            <!-- Services List -->
            <section class="services_lists">


                <div class="services_lists_items" id="service-<?php echo $d;?>">
                    <h3><?php _e('Services','mayras'); ?></h3>
                    <div class="services_lists_item">

                        <h2 class="services_lists_item_title accordion main">

                            <i class="icon-cross"></i>
                            <?php the_title(); ?>
                        </h2>
                        <div class="services_lists_item_content panel main"><?php the_content(); ?> </div>
                    </div>


                    <?php if( have_rows('lista_productos') ): $c = 0  ?>
                    <?php while( have_rows('lista_productos') ): the_row(); $c++ ?>
                    <!-- //accordion -->
                    <div class="services_lists_item">
                        <h3 class="services_lists_item_title accordion ">
                            <i class="icon-cross"></i>
                            <?php the_sub_field('titulo_lista_productos'); ?>
                        </h3>
                        <div class="services_lists_item_content panel"><?php the_sub_field('texto_lista_productos'); ?>
                        </div>
                    </div>
                    <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </section>
        </div>


        <?php endwhile; ?>
        <?php endif; ?>
        <?php wp_reset_query(); ?>


    </div>

    <!-- Services titles -->
    <div class="services_titles tab">
        <h1><?php _e('All Our Services','mayras'); ?></h1>


        <div class="services_titles_list">
            <?php
                $args = array( 
                    'post_type' => 'service', 
                    'post_status' => 'publish',
                    'posts_per_page' => -1
                );
                $wp_query = new WP_Query($args); ?>


            <?php if($wp_query->have_posts()) : $e = 0 ?>

            <?php while ($wp_query->have_posts()) : $wp_query->the_post(); $e++ ?>


            <div class="services_titles_list_item tablinks" onclick="openTab(event, 'service-<?php echo  $e ?>')"
                data-id="service-<?php echo $e;?>">


                <h3><?php _e('Services','mayras'); ?></h3>
                <h4><?php the_title(); ?></h4>
            </div>
            <?php endwhile; ?>
            <?php endif; ?>
            <?php wp_reset_query(); ?>
        </div>
    </div>


    <!-- RESPOSNVIE -->


</section>


<!-- RESPONSIVE -->

<article class="responsive-services">

    <div class="select-service">
        <h3>All our services</h3>
        <ul>
            <?php
                $args = [ 
                    'post_type' => 'service', 
                    'post_status' => 'publish',
                    'posts_per_page' => -1
                ];
                $wp_query = new WP_Query($args); ?>


            <?php if($wp_query->have_posts()) : $e = 0 ?>

            <?php while ($wp_query->have_posts()) : $wp_query->the_post(); $e++ ?>


            <li class="tab" data-id="servicio-<?php echo  $e ?>"><?php the_title(); ?></li>


            <?php endwhile; ?>
            <?php endif; ?>
            <?php wp_reset_query(); ?>
        </ul>
    </div>

    <section class="services_lists_items">




        <?php
                $args = [ 
                    'post_type' => 'service', 
                    'post_status' => 'publish',
                    'posts_per_page' => -1
                ];
                $wp_query = new WP_Query($args); ?>

        <?php if($wp_query->have_posts()) : $e = 0 ?>

        <?php while ($wp_query->have_posts()) : $wp_query->the_post(); $e++ ?>






        <div class="service-mobile item" id="servicio-<?php  echo $e ?>">
            <img class="head-pic" src="<?php the_field('imagen_servicio_mobile'); ?>" alt="<?php the_title(); ?>">

            <article class="services_lists_item">
                <div class="title-responsive accordion">
                    <i class="icon-cross"></i>
                    <h3>Services</h3>
                    <h4><?php the_title(); ?></h4>
                </div>


                <div class="services_lists_item_content panel main">
                    <?php the_content(); ?>
                </div>
            </article>





            <?php if( have_rows('lista_productos') ): $c = 0  ?>
            <?php while( have_rows('lista_productos') ): the_row(); $c++ ?>

            <article class="services_lists_item">

                <h3 class="services_lists_item_title accordion">
                    <i class="icon-cross"></i>
                    <?php the_sub_field('titulo_lista_productos'); ?>
                </h3>

                <div class="services_lists_item_content panel">
                    <?php the_sub_field('texto_lista_productos'); ?>
                </div>



            </article>
            <?php endwhile; ?>
            <?php endif; ?>
        </div>





        <?php endwhile; ?>
        <?php endif; ?>
        <?php wp_reset_query(); ?>

    </section>









</article>
<?php get_footer(); ?>