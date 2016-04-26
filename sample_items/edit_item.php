<?php

// Process item editing
if (isset($_POST['edit'])) {
  $succ = sample_items_edit_item($_GET['edit'], $_POST);

  if ($succ) {
    sample_items_display_status_message('updated', sample_items_i18n('EDIT_ITEM_SUCC'));
  } else {
    sample_items_display_status_message('error', sample_items_i18n('EDIT_ITEM_ERROR'));
  }
}

$item = sample_items_get_item($_GET['edit']);

if ($item) {
?>

<h3><?php sample_items_i18n('EDIT_ITEM', true); ?></h3>
<form action="<?php echo sample_items_get_admin_link('edit', $item['slug']); ?>" method="post">
  <?php sample_items_get_item_form($item); ?>
  <input type="submit" class="submit" name="edit" value="<?php i18n('BTN_SAVECHANGES'); ?>"> /
  <a href="<?php echo sample_items_get_admin_link(); ?>"><?php sample_items_i18n('BACK', true); ?></a>
</form>

<?php } else { ?>

<h3><?php sample_items_i18n('ITEM_NOT_FOUND', true); ?></h3>

<?php }