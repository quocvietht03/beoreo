<?php
add_theme_support( 'woocommerce' );

/** Template pages ********************************************************/

if (!function_exists('beoreo_woocommerce_content')) {
    
    function beoreo_woocommerce_content() {

        if (is_singular('product')) {
            wc_get_template_part('single', 'product');
        } else {
            wc_get_template_part('archive', 'product');
        }
    }

}

// Display 9 products per page.
//add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 9;' ), 20 );

/*
 * Show rating on all products
*/ 
add_filter( 'woocommerce_product_get_rating_html','beoreo_get_rating_html', 10,2 );
function beoreo_get_rating_html( $rating_html, $rating ) {
	
	if($rating == '') $rating = 0;
	
	$rating_html = '';

			$rating_html  = '<div class="star-rating" title="' . sprintf( __( 'Rated %s out of 5', 'beoreo' ), $rating ) . '">';

			$rating_html .= '<span style="width:' . ( ( $rating / 5 ) * 100 ) . '%"><strong class="rating">' . $rating . '</strong> ' . __( 'out of 5', 'beoreo' ) . '</span>';

			$rating_html .= '</div>';

	return $rating_html;

}

/**
* Change number of related products on product page
* Set your own value for 'posts_per_page'
*/ 
add_filter( 'woocommerce_output_related_products_args', 'beoreo_related_products_args' );
function beoreo_related_products_args( $args ) {
    $columns = 4;
    $args['posts_per_page'] = $columns; // 3 related products
    $args['columns'] = $columns; // arranged in 3 columns
    return $args;
}
/**
 * Output the product meta top.
 */
if ( ! function_exists( 'woocommerce_template_single_meta_top' ) ) {
	function woocommerce_template_single_meta_top() {
		wc_get_template( 'single-product/meta_top.php' );
	}
}
/**
 * woocommerce_page_title.
 */
if ( ! function_exists( 'tb_woocommerce_page_title' ) ) {
	function beoreo_woocommerce_page_title() {

		if ( is_search() ) {
			$page_title = sprintf( __( 'Search Results: &ldquo;%s&rdquo;', 'beoreo' ), get_search_query() );

			if ( get_query_var( 'paged' ) )
				$page_title .= sprintf( __( '&nbsp;&ndash; Page %s', 'beoreo' ), get_query_var( 'paged' ) );

		} elseif ( is_tax() ) {

			$page_title = single_term_title( "", false );

		} elseif ( is_archive() ) {

			$page_title = __( 'Archives Products', 'beoreo' );

		} elseif ( is_single() ) {

			$page_title = __( 'Single Product', 'beoreo' );

		} else {

			$shop_page_id = wc_get_page_id( 'shop' );
			$page_title   = get_the_title( $shop_page_id );

		}
		
		return $page_title;
	}
}

/**
 * Get a coupon value
 */
function wc_cart_totals_coupon_html_custom( $coupon ) {
	if ( is_string( $coupon ) ) {
		$coupon = new WC_Coupon( $coupon );
    }

	$value  = array();

	if ( $amount = WC()->cart->get_coupon_discount_amount( $coupon->code, WC()->cart->display_cart_ex_tax ) ) {
		$discount_html = '-' . wc_price( $amount );
	} else {
		$discount_html = '-' . wc_price( $amount );
	}

	$value[] = apply_filters( 'woocommerce_coupon_discount_amount_html', $discount_html, $coupon );

	if ( $coupon->enable_free_shipping() ) {
		$value[] = __( 'Free shipping coupon', 'beoreo' );
    }

    // get rid of empty array elements
    $value = array_filter( $value );
	$value = implode( ', ', $value );

	echo apply_filters( 'woocommerce_cart_totals_coupon_html', $value, $coupon );
}

/**
 * Get a shipping methods full label including price
 */
function wc_cart_totals_shipping_method_label_custom( $method ) {
	$label = '';//$method->label;

	if ( $method->cost > 0 ) {
		if ( WC()->cart->tax_display_cart == 'excl' ) {
			$label .= wc_price( $method->cost );
			if ( $method->get_shipping_tax() > 0 && WC()->cart->prices_include_tax ) {
				$label .= ' <small class="tax_label">' . WC()->countries->ex_tax_or_vat() . '</small>';
			}
		} else {
			$label .= wc_price( $method->cost + $method->get_shipping_tax() );
			if ( $method->get_shipping_tax() > 0 && ! WC()->cart->prices_include_tax ) {
				$label .= ' <small class="tax_label">' . WC()->countries->inc_tax_or_vat() . '</small>';
			}
		}
	} elseif ( $method->id !== 'free_shipping' ) {
		$label .= ' (' . __( 'Free', 'beoreo' ) . ')';
	}

	return apply_filters( 'woocommerce_cart_shipping_method_full_label', $label, $method );
}
