<?php
namespace PluginBoilerplate\App;

/**
 * WpDependencies
 */
class WpDependencies {
    const MIN_PHP_VERSION = '7.4.0';
    const MIN_WP_VERSION = '5.0';
    const DEPENDENCIES = [
        'Advanced Custom Fields PRO' => 'advanced-custom-fields-pro/acf.php'
    ];

    private ?array $active_plugins = null;

    /**
     * init()
     *
     * @return 	void
     * @access 	private
     * @package	plugin-boilerplate
     */
    private function init(): void {
		$this->active_plugins = get_option( 'active_plugins' ) ?: null;

        if ( null === $this->active_plugins ) {
            $this->active_plugins = [];
        }

		if ( false !== is_multisite() ) {
            $site_option = get_site_option( 'active_sitewide_plugins' ) ?: null;

            if ( null === $site_option ) {
                return;
            }

            $this->active_plugins = array_merge( $this->active_plugins, $site_option );
        }
	}

    /**
     * check_dependencies()
     *
     * @return 	boolean
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function check_dependencies(): bool {
        global $wp_version;

        if ( null === $this->active_plugins ) {
            $this->init();
        }
        
        foreach( self::DEPENDENCIES as $name => $plugin ) {
            if ( false === in_array( $plugin, $this->active_plugins ) ) {
                return false;
            }
        }

        if ( false === version_compare( phpversion(), self::MIN_PHP_VERSION, '>=' ) ) {
            return false;
        }
            
        if ( false === version_compare( $wp_version, self::MIN_WP_VERSION, '>=' ) ) {
            return false;
        }

		return true;
	}
}
