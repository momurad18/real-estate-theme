<?php
$images = get_field('in_gallery'); 
if($images):
?>
	<div class="project-desc" style="margin-top: 60px; color: #b3a49f">
		<div class="" style="border-bottom: 3px solid #c7cdd0; padding-bottom: 15px; width: 25%;">
			<h4>صور داخلية</h4>
		</div>
		<div class="ut-popup-group__element mt-5" style="text-align: center;">
			<?php foreach ( $images as $myhome_key => $myhome_image ) : ?>
				<a href="<?php echo esc_url( $myhome_image['url'] ); ?>"class="">
					<img src="<?php echo esc_url( wp_get_attachment_image_url( $myhome_image['ID'] ) ); ?>" alt="">
				</a>
			<?php endforeach;?>
		</div>
		</p>
	</div>
<?php
else:
	echo ' no desc';
endif
?>