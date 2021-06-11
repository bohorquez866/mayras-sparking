<div class="contact-us-form">
	<h1>
		<?php
			$title = get_field('titulo_contactenos','options');
			$title_array = explode('/', $title);
			$first_word = $title_array[0];
			$second_word = $title_array[1];
		?>
		<span><?php echo $first_word; ?></span>
		<strong><?php echo $second_word; ?></strong>
	</h1>
	<p><?php the_field( 'texto_contactenos','options'); ?></p>
	<?php
		$post_object = get_field('formulario_contactenos','options');
		if( $post_object ): 
			$post = $post_object;
			setup_postdata( $post ); 
			$cf7_id = $post->ID;
			echo do_shortcode( '[contact-form-7 id="'.$cf7_id.'" ]' ); 
			wp_reset_query();
		endif;
	?>
</div>