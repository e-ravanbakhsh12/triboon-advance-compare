<?php

function checkForWoocommerce()
{
    if (!class_exists('woocommerce') || !defined('WC_VERSION')) {
        add_action('admin_notices', 'missingWarningWoocommerce');
    }
}

function missingWarningWoocommerce()
{

    $install_url = wp_nonce_url(add_query_arg(array('action' => 'install-plugin', 'plugin' => 'woocommerce',), admin_url('update.php')), 'install-plugin_woocommerce');
    $class         = 'notice notice-error';
    $post_type     = 'product';
    $message     = sprintf(esc_html__('The <b>WooCommerce</b> plugin must be active for <b>%s Triboon Advance compare</b> plugin to work. Please <a href="%s" target="_blank">install & activate WooCommerce</a>.'), ucfirst($post_type), esc_url($install_url));
    printf('<div class="%s"><p>%s</p></div>', esc_attr($class), ($message));
}

function isAdminScreen()
{
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
        if (str_contains($page, 'tac-')) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function explodeUrlWithQuery()
{
    $exploded_url = explode('/', $_SERVER['REQUEST_URI']);

    if (strpos(end($exploded_url), '?') === 0) {
        $removed_question_mark = substr(end($exploded_url), 1);
        $query_strings = explode('&', $removed_question_mark);
        unset($exploded_url[count($exploded_url) - 1]);
        $result['query-string'] = $query_strings;
    }
    $i = 1;
    foreach ($exploded_url as $url) {
        if (empty($url)) continue;
        $result['main-url'][$i] = $url;
        $i++;
    }
    return $result;
}

function isLocalhost()
{
    return in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1', '192.168.1.51', '192.168.1.50'));
}

function isAdministrator()
{
    $response = false;
    if (is_user_logged_in()) {
        $user = wp_get_current_user(); // getting & setting the current user 
        $roles = (array) $user->roles;
        if (in_array('administrator', $roles)) {
            $response = true;
        }
    }
    return $response;
}

function roleExists($role)
{

    if (!empty($role)) {
        return $GLOBALS['wp_roles']->is_role($role);
    }

    return false;
}

function sanitizeNestedObject($object)
{
    // Create an empty array to store the sanitized object
    $sanitized_object = array();

    // Loop through each key-value pair in the object
    foreach ($object as $key => $value) {
        // If the value is an array, recursively sanitize it
        if (is_array($value) || is_object($value)) {
            $sanitized_object[$key] = /* todo */ sanitizeNestedObject((array)$value);
        }
        // If the value is a string, sanitize it using wp_kses
        elseif (is_string($value)) {
            $sanitized_object[$key] = sanitize_text_field($value);
        }
        // If the value is neither an array nor a string, keep it as is
        else {
            $sanitized_object[$key] = $value;
        }
    }
    return $sanitized_object;
}
