<?php
namespace PluginBoilerplate\Providers\WordPress;

use WP_REST_Response;

if ( false === defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * WpProvider
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
     * @param   string  $hook          The name of the action to add the callback to.
     * @param   array   $callback      The callback to be run when the action is called.
     * @param   integer $priority      Used to specify the order in which the functions associated with a particular action are executed.
     * @param   integer $accepted_args The number of arguments the function accepts.
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
     * @param   array $args Arguments to create the metabox.
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
     * @return 	boolean
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
     * @param   string $text Text to translate.
     * @return 	boolean
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
     * @param   string $option Name of the option to retrieve. Expected to not be SQL-escaped.
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
     * @param   string $option Name of the option to retrieve. Expected to not be SQL-escaped.
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
     * @param   integer $post_id  Post ID.
     * @param   string  $meta_key The meta key to retrieve. By default, returns data for all keys.
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
     * @param   integer $post_id    Post ID.
     * @param   string  $meta_key   Metadata key.
     * @param   string  $meta_value Metadata value. Must be serializable if non-scalar.
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
     * @param   integer $post_id  Post ID.
     * @param   string  $meta_key Metadata key.
     * @return 	boolean
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
     * @return 	boolean
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
     * @param   string $post_type Post type key.
     * @param   array  $args      Arguments for registering a post type.
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
     * @param   string $taxonomy    Taxonomy key.
     * @param   array  $object_type Object types with which the taxonomy should be associated.
     * @param   array  $args        Arguments for registering a taxonomy.
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
     * @param   boolean $hard Whether to update .htaccess (hard flush) or just update rewrite_rules option (soft flush).
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
     * @param   string $text Text to escape.
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
     * @param   string $meta_key       Metadata key.
     * @param   string $meta_value     Metadata value to sanitize.
     * @param   string $object_type    Type of object metadata is for.
     * @param   string $object_subtype The subtype of the object type.
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
     * @param   string  $handle    Name of the script. Should be unique.
     * @param   string  $src       Full URL of the script, or path of the script relative to the WordPress root directory.
     * @param   array   $deps      An array of registered script handles this script depends on.
     * @param   string  $version   String specifying script version number.
     * @param   boolean $in_footer Whether to enqueue the script before </body> instead of in the <head>.
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
     * @param   string $handle  Name of the stylesheet. Should be unique.
     * @param   string $src     Full URL of the stylesheet, or path of the stylesheet relative to the WordPress root directory.
     * @param   array  $deps    An array of registered stylesheet handles this stylesheet depends on.
     * @param   string $version String specifying stylesheet version number.
     * @param   string $media   The media for which this stylesheet has been defined.
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
     * @param   array  $object_type Object(s) the field is being registered to, "post"|"term"|"comment" etc.
     * @param   string $attribute   The attribute name.
     * @param   array  $args        An array of arguments used to handle the registered field.
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
     * @param   string  $namespace The first URL segment after core prefix. Should be unique to your package/plugin.
     * @param   string  $route     The base URL for route you are adding.
     * @param   array   $args      Either an array of options for the endpoint, or an array of arrays for multiple methods.
     * @param   boolean $override  If the route already exists, should we override it?.
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
     * @param   array|null $data      Response data.
     * @param   integer    $http_code HTTP status code.
     * @param   array      $headers   HTTP header map.
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
     * @param   string $role         Role name.
     * @param   string $display_name Display name for role.
     * @param   array  $capabilities List of capabilities keyed by the capability name.
     * @return 	void
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function add_role( string $role, string $display_name, array $capabilities = [] ): void
    {
        add_role( $role, $display_name, $capabilities );
    }
}
