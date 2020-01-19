<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://fonts.googleapis.com/earlyaccess/notokufiarabic.css" />

		<link rel='stylesheet' href='https://ispartagroup.com/wp-content/themes/isparta/assets/css/all.css' type='text/css' media='all' />
		<link rel='stylesheet' href='https://ispartagroup.com//wp-content/themes/isparta/assets/css/responsive.css' type='text/css' media='all' />

		<?php wp_head(); ?>
		<?php if ( is_admin_bar_showing() ) { ?>
		    <style>
		        #header.sticky-header {
		            top: 32px;
		        }
		    </style>
		<?php } ?>
	</head>

	<body <?php body_class(); ?>>
		<div class="wrapper">
			<header id="header">
				<div class="container">
					<div class="header-wrap">
						<div>
							<aside id="side-panel" class="mobile-menu d-block d-lg-none">
								<div id="close-mobile-menu" style="position: absolute; left: 0px; padding: 20px; font-size: 20px;">
										<i class="far fa-times-circle" style=""></i>
								</div>
								<div>
									<h4 style="padding-top: 60px; text-align: center; font-size: 16px"><?php bloginfo( 'title' ); ?></h4>
									<?php 
										wp_nav_menu( 
											array(
												'theme_location'    => 'primary-menu',
												'depth'             => 2,
												'container'         => 'aside',
												'container_class'   => '',
												'container_id' 		=> '',
												'menu_class' 		=> 'side-menu',
												'menu_id' 			=> 'aside'
											)
										);
									?>
									
								</div>
								<div class="contact-info">
									<a href="https://wa.me/905375001745" target="_blank"><span class="icon">+90 537 500 1745</span></a>
									<a href="https://wa.me/905375001845" target="_blank"><span class="icon">+90 537 500 1845</span></a>
									<a href="mailto:info@ispartagroup.com"><span class="icon">info@ispartagroup.com</span></a>
								</div>
							</aside> 
							<button type="button" id="" class="navbar-toggler mr-auto d-lg-none side-panel-trigger">
								<span class="fas fa-bars" style="color: #c7cdd0"></span>
							</button>
						</div>
						
						<?php
							wp_nav_menu( 
								array(
									'theme_location'    => 'primary-menu',
									'depth'             => 2,
									'container'         => 'nav',
									'container_class'   => 'd-none d-lg-block',
									'container_id' 		=> 'primary-menu',
									'menu_class' 		=> 'main-menu'
								)
							);	
						?>
						
							<div class="logo d-none d-lg-block">
								<div style="margin: auto;">
									<img src="http://localhost/hr-property/wp-content/themes/hr-property/assets/img/hr-logo.svg" alt="">
								</div>	
							</div>
							<div class="mobile-logo d-lg-none " style="margin: auto;">
								<a href="<?php site_url(); ?>">
								<img src="https://ispartagroup.com/wp-content/uploads/2019/11/footer-logo.png" alt="عقارات في تركيا" style="width: 180px;"></a>
							</div>
					</div>
				</div>
			</header>
