<?php
/*
  Plugin Name : Sample Items Pages
  Description : Loads item content from Sample Items on the front page with the slug "virtual-item-$slug"
  Version     : 1.0
  Author      : Lawrence Okoth-Odida
  Author URI  : https://github.com/lokothodida/
*/

// == Define useful constants ==
define('SAMPLE_IPAGE_ID', basename(__FILE__, '.php'));
define('SAMPLE_IPAGE_VERSION', '1.0');
define('SAMPLE_IPAGE_PLUGINPATH', GSPLUGINPATH . SAMPLE_IPAGE_ID . '/');
define('SAMPLE_IPAGE_SLUG', 'virtual-item');
define('SAMPLE_IPAGE_ACTION_PAGE_LOAD', 'sample-ipage-load');
define('SAMPLE_IPAGE_FILTER', 'sample-ipage');

// == Load common functions (used throughout plugin) ==
include(SAMPLE_IPAGE_PLUGINPATH . 'common_functions.php');

// == Merge language files ==
i18n_merge(SAMPLE_IPAGE_ID) || i18n_merge(SAMPLE_IPAGE_ID, 'en_US');

// == Register plugin ==
register_plugin(
  SAMPLE_IPAGE_ID,
  sample_ipage_i18n('PLUGIN_TITLE'),
  SAMPLE_IPAGE_VERSION,
  'Lawrence Okoth-Odida',
  'http://github.com/lokothodida/',
  sample_ipage_i18n('PLUGIN_DESC'),
  'plugins',
  'sample_ipage_admin'
);

// == Register actions and filters ==
// Display the virtual page once the front page globals are set
add_action('index-post-dataindex', 'sample_ipage_display');

// Functions
// Modifies the $data_index properties when a page is loaded
function sample_ipage_display() {
  // Get $data_index object
  global $data_index;

  if (function_exists('sample_items_get_item')) {
    // Get the 'dummy' page slug from the id in the URL query
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
    } else {
      $id = '';
    }

    $prefix = SAMPLE_IPAGE_SLUG . '-';

    // Remove the prefix and get the correct item
    if (strpos($id, $prefix) === 0) {
      $id = str_replace($prefix, '', $id);
      $item = sample_items_get_item($id);

      if ($item) {
        // Allow other plugins to execute actions
        exec_action(SAMPLE_IPAGE_ACTION_PAGE_LOAD);

        // Modify the $data_index object
        $data_index->title   = $item['title'];
        $data_index->content = $item['content'];

        // Allow other plugins to filter the page content
        $data_index = exec_filter(SAMPLE_IPAGE_FILTER, $data_index);
      }
    }
  }
}

// Admin function (does nothing in this example)
function sample_ipage_admin() {
  // ...
}