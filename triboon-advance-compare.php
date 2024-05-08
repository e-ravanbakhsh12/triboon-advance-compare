<?php
/*
 * Plugin Name:           Triboon Advance Compare
 * Description:           add admin panel customize advertising system
 * Plugin URI:            https://www.triboon.ir/
 * Author URI:            https://www.linkedin.com/in/ehsan-ravanbakhsh/
 * Version:               1.1.0
 * Author:                Ehsan Ravanbakhsh
 * License:               GPL-2.0+
 * License URI:           http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:           tac
 * Domain Path:          /languages
 * WC tested up to:      6.2
 */

use TriboonTAC\includes\TAC;
use TriboonTAC\includes\ActiveAction;

// Exit if accessed directly
if (!defined('ABSPATH')) {
     exit;
}

if (!defined('TAC_VERSION')) {
     define('TAC_VERSION', '1.1.0');
}

if (!defined('TAC_DIR')) {
     define('TAC_DIR', plugin_dir_path(__FILE__));
}

if (!defined('TAC_URL')) {
     define('TAC_URL', plugin_dir_url(__FILE__));
}
// plugin requires
require_once TAC_DIR . '/vendor/autoload.php';

$ActiveAction = new ActiveAction();
register_activation_hook(__FILE__, array($ActiveAction, 'activate'));
register_deactivation_hook(__FILE__, array($ActiveAction, 'deactivate'));


/**
 * Running plugin
 */
add_action('plugins_loaded', 'checkForWoocommerce');
add_action('plugins_loaded', 'executePlugin');
function executePlugin()
{
     if (class_exists('woocommerce')) {
          new TAC();
     }
}
