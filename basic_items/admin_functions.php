<?php
// Initialize the plugin folder
function it_init() {
  $status = true;

  // Create the folder
  if (!file_exists(IT_DATAPATH)) {
    $status = mkdir(IT_DATAPATH, 0755);
  }

  // Create the htaccess file
  if ($status && !file_exists($htaccess = IT_DATAPATH . '.htacc-ess')) {
    $status = file_put_contents($htaccess, 'Deny from all');
  }

  return $status;
}

// Display a status message
function it_display_status_message($status, $message) {
  ?>
  <div class="<?php echo $status; ?>"><?php echo $message; ?></div>
  <?php
}

function it_get_admin_link($page = null, $slug = null) {
  $url = 'load.php?id=' . IT_ID;

  if ($page) {
    $url .= '&' . $page . '=' . $slug;
  }

  return $url;
}

function it_get_item_form($item) {
  ?>
  <!--title-->
  <p>
    <label><?php it_i18n('LABEL_TITLE', true); ?>: </label>
    <input type="text" class="text" name="title" value="<?php echo $item['title']; ?>"/>
  </p>

  <!--content-->
  <p>
    <label><?php it_i18n('LABEL_CONTENT', true); ?>: </label>
    <textarea class="text" name="content"><?php echo $item['content']; ?></textarea>
  </p>
  <?php
}