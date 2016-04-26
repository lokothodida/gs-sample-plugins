<?php
// Functions for manipulating items
// Get an item
function sample_items_get_item($slug) {
  $file = sample_items_item_filename($slug);

  if (file_exists($file)) {
    $contents = file_get_contents($file);
    $data = (array) json_decode($contents);
    $data['slug'] = $slug;
    return $data;
  } else {
    return false;
  }
}

// Create an item
function sample_items_create_item($slug, $data) {
  $file = sample_items_item_filename($slug);

  if (!file_exists($file)) {
    $save = sample_items_save_item($file, $data);

    if ($save) {
      exec_action(SAMPLE_ITEMS_ACTION_CREATE_SUCCESS);
    } else {
      exec_action(SAMPLE_ITEMS_ACTION_CREATE_ERROR);
    }

    return $save;
  } else {
    return false;
  }
}

// Edit an item
function sample_items_edit_item($slug, $data) {
  $file = sample_items_item_filename($slug);

  if (file_exists($file)) {
    $save = sample_items_save_item($file, $data);

    if ($save) {
      exec_action(SAMPLE_ITEMS_ACTION_EDIT_SUCCESS);
    } else {
      exec_action(SAMPLE_ITEMS_ACTION_EDIT_ERROR);
    }

    return $save;
  } else {
    return false;
  }
}

// Helper method for saving an item
function sample_items_save_item($filename, $data) {
  $data = exec_filter(SAMPLE_ITEMS_FILTER_SAVE_ITEM, $data);
  $data = sample_items_item_data_validate($data);
  $contents = json_encode($data);

  return file_put_contents($filename, $contents);
}

// Delete an item
function sample_items_delete_item($slug) {
  $file = sample_items_item_filename($slug);

  if (file_exists($file)) {
    $delete = unlink($file);

    if ($delete) {
      exec_action(SAMPLE_ITEMS_ACTION_DELETE_SUCCESS);
    } else {
      exec_action(SAMPLE_ITEMS_ACTION_DELETE_ERROR);
    }

    return $delete;
  } else {
    return false;
  }
}

// Get all items
function sample_items_get_items() {
  $files = glob(SAMPLE_ITEMS_DATAPATH . '*.json');
  $items = array();

  foreach ($files as $file) {
    $slug = basename($file, '.json');
    $items[] = sample_items_get_item($slug);
  }

  return $items;
}

function sample_items_item_filename($slug) {
  return SAMPLE_ITEMS_DATAPATH . $slug . '.json';
}

function sample_items_item_data_validate($data) {
  return $data;
}

function sample_items_item_defaults() {
  return array(
    'title' => 'Title here',
    'content' => 'Insert Content Here'
  );
}