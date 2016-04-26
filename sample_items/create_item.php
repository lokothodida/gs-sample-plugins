<?php

$item = sample_items_item_defaults();
?>

<h3><?php sample_items_i18n('CREATE_ITEM', true); ?></h3>
<form action="<?php echo sample_items_get_admin_link(); ?>" method="post">
  <?php sample_items_get_item_form($item); ?>
  <input type="submit" class="submit" name="create" value="<?php i18n('BTN_SAVECHANGES'); ?>"> /
  <a href="<?php echo sample_items_get_admin_link(); ?>"><?php sample_items_i18n('BACK', true); ?></a>
</form>