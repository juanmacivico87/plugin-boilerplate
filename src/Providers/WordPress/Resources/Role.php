<?php
namespace PluginBoilerplate\Providers\WordPress\Resources;

use PluginBoilerplate\Providers\WordPress\WpActions;
use PluginBoilerplate\Providers\WordPress\WpProvider;

/**
 * Role
 *
 * @package	plugin-boilerplate
 */
abstract class Role
{
    private WpProvider $provider;

    protected array $capabilities = [];

    /**
     * __construct()
     *
     * @return 	void
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function __construct( WpProvider $provider )
    {
        $this->provider = $provider;

        $this->init();
    }

    /**
     * init()
     *
     * @return 	void
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function init(): void
    {
        $this->provider->add_action( WpActions::INIT, [ $this, 'add_new_role' ] );
    }
    
    /**
     * add_new_role()
     *
     * @return 	void
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function add_new_role(): void
    {
        $this->provider->add_role(
            $this::ROLE_NAME,
            $this->provider->translate( 'Custom role' ),
            $this->capabilities
        );
    }
}
