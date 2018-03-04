<?php
/**
 * Plugin Name:			Product Social Share Buttons
 * Plugin URI:			https://capsula.group/plugins/single-product-social-sharing-plugin-for-woocommerce/
 * Description:			Add Social Share buttons for woocommerce products
 * Version:			1.0.2
 * Author:			Avoori
 * Author URI:			https://avoori.com/
 * Requires at least:		4.5.0
 * Tested up to:		4.9.4
 *
 * Text Domain: avoo-share-products
 * Domain Path: /language/
 *
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Returns the main instance of Avoori_Product_Social_Sharing to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object Avoori_Product_Social_Sharing
 */
function Avoori_Product_Social_Sharing() {
	return Avoori_Product_Social_Sharing::instance();
} // End Avoori_Product_Social_Sharing()

Avoori_Product_Social_Sharing();

/**
 * Main Avoori_Product_Social_Sharing Class
 *
 * @class Avoori_Product_Social_Sharing
 * @version	1.0.2
 * @since 1.0.0
 * @package	Avoori_Product_Social_Sharing
 */
final class Avoori_Product_Social_Sharing {
	/**
	 * Avoori_Product_Social_Sharing The single instance of Avoori_Product_Social_Sharing.
	 * @var 	object
	 * @access  private
	 * @since 	1.0.0
	 */
	private static $_instance = null;

	/**
	 * The token.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $token;

	/**
	 * The version number.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $version;

	// Admin - Start
	/**
	 * The admin object.
	 * @var     object
	 * @access  public
	 * @since   1.0.0
	 */
	public $admin;

	/**
	 * Constructor function.
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function __construct( $widget_areas = array() ) {
		$this->token 				= 'avoo-product-social-sharing';
		$this->plugin_url 			= plugin_dir_url( __FILE__ );
		$this->plugin_path 			= plugin_dir_path( __FILE__ );
		$this->version 				= '1.0.2';

		register_activation_hook( __FILE__, array( $this, 'install' ) );

		add_action( 'init', array( $this, 'avoo_product_share_load_textdomain' ) );

		add_action( 'init', array( $this, 'avoo_setup_product_share' ) );
	}

	/**
	 * Main Avoori_Product_Social_Sharing Instance
	 *
	 * Ensures only one instance of Avoori_Product_Social_Sharing is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @see Avoori_Product_Social_Sharing()
	 * @return Main Avoori_Product_Social_Sharing instance
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) )
			self::$_instance = new self();
		return self::$_instance;
	} // End instance()

	/**
	 * Cloning is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __clone() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), '1.0.0' );
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), '1.0.0' );
	}

	/**
	 * Installation.
	 * Runs on activation. Logs the version number and assigns a notice message to a WordPress option.
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function install() {
		$this->_log_version_number();
	}

	/**
	 * Log the plugin version number.
	 * @access  private
	 * @since   1.0.0
	 * @return  void
	 */
	private function _log_version_number() {
		// Log the version number.
		update_option( $this->token . '-version', $this->version );
	}

	public function avoo_setup_product_share() {

		// Include Customizer Helper functions
		require_once( $this->plugin_path . 'includes/customizer-helper.php' );

		if ( avoo_is_woocommerce_active() ) {

			// Register CSS files
			add_action( 'wp_enqueue_scripts' , array( $this , 'avoo_product_share_load_css' ) );

			// Add Customizer options
			add_action( 'customize_register', array( $this , 'customizer_register' ) );

			// Add buttons to woocommerce products
			add_action( 'woocommerce_single_product_summary' , 'avoo_add_product_share_buttons' , 45);

			// Add meta information
			add_action( 'wp_footer' , 'avoo_product_share_footer_meta');

		} else {

			add_action( 'admin_notices', 'avoo_admin_notice_woo_not_active' );

		}

	}

	/**
	 * Load textdomain.
	 *
	 * @since 1.0.0
	 */
	public function avoo_product_share_load_textdomain() {

		load_plugin_textdomain( 'avoo-share-products', false, basename( dirname( __FILE__ ) ) . '/language' );
	
	}

	/**
	 * Customizer Controls and settings
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 * @since   1.0.0
	 */
	public function customizer_register( $wp_customize ) {

		/**
		 * Add a new section
		 */
		$wp_customize->add_section( 'avoo_product_share_section' , array(
			'title'      	=> esc_html__( 'Product Social Sharing', 'avoo-share-products' ),
			'priority'   	=> 210,
		) );

		
		/**
		 * Add Social Share Buttons
		 */
		$wp_customize->add_setting( 'avoo_product_share_show', array(
			'transport' 			=> 'refresh',
			'default'           	=> false,
			'sanitize_callback' 	=> 'avoo_sanitize_checkbox',
		) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'avoo_product_share_show', array(
			'label'	   				=> esc_html__( 'Enable Social Share Buttons', 'avoo-share-products' ),
			'type' 					=> 'checkbox',
			'section'  				=> 'avoo_product_share_section',
			'settings' 				=> 'avoo_product_share_show',
			'priority' 				=> 10,
		) ) );

		/**
		 * Show Title
		 */
		$wp_customize->add_setting( 'avoo_product_share_title_show', array(
			'transport' 			=> 'refresh',
			'default'           	=> false,
			'sanitize_callback' 	=> 'avoo_sanitize_checkbox',
		) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'avoo_product_share_title_show', array(
			'label'	   				=> esc_html__( 'Add Title', 'avoo-share-products' ),
			'type' 					=> 'checkbox',
			'section'  				=> 'avoo_product_share_section',
			'settings' 				=> 'avoo_product_share_title_show',
			'priority' 				=> 15,
			'active_callback'		=> 'avoo_product_share_is_enabled',
		) ) );

		/**
		 * Title text
		 */
		$wp_customize->add_setting( 'avoo_product_share_title', array(
			'transport' 			=> 'refresh',
			'default'           	=> '',
			'sanitize_callback' 	=> 'wp_filter_nohtml_kses',
		) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'avoo_product_share_title', array(
			'label'	   				=> esc_html__( 'Title Text', 'avoo-share-products' ),
			'type' 					=> 'text',
			'section'  				=> 'avoo_product_share_section',
			'settings' 				=> 'avoo_product_share_title',
			'priority' 				=> 15,
			'active_callback'		=> 'avoo_product_share_and_title_is_enabled',
		) ) );

		/**
		 * Facebook Share Button
		 */
		$wp_customize->add_setting( 'avoo_product_share_button_fb', array(
			'transport' 			=> 'refresh',
			'default'           	=> false,
			'sanitize_callback' 	=> 'avoo_sanitize_checkbox',
		) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'avoo_product_share_button_fb', array(
			'label'	   				=> esc_html__( 'Facebook', 'avoo-share-products' ),
			'type' 					=> 'checkbox',
			'section'  				=> 'avoo_product_share_section',
			'settings' 				=> 'avoo_product_share_button_fb',
			'priority' 				=> 20,
			'active_callback'		=> 'avoo_product_share_is_enabled',
		) ) );

		/**
		 * Twitter Share Button
		 */
		$wp_customize->add_setting( 'avoo_product_share_button_tw', array(
			'transport' 			=> 'refresh',
			'default'           	=> false,
			'sanitize_callback' 	=> 'avoo_sanitize_checkbox',
		) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'avoo_product_share_button_tw', array(
			'label'	   				=> esc_html__( 'Twitter', 'avoo-share-products' ),
			'type' 					=> 'checkbox',
			'section'  				=> 'avoo_product_share_section',
			'settings' 				=> 'avoo_product_share_button_tw',
			'priority' 				=> 25,
			'active_callback'		=> 'avoo_product_share_is_enabled',
		) ) );

		/**
		 * Google Plus Share Button
		 */
		$wp_customize->add_setting( 'avoo_product_share_button_gp', array(
			'transport' 			=> 'refresh',
			'default'           	=> false,
			'sanitize_callback' 	=> 'avoo_sanitize_checkbox',
		) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'avoo_product_share_button_gp', array(
			'label'	   				=> esc_html__( 'Google Plus', 'avoo-share-products' ),
			'type' 					=> 'checkbox',
			'section'  				=> 'avoo_product_share_section',
			'settings' 				=> 'avoo_product_share_button_gp',
			'priority' 				=> 30,
			'active_callback'		=> 'avoo_product_share_is_enabled',
		) ) );

		/**
		 * Pinterest Share Button
		 */
		$wp_customize->add_setting( 'avoo_product_share_button_pi', array(
			'transport' 			=> 'refresh',
			'default'           	=> false,
			'sanitize_callback' 	=> 'avoo_sanitize_checkbox',
		) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'avoo_product_share_button_pi', array(
			'label'	   				=> esc_html__( 'Pinterest', 'avoo-share-products' ),
			'type' 					=> 'checkbox',
			'section'  				=> 'avoo_product_share_section',
			'settings' 				=> 'avoo_product_share_button_pi',
			'priority' 				=> 35,
			'active_callback'		=> 'avoo_product_share_is_enabled',
		) ) );

		/**
		 * Tumblr Share Button
		 */
		$wp_customize->add_setting( 'avoo_product_share_button_tu', array(
			'transport' 			=> 'refresh',
			'default'           	=> false,
			'sanitize_callback' 	=> 'avoo_sanitize_checkbox',
		) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'avoo_product_share_button_tu', array(
			'label'	   				=> esc_html__( 'Tumblr', 'avoo-share-products' ),
			'type' 					=> 'checkbox',
			'section'  				=> 'avoo_product_share_section',
			'settings' 				=> 'avoo_product_share_button_tu',
			'priority' 				=> 40,
			'active_callback'		=> 'avoo_product_share_is_enabled',
		) ) );

		/**
		 * Linkedin Share Button
		 */
		$wp_customize->add_setting( 'avoo_product_share_button_li', array(
			'transport' 			=> 'refresh',
			'default'           	=> false,
			'sanitize_callback' 	=> 'avoo_sanitize_checkbox',
		) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'avoo_product_share_button_li', array(
			'label'	   				=> esc_html__( 'Linkedin', 'avoo-share-products' ),
			'type' 					=> 'checkbox',
			'section'  				=> 'avoo_product_share_section',
			'settings' 				=> 'avoo_product_share_button_li',
			'priority' 				=> 45,
			'active_callback'		=> 'avoo_product_share_is_enabled',
		) ) );

		/**
		 * Email Share Button
		 */
		$wp_customize->add_setting( 'avoo_product_share_button_em', array(
			'transport' 			=> 'refresh',
			'default'           	=> false,
			'sanitize_callback' 	=> 'avoo_sanitize_checkbox',
		) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'avoo_product_share_button_em', array(
			'label'	   				=> esc_html__( 'Email', 'avoo-share-products' ),
			'type' 					=> 'checkbox',
			'section'  				=> 'avoo_product_share_section',
			'settings' 				=> 'avoo_product_share_button_em',
			'priority' 				=> 50,
			'active_callback'		=> 'avoo_product_share_is_enabled',
		) ) );

		/**
		 * Email Body Text
		 */
		$wp_customize->add_setting( 'avoo_product_share_email_title', array(
			'transport' 			=> 'refresh',
			'default'           	=> esc_html__( 'I saw this and thought about you!', 'avoo-share-products' ),
			'sanitize_callback' 	=> 'wp_filter_nohtml_kses',
		) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'avoo_product_share_email_title', array(
			'label'	   				=> esc_html__( 'Email Body Text', 'avoo-share-products' ),
			'type' 					=> 'text',
			'section'  				=> 'avoo_product_share_section',
			'settings' 				=> 'avoo_product_share_email_title',
			'priority' 				=> 50,
			'active_callback'		=> 'avoo_product_share_and_email_is_enabled',
		) ) );

	}

	/**
	 * Register Scripts
	 *
	 * @since 1.0.0
	 */
	public function avoo_product_share_load_css() {

		// Check if font is already enqueued
		if ( ! wp_style_is( 'font-awesome' , $list = 'enqueued' ) && ! wp_style_is( 'fontawesome' , $list = 'enqueued' ) ) {
			// Register font for icons
			wp_enqueue_style( 'font-awesome', $this->plugin_url . 'assets/css/font-awesome.min.css', false, '4.7.0' );
		}

		// Register CSS
		wp_enqueue_style( 'product-social-share-style', $this->plugin_url . 'assets/css/style.min.css', false, '1.0.0' );
	
	}
}// End Class
?>
