<?php
/*
  Plugin Name : Basic Items
  Description : Example of a simple collection of data, whose items can be created/edited/deleted
  Version     : 1.0
  Author      : Lawrence Okoth-Odida
  Author URI  : https://github.com/lokothodida/
*/

// == Define useful constants ==
define('SAMPLE_ITEMS_ID', basename(__FILE__, '.php'));
define('SAMPLE_ITEMS_VERSION', '1.0');
define('SAMPLE_ITEMS_PLUGINPATH', GSPLUGINPATH . SAMPLE_ITEMS_ID . '/');
define('SAMPLE_ITEMS_DATAPATH', GSDATAOTHERPATH . SAMPLE_ITEMS_ID . '/');
define('SAMPLE_ITEMS_ACTION_CREATE_SUCCESS', 'item-create-success');
define('SAMPLE_ITEMS_ACTION_CREATE_ERROR', 'item-create-error');
define('SAMPLE_ITEMS_ACTION_EDIT_SUCCESS', 'item-edit-success');
define('SAMPLE_ITEMS_ACTION_EDIT_ERROR', 'item-edit-error');
define('SAMPLE_ITEMS_ACTION_DELETE_SUCCESS', 'item-delete-success');
define('SAMPLE_ITEMS_ACTION_DELETE_ERROR', 'item-delete-error');
define('SAMPLE_ITEMS_FILTER_SAVE_ITEM', 'item-save-data');

// == Load common functions (used throughout plugin) ==
include(SAMPLE_ITEMS_PLUGINPATH . 'common_functions.php');

// == Merge language files ==
i18n_merge(SAMPLE_ITEMS_ID) || i18n_merge(SAMPLE_ITEMS_ID, 'en_US');

// == Register plugin ==
register_plugin(
  SAMPLE_ITEMS_ID,
  sample_items_i18n('PLUGIN_TITLE'),
  SAMPLE_ITEMS_VERSION,
  'Lawrence Okoth-Odida',
  'http://github.com/lokothodida/',
  sample_items_i18n('PLUGIN_DESC'),
  'pages',
  'sample_items_admin'
);

// == Register actions and filters ==
// Add a sidebar link
add_action('pages-sidebar', 'createSideMenu', array(SAMPLE_ITEMS_ID, sample_items_i18n('PLUGIN_SIDEBAR')));

// Load public functions (so they are available to other plugins)
add_action('common', 'sample_items_load');

// == Functions ==
// Admin function
function sample_items_admin() {
  // Load the functions
  include(SAMPLE_ITEMS_PLUGINPATH . 'admin_functions.php');

  // Initialize the items directory
  $init = sample_items_init();

  // Select and load the correct admin panel page
  if ($init && isset($_GET['create'])) {
    $page = 'create_item';
  } elseif ($init && isset($_GET['edit'])) {
    $page = 'edit_item';
  } elseif ($init && isset($_GET['delete'])) {
    $page = 'delete_item';
  } elseif ($init) {
    $page = 'view_items';
  } else {
    $page = 'init_items_error';
  }

  include(SAMPLE_ITEMS_PLUGINPATH . $page . '.php');
}

// Callback to load public functions
function sample_items_load() {
  include(SAMPLE_ITEMS_PLUGINPATH . 'item_functions.php');
}