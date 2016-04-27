<?php
/*
  Plugin Name : Sample Items AJAX
  Description : Gives a front page which loads Sample Items from I18N Search with AJAX
  Version     : 1.0
  Author      : Lawrence Okoth-Odida
  Author URI  : https://github.com/lokothodida/
*/

// == Define useful constants ==
define('SAMPLE_ITEMS_AJAX_ID', basename(__FILE__, '.php'));
define('SAMPLE_ITEMS_AJAX_VERSION', '1.0');
define('SAMPLE_ITEMS_AJAX_PLUGINPATH', GSPLUGINPATH . SAMPLE_ITEMS_AJAX_ID . '/');
define('SAMPLE_ITEMS_AJAX_PLUGINURL', $SITEURL . 'plugins/' . SAMPLE_ITEMS_AJAX_ID . '/');
define('SAMPLE_ITEMS_AJAX_CSSURL', SAMPLE_ITEMS_AJAX_PLUGINURL . 'css/');
define('SAMPLE_ITEMS_AJAX_JSURL', SAMPLE_ITEMS_AJAX_PLUGINURL . 'js/');
define('SAMPLE_ITEMS_AJAX_SLUG', 'sample-items-ajax');
define('SAMPLE_ITEMS_AJAX_URL', $SITEURL . '?'. SAMPLE_ITEMS_AJAX_ID);

// == Load common functions (used throughout plugin) ==
include(SAMPLE_ITEMS_AJAX_PLUGINPATH . 'common_functions.php');

// == Merge language files ==
i18n_merge(SAMPLE_ITEMS_AJAX_ID) || i18n_merge(SAMPLE_ITEMS_AJAX_ID, 'en_US');

// == Register plugin ==
register_plugin(
  SAMPLE_ITEMS_AJAX_ID,
  sample_items_ajax_i18n('PLUGIN_TITLE'),
  SAMPLE_ITEMS_AJAX_VERSION,
  'Lawrence Okoth-Odida',
  'https://github.com/lokothodida/',
  sample_items_ajax_i18n('PLUGIN_DESC'),
  'plugins',
  'sample_items_ajax_admin'
);

// == Register actions and filters ==
// Load common/public functions
add_action('common', 'sample_items_ajax_load');

// Renders the page
add_action('index-pretemplate', 'sample_items_ajax_display');

// == Register styles and scripts ==
register_style('sample-items-ajax', SAMPLE_ITEMS_AJAX_CSSURL . 'style.css', '0.1', 'screen');
register_script('sample-items-ajax', SAMPLE_ITEMS_AJAX_JSURL . 'script.js', '0.1', FALSE);

// == Queue styles and scripts ==
// Queue jQuery (built into GS)
queue_script('jquery', GSFRONT);

// Queue everything else
queue_style('sample-items-ajax', GSFRONT);
queue_script('sample-items-ajax', GSFRONT);

// == Functions ==
// Loads api functions
function sample_items_ajax_load() {
  require_once(SAMPLE_ITEMS_AJAX_PLUGINPATH . 'api_functions.php');
}

// Admin function
function sample_items_ajax_admin() {
  // ...
}