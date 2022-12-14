<?php
namespace PluginBoilerplate\Providers\WordPress;

/**
 * WpActions
 */
class WpActions
{
    const INIT = 'init';
    const REST_API_INIT = 'rest_api_init';
    const ADMIN_NOTICES = 'admin_notices';
    const PLUGINS_LOADED = 'plugins_loaded';
    const WP_ENQUEUE_SCRIPTS = 'wp_enqueue_scripts';
    const ADMIN_ENQUEUE_SCRIPTS = 'admin_enqueue_scripts';
    const ADD_META_BOXES = 'add_meta_boxes';
    const SAVE_POST = 'save_post';
}
