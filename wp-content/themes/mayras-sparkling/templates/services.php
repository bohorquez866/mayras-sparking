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
                        <img src="<?php the_field('imagen_servicio'); ?>" alt="Image Servicio">
                    </div>
                </div>
            </div>


        <!-- Services List -->
            <div class="services_lists">
                <h3><?php _e('Services','mayras'); ?></h3>
                <div class="services_lists_items" id="service-<?php echo $d;?>">
                    <div class="services_lists_item">
                        <h2 class="services_lists_item_title"><?php the_title(); ?></h2>
                        <div class="services_lists_item_content"><?php the_content(); ?> </div>
                    </div>
                    <?php if( have_rows('lista_productos') ): $c = 0  ?>
                    <?php while( have_rows('lista_productos') ): the_row(); $c++ ?>
                    <!-- //accordion -->
                    <div class="services_lists_item">
                        <h3 class="services_lists_item_title accordion">
                            <?php the_sub_field('titulo_lista_productos'); ?>
                        </h3>
                        <div class="services_lists_item_content panel"><?php the_sub_field('texto_lista_productos'); ?></div>
                    </div>
                    <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        <?php endwhile; ?>
        <?php endif; ?>
        <?php wp_reset_query(); ?>
    </div>

    <!-- Services titles -->
    <div class="services_titles">
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
            <div class="services_titles_list_item" data-id="service-<?php echo $d;?>">
                <h3><?php _e('Services','mayras'); ?></h3>
                <h4><?php the_title(); ?></h4>
            </div>
            <?php endwhile; ?>
            <?php endif; ?>
            <?php wp_reset_query(); ?>
        </div>
    </div>


</section>
<?php get_footer(); ?>