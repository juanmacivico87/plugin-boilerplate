<?php
namespace PluginBoilerplate\Providers\WordPress\Resources;

use PluginBoilerplate\Providers\WordPress\WpActions;
use PluginBoilerplate\Providers\WordPress\WpProvider;

/**
 * Endpoint
 */
abstract class Endpoint
{
    private WpProvider $provider;

    protected string $namespace = 'v1/plugin-boilerplate';
    protected string $method = 'GET';

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
        $this->provider->add_action( WpActions::REST_API_INIT, [ $this, 'create_rest_route' ] );
    }

    /**
     * create_rest_route()
     *
     * @return 	void
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function create_rest_route(): void
    {
        $this->provider->register_rest_route( $this->namespace, $this::ROUTE, [
            'methods' => $this->method,
            'callback' => [ $this, 'controller' ],
            'permission_callback' => [ $this, 'permission_callback' ],
        ] );
    }

    /**
     * controller()
     *
     * @return 	\WP_REST_Response
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function controller(): \WP_REST_Response
    {
        return $this->provider->get_wp_rest_response( [
            'code' => 'custom_response',
            'message' => $this->provider->translate( 'Message of custom response' ),
            'data' => [],
        ], 200 );
    }

    /**
     * permission_callback()
     *
     * @return 	boolean
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function permission_callback(): bool
    {
        return true;
    }
}
