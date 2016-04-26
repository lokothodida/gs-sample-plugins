<?php
// Common functions
// i18n alias function
function sample_items_i18n($hash, $echo = false) {
  return i18n(SAMPLE_ITEMS_ID . '/' . $hash, $echo);
}