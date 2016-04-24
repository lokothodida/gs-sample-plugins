<?php
// Process page creation
if (isset($_POST['create'])) {
  $slug = clean_url($_POST['title']);
  $succ = it_create_item($slug, $_POST);

  if ($succ) {
    it_display_status_message('updated', it_i18n('CREATE_ITEM_SUCC'));
  } else {
    it_display_status_message('error', it_i18n('CREATE_ITEM_ERROR'));
  }

// Process page deletion
} elseif (isset($_POST['delete'])) {
  $succ = it_delete_item($_POST['slug']);

  if ($succ) {
    it_display_status_message('updated', it_i18n('DELETE_ITEM_SUCC'));
  } else {
    it_display_status_message('error', it_i18n('DELETE_ITEM_ERROR'));
  }
}

// Show all items
$items = it_get_items();
?>

<!--heading-->
<h3 class="floated"><?php it_i18n('VIEW_ITEMS', true); ?></h3>
<div class="edit-nav">
  <a href="<?php echo it_get_admin_link('create'); ?>"><?php it_i18n('CREATE_ITEM', true); ?></a>
</div>

<!--main body-->
<table>
  <thead>
    <tr>
      <th width="99%"><?php it_i18n('LABEL_TITLE', true); ?></th>
      <th><?php it_i18n('LABEL_DELETE', true); ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($items as $item) : ?>
    <tr>
      <td><a href="<?php echo it_get_admin_link('edit', $item['slug']); ?>"><?php echo $item['title']; ?></a></td>
      <td align="center"><a href="<?php echo it_get_admin_link('delete', $item['slug']); ?>">x</a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
  <tfoot>
    <tr>
      <td colspan="100%"><?php it_i18n('TOTAL_ITEMS', true); ?>: <?php echo count($items); ?></td>
    </tr>
  </tfoot>
</table>