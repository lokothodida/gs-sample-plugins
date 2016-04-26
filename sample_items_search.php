<?php
/*
  Plugin Name : Sample Items (I18N) Search
  Description : I18N Search functionality for Sample Items
  Version     : 1.0
  Author      : Lawrence Okoth-Odida
  Author URI  : https://github.com/lokothodida/

  Credit to mvlcek for I18N Search and the dummy i18n search items plugin
*/

// == Define useful constants ==
define('SAMPLE_ITEMS_SEARCH_ID', basename(__FILE__, '.php'));
define('SAMPLE_ITEMS_SEARCH_VERSION', '1.0');
define('SAMPLE_ITEMS_SEARCH_PLUGINPATH', GSPLUGINPATH . SAMPLE_ITEMS_SEARCH_ID . '/');
define('SAMPLE_ITEMS_SEARCH_PREFIX', 'sample-item:');

// == Load common functions (used throughout plugin) ==
include(SAMPLE_ITEMS_SEARCH_PLUGINPATH . 'common_functions.php');

// == Merge language files ==
i18n_merge(SAMPLE_ITEMS_SEARCH_ID) || i18n_merge(SAMPLE_ITEMS_SEARCH_ID, 'en_US');

// == Register plugin ==
register_plugin(
  SAMPLE_ITEMS_SEARCH_ID,
  sample_items_search_i18n('PLUGIN_TITLE'),
  SAMPLE_ITEMS_SEARCH_VERSION,
  'Lawrence Okoth-Odida',
  'https://github.com/lokothodida/',
  sample_items_search_i18n('PLUGIN_DESC'),
  'plugins',
  'sample_items_search_admin'
);

// == Register actions and filters ==
// Load common functions
add_action('common', 'sample_items_search_load');

// The action called for indexing items other than pages.
add_action('search-index', 'sample_items_search_search_index');
// The filter called for returning the data of the found item.
add_filter('search-item', 'sample_items_search_search_item');

// The filter called for displaying the found item.
// It is not neaded, if the item has fields title and content like a regular page.
add_filter('search-display', 'sample_items_search_search_display');

// Refresh the index whenever an item is created, edited or deleted
add_action('item-create-success', 'sample_items_search_delete_index');
add_action('item-edit-success', 'sample_items_search_delete_index');
add_action('item-delete-success', 'sample_items_search_delete_index');

// Functions
function sample_items_search_load() {
  require_once(SAMPLE_ITEMS_SEARCH_PLUGINPATH . 'search_functions.php');
}

// Admin function (does nothing in this example)
function sample_items_search_admin() {
  // ...
}