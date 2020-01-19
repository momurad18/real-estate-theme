<?php



if ( ! isset( $content_width ) ) {
	$content_width = 1920;
}

require_once get_template_directory() . '/includes/class-realestate.php';

function Real_Estate_Theme() {
	return Real_Estate::get_instance();
}

// initiate Realestate theme
Real_Estate_Theme()->init();

function get_hansel_and_gretel_breadcrumbs(){
    // Set variables for later use
    //$here_text        = __( 'انت هنا' );
    $home_link        = home_url('/');
    $home_text        = __( 'الرئيسية' );
    $link_before      = '<span typeof="v:Breadcrumb">';
    $link_after       = '</span>';
    $link_attr        = ' rel="v:url" property="v:title"';
    $link             = $link_before . '<a' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;
    $delimiter        = ' &raquo; ';              // Delimiter between crumbs
    $before           = '<span class="current">'; // Tag before the current crumb
    $after            = '</span>';                // Tag after the current crumb
    $page_addon       = '';                       // Adds the page number if the query is paged
    $breadcrumb_trail = '';
    $category_links   = '';

    /** 
     * Set our own $wp_the_query variable. Do not use the global variable version due to 
     * reliability
     */
    $wp_the_query   = $GLOBALS['wp_the_query'];
    $queried_object = $wp_the_query->get_queried_object();

    // Handle single post requests which includes single pages, posts and attatchments
    if ( is_singular() ) 
    {
        /** 
         * Set our own $post variable. Do not use the global variable version due to 
         * reliability. We will set $post_object variable to $GLOBALS['wp_the_query']
         */
        $post_object = sanitize_post( $queried_object );

        // Set variables 
        $title          = apply_filters( 'the_title', $post_object->post_title );
        $parent         = $post_object->post_parent;
        $post_type      = $post_object->post_type;
        $post_id        = $post_object->ID;
        $post_link      = $before . $title . $after;
        $parent_string  = '';
        $post_type_link = '';

        if ( 'post' === $post_type ) {
            // Get the post categories
            $categories = get_the_category( $post_id );
            if ( $categories ) {
                // Lets grab the first category
                $category  = $categories[0];

                $category_links = get_category_parents( $category, true, $delimiter );
                $category_links = str_replace( '<a',   $link_before . '<a' . $link_attr, $category_links );
                $category_links = str_replace( '</a>', '</a>' . $link_after,             $category_links );
            }
        }

        if ( !in_array( $post_type, ['post', 'page', 'attachment'] ) )
        {
            $post_type_object = get_post_type_object( $post_type );
            
            $archive_link     = esc_url( get_post_type_archive_link( $post_type ) );
            $terms = wp_get_post_terms( $post_id, array( 'property-type' , 'city' ) );
           	$term_city = esc_url(get_term_link($terms[0]->slug,'city'));
           	$term_type = esc_url(get_term_link($terms[1]->slug,'property-type'));


           	$term_link_city = sprintf( $link, $term_city, $terms[0]->name );
           	$term_link_type = sprintf( $link, $term_type, $terms[1]->name );
			
           	$post_type_link   = sprintf( $link, $archive_link, $post_type_object->labels->name );
        }

        // Get post parents if $parent !== 0
        if ( 0 !== $parent ) 
        {
            $parent_links = [];
            while ( $parent ) {
                $post_parent = get_post( $parent );

                $parent_links[] = sprintf( $link, esc_url( get_permalink( $post_parent->ID ) ), get_the_title( $post_parent->ID ) );

                $parent = $post_parent->post_parent;
            }

            $parent_links = array_reverse( $parent_links );

            $parent_string = implode( $delimiter, $parent_links );
        }

        // Lets build the breadcrumb trail
        if ( $parent_string ) {
            $breadcrumb_trail = $parent_string . $delimiter . $post_link;
        } else {
           $breadcrumb_trail = $post_link;
        }

        if ( $post_type_link && $term_link_city && $term_link_type )
            $breadcrumb_trail = $post_type_link . $delimiter . $term_link_city . $delimiter . $term_link_type . $delimiter  . $breadcrumb_trail;

        if ( $category_links )
            $breadcrumb_trail = $category_links . $breadcrumb_trail;
    }

    // Handle archives which includes category-, tag-, taxonomy-, date-, custom post type archives and author archives
    if( is_archive() )
    {
        if (    is_category()
             || is_tag()
             || is_tax()
        ) {
            // Set the variables for this section
            $term_object        = get_term( $queried_object );
            $taxonomy           = $term_object->taxonomy;
            $term_id            = $term_object->term_id;
            $term_name          = $term_object->name;
            $term_parent        = $term_object->parent;
            $taxonomy_object    = get_taxonomy( $taxonomy );
            $current_term_link  = $before . $term_name . $after;
            $parent_term_string = '';

            if ( 0 !== $term_parent )
            {
                // Get all the current term ancestors
                $parent_term_links = [];
                while ( $term_parent ) {
                    $term = get_term( $term_parent, $taxonomy );

                    $parent_term_links[] = sprintf( $link, esc_url( get_term_link( $term ) ), $term->name );

                    $term_parent = $term->parent;
                }

                $parent_term_links  = array_reverse( $parent_term_links );
                $parent_term_string = implode( $delimiter, $parent_term_links );
            }

            if ( $parent_term_string ) {
                $breadcrumb_trail = $parent_term_string . $delimiter . $current_term_link;
            } else {
                $breadcrumb_trail = $current_term_link;
            }

        } elseif ( is_author() ) {

            $breadcrumb_trail = __( 'Author archive for ') .  $before . $queried_object->data->display_name . $after;

        } elseif ( is_date() ) {
            // Set default variables
            $year     = $wp_the_query->query_vars['year'];
            $monthnum = $wp_the_query->query_vars['monthnum'];
            $day      = $wp_the_query->query_vars['day'];

            // Get the month name if $monthnum has a value
            if ( $monthnum ) {
                $date_time  = DateTime::createFromFormat( '!m', $monthnum );
                $month_name = $date_time->format( 'F' );
            }

            if ( is_year() ) {

                $breadcrumb_trail = $before . $year . $after;

            } elseif( is_month() ) {

                $year_link        = sprintf( $link, esc_url( get_year_link( $year ) ), $year );

                $breadcrumb_trail = $year_link . $delimiter . $before . $month_name . $after;

            } elseif( is_day() ) {

                $year_link        = sprintf( $link, esc_url( get_year_link( $year ) ),             $year       );
                $month_link       = sprintf( $link, esc_url( get_month_link( $year, $monthnum ) ), $month_name );

                $breadcrumb_trail = $year_link . $delimiter . $month_link . $delimiter . $before . $day . $after;
            }

        } elseif ( is_post_type_archive() ) {

            $post_type        = $wp_the_query->query_vars['post_type'];
            $post_type_object = get_post_type_object( $post_type );

            $breadcrumb_trail = $before . $post_type_object->labels->singular_name . $after;

        }
    }   

    // Handle the search page
    if ( is_search() ) {
        $breadcrumb_trail = __( 'Search query for: ' ) . $before . get_search_query() . $after;
    }

    // Handle 404's
    if ( is_404() ) {
        $breadcrumb_trail = $before . __( 'Error 404' ) . $after;
    }

    // Handle paged pages
    if ( is_paged() ) {
        $current_page = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : get_query_var( 'page' );
        $page_addon   = $before . sprintf( __( ' ( Page %s )' ), number_format_i18n( $current_page ) ) . $after;
    }

    $breadcrumb_output_link  = '';
    $breadcrumb_output_link .= '<div class="breadcrumb">';
    if (    is_home()
         || is_front_page()
    ) {
        // Do not show breadcrumbs on page one of home and frontpage
        if ( is_paged() ) {
            //$breadcrumb_output_link .= $here_text . $delimiter;
            $breadcrumb_output_link .= '<a href="' . $home_link . '">' . $home_text . '</a>';
            $breadcrumb_output_link .= $page_addon;
        }
    } else {
        //$breadcrumb_output_link .= $here_text . $delimiter;
        $breadcrumb_output_link .= '<a href="' . $home_link . '" rel="v:url" property="v:title">' . $home_text . '</a>';
        $breadcrumb_output_link .= $delimiter;
        $breadcrumb_output_link .= $breadcrumb_trail;
        $breadcrumb_output_link .= $page_addon;
    }
    $breadcrumb_output_link .= '</div><!-- .breadcrumbs -->';

    return $breadcrumb_output_link;
}


function currency_exchange($atts, $content = null) {
    extract(shortcode_atts(array("vid" => ''), $atts));
    return '
        <script>
        jQuery(function(){
            $.ajax({
                url: "https://www.on5tl.com/json/pwww-currency.php",
                dataType: "JSON",
                success: function(data){
                    usd = data.currency[0].USD;
                    eur = data.currency[0].EUR;
                    sar = data.currency[0].SAR;
                    aed = data.currency[0].AED;
                    kwd = data.currency[0].KWD;
                    qar = data.currency[0].QAR;
                    conv();
                }
            });
            $("#try").keyup(function(){
                conv();
                var val = $(this).val();
                if(isNaN(val)){
                val = val.replace(/[^0-9\.]/g,\'\');
                if(val.split(\'.\').length>2) 
                    val =val.replace(/\.+$/,"");
                }
                $(this).val(val);
                    });
            function conv(){
            	x = $("#try").val();
            	$("#usd").text((x / usd).toFixed(2));
            	$("#eur").text((x / eur).toFixed(2));
            	$("#sar").text((x / sar).toFixed(2));
            	$("#aed").text((x / aed).toFixed(2));
            	$("#kwd").text((x / kwd).toFixed(2));
            	$("#qar").text((x / qar).toFixed(2));
            }
            $("#try").click(function(){
                $("#try").val("");
            });
            $("#try").blur(function(){
            	if($("#try").val() == ""){
                $("#try").val("1");
                pwww_conv();
                }
            });
        });
</script>
<div class="row pwww-money">
	<div class="col-md-12 pwww-curr-plugin">
		<input id="try" class="currt mcurr" type="text" value="1" /> <span class="currt">ليرة تركية</span><br />
		<span id="usd" class="currt"></span> <span class="currt">دولار امريكي</span><br />
		<span id="eur" class="currt"></span> <span class="currt">يورو</span><br />
		<span id="sar" class="currt"></span> <span class="currt">الريال السعودي</span><br />
		<span id="aed" class="currt"></span> <span class="currt">الدرهم الاماراتي</span><br />
		<span id="kwd" class="currt"></span> <span class="currt">الدينار الكويتي</span><br />
		<span id="qar" class="currt"></span> <span class="currt">الريال القطري</span><br />
	</div>
</div>
    ';
}
add_shortcode("currency-exchange", "currency_exchange");


// filter
function my_posts_where( $where ) {
	
	$where = str_replace("meta_key = 'estate_details_$", "meta_key LIKE 'estate_details_%", $where);
	

	return $where;
}

add_filter('posts_where', 'my_posts_where');


