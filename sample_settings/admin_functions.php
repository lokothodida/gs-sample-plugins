<?php
// Functions for the admin panel
// Admin panel
function sample_settings_admin_display($init) {
  // Initialization successful
  if ($init) {
    // First process the form if it has been sent
    // Note that in the form there is an input field with the name 'save'
    if (!empty($_POST['save'])) {
      $data = array(
        'title'   => $_POST['title'],
        'slug'    => $_POST['slug'],
        'height'  => $_POST['height'],
        'width'   => $_POST['width'],
      );

      $succ = sample_settings_save($data);

      if ($succ) {
        sample_settings_status_message('updated', sample_settings_i18n('SAVE_SUCCESS'));
      } else {
        sample_settings_status_message('error', sample_settings_i18n('SAVE_ERROR'));
      }
    }

    // Then get the settings data and display the form
    $settings = sample_settings_get();

    if ($settings) {
      ?>

      <h3><?php sample_settings_i18n('PLUGIN_TITLE', true); ?></h3>
      <form action="" method="post">
        <?php sample_settings_display_form($settings); ?>
      </form>
      <?php
    }
  // Failed to initialize!
  } else {
    ?>
    <h3><?php sample_settings_i18n('PLUGIN_TITLE', true); ?></h3>
    <p><?php sample_settings_i18n('INIT_ERROR', true); ?></p>
    <?php
  }
}

// Displays a form for settings
function sample_settings_display_form($settings) {
  ?>
  <div class="leftsec">
    <p>
      <label><?php sample_settings_i18n('NAME', true); ?></label>
      <input type="text" class="text" name="title" value="<?php echo $settings['title']; ?>"/>
    </p>
    <p>
      <label><?php sample_settings_i18n('SLUG', true); ?></label>
      <input type="text" class="text" name="slug" value="<?php echo $settings['slug']; ?>"/>
    </p>
  </div>
  <div class="rightsec">
    <p>
      <label><?php sample_settings_i18n('HEIGHT', true); ?></label>
      <input type="number" class="text" name="height" value="<?php echo $settings['height']; ?>"/>
    </p>
    <p>
      <label><?php sample_settings_i18n('WIDTH', true); ?></label>
      <input type="number" class="text" name="width" value="<?php echo $settings['width']; ?>"/>
    </p>
  </div>
  <div class="clear"></div>

  <p>
    <input type="submit" class="submit" name="save" value="<?php i18n('BTN_SAVECHANGES'); ?>">
  </p>
  <?php
}

// Prints a success/error message
function sample_settings_status_message($status, $message) {
  ?>
  <div class="<?php echo $status; ?>"><?php echo $message; ?></div>
  <?php
}