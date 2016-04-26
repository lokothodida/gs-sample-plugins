<?php
// Settings for managing settings
// Initialize the folder and files
function sample_settings_init() {
  $status = true;
  $dir = SAMPLE_SETTINGS_DATAPATH;

  // Create the folder
  if (!file_exists($dir)) {
    $status = mkdir($dir, 0755);
  }

  // Create the htaccess file (prevents direct access to the folder)
  if ($status && !file_exists($htaccess = SAMPLE_SETTINGS_DATAPATH . '.htaccess')) {
    $status = file_put_contents($htaccess, 'Deny from all');
  }

  // Create the settings file
  if ($status && !file_exists(SAMPLE_SETTINGS_FILE)) {
    $status = sample_settings_save();
  }

  return $status;
}

// Save settings data
function sample_settings_save($settings = array()) {
  // Merge default data
  $settings = array_merge(sample_settings_default(), $settings);

  // Allow other plugins to filter the settings before being saved
  $settings = exec_filter(SAMPLE_SETTINGS_FILTER_SAVE, $settings);

  // Validate the data
  $settings = sample_settings_validate($settings);

  // Encode the data as a valid JSON object
  $content = json_encode($settings);

  // Save the contents to the settings file
  $status = file_put_contents(SAMPLE_SETTINGS_FILE, $content);

  // Allow other plugins to do actions when the settings are changed
  if ($status) {
    exec_action(SAMPLE_SETTINGS_ACTION_SAVE_SUCCESS);
  } else {
    exec_action(SAMPLE_SETTINGS_ACTION_SAVE_ERROR);
  }

  return $status;
}

// Get settings
function sample_settings_get() {
  if (file_exists(SAMPLE_SETTINGS_FILE)) {
    // Get the file contents
    $content = file_get_contents(SAMPLE_SETTINGS_FILE);

    // Decode it into an array
    $settings = (array) json_decode($content);

    // Ensure that default parameters exist and merge them
    $settings = array_merge(sample_settings_default(), $settings);

    // Allow other functions to modify the settings object before it is shown
    $settings = exec_filter(SAMPLE_SETTINGS_FILTER_LOAD, $settings);

    return $settings;
  } else {
    return false;
  }
}

// Validate the settings object
function sample_settings_validate($settings) {
  // Slugify the slug (clean_url is a function in the GS core)
  $settings['slug'] = clean_url($settings['slug']);

  return $settings;
}

// Default settings data
function sample_settings_default() {
  return array(
    'title'    => 'Your Items',
    'slug'    => 'sample-items',
    'height'  => '10',
    'width' 	=> '100',
  );
}