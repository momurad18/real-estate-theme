<?php

/*
 * Real_Estate_Init class
 *
 * This class setup theme support and contain general purpose filters and actions
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

if ( ! class_exists( 'Real_Estate_Init' ) ) :

	class Real_Estate_Init {
		public function __construct() {
			add_action( 'init', array( $this, 'register_custom_taxonomy' ) );
			//add_action( 'init', array( $this, 'register_fields' ), 100 );
			add_action( 'init', array( $this, 'register_custom_post_type' ),11 );

			// add theme support
			add_action( 'after_setup_theme', array( $this, 'theme_support' ) );
			// add google api key for ACF plugin
			//add_filter( 'acf/fields/google_map/api', array( $this, 'acf_google_map_api' ) );
			//add_filter( 'wp_before_admin_bar_render', array( $this, 'remove_admin_bar_links' ), 100 );
			// remove some menu elements (admin)
			//add_action( 'admin_menu', array( $this, 'remove_menu_elements' ) );

			add_action('wp_enqueue_scripts', array($this, 'load_stylesheets'));
			add_action('wp_enqueue_scripts', array($this, 'load_js'));

			

			add_filter('post_type_link', array($this, 'project_permalink'), 10, 4);
			
		}
		function load_stylesheets(){

			wp_register_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), false, 'all' );
			wp_enqueue_style('bootstrap');
			wp_register_style('flaticons', get_template_directory_uri() . '/assets/css/font/flaticon.css', array(), false, 'all' );
			wp_enqueue_style('flaticons');
			wp_register_style('magnific-popup', get_template_directory_uri() . '/assets/css/magnific-popup.css', array(), false, 'all' );
			wp_enqueue_style('magnific-popup');
			wp_register_style('utechs-slick', get_template_directory_uri() . '/assets/css/slick.css', array(), false, 'all' );
			wp_enqueue_style('utechs-slick');
			wp_register_style('utechs-slick-theme', get_template_directory_uri() . '/assets/css/slick-theme.css', array(), false, 'all' );
			wp_enqueue_style('utechs-slick-theme');
			wp_register_style('fancybox', get_template_directory_uri() . '/assets/css/jquery.fancybox.min.css', array(), false, 'all' );
			wp_enqueue_style('fancybox');
			wp_register_style('style', get_template_directory_uri() . '/style.css', array(), false, 'all' );
			wp_enqueue_style('style');
			wp_register_style('main', get_template_directory_uri() . '/assets/css/main.css', array(), false, 'all' );
			wp_enqueue_style('main');
			
		}

		function load_js(){
			global $wp_query;
			wp_enqueue_script('jquery');
			wp_enqueue_script( 'jquery-ui-accordion' );

			wp_register_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', 'jquery', false, true);
			wp_enqueue_script('bootstrap');

			wp_register_script('utechs_gallery', get_template_directory_uri() . '/assets/js/gallery.js',1, false, true);
			wp_enqueue_script('utechs_gallery');

			wp_register_script('utechs_plugins', get_template_directory_uri() . '/assets/js/plugins.js',1, false, true);
			wp_enqueue_script('utechs_plugins');

			wp_register_script('utechs_slick', get_template_directory_uri() . '/assets/js/slick.min.js',1, false, true);
			wp_enqueue_script('utechs_slick');
			
			wp_register_script('utechs_fancybox', get_template_directory_uri() . '/assets/js/jquery.fancybox.min.js',1, false, true);
			wp_enqueue_script('utechs_fancybox');
			
			wp_register_script('utechs_scripts', get_template_directory_uri() . '/assets/js/scripts.js',1, false, true);
			wp_enqueue_script('utechs_scripts');
			
			
		}

		function theme_support() {
			$defaults = array(
			 'height'      => 120,
			 'width'       => 120,
			 'flex-height' => true,
			 'flex-width'  => true,
			 'header-text' => array( 'site-title', 'site-description' ),
			 );
			add_theme_support('post-thumbnails');
			add_theme_support('title-tag');
			add_theme_support( 'custom-logo',$defaults);
			add_theme_support('menus');
		}

		public function remove_admin_bar_links() {
			global $wp_admin_bar;
			$wp_admin_bar->remove_menu( 'revslider' );
		}

		public function remove_menu_elements() {
			remove_menu_page( 'mega_main_menu_options' );
			remove_menu_page( 'edit.php?post_type=acf-field-group' );
			remove_menu_page( 'wpcf7' );
		}

		public function acf_google_map_api($api) {
			$api['key'] = 'AIzaSyBB3o4bAiO_KjI6DDz-gW3sAh3l-anetok';
			return $api;
		}

		/**
		 * @param \string $post_link
		 * @param \WP_Post $post
		 *
		 * @return \string
		*/

		public function project_permalink( $post_link, $post ) {
			if ( $post->post_type == 'project' ) {
				$attributes = ['property-type','city'];


				foreach ( $attributes as $attribute ) {
					$terms = get_the_terms( $post->ID, $attribute );
					if ( empty( $terms ) ) {
						return site_url() . '/?post_type=project&p=' . $post->ID;
					}
					$post_link = str_replace( '%' . $attribute . '%', array_pop( $terms )->slug, $post_link );
				}
			}

			if ( strpos( $post_link, '/%' ) !== false && strpos( $post_link, '%/' ) !== false ) {
				return site_url() . '/?post_type=project&p=' . $post->ID;
			}

			return $post_link;
		}

		/*public function register_fields(){
			if( function_exists('acf_add_local_field_group') ):

				acf_add_local_field_group(array(
					'key' => 'group_5dc00f567c577',
					'title' => esc_html__( 'Project Details', 'realestate' ),
					'fields' => array(
						array(
							'key' => 'field_5dc00f74b7960',
							'label' => esc_html__( 'Project Details', 'realestate' ),
							'name' => '',
							'type' => 'tab',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'placement' => 'top',
							'endpoint' => 0,
						),
						array(
							'key' => 'field_5dc0beac7f59d',
							'label' => esc_html__( 'City', 'realestate' ),
							'name' => 'city',
							'type' => 'taxonomy',
							'instructions' => '',
							'required' => 1,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '50',
								'class' => '',
								'id' => '',
							),
							'taxonomy' => 'city',
							'field_type' => 'select',
							'allow_null' => 0,
							'add_term' => 1,
							'save_terms' => 1,
							'load_terms' => 1,
							'return_format' => 'object',
							'multiple' => 0,
						),
						array(
							'key' => 'field_5dc1dd08dbb6e',
							'label' => esc_html__( 'Project Details', 'realestate' ),
							'name' => 'district',
							'type' => 'taxonomy',
							'instructions' => '',
							'required' => 1,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '50',
								'class' => '',
								'id' => '',
							),
							'taxonomy' => 'district',
							'field_type' => 'select',
							'allow_null' => 0,
							'add_term' => 1,
							'save_terms' => 1,
							'load_terms' => 1,
							'return_format' => 'object',
							'multiple' => 0,
						),
						array(
							'key' => 'field_5dc094fe77ca3',
							'label' => esc_html__( 'Property Type', 'realestate' ),
							'name' => 'property_type',
							'type' => 'taxonomy',
							'instructions' => '',
							'required' => 1,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '50',
								'class' => '',
								'id' => '',
							),
							'taxonomy' => 'property-type',
							'field_type' => 'select',
							'allow_null' => 0,
							'add_term' => 1,
							'save_terms' => 1,
							'load_terms' => 0,
							'return_format' => 'object',
							'multiple' => 0,
						),
						array(
							'key' => 'field_5dc094d877ca2',
							'label' => esc_html__( 'Featured Project', 'realestate' ),
							'name' => 'featured',
							'type' => 'true_false',
							'instructions' => '',
							'required' => 1,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '50',
								'class' => '',
								'id' => '',
							),
							'message' => '',
							'default_value' => 0,
							'ui' => 1,
							'ui_on_text' => 'نعم',
							'ui_off_text' => 'لا',
						),
						array(
							'key' => 'field_5dc14afdcf619',
							'label' => 'التفاصيل الداخلية',
							'name' => 'estate_details',
							'type' => 'repeater',
							'instructions' => '',
							'required' => 1,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'collapsed' => '',
							'min' => 0,
							'max' => 0,
							'layout' => 'table',
							'button_label' => 'إضافة عقار',
							'sub_fields' => array(
								array(
									'key' => 'field_5dc14b33cf61a',
									'label' => 'غرف النوم',
									'name' => 'bedrooms',
									'type' => 'number',
									'instructions' => '',
									'required' => 1,
									'conditional_logic' => array(
										array(
											array(
												'field' => 'field_5dc14afdcf619',
												'operator' => '!=empty',
											),
										),
									),
									'wrapper' => array(
										'width' => '25',
										'class' => '',
										'id' => '',
									),
									'default_value' => '',
									'placeholder' => '',
									'prepend' => '',
									'append' => '',
									'min' => '',
									'max' => '',
									'step' => '',
								),
								array(
									'key' => 'field_5dc14b8ecf61b',
									'label' => 'غرف الجلوس',
									'name' => 'living_rooms',
									'type' => 'number',
									'instructions' => '',
									'required' => 1,
									'conditional_logic' => 0,
									'wrapper' => array(
										'width' => '',
										'class' => '',
										'id' => '',
									),
									'default_value' => 1,
									'placeholder' => '',
									'prepend' => '',
									'append' => '',
									'min' => '',
									'max' => '',
									'step' => '',
								),
								array(
									'key' => 'field_5dc14e1aa6433',
									'label' => 'الحمام',
									'name' => 'bathroom',
									'type' => 'number',
									'instructions' => '',
									'required' => 1,
									'conditional_logic' => 0,
									'wrapper' => array(
										'width' => '',
										'class' => '',
										'id' => '',
									),
									'default_value' => 1,
									'placeholder' => '',
									'prepend' => '',
									'append' => '',
									'min' => '',
									'max' => '',
									'step' => '',
								),
								array(
									'key' => 'field_5dc14dd9a6432',
									'label' => 'بلكون',
									'name' => 'balcony',
									'type' => 'true_false',
									'instructions' => '',
									'required' => 1,
									'conditional_logic' => 0,
									'wrapper' => array(
										'width' => '',
										'class' => '',
										'id' => '',
									),
									'message' => '',
									'default_value' => 1,
									'ui' => 0,
									'ui_on_text' => '',
									'ui_off_text' => '',
								),
								array(
									'key' => 'field_5dc14bbbcf61c',
									'label' => 'مساحة العقار',
									'name' => 'estate_size',
									'type' => 'number',
									'instructions' => '',
									'required' => 1,
									'conditional_logic' => 0,
									'wrapper' => array(
										'width' => '',
										'class' => '',
										'id' => '',
									),
									'default_value' => '',
									'placeholder' => 'المساحة تبدأ من',
									'prepend' => '',
									'append' => '',
									'min' => '',
									'max' => '',
									'step' => '',
								),
								array(
									'key' => 'field_5dc14be3cf61d',
									'label' => 'سعر العقار',
									'name' => 'price',
									'type' => 'number',
									'instructions' => '',
									'required' => 1,
									'conditional_logic' => 0,
									'wrapper' => array(
										'width' => '',
										'class' => '',
										'id' => '',
									),
									'default_value' => 0,
									'placeholder' => 'الاسعار تبداء من',
									'prepend' => '',
									'append' => '',
									'min' => '',
									'max' => '',
									'step' => '',
								),
							),
						),
						array(
							'key' => 'field_5dcdd1356ba3d',
							'label' => 'محل تجاري',
							'name' => 'store_property',
							'type' => 'true_false',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'message' => 'اختر اذا كان العقار محل تجاري',
							'default_value' => 0,
							'ui' => 1,
							'ui_on_text' => 'نعم',
							'ui_off_text' => 'لا',
						),
						array(
							'key' => 'field_5dcdd252923c1',
							'label' => 'تفاصيل العقار التجاري',
							'name' => 'store_details',
							'type' => 'repeater',
							'instructions' => '',
							'required' => 1,
							'conditional_logic' => array(
								array(
									array(
										'field' => 'field_5dcdd1356ba3d',
										'operator' => '==',
										'value' => '1',
									),
								),
							),
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'collapsed' => '',
							'min' => 0,
							'max' => 0,
							'layout' => 'table',
							'button_label' => 'إضافة عقار',
							'sub_fields' => array(
								array(
									'key' => 'field_5dcdd2fc923c2',
									'label' => 'المساحة',
									'name' => 'store_size',
									'type' => 'number',
									'instructions' => '',
									'required' => 1,
									'conditional_logic' => 0,
									'wrapper' => array(
										'width' => '25',
										'class' => '',
										'id' => '',
									),
									'default_value' => 0,
									'placeholder' => 'مساحة العقار',
									'prepend' => '',
									'append' => '',
									'min' => '',
									'max' => '',
									'step' => '',
								),
								array(
									'key' => 'field_5dcdd341923c3',
									'label' => 'السعر',
									'name' => 'store_price',
									'type' => 'number',
									'instructions' => '',
									'required' => 1,
									'conditional_logic' => 0,
									'wrapper' => array(
										'width' => '25',
										'class' => '',
										'id' => '',
									),
									'default_value' => 0,
									'placeholder' => 'سعر العقار',
									'prepend' => '',
									'append' => '',
									'min' => '',
									'max' => '',
									'step' => '',
								),
								array(
									'key' => 'field_5dcdd466af3a9',
									'label' => 'ملاحظات',
									'name' => 'store_notes',
									'type' => 'text',
									'instructions' => '',
									'required' => 0,
									'conditional_logic' => 0,
									'wrapper' => array(
										'width' => '50',
										'class' => '',
										'id' => '',
									),
									'default_value' => '',
									'placeholder' => 'في حال وجود اي ملاحظات اكتها هنا',
									'prepend' => '',
									'append' => '',
									'maxlength' => '',
								),
							),
						),
						array(
							'key' => 'field_5dc91e182b70f',
							'label' => 'ميزات المشروع',
							'name' => 'project_features',
							'type' => 'taxonomy',
							'instructions' => '',
							'required' => 1,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'taxonomy' => 'feature',
							'field_type' => 'multi_select',
							'allow_null' => 0,
							'add_term' => 1,
							'save_terms' => 1,
							'load_terms' => 1,
							'return_format' => 'object',
							'multiple' => 0,
						),
						array(
							'key' => 'field_5dc1de59b728e',
							'label' => 'طرق الدفع',
							'name' => '',
							'type' => 'tab',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'placement' => 'left',
							'endpoint' => 0,
						),
						array(
							'key' => 'field_5dc1deb6b728f',
							'label' => 'نقداً',
							'name' => 'cash',
							'type' => 'true_false',
							'instructions' => '',
							'required' => 1,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '50',
								'class' => '',
								'id' => '',
							),
							'message' => '',
							'default_value' => 1,
							'ui' => 1,
							'ui_on_text' => 'نعم',
							'ui_off_text' => 'لا',
						),
						array(
							'key' => 'field_5dc1df09b7290',
							'label' => 'الخصم',
							'name' => 'discount',
							'type' => 'text',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => array(
								array(
									array(
										'field' => 'field_5dc1deb6b728f',
										'operator' => '==',
										'value' => '1',
									),
								),
							),
							'wrapper' => array(
								'width' => '50',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
						),
						array(
							'key' => 'field_5dc1df9a9d721',
							'label' => 'تقسيط',
							'name' => 'installment',
							'type' => 'true_false',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '50',
								'class' => '',
								'id' => '',
							),
							'message' => '',
							'default_value' => 0,
							'ui' => 1,
							'ui_on_text' => 'نعم',
							'ui_off_text' => 'لا',
						),
						array(
							'key' => 'field_5dc1dfdc9d722',
							'label' => 'خطة التقسيط',
							'name' => 'installment_plan',
							'type' => 'text',
							'instructions' => '',
							'required' => 1,
							'conditional_logic' => array(
								array(
									array(
										'field' => 'field_5dc1df9a9d721',
										'operator' => '==',
										'value' => '1',
									),
								),
							),
							'wrapper' => array(
								'width' => '50',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
						),
						array(
							'key' => 'field_5dc1e2602f5e3',
							'label' => 'قيد الانشاء',
							'name' => 'under_cons',
							'type' => 'true_false',
							'instructions' => '',
							'required' => 1,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '50',
								'class' => '',
								'id' => '',
							),
							'message' => '',
							'default_value' => 1,
							'ui' => 1,
							'ui_on_text' => 'نعم',
							'ui_off_text' => 'لا',
						),
						array(
							'key' => 'field_5dc1e2032f5e2',
							'label' => 'تاريخ التسليم',
							'name' => 'date',
							'type' => 'date_picker',
							'instructions' => '',
							'required' => 1,
							'conditional_logic' => array(
								array(
									array(
										'field' => 'field_5dc1e2602f5e3',
										'operator' => '==',
										'value' => '1',
									),
								),
							),
							'wrapper' => array(
								'width' => '50',
								'class' => '',
								'id' => '',
							),
							'display_format' => 'm/Y',
							'return_format' => 'm/Y',
							'first_day' => 1,
						),
						array(
							'key' => 'field_5dc14feccbf1e',
							'label' => 'معرض الصور',
							'name' => '',
							'type' => 'tab',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'placement' => 'left',
							'endpoint' => 0,
						),
						array(
							'key' => 'field_5dc15087cbf1f',
							'label' => 'معرض الصور',
							'name' => 'gallery',
							'type' => 'gallery',
							'instructions' => '',
							'required' => 1,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'return_format' => 'array',
							'preview_size' => 'thumbnail',
							'insert' => 'append',
							'library' => 'all',
							'min' => '',
							'max' => '',
							'min_width' => '',
							'min_height' => '',
							'min_size' => '',
							'max_width' => '',
							'max_height' => '',
							'max_size' => '',
							'mime_types' => '',
						),
						array(
							'key' => 'field_5dc150d0662d4',
							'label' => 'الموقع',
							'name' => '',
							'type' => 'tab',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'placement' => 'left',
							'endpoint' => 0,
						),
						array(
							'key' => 'field_5dc150f2662d5',
							'label' => 'الموقع',
							'name' => 'location',
							'type' => 'google_map',
							'instructions' => '',
							'required' => 1,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'center_lat' => '41.015137',
							'center_lng' => '28.979530',
							'zoom' => 10,
							'height' => '',
						),
						array(
							'key' => 'field_5dc9354062150',
							'label' => 'ميزات الموقع',
							'name' => 'location_features',
							'type' => 'taxonomy',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'taxonomy' => 'location-feature',
							'field_type' => 'multi_select',
							'allow_null' => 0,
							'add_term' => 1,
							'save_terms' => 1,
							'load_terms' => 1,
							'return_format' => 'object',
							'multiple' => 0,
						),
						array(
							'key' => 'field_5dc151ef491b9',
							'label' => 'مخططات داخلية',
							'name' => '',
							'type' => 'tab',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'placement' => 'left',
							'endpoint' => 0,
						),
						array(
							'key' => 'field_5dc1520b491ba',
							'label' => 'مخططات داخلية',
							'name' => 'plans_gallery',
							'type' => 'gallery',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'return_format' => 'array',
							'preview_size' => 'thumbnail',
							'insert' => 'append',
							'library' => 'all',
							'min' => '',
							'max' => '',
							'min_width' => '',
							'min_height' => '',
							'min_size' => '',
							'max_width' => '',
							'max_height' => '',
							'max_size' => '',
							'mime_types' => '',
						),
						array(
							'key' => 'field_5dc15284491bc',
							'label' => 'صور خارجية',
							'name' => '',
							'type' => 'tab',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'placement' => 'left',
							'endpoint' => 0,
						),
						array(
							'key' => 'field_5dc152c1491bd',
							'label' => 'صور خاجية',
							'name' => 'ex_gallery',
							'type' => 'gallery',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'return_format' => 'array',
							'preview_size' => 'thumbnail',
							'insert' => 'append',
							'library' => 'all',
							'min' => '',
							'max' => '',
							'min_width' => '',
							'min_height' => '',
							'min_size' => '',
							'max_width' => '',
							'max_height' => '',
							'max_size' => '',
							'mime_types' => '',
						),
						array(
							'key' => 'field_5dc1e34a89c40',
							'label' => 'صور داخلية',
							'name' => '',
							'type' => 'tab',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'placement' => 'left',
							'endpoint' => 0,
						),
						array(
							'key' => 'field_5dc1e35a89c41',
							'label' => 'صور داخلية',
							'name' => 'in_gallery',
							'type' => 'gallery',
							'instructions' => '',
							'required' => 1,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'return_format' => 'array',
							'preview_size' => 'thumbnail',
							'insert' => 'append',
							'library' => 'all',
							'min' => '',
							'max' => '',
							'min_width' => '',
							'min_height' => '',
							'min_size' => '',
							'max_width' => '',
							'max_height' => '',
							'max_size' => '',
							'mime_types' => '',
						),
						array(
							'key' => 'field_5dc15341491bf',
							'label' => 'فيديو',
							'name' => '',
							'type' => 'tab',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'placement' => 'left',
							'endpoint' => 0,
						),
						array(
							'key' => 'field_5dc1536f491c0',
							'label' => 'رابط الفيديو (Youtube / Vimeo / Facebook / Twitter / Instagram / link to .mp4)',
							'name' => 'estate_video',
							'type' => 'oembed',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'width' => '',
							'height' => '',
						),
					),
					'location' => array(
						array(
							array(
								'param' => 'post_type',
								'operator' => '==',
								'value' => 'project',
							),
						),
					),
					'menu_order' => 0,
					'position' => 'normal',
					'style' => 'default',
					'label_placement' => 'top',
					'instruction_placement' => 'label',
					'hide_on_screen' => '',
					'active' => true,
					'description' => '',
				));

				acf_add_local_field_group(array(
					'key' => 'group_5dce5ff4f089e',
					'title' => 'Services',
					'fields' => array(
						array(
							'key' => 'field_5dce60c20448c',
							'label' => 'وصف Service',
							'name' => 'desc',
							'type' => 'text',
							'instructions' => '',
							'required' => 1,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '50',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => 'ادخل وصف Service',
							'prepend' => '',
							'append' => '',
							'maxlength' => 250,
						),
						array(
							'key' => 'field_5dce60300448b',
							'label' => 'ايقونة Service',
							'name' => 'icon',
							'type' => 'font-awesome',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '50',
								'class' => '',
								'id' => '',
							),
							'icon_sets' => array(
								0 => 'fas',
								1 => 'far',
							),
							'custom_icon_set' => '',
							'default_label' => '',
							'default_value' => '',
							'save_format' => 'class',
							'allow_null' => 0,
							'show_preview' => 1,
							'enqueue_fa' => 1,
							'fa_live_preview' => '',
							'choices' => array(
							),
						),
						array(
							'key' => 'field_5dce621483ed4',
							'label' => 'رابط Service',
							'name' => 'service_link',
							'type' => 'url',
							'instructions' => '',
							'required' => 1,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => 'ادخل عنوان الصفحة او العقار هنا',
						),
					),
					'location' => array(
						array(
							array(
								'param' => 'post_type',
								'operator' => '==',
								'value' => 'service',
							),
						),
					),
					'menu_order' => 0,
					'position' => 'normal',
					'style' => 'default',
					'label_placement' => 'top',
					'instruction_placement' => 'label',
					'hide_on_screen' => '',
					'active' => true,
					'description' => '',
				));

				acf_add_local_field_group(array(
					'key' => 'group_5dcb3d928dc80',
					'title' => 'صور',
					'fields' => array(
						array(
							'key' => 'field_5dcb3dd6ba094',
							'label' => 'صورة',
							'name' => 'taxonomy-image',
							'type' => 'image',
							'instructions' => '',
							'required' => 1,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'return_format' => 'array',
							'preview_size' => 'thumbnail',
							'library' => 'all',
							'min_width' => '',
							'min_height' => '',
							'min_size' => '',
							'max_width' => '',
							'max_height' => '',
							'max_size' => '',
							'mime_types' => '',
						),
					),
					'location' => array(
						array(
							array(
								'param' => 'taxonomy',
								'operator' => '==',
								'value' => 'all',
							),
						),
					),
					'menu_order' => 0,
					'position' => 'normal',
					'style' => 'default',
					'label_placement' => 'top',
					'instruction_placement' => 'label',
					'hide_on_screen' => '',
					'active' => true,
					'description' => '',
				));

			endif;
		}*/

		public function register_custom_taxonomy() {
			register_taxonomy(
				'property-type',array('project', 'estate'), array(
					'labels' => array(
						'name'               => esc_html__( 'Property Types', 'realestate' ),
						'singular_name'      => esc_html__( 'Property Type', 'realestate' ),
						'menu_name'          => esc_html__( 'Property Types', 'realestate' ),
						'name_admin_bar'     => esc_html__( 'Property Type', 'realestate' ),
						'add_new'            => esc_html__( 'Add a property type', 'realestate' ),
						'add_new_item'       => esc_html__( 'Add a property type', 'realestate' ),
						'new_item'           => esc_html__( 'New property type', 'realestate' ),
						'edit_item'          => esc_html__( 'Edit property type', 'realestate' ),
						'view_item'          => esc_html__( 'View property type', 'realestate' ),
						'all_items'          => esc_html__( 'Property Types', 'realestate' ),
						'search_items'       => esc_html__( 'Search', 'realestate' ),
						'not_found'          => esc_html__( 'No Property Type Found found.', 'realestate' ),
						'not_found_in_trash' => esc_html__( 'No Property Type found in Trash.', 'realestate' )

					),
					'public'             => true,
					'hierarchical'       => false,
					'show_admin_column'  => true,
					'query_vars'         => true,
					'publicly_queryable' => true,
					'has_archive'        => true,
					'rewrite'            => array( 'slug' => 'property-type' , 'with_front' => false),
					
				)
			);
			register_taxonomy(
				'city',array('project', 'estate'), array(
					'labels' => array(
						'name'               => esc_html__( 'Cities', 'realestate' ),
						'singular_name'      => esc_html__( 'City', 'realestate' ),
						'menu_name'          => esc_html__( 'City', 'realestate' ),
						'name_admin_bar'     => esc_html__( 'City', 'realestate' ),
						'add_new'            => esc_html__( 'Add new city', 'realestate' ),
						'add_new_item'       => esc_html__( 'Add new city', 'realestate' ),
						'new_item'           => esc_html__( 'New City', 'realestate' ),
						'edit_item'          => esc_html__( 'Edit city', 'realestate' ),
						'view_item'          => esc_html__( 'View City', 'realestate' ),
						'all_items'          => esc_html__( 'Cities', 'realestate' ),
						'search_items'       => esc_html__( 'Search', 'realestate' ),
						'not_found'          => esc_html__( 'No City Found found.', 'realestate' ),
						'not_found_in_trash' => esc_html__( 'No City found in Trash.', 'realestate' )
					),
					'public'             => true,
					'hierarchical'       => false,
					'show_admin_column'  => true,
					'query_vars'         => true,
					'publicly_queryable' => true,
					'has_archive'        => true,
					'rewrite'            => array( 'slug' => 'projects', 'with_front' => false ),
				)
			);
			register_taxonomy(
				'district',array('project', 'estate'), array(
					'labels' => array(
						'name'               => esc_html__( 'Districts', 'realestate' ),
						'singular_name'      => esc_html__( 'District', 'realestate' ),
						'menu_name'          => esc_html__( 'Districts', 'realestate' ),
						'name_admin_bar'     => esc_html__( 'District', 'realestate' ),
						'add_new'            => esc_html__( 'Add new district', 'realestate' ),
						'add_new_item'       => esc_html__( 'Add new district', 'realestate' ),
						'new_item'           => esc_html__( 'New district', 'realestate' ),
						'edit_item'          => esc_html__( 'Edit district', 'realestate' ),
						'view_item'          => esc_html__( 'Veiw district', 'realestate' ),
						'all_items'          => esc_html__( 'Districts', 'realestate' ),
						'search_items'       => esc_html__( 'Search', 'realestate' ),
						'not_found'          => esc_html__( 'No District Found found.', 'realestate' ),
						'not_found_in_trash' => esc_html__( 'No District found in Trash.', 'realestate' )

					),
					'public'             => true,
					'hierarchical'       => false,
					'show_admin_column'  => true,
					'query_vars'         => true,
					'publicly_queryable' => true,
					'has_archive'        => true,
					'rewrite'            => array( 'slug' => 'district', 'with_front' => false ),
				)
			);
			register_taxonomy(
				'feature',array('project', 'estate'), array(
					'labels' => array(
						'name'               => esc_html__( 'Features', 'realestate' ),
						'singular_name'      => esc_html__( 'Features', 'realestate' ),
						'menu_name'          => esc_html__( 'Features', 'realestate' ),
						'name_admin_bar'     => esc_html__( 'Features', 'realestate' ),
						'add_new'            => esc_html__( 'Add new feature', 'realestate' ),
						'add_new_item'       => esc_html__( 'Add new feature', 'realestate' ),
						'new_item'           => esc_html__( 'New' ),
						'edit_item'          => esc_html__( 'Edit Feature', 'realestate' ),
						'view_item'          => esc_html__( 'View Feature', 'realestate' ),
						'all_items'          => esc_html__( 'Features', 'realestate' ),
						'search_items'       => esc_html__( 'Search', 'realestate' ),
						'not_found'          => esc_html__( 'No Feature Found found.', 'realestate' ),
						'not_found_in_trash' => esc_html__( 'No Feature found in Trash.', 'realestate' )

					),
					'public'             => true,
					'hierarchical'       => false,
					'show_admin_column'  => true,
					'query_vars'         => false,
					'publicly_queryable' => false,
					'has_archive'        => true,
				)
			);
			register_taxonomy(
				'location-feature',array('project', 'estate'), array(
					'labels' => array(
						'name'               => esc_html__( 'Offer Types' ),
						'singular_name'      => esc_html__( 'Offer Types' ),
						'menu_name'          => esc_html__( 'Offer Types' ),
						'name_admin_bar'     => esc_html__( 'Offer Types' ),
						'add_new'            => esc_html__( 'Add new offer type' ),
						'add_new_item'       => esc_html__( 'Add new offer type' ),
						'new_item'           => esc_html__( 'New offer type' ),
						'edit_item'          => esc_html__( 'Edit' ),
						'view_item'          => esc_html__( 'View offer type' ),
						'all_items'          => esc_html__( 'Offer Types' ),
						'search_items'       => esc_html__( 'Search Feature' ),
						'not_found'          => esc_html__( 'No Feature Found found.' ),
						'not_found_in_trash' => esc_html__( 'No Feature found in Trash.' )

					),
					'public'             => true,
					'hierarchical'       => false,
					'show_admin_column'  => true,
					'query_vars'         => true,
					'publicly_queryable' => true,
					'has_archive'        => true,
				)
			);
			register_taxonomy(
				'location-feature',array('project', 'estate'), array(
					'labels' => array(
						'name'               => esc_html__( 'Location Features', 'realestate' ),
						'singular_name'      => esc_html__( 'Location Features', 'realestate' ),
						'menu_name'          => esc_html__( 'Location Features', 'realestate' ),
						'name_admin_bar'     => esc_html__( 'Location Features', 'realestate' ),
						'add_new'            => esc_html__( 'Add new', 'realestate' ),
						'add_new_item'       => esc_html__( 'Add new', 'realestate' ),
						'new_item'           => esc_html__( 'New', 'realestate' ),
						'edit_item'          => esc_html__( 'Edit', 'realestate' ),
						'view_item'          => esc_html__( 'View', 'realestate' ),
						'all_items'          => esc_html__( 'Location Features', 'realestate' ),
						'search_items'       => esc_html__( 'Search Feature', 'realestate' ),
						'not_found'          => esc_html__( 'No Feature Found found.', 'realestate' ),
						'not_found_in_trash' => esc_html__( 'No Feature found in Trash.', 'realestate' )

					),
					'public'             => true,
					'hierarchical'       => false,
					'show_admin_column'  => true,
					'query_vars'         => false,
					'publicly_queryable' => false,
					'has_archive'        => false,
				)
			);
		}

		public function register_custom_post_type() {
			// define post type slug
			//$slug = \MyHomeCore\My_Home_Core()->settings->get( 'estate-slug' );
			//if ( empty( $slug ) ) {
			$slug = 'projects';
			//}
			$archive_slug = $slug;

			$attributes = ['city', 'property-type'];
			foreach ( $attributes as $attribute ) {
				$slug .= '/%' . $attribute . '%';
			}

			$supports = array(
				'title',
				'author',
				'editor',
				'thumbnail',
			);

			/*$enable_comments = \MyHomeCore\My_Home_Core()->settings->get( 'property-enabled_comments' );
			if ( ! empty( $enable_comments ) ) {
				$supports[] = 'comments';
			}*/

			register_post_type(
				'project', array(
					'labels'        => array(
						'name'          => esc_html__( 'Projects', 'realestate' ),
						'singular_name'      => esc_html__( 'Project', 'realestate' ),
						'menu_name'          => esc_html__( 'Projects', 'realestate' ),
						'name_admin_bar'     => esc_html__( 'Project', 'realestate' ),
						'add_new'            => esc_html__( 'Add new project', 'realestate' ),
						'add_new_item'       => esc_html__( 'Add new project', 'realestate' ),
						'new_item'           => esc_html__( 'New Project', 'realestate' ),
						'edit_item'          => esc_html__( 'Edit project', 'realestate' ),
						'view_item'          => esc_html__( 'View project', 'realestate' ),
						'all_items'          => esc_html__( 'Projects', 'realestate' ),
						'search_items'       => esc_html__( 'Search', 'realestate' ),
						'not_found'          => esc_html__( 'No Property Found.', 'realestate' ),
						'not_found_in_trash' => esc_html__( 'No Property Found in trash', 'realestate' )
					),
					'show_in_rest'  => true,
					'query_var'     => true,
					'public'        => true,
					'has_archive'   => $archive_slug,
					'menu_position' => 4,
					'menu_icon'     => 'dashicons-admin-home',
					'map_meta_cap'  => true,
					'rewrite'       => array( 'slug' => $slug, 'with_front' => false ),
					'supports'      => $supports
				)
			);
			register_post_type(
				'testimonial', array(
					'name'          => esc_html__( 'Testimonials', 'realestate' ),
					'labels'        => array(
						'singular_name'      => esc_html__( 'Testimonial', 'realestate' ),
						'menu_name'          => esc_html__( 'Testimonials', 'realestate' ),
						'name_admin_bar'     => esc_html__( 'Testimonial', 'realestate' ),
						'add_new'            => esc_html__( 'Add new', 'realestate' ),
						'add_new_item'       => esc_html__( 'Add new', 'realestate' ),
						'new_item'           => esc_html__( 'New', 'realestate' ),
						'edit_item'          => esc_html__( 'Edit', 'realestate' ),
						'view_item'          => esc_html__( 'View', 'realestate' ),
						'all_items'          => esc_html__( 'Testimonials', 'realestate' ),
						'search_items'       => esc_html__( 'Search', 'realestate' ),
						'not_found'          => esc_html__( 'No Testimonial Found', 'realestate' ),
						'not_found_in_trash' => esc_html__( 'Testimonial in Trash', 'realestate' )
					),
					'show_in_rest'       => false,
					'query_var'          => false,
					'publicly_queryable' => false,
					'public'             => true,
					'has_archive'        => false,
					'show_in_nav_menus'  => false,
					'menu_position'      => 10,
					'supports'           => array(
						'title',
						'editor',
						'thumbnail',
					)
				)
			);
			register_post_type(
				'service', array(
					'name'          => esc_html__( 'Services' ),
					'labels'        => array(
						'singular_name'      => esc_html__( 'Service', 'realestate' ),
						'menu_name'          => esc_html__( 'Services', 'realestate' ),
						'name_admin_bar'     => esc_html__( 'Service', 'realestate' ),
						'add_new'            => esc_html__( 'Add new', 'realestate' ),
						'add_new_item'       => esc_html__( 'Add new', 'realestate' ),
						'new_item'           => esc_html__( 'New' ),
						'edit_item'          => esc_html__( 'Edit', 'realestate' ),
						'view_item'          => esc_html__( 'View', 'realestate' ),
						'all_items'          => esc_html__( 'Services', 'realestate' ),
						'search_items'       => esc_html__( 'Search', 'realestate' ),
						'not_found'          => esc_html__( 'No Property Found.', 'realestate' ),
						'not_found_in_trash' => esc_html__( 'No Property Found. in Trash', 'realestate' )
					),
					'show_in_rest'       => false,
					'query_var'          => false,
					'publicly_queryable' => false,
					'public'             => true,
					'has_archive'        => false,
					'show_in_nav_menus'  => false,
					'menu_position'      => 11,
					'supports'           => array(
						'title',
					)
				)
			);
			register_post_type(
				'estate', array(
					'labels'        => array(
						'name'               => esc_html__( 'Properties', 'realestate' ),
						'singular_name'      => esc_html__( 'Property', 'realestate' ),
						'menu_name'          => esc_html__( 'Properties', 'realestate' ),
						'name_admin_bar'     => esc_html__( 'Property', 'realestate' ),
						'add_new'            => esc_html__( 'Add New Property', 'realestate' ),
						'add_new_item'       => esc_html__( 'Add New Property', 'realestate' ),
						'new_item'           => esc_html__( 'New Property', 'realestate' ),
						'edit_item'          => esc_html__( 'Edit Property', 'realestate' ),
						'view_item'          => esc_html__( 'View Property', 'realestate' ),
						'all_items'          => esc_html__( 'Properties', 'realestate' ),
						'search_items'       => esc_html__( 'Search property', 'realestate' ),
						'not_found'          => esc_html__( 'No Property Found.', 'realestate' ),
						'not_found_in_trash' => esc_html__( 'No Property found in Trash.', 'realestate' )
					),
					'show_in_rest'  => true,
					'query_var'     => true,
					'public'        => true,
					'has_archive'   => $archive_slug,
					'menu_position' => 4,
					'menu_icon'     => 'dashicons-admin-home',
					'map_meta_cap'  => true,
					'rewrite'       => array( 'slug' => $slug ),
					'supports'      => $supports
				)
			);
		}
		
	}
endif;