<?php

// Process item editing
if (isset($_POST['edit'])) {
  $succ = it_edit_item($_GET['edit'], $_POST);

  if ($succ) {
    it_display_status_message('updated', it_i18n('EDIT_ITEM_SUCC'));
  } else {
    it_display_status_message('error', it_i18n('EDIT_ITEM_ERROR'));
  }
}

$item = it_get_item($_GET['edit']);

if ($item) {
?>

<h3><?php it_i18n('EDIT_ITEM', true); ?></h3>
<form action="<?php echo it_get_admin_link('edit', $item['slug']); ?>" method="post">
  <?php it_get_item_form($item); ?>
  <input type="submit" class="submit" name="edit" value="<?php i18n('BTN_SAVECHANGES'); ?>"> /
  <a href="<?php echo it_get_admin_link(); ?>"><?php it_i18n('BACK', true); ?></a>
</form>

<?php } else { ?>

<h3><?php it_i18n('ITEM_NOT_FOUND', true); ?></h3>

<?php }