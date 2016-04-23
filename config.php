<?php

/*
  Plugin Name : Sample Configuration
  Description : A plugin showcasing a simple configuration page in the admin panel
                for some arbitrary data.
  Version			:	0.1
  Author      :	Lawrence Okoth-Odida
  Author URI  : https://github.com/lokothodida/
*/

// Constants
define('CFG_ID',      basename(__FILE__, '.php'));      // Plugin ID
define('CFG_VERSION', '0.1');                           // Plugin Version
define('CFG_PLUGINPATH', GSPLUGINPATH . CFG_ID . '/');  // Plugin folder path
define('CFG_DATAPATH', GSDATAOTHERPATH . CFG_ID . '/'); // Plugin data path
define('CFG_FILE', CFG_DATAPATH . 'config.json');       // Config file path

// Languages
i18n_merge(CFG_ID) || i18n_merge(CFG_ID, 'en_US');

// Register plugin
register_plugin(
  CFG_ID,                           // Plugin id
  cfg_i18n('TITLE'),                // Plugin name
  CFG_VERSION,                      // Plugin version
  'Lawrence Okoth-Odida',           // Plugin author
  'https://github.com/lokothodida', // author website
  cfg_i18n('DESC'),                 // Plugin description
  'settings',                       // Page type - on which admin tab to display
  'cfg_admin'                       // Main function (administration)
);

// Actions/Filters
// add a link in the admin tab 'theme'
add_action('settings-sidebar', 'createSideMenu', array(CFG_ID, cfg_i18n('SIDEBAR')));

// Functions
// Initialize the folder and files
function cfg_init() {
  $status = true;
  $dir = CFG_DATAPATH;

  // Create the folder
  if (!file_exists($dir)) {
    $status = mkdir($dir, 0755);
  }

  // Create the htaccess file
  if ($status && !file_exists($htaccess = CFG_DATAPATH . '.htaccess')) {
    $status = file_put_contents($htaccess, 'Deny from all');
  }

  // Create the config file
  if ($status && !file_exists(CFG_FILE)) {
    $status = cfg_save();
  }

  return $status;
}

// Save Configuration
function cfg_save($config = array()) {
  $content = json_encode($config);
  return file_put_contents(CFG_FILE, $content);
}

// Get Configuration
function cfg_get() {
  if (file_exists(CFG_FILE)) {
    // Get the file contents
    $content = file_get_contents(CFG_FILE);

    // Decode it into an array
    $config = (array) json_decode($content);

    // Ensure that default parameters exist
    $config = array_merge(array(
      'name'    => 'Your Site',
      'height'  => '10',
      'width' 	=> '100',
      'content' => 'Hello World'
    ), $config);

    return $config;
  } else {
    return false;
  }
}

// Prints a success/error message
function cfg_status_message($status, $message) {
  ?>
  <div class="<?php echo $status; ?>"><?php echo $message; ?></div>
  <?php
}

// Admin function
function cfg_admin() {
  cfg_init();
  include(CFG_PLUGINPATH . 'admin.php');
}

// i18n alias function
function cfg_i18n($hash, $echo = false) {
  return i18n(CFG_ID . '/' . $hash, $echo);
}