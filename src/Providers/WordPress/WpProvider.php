<?php
namespace PluginBoilerplate\Providers\WordPress;

use WP_REST_Response;

if ( false === defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * WpProvider
 *
 * @package	plugin-boilerplate
 */
class WpProvider
{
    public string $wp_version;

    /**
     * __construct()
     *
     * @return 	void
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function __construct()
    {
        global $wp_version;

        $this->wp_version = $wp_version;
    }

    /**
     * add_action()
     *
     * @param   string  $hook
     * @param   array   $callback
     * @param   int     $priority
     * @param   int     $accepted_args
     * @return 	void
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function add_action( string $hook, array $callback, int $priority = 10, int $accepted_args = 1 ): void
    {
        add_action( $hook, $callback, $priority, $accepted_args );
    }

    /**
     * add_meta_box()
     *
     * @param   array   $args
     * @return 	void
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function add_meta_box( array $args ): void
    {
        add_meta_box( $args['id'], $args['title'], $args['callback'], $args['screen'], $args['context'], $args['priority'], null );
    }

    /**
     * load_plugin_textdomain()
     *
     * @return 	bool
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function load_plugin_textdomain(): bool
    {
        return load_plugin_textdomain( PLUGIN_BOILERPLATE_TEXTDOMAIN, false, PLUGIN_BOILERPLATE_LANG_DIR );
    }

    /**
     * translate()
     *
     * @param   string  $text
     * @return 	bool
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function translate( string $text ): string
    {
        return __( $text, PLUGIN_BOILERPLATE_TEXTDOMAIN );
    }

    /**
     * get_option()
     *
     * @param   string  $option
     * @return 	mixed
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function get_option( string $option )
    {
        return get_option( $option, null );
    }

    /**
     * get_site_option()
     *
     * @param   string  $option
     * @return 	mixed
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function get_site_option( string $option )
    {
        return get_site_option( $option, null );
    }

    /**
     * get_post_meta()
     *
     * @param   int     $id
     * @param   string  $meta_key
     * @return 	string|null
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function get_post_meta( int $post_id, string $meta_key = '' ): ?string
    {
        $post_meta = get_post_meta( $post_id, $meta_key, true );

        if ( false === $post_meta ) {
            return null;
        }

        return $post_meta;
    }

    /**
     * update_post_meta()
     *
     * @param   int     $post_id
     * @param   string  $meta_key
     * @param   string  $meta_value
     * @return 	void
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function update_post_meta( int $post_id, string $meta_key, string $meta_value ): void
    {
        update_post_meta( $post_id, $meta_key, $meta_value );
    }

    /**
     * delete_post_meta()
     *
     * @param   int     $post_id
     * @param   string  $meta_key
     * @return 	bool
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function delete_post_meta( int $post_id, string $meta_key ): bool
    {
        return delete_post_meta( $post_id, $meta_key );
    }

    /**
     * is_multisite()
     *
     * @return 	bool
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function is_multisite(): bool
    {
        return is_multisite();
    }

    /**
     * register_post_type()
     *
     * @param   string  $post_type
     * @param   array   $args
     * @return 	void
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function register_post_type( string $post_type, array $args ): void
    {
        register_post_type( $post_type, $args );
    }

    /**
     * register_taxonomy()
     *
     * @param   string  $taxonomy
     * @param   array   $object_type
     * @param   array   $args
     * @return 	void
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function register_taxonomy( string $taxonomy, array $object_type, array $args ): void
    {
        register_taxonomy( $taxonomy, $object_type, $args );
    }

    /**
     * flush_rewrite_rules()
     *
     * @param   bool    $hard
     * @return 	void
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function flush_rewrite_rules( bool $hard = true ): void
    {
        flush_rewrite_rules( $hard );
    }

    /**
     * esc_attr()
     *
     * @param   string  $text
     * @return 	string
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function esc_attr( string $text ): string
    {
        return esc_attr( $text );
    }

    /**
     * sanitize_meta()
     *
     * @param   string  $meta_key
     * @param   string  $meta_value
     * @param   string  $object_type
     * @param   string  $object_subtype
     * @return 	mixed
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function sanitize_meta( string $meta_key, string $meta_value, string $object_type, string $object_subtype = '' )
    {
        return sanitize_meta( $meta_key, $meta_value, $object_type, $object_subtype );
    }

    /**
     * enqueue_script()
     *
     * @param   string  $handle
     * @param   string  $src
     * @param   array   $deps
     * @param   string  $version
     * @param   bool    $in_footer
     * @return 	void
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function enqueue_script( string $handle, string $src = '', array $deps = [], string $version = '', bool $in_footer = false ): void
    {
        if ( false !== empty( $version ) ) {
            $version = false;
        }

        wp_enqueue_script( $handle, $src, $deps, $version, $in_footer );
    }

    /**
     * enqueue_style()
     *
     * @param   string  $handle
     * @param   string  $src
     * @param   array   $deps
     * @param   string  $version
     * @param   string  $media
     * @return 	void
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function enqueue_style( string $handle, string $src = '', array $deps = [], string $version = '', string $media = 'all' ): void
    {
        if ( false !== empty( $version ) ) {
            $version = false;
        }

        wp_enqueue_style( $handle, $src, $deps, $version, $media );
    }

    /**
     * register_rest_field()
     *
     * @param   string  $object_type
     * @param   string  $attribute
     * @param   array   $args
     * @return 	void
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function register_rest_field( array $object_type, string $attribute, array $args = [] ): void
    {
        register_rest_field( $object_type, $attribute, $args );
    }

    /**
     * register_rest_route()
     *
     * @param   string  $namespace
     * @param   string  $route
     * @param   array   $args
     * @param   bool    $override
     * @return 	void
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function register_rest_route( string $namespace, string $route, array $args = [], bool $override = false ): void
    {
        register_rest_route( $namespace, $route, $args, $override );
    }

    /**
     * get_wp_rest_response()
     *
     * @param   array|null  $data
     * @param   int         $http_code
     * @param   array       $headers
     * @return 	\WP_REST_Response
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function get_wp_rest_response( ?array $data = null, int $http_code, array $headers = [] ): \WP_REST_Response
    {
        return new \WP_REST_Response( $data, $http_code, $headers );
    }

    /**
     * add_role()
     *
     * @param   string  $role
     * @param   string  $display_name
     * @param   array   $capabilities
     * @return 	void
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function add_role( string $role, string $display_name, array $capabilities = [] ): void
    {
        add_role( $role, $display_name, $capabilities );
    }
}
