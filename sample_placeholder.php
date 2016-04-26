<?php
/*
  Plugin Name : Sample Placeholder
  Description : Replaces (% placeholder[params]%) in page content with an unordered
                list that "Hello World" a specified number of times
  Version     : 1.0
  Author      : Lawrence Okoth-Odida
  Author URI  : https://github.com/lokothodida/
*/

// == Define useful constants ==
define('SAMPLE_PLACEHOLDER_ID', basename(__FILE__, '.php'));
define('SAMPLE_PLACEHOLDER_VERSION', '1.0');
define('SAMPLE_PLACEHOLDER_PLUGINPATH', GSPLUGINPATH . SAMPLE_PLACEHOLDER_ID . '/');

// == Load common functions (used throughout plugin) ==
include(SAMPLE_PLACEHOLDER_PLUGINPATH . 'common_functions.php');

// == Merge language files ==
i18n_merge(SAMPLE_PLACEHOLDER_ID) || i18n_merge(SAMPLE_PLACEHOLDER_ID, 'en_US');

// == Register plugin ==
register_plugin(
  SAMPLE_PLACEHOLDER_ID,
  sample_placeholder_i18n('PLUGIN_TITLE'),
  SAMPLE_PLACEHOLDER_VERSION,
  'Lawrence Okoth-Odida',
  'http://github.com/lokothodida/',
  sample_placeholder_i18n('PLUGIN_DESC'),
  'pages',
  'sample_placeholder_admin'
);

// == Register actions and filters ==
// Add a sidebar link
add_action('pages-sidebar', 'createSideMenu', array(SAMPLE_PLACEHOLDER_ID, sample_placeholder_i18n('PLUGIN_SIDEBAR')));

// Ensure the placeholder functions are available in the page template
add_action('index-pretemplate', 'sample_placeholder_load');

// Filter the page contents with the placeholder
add_filter('content', 'sample_placeholder_filter');

// Functions
// Loads the placeholder functions
function sample_placeholder_load() {
  require_once(SAMPLE_PLACEHOLDER_PLUGINPATH . '/placeholder_functions.php');
}

// Admin function (does nothing in this example)
function sample_placeholder_admin() {
  // ...
}