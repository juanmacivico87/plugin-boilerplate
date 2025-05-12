<?php
namespace PluginBoilerplate\Modules\Endpoints;

/**
 * Endpoint
 */
abstract class Endpoint {
    protected string $namespace = 'v1/plugin-boilerplate';
    protected string $method = 'GET';

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
        add_action( 'rest_api_init', [ $this, 'create_rest_route' ] );
    }

    /**
     * create_rest_route()
     *
     * @return 	void
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function create_rest_route(): void {
        register_rest_route( $this->namespace, $this::ROUTE, [
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
    public function controller(): \WP_REST_Response {
        return new \WP_REST_Response( [
            'code' => 'custom_response',
            'message' => __( 'Message of custom response', PLUGIN_BOILERPLATE_TEXTDOMAIN ),
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
    public function permission_callback(): bool {
        return true;
    }
}
