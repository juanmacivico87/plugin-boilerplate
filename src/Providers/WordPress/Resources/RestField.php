<?php
namespace PluginBoilerplate\Providers\WordPress\Resources;

use PluginBoilerplate\Providers\WordPress\WpActions;
use PluginBoilerplate\Providers\WordPress\WpProvider;

/**
 * RestField
 */
abstract class RestField
{
    private WpProvider $provider;

    /**
     * __construct()
     *
     * @param   WpProvider $provider Provider of WordPress functions.
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
        $this->provider->add_action( WpActions::REST_API_INIT, [ $this, 'add_new_rest_field' ] );
    }

    /**
     * add_new_rest_field()
     *
     * @return 	void
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function add_new_rest_field(): void
    {
        $args = [
            'get_callback' => [ $this, 'get_rest_field_value' ],
        ];
    
        $this->provider->register_rest_field( $this::OBJECT_TYPES, 'custom-rest-field', $args );
    }

    /**
     * get_rest_field_value()
     *
     * @return 	string
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function get_rest_field_value(): string
    {
        return 'Some value';
    }
}
