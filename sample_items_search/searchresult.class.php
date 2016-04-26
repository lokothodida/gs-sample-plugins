<?php
class SampleItemsSearchResult extends I18nSearchResultItem {
  // Array of the data for an individual search item
  protected $data = null;

  // this is the only function you need to implement
  protected function get($name) {
    // If the data hasn't been loaded, load it
    if (!$this->data && function_exists('sample_items_get_item')) {
      // Get the correct slug (shave off the prefix)
      $slug = str_replace(SAMPLE_ITEMS_SEARCH_PREFIX, '', $this->id);

      // Load the data
      $this->data = sample_items_get_item($slug);

      if (!$this->data) {
        return null;
      }
    }

    switch ($name) {
      case 'title': return $this->data['title'];
      case 'description': return $this->data['content'];
      case 'content': return '<p>' . htmlspecialchars($this->data['content']) . '</p>';
      case 'link': return null;
      default: return @$this->data[$name];
    }
  }
}