<?php
/**
 * Social Share Buttons Output
 *
 * @package Avoori_Product_Social_Sharing
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Check if product social buttons are enabled
 *
 * @since 1.0.0
 */
function avoo_product_share_is_enabled() {
	return get_theme_mod( 'avoo_product_share_show', false );
}

/**
 * Check if product social buttons title is enabled
 *
 * @since 1.0.0
 */
function avoo_product_share_title_is_enabled() {
	return get_theme_mod( 'avoo_product_share_title_show', false );
}

/**
 * Add Social Share Buttons based on the user's choice in the customizer
 *
 * @since 1.0.0
 */
function avoo_add_product_share_buttons() {

	// Define Variables
	global $post;
	$product_share_title 	= get_theme_mod( 'avoo_product_share_title', '' );
	$product_share 			= '<div class="avoo-social-share-buttons">';

	// Add a title based on user choice
	if ( avoo_product_share_is_enabled() && avoo_product_share_title_is_enabled() && '' != $product_share_title ) {
		$product_share.='<h3 class="avoo-social-share-title">'. $product_share_title .'</h3>';
	}

	// Facebook
	if ( avoo_product_share_is_enabled() && get_theme_mod( 'avoo_product_share_button_fb', false ) ) {
		$product_share.='<span class="avoo-social-share-fb"><a href="https://www.facebook.com/sharer/sharer.php?u='.get_permalink($post->ID).'" target="_blank"><i class="fa fa-facebook-f"></i></a></span>';
	}

	// Twitter
	if ( avoo_product_share_is_enabled() && get_theme_mod( 'avoo_product_share_button_tw', false ) ) {
		$product_share.='<span class="avoo-social-share-tw"><a href="https://twitter.com/intent/tweet?source=webclient&amp;original_referer='.get_permalink($post->ID).'&amp;text='.get_the_title($post->ID).'&amp;url='.get_permalink($post->ID).'" target="_blank"><i class="fa fa-twitter"></i></a></span>';
	}

	// Google Plus
	if ( avoo_product_share_is_enabled() && get_theme_mod( 'avoo_product_share_button_gp', false ) ) {
		$product_share.='<span class="avoo-social-share-gp"><a href="https://plus.google.com/share?url='.get_permalink($post->ID).'" target="_blank"><i class="fa fa-google-plus"></i></a></span>';
	}

	// Pinterest
	if ( avoo_product_share_is_enabled() && get_theme_mod( 'avoo_product_share_button_pi', false ) ) {
		$product_share.='<span class="avoo-social-share-pi"><a href="http://pinterest.com/pin/create/bookmarklet/?media='.wp_get_attachment_url( get_post_thumbnail_id() ).'&amp;url='.get_permalink($post->ID).'&amp;title='.get_the_title($post->ID).'&amp;description='.get_the_title($post->ID).'" target="_blank"><i class="fa fa-pinterest-p"></i></a></span>';
	}

	// Tumblr
	if ( avoo_product_share_is_enabled() && get_theme_mod( 'avoo_product_share_button_tu', false ) ) {
		$product_share.='<span class="avoo-social-share-tu"><a href="http://www.tumblr.com/share/link?url='.get_permalink($post->ID).'" target="_blank"><i class="fa fa-tumblr"></i></a></span>';
	}

	// Linkedin
	if ( avoo_product_share_is_enabled() && get_theme_mod( 'avoo_product_share_button_li', false ) ) {
		$product_share.='<span class="avoo-social-share-li"><a href="https://www.linkedin.com/shareArticle?mini=true&url='.get_permalink($post->ID).'&title='.get_the_title($post->ID).'&summary=&source=" target="_blank"><i class="fa fa-linkedin"></i></a></span>';
	}

	// Email
	if ( avoo_product_share_is_enabled() && get_theme_mod( 'avoo_product_share_button_em', false ) ) {
        $email_body_const   = esc_html__( 'I saw this and thought about you!', 'avoo-share-products' );
        $email_title        = get_theme_mod( 'avoo_product_share_email_title' , $email_body_const );
		if ( $email_body_const != $email_title ) {
			$product_share.='<span class="avoo-social-share-em"><a href="mailto:?subject='.get_the_title($post->ID).'&amp;body='. $email_title .'%0D%0A' . get_permalink($post->ID) . '"><i class="fa fa-envelope"></i></a></span>';
		} else {
			$product_share.='<span class="avoo-social-share-em"><a href="mailto:?subject='.get_the_title($post->ID).'&amp;body='. $email_body_const .'%0D%0A' . get_permalink($post->ID) . '"><i class="fa fa-envelope"></i></a></span>';
		}
	}

	$product_share.='<div style="clear:both"></div></div>';
	echo $product_share;
}

/**
 * Add meta information if required
 *
 * @since 1.0.0
 */
function avoo_product_share_footer_meta() {
	if ( get_theme_mod( 'avoo_product_share_button_tw', false ) ) {
		echo '<!-- Twitter Card data -->
			<meta name="twitter:card" content="summary">
			<meta name="twitter:title" content="'.get_the_title($post->ID).'">
			<meta name="twitter:description" content="'.get_the_excerpt($post->ID).'">
			<!-- Twitter Summary card images must be at least 120x120px -->
			<meta name="twitter:image" content="'.wp_get_attachment_url( get_post_thumbnail_id() ).'">
			';
	}
	if ( get_theme_mod( 'avoo_product_share_button_gp', false ) ) {
		echo '<!-- Schema.org markup for Google+ -->
		  <meta itemprop="name" content="'.get_the_title($post->ID).'">
		  <meta itemprop="description" content="'.get_the_excerpt($post->ID).'">
		  <meta itemprop="image" content="'.wp_get_attachment_url( get_post_thumbnail_id() ).'">
		  ';
	}	
}

/**
 * Sanitize input from customizer
 *
 * @since 1.0.0
 */
function avoo_sanitize_checkbox( $input ){
    return ( ( isset( $input ) && true == $input ) ? true : false );
}