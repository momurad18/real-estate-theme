<?php
if(get_field('estate_video')) :
?>
	<div class="project-desc" style="margin-top: 60px; color: #b3a49f">
		<div class="" style="border-bottom: 3px solid #c7cdd0; padding-bottom: 15px; width: 25%;">
			<h4>من داخل المشروع</h4>
		</div>
			<div class="embed-container mt-5">
				<?php the_field('estate_video'); ?>
			</div>
	</div>
<?php
else:

endif
?>