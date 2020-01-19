<?php
if( '' !== $post->post_content ) :
?>
	<div class="project-desc" style="margin-top: 60px; color: #b3a49f">
		<div class="" style="border-bottom: 3px solid #c7cdd0; padding-bottom: 15px; width: 25%;">
			<h4>عن المشروع</h4>
		</div>
		<p>
			<?php the_content(); ?>
		</p>
	</div>
<?php
else:
	echo ' no desc';
endif
?>