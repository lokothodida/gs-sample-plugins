<?php
/*
  Plugin Name : Sample Virtual Page
  Description : Loads arbitrary content for a nonexistent page slug 'virtual-page'
  Version     : 1.0
  Author      : Lawrence Okoth-Odida
  Author URI  : https://github.com/lokothodida/
*/

// == Define useful constants ==
define('SAMPLE_VPAGE_ID', basename(__FILE__, '.php'));
define('SAMPLE_VPAGE_VERSION', '1.0');
define('SAMPLE_VPAGE_PLUGINPATH', GSPLUGINPATH . SAMPLE_VPAGE_ID . '/');
define('SAMPLE_VPAGE_SLUG', 'virtual-page');
define('SAMPLE_VPAGE_ACTION_PAGE_LOAD', 'sample-vpage-load');
define('SAMPLE_VPAGE_FILTER', 'sample-vpage');

// == Load common functions (used throughout plugin) ==
include(SAMPLE_VPAGE_PLUGINPATH . 'common_functions.php');

// == Merge language files ==
i18n_merge(SAMPLE_VPAGE_ID) || i18n_merge(SAMPLE_VPAGE_ID, 'en_US');

// == Register plugin ==
register_plugin(
  SAMPLE_VPAGE_ID,
  sample_vpage_i18n('PLUGIN_TITLE'),
  SAMPLE_VPAGE_VERSION,
  'Lawrence Okoth-Odida',
  'http://github.com/lokothodida/',
  sample_vpage_i18n('PLUGIN_DESC'),
  'plugins',
  'sample_vpage_admin'
);

// == Register actions and filters ==
// Display the virtual page once the front page globals are set
add_action('index-post-dataindex', 'sample_vpage_display');

// Functions
// Modifies the $data_index properties when a page is loaded
function sample_vpage_display() {
  // Get $data_index object
  global $data_index;

  // Get the 'dummy' page slug from the id in the URL query
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
  } else {
    $id = '';
  }

  // Modify the page contents if the slug is correct
  if ($id == SAMPLE_VPAGE_SLUG) {
    // Allow other plugins to execute actions
    exec_action(SAMPLE_VPAGE_ACTION_PAGE_LOAD);

    // Modify the $data_index object
    $data_index->title   = sample_vpage_i18n('PAGE_TITLE');
    $data_index->content = sample_vpage_i18n('PAGE_CONTENT');

    // Allow other plugins to filter the page content
    $data_index = exec_filter(SAMPLE_VPAGE_FILTER, $data_index);
  }
}

// Admin function (does nothing in this example)
function sample_vpage_admin() {
  // ...
}