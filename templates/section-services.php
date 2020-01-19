<section class="services-section mb-5">
		<div class="section-heading light mb-4">
			<h2 class="pt-3">خدماتنا</h2>
		</div>
		<div class="container">
			<div class="row" style="justify-content: center;">
            <?php 
                $services = get_posts(array(
                    'numberposts'	=> -1,
                    'post_type'		=> 'service',
					//'meta_value'	=> '1',
					'orderby'          => 'ID',
        			'order'            => 'ASC',
                ));

                if( $services ): 
                    foreach( $services as $post ):
                        setup_postdata( $post );          
            ?>
				<div class="col-lg-2 col-md2 col-sm-12 col-12 mb-3">
					<a href="<?php the_field('service_link'); ?>" style="display: block; color: inherit">
						<div class="service-card">
							<div class="service-icon mb-4">
								<i class="<?php the_field('icon');?>"></i>
							</div>
							<div class="title mb-3"><h6><?php the_title(); ?></h6></div>
							<div class="body" style="font-size: 14px; min-height: 80px"><?php the_field('desc'); ?></div>
						</div>
					</a>
				</div>
            <?php 
                    endforeach;
                    wp_reset_postdata();
                endif; 
            ?>
			</div>
		</div>
	</section>