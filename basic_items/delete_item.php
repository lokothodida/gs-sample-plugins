<?php

$item = it_get_item($_GET['delete']);

if ($item) {
?>

<h3><?php it_i18n('DELETE_ITEM', true); ?></h3>
<form action="<?php echo it_get_admin_link(); ?>" method="post">
  <input type="hidden" name="slug" value="<?php echo $item['slug']; ?>"/>

  <p><?php it_i18n('DELETE_ITEM_SURE', true); ?></p>

  <p>
    <label><?php it_i18n('LABEL_TITLE'); ?>: </label>
    <?php echo htmlentities($item['title']); ?>
  </p>
  <p>
    <label><?php it_i18n('LABEL_CONTENT'); ?>: </label>
    <?php echo htmlentities($item['content']); ?>
  </p>

  <input type="submit" class="submit" name="delete" value="<?php i18n('BTN_SAVECHANGES'); ?>"> /
  <a href="<?php echo it_get_admin_link(); ?>"><?php it_i18n('BACK', true); ?></a>
</form>

<?php } else { ?>

<h3><?php it_i18n('ITEM_NOT_FOUND', true); ?></h3>

<?php }