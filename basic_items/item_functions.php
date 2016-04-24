<?php
// Functions for manipulating items
// Get an item
function it_get_item($slug) {
  $file = it_item_filename($slug);

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
function it_create_item($slug, $data) {
  $file = it_item_filename($slug);

  if (!file_exists($file)) {
    return it_save_item($file, $data);
  } else {
    return false;
  }
}

// Edit an item
function it_edit_item($slug, $data) {
  $file = it_item_filename($slug);

  if (file_exists($file)) {
    return it_save_item($file, $data);
  } else {
    return false;
  }
}

// Helper method for saving an item
function it_save_item($filename, $data) {
  $data = it_item_data_validate($data);
  $contents = json_encode($data);

  return file_put_contents($filename, $contents);
}

// Delete an item
function it_delete_item($slug) {
  $file = it_item_filename($slug);

  if (file_exists($file)) {
    return unlink($file);
  } else {
    return false;
  }
}

// Get all items
function it_get_items() {
  $files = glob(IT_DATAPATH . '*.json');
  $items = array();

  foreach ($files as $file) {
    $slug = basename($file, '.json');
    $items[] = it_get_item($slug);
  }

  return $items;
}

function it_item_filename($slug) {
  return IT_DATAPATH . $slug . '.json';
}

function it_item_data_validate($data) {
  return $data;
}

function it_item_defaults() {
  return array(
    'title' => 'Title here',
    'content' => 'Insert Content Here'
  );
}