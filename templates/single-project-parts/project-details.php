<?php if( have_rows('estate_details') ): ?>
<div class="project-desc" style="margin-top: 60px; color: #b3a49f">
		<div class="" style="border-bottom: 3px solid #c7cdd0; padding-bottom: 15px; width: 25%;">
			<h4>تفاصيل العقار</h4>
		</div>
		<?php 
			// vars
			$bedrooms = get_sub_field_object('bedrooms');
			$living_rooms = get_sub_field_object('living_rooms');
			$bathroom = get_sub_field_object('bathroom');
			$balcony = get_sub_field_object('balcony');
			$estate_size = get_sub_field_object('estate_size');
			$price = get_sub_field_object('price'); 
		?>
		<div style="display: flex; justify-content: center;">
			<table class="table table-borderless table-striped table-responsive mt-5" style="color: #b3a49f; text-align: center; font-weight: 500; font-size: 16px; width: auto">
			<thead class="thead-light">
				<tr>
					<th><?php echo esc_html($living_rooms['label']);?></th>
					<th><?php echo esc_html($bedrooms['label']);?></th>
					<th><?php echo esc_html($bathroom['label']);?></th>
					<th><?php echo esc_html($balcony['label']);?></th>
					<th><?php echo esc_html($estate_size['label']);?></th>
					<th><?php echo esc_html($price['label']);?></th>
				</tr>
			</thead>
			

			<?php 
			while( have_rows('estate_details') ): the_row(); 
				$bedrooms = get_sub_field_object('bedrooms');
				$living_rooms = get_sub_field_object('living_rooms');
				$bathroom = get_sub_field_object('bathroom');
				$balcony = get_sub_field_object('balcony');
				$estate_size = get_sub_field_object('estate_size');
				$price = get_sub_field_object('price'); 
			?>
				<tr>
					<td><?php echo esc_html($living_rooms['value']); ?></td>
					<td><?php echo esc_html($bedrooms['value']); ?></td>
					<td><?php echo esc_html($bathroom['value']); ?></td>
					<td><?php echo esc_html($balcony['value']); ?></td>
					<td><span style="font-weight: 400; font-size: 14px">تبدأ من </span><span>M<sup>2</sup> </span><?php echo esc_html($estate_size['value']); ?></td>
					<td><span style="font-weight: 400; font-size: 14px">تبدأ من </span><span>TL </span><?php echo esc_html($price['value']); ?></td>


				</tr>
			<?php endwhile; ?>
		</table>
		</div>
</div>
<?php endif; ?>
<?php if( have_rows('store_details') && get_field('store_property') ): ?>
<div class="project-desc" style="margin-top: 60px; color: #b3a49f">
		<div class="" style="border-bottom: 3px solid #c7cdd0; padding-bottom: 15px; width: 25%;">
			<h4>تفاصيل العقار التجاري</h4>
		</div>
		<?php 
			// vars
			$store_notes = get_sub_field_object('store_notes');
			$store_size = get_sub_field_object('store_size');
			$store_price = get_sub_field_object('store_price'); 
		?>
		<div style="display: flex; justify-content: center;">
			<table class="table table-borderless table-striped table-responsive mt-5" style="color: #b3a49f; text-align: center; font-weight: 500; font-size: 16px; width: auto">
			<thead class="thead-light">
				<tr>
					<th><?php echo esc_html($store_size['label']);?></th>
					<th><?php echo esc_html($store_price['label']);?></th>
					<th><?php echo esc_html($store_notes['label']);?></th>
				</tr>
			</thead>
			

			<?php 
			while( have_rows('store_details') ): the_row(); 
				$store_size = get_sub_field_object('store_size');
				$store_price = get_sub_field_object('store_price'); 
				$store_notes = get_sub_field_object('store_notes'); 
			?>
				<tr>
					<td><span style="font-weight: 400; font-size: 14px">تبدأ من </span><span>M<sup>2</sup> </span><?php echo esc_html($store_size['value']); ?></td>
					<td><span style="font-weight: 400; font-size: 14px">تبدأ من </span><span>TL </span><?php echo esc_html($store_price['value']); ?></td>
					<td><?php echo esc_html($store_notes['value']); ?></td>


				</tr>
			<?php endwhile; ?>
		</table>
		</div>
</div>
<?php endif; ?>