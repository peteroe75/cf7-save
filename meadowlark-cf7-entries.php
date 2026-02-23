<?php
/*
Plugin Name: Meadowlark CF7 Entries
Description: Stores Contact Form 7 submissions in a custom table and displays via shortcode.
Version: 1.0.0
Author: Meadowlark IT
*/

if (!defined('ABSPATH')) exit;

define('ML_CF7_PATH', plugin_dir_path(__FILE__));
define('ML_CF7_VERSION', '1.0.0');

require_once ML_CF7_PATH . 'includes/install.php';
require_once ML_CF7_PATH . 'includes/permissions.php';
require_once ML_CF7_PATH . 'includes/capture.php';
require_once ML_CF7_PATH . 'includes/shortcode.php';

register_activation_hook(__FILE__, 'ml_cf7_install');
register_activation_hook(__FILE__, 'ml_cf7_add_capability');
