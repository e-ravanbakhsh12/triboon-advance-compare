<?php

namespace TriboonTAC\includes;

use TriboonTAC\includes\admin\Admin;
use TriboonTAC\includes\ajax\Ajax;
use TriboonTAC\includes\publics\Publics;

/**
 * This file is the maine class of plugin
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}


/**
 * The main plugin class.
 *
 * this class used to add action and filter hooks.
 *
 */
class TAC
{
    protected $mainSlug;
    protected $editPageSlug;
    protected $capability;


    /**
     * execute front-end and backend hooks
     */
    function __construct()
    {


        $this->setAdminHooks();
        $this->setPublicHooks();
    }


    /**
     * loading admin hooks needed for plugin
     */
    public function setAdminHooks()
    {
        $admin = new Admin();
        add_action('admin_menu', array($admin, 'addMenu'));
        add_action('add_meta_boxes', array($admin, 'addPostMeta'));
        add_action('save_post_product', array($admin, 'saveMetaBoxData'));
        add_action('admin_enqueue_scripts', array($admin, 'adminEnqueueCss'));
        add_action('admin_enqueue_scripts', array($admin, 'adminEnqueueJs'));

        $ajax = new Ajax();
        add_action('init', array($ajax, 'defineAjaxRoute'));
        add_action('template_redirect', array($ajax, 'ajaxHandler'));
        add_filter('posts_where', array($ajax, 'addQuerySearchTitle'), 10, 2);
    }

    /**
     * loading public hooks needed for plugin
     */
    public function setPublicHooks()
    {
        $publics = new Publics();
        add_action('wp_loaded', array($publics, 'loadTextdomain'));
        add_action('wp_enqueue_scripts', array($publics, 'enqueueCss'));
        add_action('wp_enqueue_scripts', array($publics, 'enqueueJs'));
        add_filter('theme_page_templates', array($publics, 'addPageTemplates'));
        add_filter('page_template',  array($publics, 'displayPageTemplate'));
    }

    /**
     * Enqueue public js file
     */
    public function publicEnqueueJs()
    {
    }


    static public function jsArray()
    {
        return array(
            'ajaxUrl'   => admin_url('admin-ajax.php'),
            'homeUrl'   => home_url(),
            'nonce' => wp_create_nonce('tac_nonce'),
            'path' => TAC_DIR,
            'local' => get_locale(),
        );
    }
}
