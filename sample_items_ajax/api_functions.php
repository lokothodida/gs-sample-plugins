<?php
// API Functions
// Displays the page
function sample_items_ajax_display() {
  global $data_index;

  // If a call to the API is made, execute thta API call
  if (isset($_GET[SAMPLE_ITEMS_AJAX_ID])) {
    return sample_items_ajax_api();
  }

  // Otherwise, get the id of the page and check if it is the right one
  $id = sample_items_ajax_get_page_id();

  if ($id == SAMPLE_ITEMS_AJAX_SLUG) {
    $data_index->title   = sample_items_ajax_i18n('PLUGIN_TITLE');
    $data_index->content = sample_items_ajax_render_page();
  }
}

// Gets the current page id
function sample_items_ajax_get_page_id() {
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
  } else {
    $id = '';
  }

  return $id;
}

// Renders the page contents (using output buffering)
function sample_items_ajax_render_page() {
  // Start output buffering - all echo statements will be buffered into a string
  ob_start();
  ?>

  <!--container for the items-->
  <ul id="sample-items">
  </ul>

  <!--"load more" link-->
  <a id="load-more" data-page="1" href="#"><?php sample_items_ajax_i18n('LOAD_MORE', true); ?></a>

  <!--hidden template for generated items-->
  <div id="sample-item-template">
    <li>
      <span class="title"></span>
      <span class="content"></span>
    </li>
  </div>

  <?php
  // Get the string, end the buffering and return it
  $contents = ob_get_contents();
  ob_end_clean();

  return $contents;
}

// AJAX entrypoint (a JSON api)
function sample_items_ajax_api() {
  $data = array(
    'results' => array(),
  );

  if (function_exists('return_i18n_search_results')) {
    // Set up the parameters
    // Sample items
    $tags = array('_sample_item');

    // Max items per page
    $max = 2;

    // Not searching for any words
    $words = null;

    // Index of the item to start from, based on the current page
    $first = ($_GET['page'] - 1) * $max;

    // Ordered by title (ascending)
    $order = 'title';

    // No language set
    $lang = null;

    // Get the search results
    $results = return_i18n_search_results($tags, $words, $first, $max, $order, $lang);

    // Format the results so that they are suitable for JSON
    foreach ($results['results'] as $result) {
      $data['results'][] = array(
        'title'   => $result->title,
        'content' => $result->content,
      );
    }
  }

  // Output the data as a JSON
  header('Content-Type: application/json');
  exit(json_encode($data));
}