<?php
// Common functions
// i18n alias function
function sample_settings_i18n($hash, $echo = false) {
  return i18n(SAMPLE_SETTINGS_ID . '/' . $hash, $echo);
}