<?php namespace BasePlugin;


class Activator {

	/**
	 * @param string $main_file Location of main plugin file
	 * @param integer $db_version Current db version (update to trigger change)
	 * @param string $db_option_name Option name to use to store latest db version
	 */
	function __construct( $main_file, $db_version, $db_option_name, $db_table_name ) {
		$this->main_file      = $main_file;
		$this->db_version     = $db_version;
		$this->db_option_name = $db_option_name;
		$this->db_table_name  = $db_table_name;
	}

	public function init() {
		register_activation_hook( $this->main_file, [ $this, 'activate' ] );
		add_action( 'plugins_loaded', [ $this, 'dbVersionCheck' ] );
	}

	/**
	 * Using the Wordpress dbDelta function create or update your custom table.
	 * dbDelta can be quite strict about the format you use so make sure you
	 * read the docs.
	 * https://codex.wordpress.org/Creating_Tables_with_Plugins
	 */
	public function activate() {
		global $wpdb;

		$charset_collate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE $this->db_table_name (
                id mediumint(11) NOT NULL AUTO_INCREMENT,
                firstname VARCHAR(255) NOT NULL,
                lastname VARCHAR(255) NOT NULL,
                home_url VARCHAR(2083),
                created datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
                updated datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
                PRIMARY KEY  (id)
            ) $charset_collate;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );

		add_option( $this->db_option_name, $this->db_version );
	}

	/**
	 * Check the stored db option version against the current version in the base
	 * plugin file. If they are not the same then run the activate method again.
	 */
	public function dbVersionCheck() {
		// check saved option matches current version
		if ( get_option( $this->db_option_name ) != $this->db_version ) {
			$this->activate();
		}
	}
}