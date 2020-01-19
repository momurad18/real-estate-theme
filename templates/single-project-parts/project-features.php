<?php
if( '' !== $post->post_content ) :
?>
	<div class="project-desc" style="margin-top: 60px; color: #b3a49f">
		<div class="" style="border-bottom: 3px solid #c7cdd0; padding-bottom: 15px; width: 25%;">
			<h4>ميزات المشروع</h4>
		</div>
		<?php 
			$terms = get_field('project_features');
			if( $terms ): ?>
			    <ul class="features-list">
			    	<div class="row" style="justify-content: center;">
			    <?php foreach( $terms as $key => $term ):?>

			        <li class="col-lg-3 col-md-4 col-sm-6"><?php echo esc_html( $term->name ); ?></li>
			    <?php endforeach; ?>
			    </div>
			    </ul>
			<?php endif; ?>
	</div>
<?php
else:
	echo ' no desc';
endif
?>