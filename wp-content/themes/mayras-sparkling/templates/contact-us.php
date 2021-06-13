<?php
/* Template Name: Template - Contact Us*/
get_header(); ?>
<section class="contact-banner">
    <?php echo do_shortcode('[banner_general]'); ?>
</section>

<section class="contact-us">
    <?php get_template_part( 'templates/content-form'); ?>
</section>
<?php get_footer(); ?>