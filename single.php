<?php 

get_header();
get_template_part( 'templates/section', 'hero');
?>

<div style="margin-top: -25px">
	<div class="container">
		<div class="row ">
			<div class="col-lg-9" style="text-align: right;">
				<?php 
					$terms = wp_get_post_terms( get_the_ID(), array( 'property-type' ) );
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


<?php 
while ( have_posts() ) : the_post();?>
<section class="mt-5">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-9">
				<div class="content">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php 
endwhile;
?>


<?php get_footer(); ?>