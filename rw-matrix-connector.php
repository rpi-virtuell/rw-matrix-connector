<?php

/*
 * Plugin Name:       RW Matrix Connector
 * Plugin URI:        https://github.com/rpi-virtuell/rw-matrix-connector
 * Description:       Connector to Matrix Chat via MessageQueue "Enqueue" to our MatrixBot
 * Version:           0.0.1
 * Author:            Frank Neumann-Staude
 * Author URI:        https://staude.net
 * License:           GNU General Public License v3
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       rw-matrix-connector
 * Domain Path:       /languages
 * GitHub Plugin URI: https://github.com/rpi-virtuell/rw-matrix-connector
 * GitHub Branch:     master
 */


require __DIR__ . '/vendor/autoload.php';

define ( 'MatrixMessageText', 'text' );

class RW_Matrix_Connector {
	/**
	 * Plugin version
	 *
	 * @var     string
	 * @since   0.1
	 * @access  public
	 */
	static public $version 		= '0.0.1';

	/**
	 * Singleton object holder
	 *
	 * @var     mixed
	 * @since   0.1
	 * @access  private
	 */
	static private $instance = NULL;

	/**
	 * @var     mixed
	 * @since   0.1
	 * @access  public
	 */
	static public $plugin_name = NULL;

	/**
	 * @var     mixed
	 * @since   0.1
	 * @access  public
	 */
	static public $textdomain = NULL;

	/**
	 * @var     mixed
	 * @since   0.1
	 * @access  public
	 */
	static public $plugin_base_name = NULL;

	/**
	 * @var     mixed
	 * @since   0.1
	 * @access  public
	 */
	static public $plugin_url = NULL;

	/**
	 * @var     string
	 * @since   0.1
	 * @access  public
	 */
	static public $plugin_filename = __FILE__;

	/**
	 * @var     string
	 * @since   0.9
	 * @access  public
	 */
	static public $plugin_dir;

	/**
	 * @var     string
	 * @since   0.1
	 * @access  public
	 */
	static public $plugin_version = '';

	/**
	 * @var     string
	 * @since   0.1
	 * @access  public
	 */
	static public $plugin_dir_name = '';

	/**
	 * Plugin constructor.
	 *
	 * @since   0.1
	 * @access  public
	 * @uses    plugin_basename
	 * @action  rw_remote_auth_server_init
	 */
	public function __construct () {
		// set the textdomain variable
		self::$textdomain = self::get_textdomain();
		// The Plugins Name
		self::$plugin_name = $this->get_plugin_header( 'Name' );
		// The Plugins Basename
		self::$plugin_base_name = plugin_basename( __FILE__ );
		// The Plugins Version
		self::$plugin_version = $this->get_plugin_header( 'Version' );
		self::$plugin_dir_name = dirname( plugin_basename( __FILE__ ) );
		self::$plugin_dir_name = dirname( plugin_basename( __FILE__ ) );
		// absolute path to plugins root
		self::$plugin_dir = plugin_dir_path(__FILE__);
		// Load the textdomain
		$this->load_plugin_textdomain();
		// Add Filter & Actions

		add_action( 'transition_post_status',       array( 'RW_Matrix_Connector_Actions', 'publish_post'), 10, 3 );

		if( function_exists('acf_add_options_page') ) {
			acf_add_options_sub_page(array(
				'page_title' 	=> 'Matrix Connector',
				'menu_title' 	=> 'Matrix Connector',
				'parent_slug' 	=> 'options-general.php',
			));
		}
		do_action( 'rw_matrix_connector_init' );
	}

	/**
	 * Creates an Instance of this Class
	 *
	 * @since   0.1
	 * @access  public
	 * @return  RW_Remote_Auth_Server
	 */
	public static function get_instance() {
		if ( NULL === self::$instance )
			self::$instance = new self;
		return self::$instance;
	}

	/**
	 * Load the localization
	 *
	 * @since	0.1
	 * @access	public
	 * @uses	load_plugin_textdomain, plugin_basename
	 * @filters rw_remote_auth_server_translationpath path to translations files
	 * @return	void
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain( self::get_textdomain(), false, apply_filters ( 'rw_matrix_connector_translationpath', dirname( plugin_basename( __FILE__ )) .  self::get_textdomain_path() ) );
	}

	/**
	 * Get a value of the plugin header
	 *
	 * @since   0.1
	 * @access	protected
	 * @param	string $value
	 * @uses	get_plugin_data, ABSPATH
	 * @return	string The plugin header value
	 */
	protected function get_plugin_header( $value = 'TextDomain' ) {
		if ( ! function_exists( 'get_plugin_data' ) ) {
			require_once( ABSPATH . '/wp-admin/includes/plugin.php');
		}
		$plugin_data = get_plugin_data( __FILE__ );
		$plugin_value = $plugin_data[ $value ];
		return $plugin_value;
	}

	/**
	 * get the textdomain
	 *
	 * @since   0.1
	 * @static
	 * @access	public
	 * @return	string textdomain
	 */
	public static function get_textdomain() {
		if( is_null( self::$textdomain ) )
			self::$textdomain = self::get_plugin_data( 'TextDomain' );
		return self::$textdomain;
	}

	/**
	 * get the textdomain path
	 *
	 * @since   0.1
	 * @static
	 * @access	public
	 * @return	string Domain Path
	 */
	public static function get_textdomain_path() {
		return self::get_plugin_data( 'DomainPath' );
	}

	/**
	 * return plugin comment data
	 *
	 * @since   0.1
	 * @uses    get_plugin_data
	 * @access  public
	 * @param   $value string, default = 'Version'
	 *		Name, PluginURI, Version, Description, Author, AuthorURI, TextDomain, DomainPath, Network, Title
	 * @return  string
	 */
	public static function get_plugin_data( $value = 'Version' ) {
		if ( ! function_exists( 'get_plugin_data' ) )
			require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
		$plugin_data  = get_plugin_data ( __FILE__ );
		$plugin_value = $plugin_data[ $value ];
		return $plugin_value;
	}
}

if ( class_exists( 'RW_Matrix_Connector' ) ) {
	add_action( 'plugins_loaded', array( 'RW_Matrix_Connector', 'get_instance' ) );
	require_once 'inc/RW_Matrix_Connector_Autoloader.php';
	RW_Matrix_Connector_Autoloader::register();
	register_activation_hook( __FILE__, array( 'RW_Matrix_Connector_Installation', 'on_activate' ) );
	register_uninstall_hook(  __FILE__,	array( 'RW_Matrix_Connector_Installation', 'on_uninstall' ) );
	register_deactivation_hook( __FILE__, array( 'RW_Matrix_Connector_Installation', 'on_deactivation' ) );
}