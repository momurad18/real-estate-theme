<?php

get_header();
get_template_part( 'templates/section', 'hero');
if ( have_posts() ):
?>

	<article
		id="post-<?php echo esc_attr( get_the_ID() ); ?>"
		data-id="<?php echo esc_attr( get_the_ID() ); ?>"
		class="is-post"
	>
		<?php
		while ( have_posts() ) : the_post();
			get_template_part( 'templates/content-single', 'project' );
		endwhile;
		?>
	</article>

<?php
endif;

get_footer();