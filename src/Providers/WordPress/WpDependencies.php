<?php
namespace PluginBoilerplate\Providers\WordPress;

/**
 * WpDependencies
 *
 * @package	plugin-boilerplate
 */
class WpDependencies
{
    const MIN_PHP_VERSION = '7.4.0';
    const MIN_WP_VERSION = '5.0';
    const DEPENDENCIES = [];

    private ?array $active_plugins = null;
    private WpProvider $provider;

    /**
     * __construct()
     *
     * @param   WpProvider  $provider
     * @return 	void
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function __construct( WpProvider $provider )
    {
        $this->provider = $provider;
    }

    /**
     * init()
     *
     * @return 	void
     * @access 	private
     * @package	plugin-boilerplate
     */
    private function init(): void
    {
		$this->active_plugins = $this->provider->get_option( WpOptions::ACTIVE_PLUGINS );

        if ( null === $this->active_plugins ) {
            $this->active_plugins = [];
        }

		if ( false !== $this->provider->is_multisite() ) {
            $site_option = $this->provider->get_site_option( WpOptions::ACTIVE_SITEWIDE_PLUGINS );

            if ( null === $site_option ) {
                return;
            }

            $this->active_plugins = array_merge( $this->active_plugins, $site_option );
        }
	}

    /**
     * check_dependencies()
     *
     * @return 	bool
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function check_dependencies(): bool
    {
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
            
        if ( false === version_compare( $this->provider->wp_version, self::MIN_WP_VERSION, '>=' ) ) {
            return false;
        }

		return true;
	}
}
