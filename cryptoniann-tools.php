<?php
/**
 * Plugin Name: cryptoniann-tools
 * Plugin URI: https://cryptoniann.dgsoft.eu
 * Description: Plugin needed for running short tags and other options for cryptoniann Theme.
 * Version: 1.0.0
 * Author: DGSoft
 * Author URI: https://dgsoft.eu
 * License: GPL2
 */
// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}
function cryptoniann_tools_activate() {
    // Activation
	if(!cryptoniann_theme_is_enabled()) echo __( 'Plugin requires the Theme Cryptoninann','cryptoniann' );
}
register_activation_hook( __FILE__, 'cryptoniann_tools_activate' );

function cryptoniann_theme_is_enabled(){
	$theme = wp_get_theme(); // gets the current theme
	if ( 'cryptoniann' == strtolower($theme->name) ) {
		return true;
	}else return false;
}


	/*
	 * Shortcodes
	*/	
	function cryptoniann_st( $atts ) {
		
		// This code only provides functionality for Visual Widgets like Bitcoin Stock info graphics,converter, forum topics.. etc. You can see them here: widgets.bitcoin.com
		$cwgt_code="<script>
					  (function(b,i,t,C,O,I,N) {
						window.addEventListener('load',function() {
						  if(b.getElementById(C))return;
						  I=b.createElement(i),N=b.getElementsByTagName(i)[0];
						  I.src=t;I.id=C;N.parentNode.insertBefore(I, N);
						},false)
					  })(document,'script','https://widgets.bitcoin.com/widget.js','btcwdgt');
					</script>";
		
		switch($atts['show']){
			case 'whyus':
				if(!cryptoniann_theme_is_enabled()) return ;
				ob_start();
				get_template_part( 'content-parts/whyus' );
				return ob_get_clean();
			break;
			case 'currency_converter':
				if(!cryptoniann_theme_is_enabled()) return ;
				ob_start();
				get_template_part( 'content-parts/currency_converter' );
				return ob_get_clean();
			break;	
			case 'services_promo':
				if(!cryptoniann_theme_is_enabled()) return ;
				ob_start();
				get_template_part( 'content-parts/services_promo' );
				return ob_get_clean();
			break;		
			case 'latest_news':
				if(!cryptoniann_theme_is_enabled()) return ;
				ob_start();
				get_template_part( 'content-parts/latest_news' );
				return ob_get_clean();
			break;							
			case 'our_services':
				if(!cryptoniann_theme_is_enabled()) return ;
				ob_start();
				get_template_part( 'content-parts/our_services' );
				return ob_get_clean();
			break;					
			case 'faq':
				if(!cryptoniann_theme_is_enabled()) return ;
				ob_start();
				get_template_part( 'content-parts/faq' );
				return ob_get_clean();
			break;					
			case 'testimonials':
				if(!cryptoniann_theme_is_enabled()) return ;
				ob_start();
				get_template_part( 'content-parts/testimonials' );
				return ob_get_clean();
			break;					
			case 'team':
				if(!cryptoniann_theme_is_enabled()) return ;
				ob_start();
				get_template_part( 'content-parts/team' );
				return ob_get_clean();
			break;					
			case 'widget-forum':
				ob_start();
				echo '<div id="dgbtcwgt" class="btcwdgt-forum"></div>'.$cwgt_code;
				return ob_get_clean();
			break;					
			case 'widget-news':
				ob_start();
				echo '<div id="dgbtcwgt" class="btcwdgt-news"></div>'.$cwgt_code;
				return ob_get_clean();
			break;					
			case 'widget-chart':
				ob_start();
				echo '<div class="btcwdgt-chart" style="max-width: 100% !important;">
				
				</div>'.$cwgt_code;
				return ob_get_clean();
			break;						
			case 'widget-news-ticker':
				ob_start();
				echo '<div class="btcwdgt-news-ticker"></div>'.$cwgt_code;
				return ob_get_clean();
			break;	
		}
	}
	add_shortcode( 'cryptoniann', 'cryptoniann_st' );	


/*
 * Post Types
*/
function cryptoniann_create_post_types() {
  register_post_type( 'services',
	array(
	  'labels' => array(
		'name' => __( 'Services','cryptoniann' ),
		'singular_name' => __( 'Service','cryptoniann' )
	  ),
	  'supports' => array( 'title','editor','revisions','thumbnail' ),
	  'public' => true,
	  'has_archive' => true,
	  'show_in_nav_menus' => true
	)
  );
  register_post_type( 'team',
	array(
	  'labels' => array(
		'name' => __( 'Team','cryptoniann' ),
		'singular_name' => __( 'Profile','cryptoniann' )
	  ),
	  'supports' => array( 'title','editor','revisions','thumbnail' ),
	  'public' => true,
	  'has_archive' => true,
	  'show_in_nav_menus' => true
	)
  );
  register_post_type( 'faq',
	array(
	  'labels' => array(
		'name' => __( 'FAQ','cryptoniann' ),
		'singular_name' => __( 'FAQ','cryptoniann' )
	  ),
	  'supports' => array( 'title','editor','revisions' ),
	  'public' => true,
	  'has_archive' => true,
	  'show_in_nav_menus' => true
	)
  );
  register_post_type( 'testimonials',
	array(
	  'labels' => array(
		'name' => __( 'Testimonials','cryptoniann' ),
		'singular_name' => __( 'Testimonial','cryptoniann' )
	  ),
	  'supports' => array( 'title','editor','revisions' ),
	  'public' => true,
	  'has_archive' => true,
	  'show_in_nav_menus' => true
	)
  );
}
add_action( 'init', 'cryptoniann_create_post_types' );