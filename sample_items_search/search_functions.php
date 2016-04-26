<?php
// Search functions
// Indexes items
function sample_items_search_search_index() {
  // Only index if the sample items plugin is loaded
  if (function_exists('sample_items_get_items')) {
    $items = sample_items_get_items();

    // for each item call i18n_search_index_item($id, $language, $creDate, $pubDate, $tags, $title, $content)
    foreach ($items as $item) {
      // Fill in the relevant properties
      // The ID requies a unique prefix
      $id = SAMPLE_ITEMS_SEARCH_PREFIX . $item['slug'];
      $title = $item['title'];
      $content = $item['content'];

      // The creation date and publishing dates are UNIX timestamps
      // Since the plugin stores no information about when it was created/published, we will simply add the current time
      $creDate = time();
      $pubDate = $creDate;

      // For tags, we will add a private tag "_sample_item" so that one can restrict a search to only sample items
      // You can of course add item-specific data to this array
      $tags = array('_sample_item');

      // title and description are texts with no HTML tags or HTML entities
      // you can combine the text of multiple fields for the title or content
      // the only difference between title and content is that words in the title count more
      $language = null;

      i18n_search_index_item($id, $language, $creDate, $pubDate, $tags, $title, $content);
    }
  }
}

// Provies an I18nSearchResultItem object for a given sample item
function sample_items_search_search_item($id, $language, $creDate, $pubDate, $score) {
  // Require the search result class
  require_once(SAMPLE_ITEMS_SEARCH_PLUGINPATH . 'searchresult.class.php');

  // If the prefix of the $id is correct, return the search result object
  if (sample_items_search_is_item($id)) {
    // return the result item, if it is an item of our plugin
    return new SampleItemsSearchResult($id, $language, $creDate, $pubDate, $score);
  }

  // item is not from our plugin - maybe from another plugin
  return null;
}

// Helper function that checks if the $id prefix is for our items
function sample_items_search_is_item($id) {
  return strpos($id, SAMPLE_ITEMS_SEARCH_PREFIX) === 0;
}

function sample_items_search_search_display($item, $showLanguage, $showDate, $dateFormat, $numWords) {
  // If we have a valid item, display it accordingly
  if (sample_items_search_is_item($item->id)) {
    ?>
    <div class="sample-item">
      <h3><?php echo htmlspecialchars($item->title); ?></h3>
      <p><?php echo htmlspecialchars($item->description); ?></p>
    </div>
    <?php
    return true;
  }

  // item is not from our plugin - maybe from another plugin
  return false;
}

// Deletes the index (so it can be refreshed)
function sample_items_search_delete_index() {
  // Delete the index if i18n search is enabled
  if (function_exists('delete_i18n_search_index')) {
    delete_i18n_search_index();
  }
}