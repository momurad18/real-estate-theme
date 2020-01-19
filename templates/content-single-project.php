<div style="margin-top: -25px">
	<div class="container">
		<div class="row">
			<div class="col-lg-9" style="text-align: right;">
				<?php 
					$terms = wp_get_post_terms( get_the_ID(), array( 'property-type' ) );
				   if(function_exists('get_hansel_and_gretel_breadcrumbs') && $terms): 
				      echo get_hansel_and_gretel_breadcrumbs();
				   endif;
				?>
			</div>
			<div class="col-lg-3">
			</div>
		</div>
	</div>
</div>
<section class="project-details">
	<div class="container">
		
		<div class="row main-wrapper">
			<div class="col-lg-9">
                <?php

                    get_template_part( 'templates/single-project-parts/gallery');
                    get_template_part( 'templates/single-project-parts/project-desc');
                    get_template_part( 'templates/single-project-parts/project-details');
                    get_template_part( 'templates/single-project-parts/project-features');
                    get_template_part( 'templates/single-project-parts/project-video');
                    get_template_part( 'templates/single-project-parts/project-interior');
                    get_template_part( 'templates/single-project-parts/project-exterior');
                    get_template_part( 'templates/single-project-parts/project-plans');
                ?>
			</div>

			<!-- SIDEBAR -->
			<div class="col-lg-3 ">
				<aside class="right">
					<div class="sidebar-card">
						<div class="sidebar-card-title">
							<h5><i class="flaticon-location"></i>الموقع</h5>
						</div>
						<div class="sidebar-card-content">
							<ul style="position: relative; margin-top: 20px; list-style: none; padding-right: 5px; font-size: 15px;">
								<li>
									<i class="flaticon-back"></i>
									<?php
										$field = get_field_object('property_type');
									?>
									<span><?php echo $field['label'];?>:</span>
									<span><?php echo $field['value']->name;?></span>

								</li>
								<li>
									<i class="flaticon-back"></i>
									<?php
										$field = get_field_object('city');
									?>
									<span><?php echo $field['label'];?>:</span>
									<span><?php echo $field['value']->name;?></span>
								</li>
								<li>
									<i class="flaticon-back"></i>
									<?php
										$field = get_field_object('district');
									?>
									<span><?php echo $field['label'];?>:</span>
									<span><?php echo $field['value']->name;?></span>
								</li>
								<?php 
									$terms = get_field_object('location_features');
									if( $terms ): ?>
								<li class="flaticon-back">

									<span><?php echo $terms['label'];
									?>:</span>
									
									    <ul class="mt-4" style="list-style-type: square;">
									    	
									    <?php foreach( $terms['value'] as $key => $term ):?>
									        <li><?php echo esc_html( $term->name ); ?></li>
									    <?php endforeach; ?>
									    </ul>
									
								</li>
								<?php endif; ?>
							</ul>
						</div>
					</div>
					<div class="sidebar-card">
						<div class="sidebar-card-title">
							<h5><i class="flaticon-wallet"></i>طرق الدفع</h5>
						</div>
						<div class="sidebar-card-content">
							<ul style="position: relative; margin-top: 20px; list-style: none; padding-right: 5px; font-size: 15px;">
								<?php
								$field = get_field_object('under_cons');
								if($field['value'] == 1):?>
								<li>
									<i class="flaticon-back"></i>
									<span>الحالة:</span>
									<span><?php echo $field['label'];?></span>
								</li>
								<li>
									<i class="flaticon-back"></i>
									<?php
										$notice = get_field_object('date');
									?>
									<span><?php echo $notice['label'];?>:</span>
									<span><?php echo $notice['value']; ?></span>
									
								</li>
								<?php else:?>
								<li>
									<i class="flaticon-back"></i>
									<span>الحالة:</span>
									<span>جاهز للتسليم</span>
								</li>	 
								<?php endif?>
								<li>
									<i class="flaticon-back"></i>
									<?php
										$field = get_field_object('cash');
										if($field['value'] == 1):
											$notice = get_field('discount');
									?>
										<span><?php echo $notice; ?></span>
									<?php endif ?>
								</li>
								<li>
									<i class="flaticon-back"></i>
									<?php
										$field = get_field_object('installment');
										if($field['value'] == 1):
											$notice = get_field('installment_plan');
									?>
									<span><?php echo $notice;?></span>
									<?php endif ?>
								</li>
							</ul>
						</div>
					</div>
					<div class="sidebar-card">
						<div class="sidebar-card-title mb-4">
							<h5>اسأل عن المشروع</h5>
						</div>
						<div class="sidebar-card-content">
							<?php echo do_shortcode('[contact-form-7 id="19" title="project form"]') ?>
						</div>
					</div>
				</aside>
			</div>
		
		</div>
		
	</div>
</section>
<?php
$location = get_field('location');
if( $location ): ?>
    <div id="project-map" class="acf-map" data-zoom="14">
        <div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>" data-title="<?php echo the_title(); ?>" data-price="<?php echo $price; ?>"data-image="<?php echo get_the_post_thumbnail_url(); ?>"></div>
    </div>
<?php endif; ?>