<?php
/*
  Plugin Name : Sample Settings
  Description : A plugin showcasing a simple settings page in the admin panel
                for some arbitrary data.
  Version     :	0.1
  Author      :	Lawrence Okoth-Odida
  Author URI  : https://github.com/lokothodida/
*/

// == Define useful constants ==
define('SAMPLE_SETTINGS_ID', basename(__FILE__, '.php'));
define('SAMPLE_SETTINGS_VERSION', '0.1');
define('SAMPLE_SETTINGS_PLUGINPATH', GSPLUGINPATH . SAMPLE_SETTINGS_ID . '/');
define('SAMPLE_SETTINGS_DATAPATH', GSDATAOTHERPATH . SAMPLE_SETTINGS_ID . '/');
define('SAMPLE_SETTINGS_FILE', SAMPLE_SETTINGS_DATAPATH . 'settings.json');
define('SAMPLE_SETTINGS_ACTION_SAVE_SUCCESS', 'sample-settings-save-success');
define('SAMPLE_SETTINGS_ACTION_SAVE_ERROR', 'sample-settings-save-error');
define('SAMPLE_SETTINGS_FILTER_LOAD', 'sample-settings-load');
define('SAMPLE_SETTINGS_FILTER_SAVE', 'sample-settings-save');

// == Load common functions (used throughout plugin) ==
include(SAMPLE_SETTINGS_PLUGINPATH . 'common_functions.php');

// == Merge language files ==
i18n_merge(SAMPLE_SETTINGS_ID) || i18n_merge(SAMPLE_SETTINGS_ID, 'en_US');

// == Register plugin ==
register_plugin(
  SAMPLE_SETTINGS_ID,
  sample_settings_i18n('PLUGIN_TITLE'),
  SAMPLE_SETTINGS_VERSION,
  'Lawrence Okoth-Odida',
  'https://github.com/lokothodida',
  sample_settings_i18n('PLUGIN_DESC'),
  'settings',
  'sample_settings_admin'
);

// == Register actions and filters ==
// Add sidebar link
add_action('settings-sidebar', 'createSideMenu', array(SAMPLE_SETTINGS_ID, sample_settings_i18n('PLUGIN_SIDEBAR')));

// Load public functions (so they are available to other plugins)
add_action('common', 'sample_settings_load');

// == Functions ==
// Admin function
function sample_settings_admin() {
  // Load admin functions
  include(SAMPLE_SETTINGS_PLUGINPATH . 'admin_functions.php');

  // Initialize
  $init = sample_settings_init();

  // Display the admin panel
  sample_settings_admin_display($init);
}

// Callback to load public functions
function sample_settings_load() {
  include(SAMPLE_SETTINGS_PLUGINPATH . 'settings_functions.php');
}