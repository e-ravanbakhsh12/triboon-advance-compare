<?php

namespace TriboonTAC\includes\publics;
use TriboonTAC\includes\TAC;

/**
 * This file is the public class of plugin
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}


/**
 * The plugin public class.
 *
 * this class used to apply public methods.
 *
 */
class Publics extends TAC
{
    public function __construct()
    {
    }

    public function loadTextdomain()
    {
        load_plugin_textdomain('tac', false, dirname(plugin_basename(__FILE__), 3) . '/languages/');
    }

    /**
     * Add page templates.
     */
    public  function addPageTemplates($templates)
    {
        $templates['compare-template.php'] = __('compare page', 'tac');

        return $templates;
    }


    public function displayPageTemplate($page_template)
    {

        if (get_page_template_slug() == 'compare-template.php') {
            $page_template = TAC_DIR . 'include/public/templates/compare-template.php';
        }
        return $page_template;
    }

    /**
     * Enqueue public css file
     */
    public function enqueueCss()
    {
        if (get_page_template_slug() == 'compare-template.php') {
            wp_enqueue_style('tac-public', TAC_URL . 'assets/css/public-style.css', array(), TAC_VERSION, 'all');
        }
    }

    /**
     * Enqueue public js file
     */
    public function enqueueJs()
    {
        if (get_page_template_slug() == 'compare-template.php') {

            wp_enqueue_script('tac-public', TAC_URL . 'assets/js/public.js', array('jquery'), TAC_VERSION, true);
        }
    }
}
