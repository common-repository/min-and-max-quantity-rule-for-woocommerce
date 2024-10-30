<?php
/**
* Plugin Name: Min and Max Quantity Rule For Woocommerce
* Description: This plugin allows create Min and Max Quantity Rule For Woocommerce plugin.
* Version: 1.0
* Copyright: 2020
* Text Domain: min-and-max-quantity-rule-for-woocommerce
* Domain Path: /languages 
*/


// Exit if accessed directly
if (!defined('ABSPATH')) {
  die('-1');
}

if (!defined('OCMAMQRW_PLUGIN_NAME')) {
  define('OCMAMQRW_PLUGIN_NAME', 'Min and Max Quantity Rule For Woocommerce');
}
if (!defined('OCMAMQRW_PLUGIN_VERSION')) {
  define('OCMAMQRW_PLUGIN_VERSION', '1.0');
}
if (!defined('OCMAMQRW_PLUGIN_FILE')) {
  define('OCMAMQRW_PLUGIN_FILE', __FILE__);
}
if (!defined('OCMAMQRW_PLUGIN_DIR')) {
  define('OCMAMQRW_PLUGIN_DIR',plugins_url('', __FILE__));
}
if (!defined('OCMAMQRW_BASE_NAME')) {
    define('OCMAMQRW_BASE_NAME', plugin_basename(OCMAMQRW_PLUGIN_FILE));
}
if (!defined('OCMAMQRW_DOMAIN')) {
  define('OCMAMQRW_DOMAIN', 'min-and-max-quantity-rule-for-woocommerce');
}

//Main class
//Load required js,css and other files

if (!class_exists('OCMAMQRW')) {
	add_action('plugins_loaded', array('OCMAMQRW', 'OCMAMQRW_instance'));
  	class OCMAMQRW {

	    protected static $OCMAMQRW_instance;

	    public static function OCMAMQRW_instance() {
	      	if (!isset(self::$OCMAMQRW_instance)) {
	        	self::$OCMAMQRW_instance = new self();
	        	self::$OCMAMQRW_instance->init();
	        	self::$OCMAMQRW_instance->includes();
			}
	      	return self::$OCMAMQRW_instance;
	    }

	    function __construct() {
	        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	        add_action('admin_init', array($this, 'OCMAMQRW_check_plugin_state'));
	    }


	    function OCMAMQRW_check_plugin_state(){
	      	if ( ! ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) ) {
	        	set_transient( get_current_user_id() . 'mamwrerror', 'message' );
	      	}
	    }


	    function init() {
	      	add_action( 'admin_notices', array($this, 'OCMAMQRW_show_notice'));
	       	add_action( 'admin_enqueue_scripts', array($this, 'OCMAMQRW_load_admin_script_style'), 1);
	       	add_action( 'wp_enqueue_scripts', array($this, 'OCMAMQRW_load_front_script_style'), 1);
	       	add_filter( 'plugin_row_meta', array( $this, 'OCMAMQRW_plugin_row_meta' ), 10, 2 );
	    }


      	function OCMAMQRW_plugin_row_meta( $links, $file ) {
          	if ( OCMAMQRW_BASE_NAME === $file ) {
              	$row_meta = array(
                  'rating'    =>  ' <a href="https://www.xeeshop.com/min-max-quantities-for-woocommerce/" target="_blank">Documentation</a> | <a href="https://www.xeeshop.com/support-us/?utm_source=aj_plugin&utm_medium=plugin_support&utm_campaign=aj_support&utm_content=aj_wordpress" target="_blank">Support</a> |<a href="https://wordpress.org/support/plugin/min-and-max-quantity-rule-for-woocommerce/reviews/?filter=5" target="_blank"><img src="'.OCMAMQRW_PLUGIN_DIR.'/images/star.png" class="mawr_rating_div"></a>',
              	);

              	return array_merge( $links, $row_meta );
          	}
          	return (array) $links;
      	}


	    function OCMAMQRW_show_notice() {
	        if ( get_transient( get_current_user_id() . 'mamwrerror' ) ) {

	          	deactivate_plugins( plugin_basename( __FILE__ ) );

	          	delete_transient( get_current_user_id() . 'mamwrerror' );

	          	echo '<div class="error"><p> This plugin is deactivated because it require <a href="plugin-install.php?tab=search&s=woocommerce">WooCommerce</a> plugin installed and activated.</p></div>';
	        }
	    }
	   

	    function OCMAMQRW_load_admin_script_style() {
	      	wp_enqueue_style( 'mamqrw_admin_style', OCMAMQRW_PLUGIN_DIR . '/assets/css/mamwr-admin-style.css', false, '1.0.0' );
	      	wp_enqueue_script( 'mamqrw_admin_script', OCMAMQRW_PLUGIN_DIR . '/assets/js/mamwr-admin-script.js', array('jquery'), '1.0.0',false );
	    }

	    function OCMAMQRW_load_front_script_style() {
	      	wp_enqueue_style( 'mamqrw_admin_style', OCMAMQRW_PLUGIN_DIR . '/assets/css/mamwr-front-style.css', false, '1.0.0' );
	    }

	   
	    function includes() {

	      //admin settings
	      include_once('includes/mamqrw-adminsettings.php');

	      include_once('includes/mamqrw-kit.php');

	      //Total Cart QTY Validation
	      include_once('includes/mamqrw-functionality.php');

	      //single,variations,category etc product setting
	      include_once('includes/mamqrw-product_cat_settings.php');
	    }     
	} 
}


add_action( 'plugins_loaded', 'mamqrw_load_textdomain' );
function mamqrw_load_textdomain() {
    load_plugin_textdomain( 'min-and-max-quantity-rule-for-woocommerce', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}

function mamqrw_load_my_own_textdomain( $mofile, $domain ) {
    if ( 'min-and-max-quantity-rule-for-woocommerce' === $domain && false !== strpos( $mofile, WP_LANG_DIR . '/plugins/' ) ) {
        $locale = apply_filters( 'plugin_locale', determine_locale(), $domain );
        $mofile = WP_PLUGIN_DIR . '/' . dirname( plugin_basename( __FILE__ ) ) . '/languages/' . $domain . '-' . $locale . '.mo';
    }
    return $mofile;
}
add_filter( 'load_textdomain_mofile', 'mamqrw_load_my_own_textdomain', 10, 2 );