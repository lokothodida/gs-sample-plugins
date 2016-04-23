<?php
/*
  Plugin Name : Hello World
  Description : Echos "Hello World" in footer of theme
  Version     : 1.0
  Author      : Chris Cagle
  Author URI  : http://www.cagintranet.com/
*/

// Constants
define('HW_ID', basename(__FILE__, '.php'));          // Plugin ID
define('HW_VERSION', '1.0');                          // Plugin Version
define('HW_PLUGINPATH', GSPLUGINPATH . HW_ID . '/');  // Plugin folder path

// Languages
i18n_merge(HW_ID) || i18n_merge(HW_ID, 'en_US');

// Register plugin
register_plugin(
  HW_ID,                         // Plugin id
  hw_i18n('TITLE'),              // Plugin name
  HW_VERSION,                    // Plugin version
  'Chris Cagle',                 // Plugin author
  'http://www.cagintranet.com/', // author website
  hw_i18n('DESC'),               // Plugin description
  'theme',                       // Page type - on which admin tab to display
  'hw_admin'                     // Main function (administration)
);

// Actions/Filters
// Add a link in the admin tab 'theme'
add_action('theme-sidebar', 'createSideMenu', array(HW_ID, hw_i18n('SIDEBAR')));

// Call @hw_footer when the theme footer is rendered
add_action('theme-footer', 'hw_footer');

// Functions
// Echos hello world
function hw_footer() {
  echo '<p>' . hw_i18n('HELLO_WORLD') . '</p>';
}

// Admin function
function hw_admin() {
  include(HW_PLUGINPATH . 'admin.php');
}

// i18n alias function
function hw_i18n($hash, $echo = false) {
  return i18n(HW_ID . '/' . $hash, $echo);
}