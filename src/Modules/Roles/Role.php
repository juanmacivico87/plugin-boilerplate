<?php
namespace PluginBoilerplate\Modules\Roles;

/**
 * Role
 */
abstract class Role {
    protected array $capabilities = [];

    /**
     * __construct()
     *
     * @return 	void
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function __construct() {
        $this->init();
    }

    /**
     * init()
     *
     * @return 	void
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function init(): void {
        add_action( 'init', [ $this, 'add_new_role' ] );
    }
    
    /**
     * add_new_role()
     *
     * @return 	void
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function add_new_role(): void {
        add_role(
            $this::ROLE_NAME,
            __( 'Custom role', PLUGIN_BOILERPLATE_TEXTDOMAIN ),
            $this->capabilities
        );
    }
}
