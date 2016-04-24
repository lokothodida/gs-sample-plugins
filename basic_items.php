<?php
/*
  Plugin Name : Basic Items
  Description : Example of a simple collection of data, whose itemscan be created/edited/deleted
  Version     : 1.0
  Author      : Lawrence Okoth-Odida
  Author URI  : https://github.com/lokothodida/
*/

// Constants
define('IT_ID', basename(__FILE__, '.php'));           // Plugin ID
define('IT_VERSION', '1.0');                           // Plugin Version
define('IT_PLUGINPATH', GSPLUGINPATH . IT_ID . '/');   // Plugin folder path
define('IT_DATAPATH', GSDATAOTHERPATH . IT_ID . '/');  // Plugin folder path

// Languages
i18n_merge(IT_ID) || i18n_merge(IT_ID, 'en_US');

// Register plugin
register_plugin(
  IT_ID,                            // Plugin id
  it_i18n('PLUGIN_TITLE'),          // Plugin name
  IT_VERSION,                       // Plugin version
  'Lawrence Okoth-Odida',           // Plugin author
  'http://github.com/lokothodida/', // author website
  it_i18n('PLUGIN_DESC'),           // Plugin description
  'pages',                          // Page type - on which admin tab to display
  'it_admin'                        // Main function (administration)
);

// Actions/Filters
// Add a sidebar link
add_action('pages-sidebar', 'createSideMenu', array(IT_ID, it_i18n('PLUGIN_SIDEBAR')));

// Functions
// Admin function
function it_admin() {
  // Load the functions
  include(IT_PLUGINPATH . 'item_functions.php');
  include(IT_PLUGINPATH . 'admin_functions.php');

  // Initialize the items directory
  $init = it_init();

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
    $page = 'init_error';
  }

  include(IT_PLUGINPATH . $page . '.php');
}

// i18n alias function
function it_i18n($hash, $echo = false) {
  return i18n(IT_ID . '/' . $hash, $echo);
}