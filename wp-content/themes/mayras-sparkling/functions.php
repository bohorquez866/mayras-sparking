<?php
  if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
      'page_title'    => 'Configuración General',
      'menu_title'    => 'Configuraciones',
      'menu_slug'     => 'theme-general-settings',
      'capability'    => 'edit_posts',
      'redirect'      => false,
      'position'      => '2.1',
      'icon_url'      => 'dashicons-admin-settings',
    ));
}
function register_my_menus() {
    register_nav_menus(
      array(
		    'header-menu' => __( 'Header Menu' ), 
        'social-menu' => __( 'Social Menu' )
     )
    );
}
add_action( 'init', 'register_my_menus' ); 

// add theme suppor post thumbnails
add_theme_support( 'post-thumbnails' );

// Support Titulos
add_theme_support( 'title-tag' );

// Remover Editor
function remove_editor() {
  remove_post_type_support('page', 'editor');
}
add_action('admin_init', 'remove_editor');

function scripts(){
  wp_register_style('style', get_stylesheet_directory_uri() . '/sass/styles.css', [], 1, 'all'); 
  wp_enqueue_style('style');
  
}
add_action('wp_enqueue_scripts', 'scripts');
add_action('get_header', 'my_filter_head');
 
function add_this_script_footer(){
   //Swipper Js
   wp_register_script('swipper-js', get_stylesheet_directory_uri() . '/templates/src/assets/js/swiper.js');
   wp_enqueue_script('swipper-js');
   wp_register_script('app', get_stylesheet_directory_uri() . '/dist/js/app.js', 1, true);
   //uncompiled Script
  wp_register_script('script-js', get_stylesheet_directory_uri() . '/templates/src/assets/js/script.js');
   wp_enqueue_script('script-js');
   wp_enqueue_script('app');
}
add_action('wp_footer', 'add_this_script_footer');

function my_filter_head() {
   remove_action('wp_head', '_admin_bar_bump_cb');
} 
load_theme_textdomain('mayras', get_template_directory() . '/languages');

add_filter( 'wpcf7_autop_or_not', '__return_false' );
// social media header
function wp_custom_social_media($content = null) {
  ob_start(); ?>
<?php if( have_rows('redes_sociales', 'options') ): ?>
<?php while( have_rows('redes_sociales', 'options') ): the_row(); ?>
<?php 
              $name_select_sub_field = (get_sub_field_object('tipo_red_social','options'));
              $name_sub_field = get_sub_field('tipo_red_social','options');
              $label_select = ($name_select_sub_field['choices'][$name_sub_field]);
            ?>
<?php if( get_sub_field('url_red_social', 'options') ) { ?>
<li>
    <a class="icon-<?php the_sub_field( 'tipo_red_social','options' ); ?>"
        href="<?php the_sub_field('url_red_social', 'options'); ?>" target="_blank" title="Coming Soon"> </a>
</li>
<?php } ?>
<?php endwhile; ?>
<?php endif;
  $content = ob_get_contents();
  ob_end_clean();
  return $content;  
}
add_shortcode('social_media', 'wp_custom_social_media');

// Shortcode Slider
function wp_benefits_how_we_work($content = null) {
	ob_start(); ?>
<div class="banner_slider_section"
    style="background-image: url('<?php the_field( 'imagen_benefits_how_we_work'); ?>');">
    <div class="banner_slider_section_general">
        <h3>
            <?php
                $title = get_field('titulo_benefits_how_we_work');
                $title_array = explode('/', $title);
                $first_word = $title_array[0];
                $second_word = $title_array[1];
            ?>
            <?php echo $first_word; ?> <strong><?php echo $second_word; ?></strong>
        </h3>
        <div class="banner_slider_prin">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <?php if( have_rows('lista_benefits_how_we_work') ): $a = 0  ?>
                    <?php while( have_rows('lista_benefits_how_we_work') ): the_row(); $a++ ?>
                    <div class="swiper-slide">
                        <figure>
                            <img src="<?php the_sub_field( 'imagen_benefits_how_we_work'); ?>"
                                alt="Benefits-How we Work">
                        </figure>
                        <p><?php the_sub_field( 'texto_benefits_how_we_work'); ?></p>
                    </div>
                    <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;  
}
add_shortcode('benefits_how_we_work', 'wp_benefits_how_we_work');

// Shortcode Slider
function wp_banner_general($content = null) {
	ob_start(); ?>
<div class="banner_general" style="background-image: url('<?php the_field( 'banner_general'); ?>');">
    <h1><?php the_title(); ?></h1>
    <h3><?php the_field('titulo_banner_general'); ?></h3>
</div>
<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;  
}
add_shortcode('banner_general', 'wp_banner_general');

/*-----------------------------------
Select Services
-----------------------------------*/
function add_listServices_to_CF7 ( $tag, $unused ) {
  if ( $tag['name'] != 'list_services' ){
        return $tag;
  }
  $args = get_posts(array(
      'post_type' => 'service',
      'post_status' => 'publish',
      'posts_per_page' => -1,
      'update_post_meta_cache' => false,
      'update_post_term_cache' => false,
  ));

  foreach ( $args as & $arg ) {
      $tag['raw_values'][] = $arg->post_title;
      $tag['values'][] = $arg->post_title;
  }
  return $tag;
}
add_filter( 'wpcf7_form_tag', 'add_listServices_to_CF7', 10, 2);

function the_excerpt_max_charlength($charlength) {
	$excerpt = get_the_excerpt();
	$charlength++;

	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut );
		} else {
			echo $subex;
		}
		echo '...';
	} else {
		echo $excerpt;
	}
}