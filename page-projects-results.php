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
			<div class="row justify-content-center">
				<?php 
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$meta_query[] = array(
					'relation'		=> 'AND'
				);
				$_type = $_GET['type'] != 'any' ? $_GET['type'] : '';
        		$_city = $_GET['city'] != 'any' ? $_GET['city'] : '';
        		$_district = $_GET['district'] != 'any' ? $_GET['district'] : '';
				
        		$_roomsF = $_GET['rooms-from'] != 0 ? $_GET['rooms-from'] : 0;
        		$_roomsT = $_GET['rooms-to'] != 0 ? $_GET['rooms-to'] : 0;
				
				
        		$_priceF = $_GET['price-from'] != 0 ? $_GET['price-from'] : 0;
        		$_priceT = $_GET['price-to'] != 0 ? $_GET['price-to'] : 0;
				
				
        		$_sizeF = $_GET['size-from'] != 0 ? $_GET['size-from'] : 0;
        		$_sizeT = $_GET['size-to'] != 0 ? $_GET['size-to'] : 0;
				
				if($_type !== ''){
					$meta_query[] = array(
					 	'key'     => 'property_type', // assumed your meta_key is 'car_model'
						'value'   => $_type,
						'compare' => '=', // finds models that matches 'model' from the select field
					 );
				}
				
				if($_city !== ''){
					$meta_query[] = array(
						 
					 	'key'     => 'city', // assumed your meta_key is 'car_model'
						'value'   => $_city,
						'compare' => '=', // finds models that matches 'model' from the select field
					 );
				}
				if($_district !== ''){
					$meta_query[] = array(
						 
					 	'key'     => 'district', // assumed your meta_key is 'car_model'
						'value'   => $_district,
						'compare' => '=', // finds models that matches 'model' from the select field
					 );
				}
				
				/*if($_roomsF < $_roomsT){
					 $meta_query[] = array(
					 	'key'     => 'estate_details_$_bedrooms',
						'value'   => $_roomsF,
						'compare' => '>='
					 );
					
					$meta_query[] = array(
					 	'key'     => 'estate_details_$_bedrooms',
						'value'   => $_roomsT,
						'compare' => '<='
					 );
				}*/
				
				
				/*if($_roomsF >= $_roomsT){
					 $meta_query[] = array(
						 
					 	'key'     => 'estate_details_$_bedrooms', 
						'value'   => $_roomsF,
						'compare' => '>='
					 );
				}*/
				
				
			/*	if($_sizeF < $_sizeT){
					 $meta_query[] = array(
						 
					 	'key'     => 'estate_details_%_estate_size', // assumed your meta_key is 'car_model'
						'value'   => $_sizeF,
						'compare' => '>=', // finds models that matches 'model' from the select field
					 );
					
					$meta_query[] = array(
						 
					 	'key'     => 'estate_details_$_estate_size', // assumed your meta_key is 'car_model'
						'value'   => $_sizeT,
						'compare' => '<=', // finds models that matches 'model' from the select field
					 );
				}
				
				
				if($_sizeF >= $_sizeT){
					 $meta_query[] = array(
						 
					 	'key'     => 'estate_details_%_estate_size', // assumed your meta_key is 'car_model'
						'value'   => $_sizeF,
						'compare' => '>=', // finds models that matches 'model' from the select field
					 );
				}*/
				
				/*if($_priceF < $_priceT){
					 $meta_query[] = array(
						 
					 	'key'     => 'price', // assumed your meta_key is 'car_model'
						'value'   => array($_priceF, $_priceT),
						'compare' => 'between', // finds models that matches 'model' from the select field
					 );
				}
				
				
				if($_priceF >= $_priceT){
					 $meta_query[] = array(
						 
					 	'key'     => 'price', // assumed your meta_key is 'car_model'
						'value'   => $_priceF,
						'compare' => '>=', // finds models that matches 'model' from the select field
					 );
				}*/
				
				$args  = array(
					'post_type'		=> 'project',
					'suppress_filters' => false,
					'paged' 		=> $paged,
					'meta_query' 	=> $meta_query
					 );
				
				$posts = new WP_Query( $args );
				if( $posts->have_posts() ): ?>
				<?php 
				while ( $posts->have_posts() ) : $posts->the_post(); ?>
					
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
				<?php 
				endwhile;
				wp_reset_postdata();
				?>

				<?php endif; ?>
			</div>
			<div class="row justify-content-center mt-4">
				<div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center">
					<?php
			
						$big = 999999999;
								echo paginate_links(array(
									'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
									'format' => '?paged?%#%',
									'current' => max(1, get_query_var('paged')),
									'total' => $posts->max_num_pages,
									'prev_text'=>'&laquo;',
									'next_text'=>'&raquo;',
								));
						?>  
				</div>
			</div>
		</div>

	</section>


<?php get_footer();?>