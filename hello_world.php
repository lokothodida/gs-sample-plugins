<?php
/*
  Plugin Name : Hello World
  Description : Echos "Hello World" in footer of theme
  Version     : 1.0
  Author      : Chris Cagle
  Author URI  : http://www.cagintranet.com/
*/

// == Define useful constants ==
define('HW_ID', basename(__FILE__, '.php'));
define('HW_VERSION', '1.0');
define('HW_PLUGINPATH', GSPLUGINPATH . HW_ID . '/');

// == Merge language files ==
i18n_merge(HW_ID) || i18n_merge(HW_ID, 'en_US');

// == Register plugin ==
register_plugin(
  HW_ID,
  hw_i18n('PLUGIN_TITLE'),
  HW_VERSION,
  'Chris Cagle',
  'http://www.cagintranet.com/',
  hw_i18n('PLUGIN_DESC'),
  'theme',
  'hw_admin'
);

// == Register actions and filters ==
// Add sidebar link
add_action('theme-sidebar', 'createSideMenu', array(HW_ID, hw_i18n('PLUGIN_SIDEBAR')));

// Call @hw_footer when the theme footer is rendered
add_action('theme-footer', 'hw_footer');

// == Functions ==
// Echos hello world
function hw_footer() {
  echo '<p>' . hw_i18n('HELLO_WORLD') . '</p>';
}

// Admin function
function hw_admin() {
  echo '<h3>' . hw_i18n('PLUGIN_TITLE') . '</h3>';
  echo '<p>' . hw_i18n('PLUGIN_DESC') . '</p>';
}

// i18n alias function
function hw_i18n($hash, $echo = false) {
  return i18n(HW_ID . '/' . $hash, $echo);
}