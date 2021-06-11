<?php
/* Template Name: Template - About*/
get_header(); ?>
<!-- Banner -->
<?php echo do_shortcode('[banner_general]'); ?>
<!-- About -->
<section class="section_about_contact">
    <div class="section_about_contact_image">
        <img src="<?php the_field('imagen_general_about'); ?>" alt="<?php the_field('titulo_banner_general'); ?>">
    </div>
    <div class="section_about_contact_info">
        <?php the_field('texto_general_about'); ?>
        <a href="<?php echo esc_url( home_url( '/contact-us' ) ); ?>"><?php the_field('label_general_about'); ?></a>
    </div>
</section>
<!-- How we work -->
<?php echo do_shortcode('[benefits_how_we_work]'); ?>
<!-- Questions -->
<section class="section_about_questions">
    <h3>
        <?php
            $title = get_field('titulo_questions_about');
            $title_array = explode('/', $title);
            $first_word = $title_array[0];
            $second_word = $title_array[1];
        ?>
        <?php echo $first_word; ?> <strong><?php echo $second_word; ?></strong>
    </h3>
    <div class="section_about_questions_prin">
        <ul>
            <?php if( have_rows('lista_questions_about') ): $a = 0  ?>
            <?php while( have_rows('lista_questions_about') ): the_row(); $a++ ?>
                <li>
                    <h4><?php the_sub_field('titulo_lista_questions_about'); ?></h4>
                    <p><?php the_sub_field('texto_lista_questions_about'); ?></p>
                </li>
            <?php endwhile; ?>
            <?php endif; ?>
        </ul>
    </div>
</section>

<?php get_footer(); ?>