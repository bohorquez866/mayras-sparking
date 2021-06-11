<?php
/* Template Name: Template - Contact Us*/
get_header(); ?>

<?php echo do_shortcode('[banner_general]'); ?>

<section class="contact-us">
    <?php get_template_part( 'templates/content-form'); ?>
</section>
<?php get_footer(); ?>