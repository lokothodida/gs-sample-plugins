<?php
// Initialize the plugin folder
function sample_items_init() {
  $status = true;

  // Create the folder
  if (!file_exists(SAMPLE_ITEMS_DATAPATH)) {
    $status = mkdir(SAMPLE_ITEMS_DATAPATH, 0755);
  }

  // Create the htaccess file
  if ($status && !file_exists($htaccess = SAMPLE_ITEMS_DATAPATH . '.htaccess')) {
    $status = file_put_contents($htaccess, 'Deny from all');
  }

  return $status;
}

// Display a status message
function sample_items_display_status_message($status, $message) {
  ?>
  <div class="<?php echo $status; ?>"><?php echo $message; ?></div>
  <?php
}

function sample_items_get_admin_link($page = null, $slug = null) {
  $url = 'load.php?id=' . SAMPLE_ITEMS_ID;

  if ($page) {
    $url .= '&' . $page . '=' . $slug;
  }

  return $url;
}

function sample_items_get_item_form($item) {
  ?>
  <!--title-->
  <p>
    <label><?php sample_items_i18n('LABEL_TITLE', true); ?>: </label>
    <input type="text" class="text" name="title" value="<?php echo $item['title']; ?>"/>
  </p>

  <!--content-->
  <p>
    <label><?php sample_items_i18n('LABEL_CONTENT', true); ?>: </label>
    <textarea class="text" name="content"><?php echo $item['content']; ?></textarea>
  </p>
  <?php
}