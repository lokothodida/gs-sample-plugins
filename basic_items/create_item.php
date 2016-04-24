<?php

$item = it_item_defaults();
?>

<h3><?php it_i18n('CREATE_ITEM', true); ?></h3>
<form action="<?php echo it_get_admin_link(); ?>" method="post">
  <?php it_get_item_form($item); ?>
  <input type="submit" class="submit" name="create" value="<?php i18n('BTN_SAVECHANGES'); ?>"> /
  <a href="<?php echo it_get_admin_link(); ?>"><?php it_i18n('BACK', true); ?></a>
</form>