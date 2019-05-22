<?php

/**
 * Class RW_Matrix_Connector_Autoloader
 *
 * Autoloader for the plugin
 *
 */

class RW_Matrix_Connector_Autoloader {

	/**
	 * @throws
	 * @since   0.1
	 * @access  public
	 * @static
	 * @action  rw_matrix_connector_autoload_register
	 * @return  void
	 */
	public static function register(){
		spl_autoload_register( 'RW_Matrix_Connector_Autoloader::load' );
		do_action( 'rw_matrix_connector_autoload_register' );
	}

	/**
	 * Unregisters autoloader function with spl_autoload
	 *
	 * @since   0.1
	 * @access  public
	 * @static
	 * @action  rw_matrix_connector_autoload_unregister
	 * @return  void
	 */
	public static function unregister(){
		spl_autoload_unregister( 'RW_Matrix_Connector_Autoloader::load' );
		do_action( 'rw_matrix_connector_autoload_unregister' );
	}

	/**
	 * Autoloading function
	 *
	 * @since   0.1
	 * @param   string  $classname
	 * @access  public
	 * @static
	 * @return  void
	 */
	public static function load( $classname ){
		$file =  dirname( __FILE__ ) . DIRECTORY_SEPARATOR . ucfirst( $classname ) . '.php';
		if( file_exists( $file ) ) require_once $file;
	}
}
