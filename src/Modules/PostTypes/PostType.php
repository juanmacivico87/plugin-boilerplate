<?php
namespace PluginBoilerplate\Modules\PostTypes;

/**
 * PostType
 */
abstract class PostType
{
    protected string $singular = 'Post';
    protected string $plural = 'Posts';
    protected bool $public = true;
    protected bool $exclude_from_search = false;
    protected bool $publicly_queryable = true;
    protected bool $show_ui = true;
    protected bool $show_in_nav_menus = true;
    protected bool $show_in_menu = true;
    protected int $menu_position = 20;
    protected string $menu_icon = 'dashicons-wordpress';
    protected bool $hierarchical = false;
    protected bool $has_archive = true;
    protected bool $query_var = true;
    protected bool $can_export = true;
    protected bool $delete_with_user = false;
    protected bool $show_in_rest = true;
    protected bool $map_meta_cap = true;
    protected array $support = [ 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes', 'post-formats' ];
    protected array $taxonomies = [];
    protected array $rewrite = [
        'slug'       => '',
        'with_front' => false,
        'feeds'      => false,
        'pages'      => true,
    ];

    /**
     * __construct()
     *
     * @param   array      $args     Arguments to create the post type.
     * @return 	void
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function __construct( array $args ) {
        if ( false !== isset( $args['slug'] ) && false === empty( $args['slug'] ) ) {
            $this->rewrite['slug'] = $args['slug'];
        }

        $this->init();
    }

    /**
     * init()
     *
     * @return 	void
     * @access 	private
     * @package	plugin-boilerplate
     */
    private function init(): void {
        add_action( 'init', [ $this, 'add_custom_post_type' ] );
    }

    /**
     * get_labels()
     *
     * @return 	array
     * @access 	private
     * @package	plugin-boilerplate
     */
    private function get_labels(): array {
        return [
            'name' => sprintf( __( '%s', PLUGIN_BOILERPLATE_TEXTDOMAIN ), $this->plural ),
            'singular_name' => sprintf( __( '%s', PLUGIN_BOILERPLATE_TEXTDOMAIN ), $this->singular ),
            'add_new' => sprintf( __( 'Add New', PLUGIN_BOILERPLATE_TEXTDOMAIN ) ),
            'add_new_item' => sprintf( __( 'Add New %s', PLUGIN_BOILERPLATE_TEXTDOMAIN ), $this->singular ),
            'edit_item' => sprintf( __( 'Edit %s', PLUGIN_BOILERPLATE_TEXTDOMAIN ), $this->singular ),
            'new_item' => sprintf( __( 'New %s', PLUGIN_BOILERPLATE_TEXTDOMAIN ), $this->singular ),
            'view_item' => sprintf( __( 'View %s', PLUGIN_BOILERPLATE_TEXTDOMAIN ), $this->singular ),
            'view_items' => sprintf( __( 'View %s', PLUGIN_BOILERPLATE_TEXTDOMAIN ), $this->plural ),
            'search_items' => sprintf( __( 'Search %s', PLUGIN_BOILERPLATE_TEXTDOMAIN ), $this->plural ),
            'not_found' => sprintf( __( '%s not Found', PLUGIN_BOILERPLATE_TEXTDOMAIN ), $this->singular ),
            'not_found_in_trash' => sprintf( __( '%s not Found in Trash', PLUGIN_BOILERPLATE_TEXTDOMAIN ), $this->singular ),
            'parent_item_colon' => sprintf( __( 'Parent %s:', PLUGIN_BOILERPLATE_TEXTDOMAIN ), $this->singular ),
            'all_items' => sprintf( __( 'All %s', PLUGIN_BOILERPLATE_TEXTDOMAIN ), $this->plural ),
            'archives' => sprintf( __( '%s Archives', PLUGIN_BOILERPLATE_TEXTDOMAIN ), $this->singular ),
            'attributes' => sprintf( __( '%s Attributes', PLUGIN_BOILERPLATE_TEXTDOMAIN ), $this->singular ),
            'insert_into_item' => sprintf( __( 'Insert into %s', PLUGIN_BOILERPLATE_TEXTDOMAIN ), $this->singular ),
            'uploaded_to_this_item' => sprintf( __( 'Uploaded to this %s', PLUGIN_BOILERPLATE_TEXTDOMAIN ), $this->singular ),
            'featured_image' => sprintf( __( 'Featured Image', PLUGIN_BOILERPLATE_TEXTDOMAIN ) ),
            'set_featured_image' => sprintf( __( 'Set Featured Image', PLUGIN_BOILERPLATE_TEXTDOMAIN ) ),
            'remove_featured_image' => sprintf( __( 'Remove Featured Image', PLUGIN_BOILERPLATE_TEXTDOMAIN ) ),
            'use_featured_image' => sprintf( __( 'Use Featured Image', PLUGIN_BOILERPLATE_TEXTDOMAIN ) ),
            'menu_name' => sprintf( __( '%s', PLUGIN_BOILERPLATE_TEXTDOMAIN ), $this->plural ),
            'filter_items_list' => sprintf( __( 'Filter %s List', PLUGIN_BOILERPLATE_TEXTDOMAIN ), $this->plural ),
            'items_list_navigation' => sprintf( __( '%s List Navigation', PLUGIN_BOILERPLATE_TEXTDOMAIN ), $this->plural ),
            'items_list' => sprintf( __( '%s List', PLUGIN_BOILERPLATE_TEXTDOMAIN ), $this->plural ),
            'name_admin_bar' => sprintf( __( '%s', PLUGIN_BOILERPLATE_TEXTDOMAIN ), $this->plural ),
            'item_published' => sprintf( __( '%s Published', PLUGIN_BOILERPLATE_TEXTDOMAIN ), $this->singular ),
            'item_published_privately' => sprintf( __( '%s Published Privately', PLUGIN_BOILERPLATE_TEXTDOMAIN ), $this->singular ),
            'item_reverted_to_draft' => sprintf( __( '%s Reverte to Draft', PLUGIN_BOILERPLATE_TEXTDOMAIN ), $this->singular ),
            'item_scheduled' => sprintf( __( '%s Scheduled', PLUGIN_BOILERPLATE_TEXTDOMAIN ), $this->singular ),
            'item_updated' => sprintf( __( '%s Updated', PLUGIN_BOILERPLATE_TEXTDOMAIN ), $this->singular ),
        ];
    }

    /**
     * add_custom_post_type()
     *
     * @return 	void
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function add_custom_post_type(): void {
        $args = [
            'labels' => $this->get_labels(),
            'public' => $this->public,
            'exclude_from_search' => $this->exclude_from_search,
            'publicly_queryable' => $this->publicly_queryable,
            'show_ui' => $this->show_ui,
            'show_in_nav_menus' => $this->show_in_nav_menus,
            'show_in_menu' => $this->show_in_menu,
            'menu_position' => $this->menu_position,
            'menu_icon' => $this->menu_icon,
            'hierarchical' => $this->hierarchical,
            'supports' => $this->support,
            'taxonomies' => $this->taxonomies,
            'has_archive' => $this->has_archive,
            'rewrite' => $this->rewrite,
            'query_var' => $this->query_var,
            'can_export' => $this->can_export,
            'delete_with_user' => $this->delete_with_user,
            'show_in_rest' => $this->show_in_rest,
            'map_meta_cap' => $this->map_meta_cap,
        ];

        register_post_type( $this::POST_TYPE_NAME, $args );
        flush_rewrite_rules();
    }
}
