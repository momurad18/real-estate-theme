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
<section class="cat-details mt-5 mb-5" style="text-align: center; min-height: 500px">
		<div class="container">
			<div class="row">
				<?php 

				if ( have_posts() ) :
					while ( have_posts() ) : the_post();
					
					
					?>
					
							<?php
								$city = get_field( 'city', get_the_ID() );
								$district = get_field( 'district', get_the_ID() );
								$type = get_field( 'property_type', get_the_ID() );
								$status = get_field_object('under_cons', get_the_ID());
								$featured = get_field('featured', get_the_ID());




								if( have_rows('estate_details', get_the_ID())):
									while( have_rows('estate_details',get_the_ID())): the_row();
										$price = get_sub_field_object('price',get_the_ID())['value'];
										$size = get_sub_field_object('estate_size',get_the_ID())['value'];
										break;
									endwhile;
								else:
									$price = 0;
									$size = 0 ;
								endif;

							?>
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<div class="project-card">
									<div class="card-image">
										<img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="" style="width: 100%; height: 200px">
										<?php if($featured): ;?>
										<div class="badget featured" style=""><i class="flaticon-star"></i></div>
										<?php endif ;?>
										<div class="badget type" style=""><?php echo $type->name; ?></div>
									</div>
									<div class="body" style="padding: 8px;">
										<h4><?php the_title(); ?></h4>
										<ul>
											<li><i class="flaticon-location"></i><?php echo $city->name; ?> - <?php echo $district->name; ?></li>
											<li><i class="flaticon-cube-with-arrows"></i>

											<?php if($size > 0):?> 
											<span>المساحة تبدأ من </span><span>M<sup>2</sup> </span>
											<?php echo $size; 
											else:
											?>
											<span>غير متوفر</span>
											<?php
											endif;
											?>
											</li>
											<?php

												if($status['value'] == 1):?>
												<li><i class="flaticon-calendar"></i>
													<?php
														$notice = get_field_object('date',get_the_ID());
													?>
													<span><?php echo $notice['label'];?></span>
													<span><?php echo $notice['value']; ?></span>
													
												</li>
												<?php else:?>
												<li>
													<i class="flaticon-calendar"></i>
													<span>جاهز للتسليم</span>
												</li>	 
												<?php endif?>
										</ul>
									</div>
									<div class="footer">
										<div>
											<?php if($price > 0):?> 
											<span>الأسعار تبدأ من </span><span>TL </span>
											<?php echo $price; 
											else:
											?>
											<span>غير متوفر</span>
											<?php
											endif;

										?>
										</div>
										<div><a href="<?php the_permalink(); ?>">التفاصيل</a></div>
									</div>
								</div>
							</div>
										<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>

				<?php endif; ?>
			</div>
			<div class="row justify-content-center mt-3">
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

<?php get_footer();?>