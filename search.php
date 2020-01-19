<?php
/*
 * Page
 */
get_header();
get_template_part( 'templates/section', 'hero');
?>

<div style="margin-top: -25px">
	<div class="container">
		<div class="row">
			<div class="col-lg-9" style="text-align: right;">
				<?php 
				   if(function_exists('get_hansel_and_gretel_breadcrumbs')): 
				      echo get_hansel_and_gretel_breadcrumbs();
				   endif;
				?>
			</div>
			<div class="col-lg-3">
			</div>
		</div>
	</div>
</div>

<?php

	if ( have_posts() ) :
	?>
	<section class="blog-section mt-5">
		<div class="container">
			<div class="row justify-content-center">
				
						<?php while ( have_posts() ) : the_post(); ?>
						
								<div id="card" class="col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
									<article id="post-<?php echo esc_attr( get_the_ID() ); ?>" class="post-card">
										<a href="<?php the_permalink(); ?>" class="post-link">
											<div class="thumbnail">
												<img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="" style="width: 100%; height: 200px">
											</div>
											<div class="cap-date">
												<div class="date-inner">
												<?php echo esc_html( get_the_date() ); ?>
												</div>
											</div>
										</a>
										<div class="body">
											<h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
											<div class="excerpt">
												<?php echo esc_html( wp_trim_words( get_the_excerpt(), 35, esc_html( '...' ) ) ); ?>
											</div>
											<div class="btn-wrapper">
												<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="button button-style">اقراء المزيد</a>
											</div>
										</div>
									</article>
								</div>	
							
                        <?php 
                        endwhile;
                        wp_reset_postdata();
                        ?>
                      
			</div>

			<div class="row justify-content-center mt-4">
				<div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center">
					<?php
						global $wp_query;
						$big = 999999999;
								echo paginate_links(array(
									'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
									'format' => '?paged?%#%',
									'current' => max(1, get_query_var('paged')),
									'total' => $wp_query->max_num_pages,
									'prev_text'=>'&laquo;',
									'next_text'=>'&raquo;',
								));
						?>  
				</div>
			</div>
		</div>

	</section>
	<?php endif; ?>

<?php get_footer();?>