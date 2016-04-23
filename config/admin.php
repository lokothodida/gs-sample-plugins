<?php
// Saving the changes
if (!empty($_POST['save'])) {
  $data = array(
    'height'  => $_POST['height'],
    'width'   => $_POST['width'],
    'content' => $_POST['content'],
  );

  $succ = cfg_save($data);

  if ($succ) {
    cfg_status_message('updated', cfg_i18n('SAVE_SUCC'));
  } else {
    cfg_status_message('error', cfg_i18n('SAVE_ERR'));
  }
}

// Get the config object
$config = cfg_get();

// The main form
if ($config) {
?>

<h3><?php cfg_i18n('TITLE', true); ?></h3>
<form action="" method="post">
  <!--fields-->
  <p>
    <label><?php cfg_i18n('NAME', true); ?></label>
    <input type="text" class="text" name="name" value="<?php echo $config['name']; ?>"/>
  </p>
  <p>
    <label><?php cfg_i18n('HEIGHT', true); ?></label>
    <input type="number" class="text" name="height" value="<?php echo $config['height']; ?>"/>
  </p>
  <p>
    <label><?php cfg_i18n('WIDTH', true); ?></label>
    <input type="number" class="text" name="width" value="<?php echo $config['width']; ?>"/>
  </p>
  <p>
    <label><?php cfg_i18n('CONTENT', true); ?></label>
    <textarea type="text" class="text" name="content"><?php echo $config['content']; ?></textarea>
  </p>
  <!--submit button-->
  <p>
    <input type="submit" class="submit" name="save" value="<?php i18n('BTN_SAVECHANGES'); ?>">
  </p>
</form>

<?php
// Otherwise, the configuration object wasn't loaded
} else {
?>

<h3><?php cfg_i18n('TITLE', true); ?></h3>
<p><?php cfg_i18n('NO_CONFIG', true); ?></p>

<?php }