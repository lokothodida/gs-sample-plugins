<?php
/*
  Plugin Name : Hello World Placeholder
  Description : Replaces (% placeholder %) in page content with "Hello World"
  Version     : 1.0
  Author      : Lawrence Okoth-Odida
  Author URI  : https://github.com/lokothodida
*/

// Constants
define('HWP_ID', basename(__FILE__, '.php'));          // Plugin ID
define('HWP_VERSION', '1.0');                          // Plugin Version
define('HWP_PLUGINPATH', GSPLUGINPATH . HWP_ID . '/'); // Plugin folder path

// Languages
i18n_merge(HWP_ID) || i18n_merge(HWP_ID, 'en_US');

// Register plugin
register_plugin(
  HWP_ID,                           // Plugin id
  hwp_i18n('PLUGIN_TITLE'),         // Plugin name
  HWP_VERSION,                      // Plugin version
  'Lawrence Okoth-Odida',           // Plugin author
  'http://github.com/lokothodida/', // author website
  hwp_i18n('PLUGIN_DESC'),          // Plugin description
  'pages',                          // Page type - on which admin tab to display
  'hwp_admin'                       // Main function (administration)
);

// Actions/Filters
// add a link in the admin tab 'theme'
add_action('pages-sidebar', 'createSideMenu', array(HWP_ID, hwp_i18n('PLUGIN_SIDEBAR')));

add_filter('content', 'hwp_content');

// Functions
// Filter
function hwp_content($content) {
  $placeholder = '(% placeholder %)';
  $hello_world = hwp_i18n('HELLO_WORLD');
  return str_replace($placeholder, $hello_world, $content);
}

// Admin function
function hwp_admin() {
  include(HWP_PLUGINPATH . 'admin.php');
}

// i18n alias function
function hwp_i18n($hash, $echo = false) {
  return i18n(HWP_ID . '/' . $hash, $echo);
}