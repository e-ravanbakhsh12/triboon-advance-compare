<?php

namespace TriboonTAC\includes\ajax;
use TriboonTAC\includes\TAC;

/**
 * This file is the maine class of ajax of plugin
 * 
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}


/**
 * The main plugin ajax class.
 *
 * this class used to evaluate and display all thing about ajax
 *
 */
class Ajax extends TAC
{


    // Instance of this class.;
    protected $ajaxMassage;

    public function __construct()
    {
        $this->localizeStrings();
    }

    /**
     * Ajax array response for wp_send_json
     */
    public  function ajaxResponse($success = true, $message = null, $content = null)
    {

        $response = array(
            'success' => $success,
            'message' => $message,
            'content' => $content
        );

        wp_send_json($response);
    }

    /**
     * Define rewrite api url
     */
    public function defineAjaxRoute()
    {

        add_rewrite_tag('%tacAction%', '([^&/]+)');
        add_rewrite_rule('wp-ajax/tac/([^/]+)/?', 'index.php?tacAction=$matches[1]', 'top');
        flush_rewrite_rules();
    }





    /**
     * ajax callback function distributor
     */
    public function ajaxHandler()
    {

        // retrieve data
        $expandedUrl = explodeUrlWithQuery()['main-url'];
        if (in_array('wp-ajax', $expandedUrl)) {
            global $wp_query;
            $requestQuery = $wp_query->get('tacAction');
            if (!empty($requestQuery)) {
                define('WP_AJAX', true);
                switch ($requestQuery) {
                    case 'search-post':
                        require TAC_DIR . '/includes/ajax/search-post.php';
                        break;
                }
            }
        }
    }



    public function localizeStrings()
    {

        $this->ajaxMassage = array(
            'ajaxAdminUrl'  => admin_url(),
        );
    }


    public function addQuerySearchTitle($where, $wp_query)
    {
        global $wpdb;
        if ($title = $wp_query->get('search_title')) {
            $where .= " AND " . $wpdb->posts . ".post_title LIKE '%" . esc_sql($wpdb->esc_like($title)) . "%'";
        }
        return $where;
    }

    public function searchProductByTitle($search)
    {
        global $wpdb;
        $search = esc_sql($search);
        $query = "
            SELECT p.ID, p.post_title as title FROM {$wpdb->prefix}posts p
            WHERE
            p.post_type = 'product'
            AND p.post_status = 'publish'
            AND p.post_title like '%{$search}%'
            ORDER BY p.post_date DESC
            ";
        return $wpdb->get_results($query);
    }
}
