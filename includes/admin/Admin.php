<?php

namespace TriboonTAC\includes\admin;
use TriboonTAC\includes\TAC;


/**
 * This file is the  class of admin of plugin
 * 
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}


/**
 * The plugin admin class.
 *
 * this class used to evaluate and display all thing about admin panel
 *
 */
class Admin extends TAC
{


    // Instance of this class.
    protected $mainSlug;
    protected $editPageSlug;
    protected $capability;

    public function __construct()
    {
        $this->mainSlug         = 'tac-dashboard';
        $this->editPageSlug     = 'tac-edit-page';
        $this->capability       = 'edit_posts';
    }

    /**
     * Add plugin menu and submenu to dashboard
     */
    public function addMenu()
    {


        add_menu_page(
            esc_html__('مقایسه محصولات', 'tac'),
            esc_html__('مقایسه محصولات', 'tac'),
            $this->capability,
            $this->mainSlug,
            [$this, 'adminConditionMenuContent'],
            // TAC_DIS_URL . 'assets/img/icon-menu.png'
        );
    }

    public function addPostMeta()
    {
        add_meta_box(
            'wp_book',
            'Product Options',
            [$this, 'renderCustomMetaBox'],
            'product',
            'normal',
            'default'
        );
    }

    /**
     * Enqueue admin css file
     */
    public function adminEnqueueCss()
    {
        wp_enqueue_style('tac-admin', TAC_URL . 'assets/css/style.css', array(), TAC_VERSION, 'all');
        // wp_enqueue_style('tac-icon', TAC_URL . 'assets/css/tacicon.css', array(), TAC_VERSION, 'all');
        // wp_enqueue_style('aar-select2', TAC_DIS_URL . 'assets/css/select2.min.css', array(), TAC_DIS_VERSION, 'all');
    }

    /**
     * Enqueue admin js file
     */
    public function adminEnqueueJs()
    {
        if (isAdminScreen()) {

            wp_enqueue_script('tac-admin', TAC_URL . 'assets/js/admin.js', array('jquery'), TAC_VERSION, true);
            wp_localize_script('tac-admin',      'abeArr', self::jsArray());
        }
    }

    public function adminConditionMenuContent()
    {
        if (current_user_can('manage_options') || current_user_can('shop_manager')) {
            require_once TAC_DIR . 'includes/admin/templates/dashboard.php';
        } else {
            wp_die('شما اجازه دسترسی به این صفحه را ندارید');
        }
    }

    /**
     * Render custom meta box for the book.
     *
     * @param object $post The post object.
     */
    public static function renderCustomMetaBox($post): void
    {
        require_once TAC_DIR . 'includes/admin/templates/metaBox.php';
    }

    /**
     * Save meta box data for the book.
     */
    public static function saveMetaBoxData($post_id): void
    {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        if (isset($_POST['tac_ram'])) {
            update_post_meta($post_id,'tac_ram',sanitize_text_field($_POST['tac_ram']));
        }
        if (isset($_POST['tac_cpu'])) {
            update_post_meta($post_id,'tac_cpu',sanitize_text_field($_POST['tac_cpu']));
        }
        if (isset($_POST['tac_screen'])) {
            update_post_meta($post_id,'tac_screen',sanitize_text_field($_POST['tac_screen']));
        }
    }
}
