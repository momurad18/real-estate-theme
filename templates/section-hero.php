<?php

$theme_top                  = true;
$theme_top_title_title      = '';
$theme_top_title_text       = '';
$theme_top_title_background = '';


if ( is_home() ) :
	$theme_top_title_title = esc_html__( 'المدونة العقارية', 'mytheme' );
	$theme_top_title_text  = esc_html__( 'علومات مفيدة و قيّمة عن الاستثمار  في تركيا ', 'mytheme' );
elseif ( is_post_type_archive( 'project' ) ) :
	$theme_archive_title = esc_html__( 'المشاريع العقارية', 'mytheme' );
	$theme_archive_title = esc_html__( 'المشاريع العقارية', 'mytheme' );
	$theme_top_title_text = esc_html__( 'كل المشاريع العقارية في عموم تركيا', 'mytheme' );
	$theme_top_title_title = $theme_archive_title;
	$theme_top_title_background = esc_url(wp_get_attachment_image_url( 61, 'full' ));
elseif ( is_category() || is_tag() || ( is_archive() && ! is_tax() && ! is_author() ) ) :
	$theme_top_title_title = get_the_archive_title();
	$theme_top_title_text  = get_the_archive_description();
elseif ( is_singular( 'post' ) ) :
	$theme_top_title_title = esc_html__( get_the_title($post->ID) );
	$theme_top_title_text  = esc_html__( get_the_date() );
	global $post;
	$theme_image = get_the_post_thumbnail_url( $post->ID);
	if ( ! empty( $theme_image ) ) :
		$theme_top_title_background = $theme_image;
	endif;
elseif ( is_singular( 'project' ) ) :
	global $post;
	$theme_top_title_title = get_the_title($post->ID);
	$location = get_field('location', $post->ID);
	$theme_image = get_the_post_thumbnail_url( $post->ID);
	if ( ! empty( $theme_image ) ) :
		$theme_top_title_background = $theme_image;
	endif;
elseif ( is_singular( 'page' ) || is_singular( 'testimonial' ) ) :
	$theme_top_title_title = get_the_title();
	global $post;
	$theme_image = get_the_post_thumbnail_url( $post->ID);
	if ( ! empty( $theme_image ) ) :
		$theme_top_title_background = $theme_image;
	endif;
elseif ( is_search() ) :
	$theme_top_title_title = esc_html__( 'نتائج البحث عن ', 'mytheme' ) . get_search_query();
elseif ( is_archive() && is_tax() && ! is_author() ) :
	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
	$image = get_field('taxonomy-image', $term);
	$theme_top_title_title = $term->name;
	$theme_top_title_text  = $term->description;
	$theme_top_title_background = $image['url'];
elseif ( is_author() ) :
	array_push( $theme_top_title_class, 'mh-top-title--author' );
endif;

if ( $theme_top ) :
	?>
<section id="page-hero" style="background-image: url(<?php echo $theme_top_title_background; ?>)">
	<div class="cover-overlay">
	</div>
	<div class="title-container">
		<h2><?php echo esc_html( $theme_top_title_title ); ?></h2>
		<?php
		if($location):?>
			<div class="address">
				<a href="#project-map"><i class="flaticon-location" style="color: #fff">
				</i></a>
				<span>
					
							<?php echo $location['address']; ?>
				</span>
			</div>
		<?php endif ?>
		<?php if ( ! empty( $theme_top_title_text ) ) : ?>
            <div class="address"><?php echo wp_kses_post( $theme_top_title_text ); ?></div>
		<?php endif ?>
	</div>
</section>

<?php endif ?>