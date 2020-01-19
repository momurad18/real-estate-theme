<!--<footer>
	<div class="container-fluid">
	    <div class="row">
			<div class="col-lg-6 col-md-6 col-sm-12 col-12">
				<div class="row align-items-md-center" style="padding: 40px; background: #f7f7ee; height: 100%;">
				<div class="col-md-12">
					
					<div class="footer-light-section" style="color: #c7cdd0; text-align: center;">
							<h4 style="color:#252f32">روابط مهمة</h4>
							<?php
							wp_nav_menu( 
								array(
									'theme_location'    => 'footer-menu',
									'depth'             => 2,
									'container'         => 'footer',
									'container_class'   => '',
									'container_id' 		=> 'primary-menu',
									'menu_class' 		=> 'footer-menu'
								)
							);
						?>
					</div>
				</div>
				</div>
				
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12 col-12">
				<div class="row" style="background-color: #252f32; padding: 40px;">
					<div class="col-lg-6 col-md-12 col-sm-12 col-12">
						
						<div class="footer-dark-section" style="color: #c7cdd0; text-align: center;">
							<h4>أسعار العملات</h4>
							<?php echo do_shortcode('[currency-exchange]'); ?>
						</div>
					</div>
					<div class="col-lg-6 col-md-12 col-sm-12 col-12 footer-contact">

						<a href="<?php site_url(); ?>" class="footer-logo"><img src="https://ispartagroup.com/wp-content/uploads/2019/11/footer-logo.png" alt="عقارات في تركيا" ></a>
						<p style="color: #c7cdd0; padding: 15px;">
							Cumhuriyet Mh. Nazim hikmet Cd
							Altıntaş Sitesi No:89/80<br>
							Beylikdüzü/Istanbul
						</p>
						<ul style="list-style: none; color: #c7cdd0; padding: 0 15px; direction: ltr;">
							<li style="padding: 8px 0"><i class="fas fa-phone"></i><span style="margin-left: 5px;">+90 537 500 1745</span></li>
							<li style="padding: 8px 0"><i class="fas fa-phone"></i><span style="margin-left: 5px;">+90 537 500 1845</span></li>
							<li style="padding: 8px 0"><i class="fas fa-envelope"></i><span style="margin-left: 5px;"><a href="mailto:info@ispartagroup.com">info@ispartagroup.com</a></span></li>
						</ul>
					</div>
				</div>
			</div>
	    </div>
	</div>
	<div class="copy text-center" style="">
		<p>© جميع الحقوق محفوظة <a><span>Isparta Group</span></a></p>
	</div>
</footer>-->
</div>
<script src="https://cdn.rawgit.com/leafo/sticky-kit/v1.1.2/jquery.sticky-kit.js"></script>
<?php wp_footer(); ?>
<script src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyBB3o4bAiO_KjI6DDz-gW3sAh3l-anetok"></script>
</body>
</html>