<?php
namespace PluginBoilerplate\Providers\WordPress\Resources;

use PluginBoilerplate\Providers\WordPress\WpActions;
use PluginBoilerplate\Providers\WordPress\WpProvider;

/**
 * PostType
 */
abstract class PostType
{
    private WpProvider $provider;

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
     * @param   WpProvider $provider Provider of WordPress functions.
     * @param   array      $args     Arguments to create the post type.
     * @return 	void
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function __construct( WpProvider $provider, array $args )
    {
        $this->provider = $provider;

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
    private function init(): void
    {
        $this->provider->add_action( WpActions::INIT, [ $this, 'add_custom_post_type' ] );
    }

    /**
     * get_labels()
     *
     * @return 	array
     * @access 	private
     * @package	plugin-boilerplate
     */
    private function get_labels(): array
    {
        return [
            'name' => sprintf( $this->provider->translate( '%s' ), $this->plural ),
            'singular_name' => sprintf( $this->provider->translate( '%s' ), $this->singular ),
            'add_new' => sprintf( $this->provider->translate( 'Add New' ) ),
            'add_new_item' => sprintf( $this->provider->translate( 'Add New $s' ), $this->singular ),
            'edit_item' => sprintf( $this->provider->translate( 'Edit %s' ), $this->singular ),
            'new_item' => sprintf( $this->provider->translate( 'New %s' ), $this->singular ),
            'view_item' => sprintf( $this->provider->translate( 'View %s' ), $this->singular ),
            'view_items' => sprintf( $this->provider->translate( 'View %s' ), $this->plural ),
            'search_items' => sprintf( $this->provider->translate( 'Search %s' ), $this->plural ),
            'not_found' => sprintf( $this->provider->translate( '%s not Found' ), $this->singular ),
            'not_found_in_trash' => sprintf( $this->provider->translate( '%s not Found in Trash' ), $this->singular ),
            'parent_item_colon' => sprintf( $this->provider->translate( 'Parent %s:' ), $this->singular ),
            'all_items' => sprintf( $this->provider->translate( 'All %s' ), $this->plural ),
            'archives' => sprintf( $this->provider->translate( '%s Archives' ), $this->singular ),
            'attributes' => sprintf( $this->provider->translate( '%s Attributes' ), $this->singular ),
            'insert_into_item' => sprintf( $this->provider->translate( 'Insert into %s' ), $this->singular ),
            'uploaded_to_this_item' => sprintf( $this->provider->translate( 'Uploaded to this %s' ), $this->singular ),
            'featured_image' => sprintf( $this->provider->translate( 'Featured Image' ) ),
            'set_featured_image' => sprintf( $this->provider->translate( 'Set Featured Image' ) ),
            'remove_featured_image' => sprintf( $this->provider->translate( 'Remove Featured Image' ) ),
            'use_featured_image' => sprintf( $this->provider->translate( 'Use Featured Image' ) ),
            'menu_name' => sprintf( $this->provider->translate( '%s' ), $this->plural ),
            'filter_items_list' => sprintf( $this->provider->translate( 'Filter %s List' ), $this->plural ),
            'items_list_navigation' => sprintf( $this->provider->translate( '%s List Navigation' ), $this->plural ),
            'items_list' => sprintf( $this->provider->translate( '%s List' ), $this->plural ),
            'name_admin_bar' => sprintf( $this->provider->translate( '%s' ), $this->plural ),
            'item_published' => sprintf( $this->provider->translate( '%s Published' ), $this->singular ),
            'item_published_privately' => sprintf( $this->provider->translate( '%s Published Privately' ), $this->singular ),
            'item_reverted_to_draft' => sprintf( $this->provider->translate( '%s Reverte to Draft' ), $this->singular ),
            'item_scheduled' => sprintf( $this->provider->translate( '%s Scheduled' ), $this->singular ),
            'item_updated' => sprintf( $this->provider->translate( '%s Updated' ), $this->singular ),
        ];
    }

    /**
     * add_custom_post_type()
     *
     * @return 	void
     * @access 	public
     * @package	plugin-boilerplate
     */
    public function add_custom_post_type(): void
    {
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

        $this->provider->register_post_type( $this::POST_TYPE_NAME, $args );
        $this->provider->flush_rewrite_rules();
    }
}
