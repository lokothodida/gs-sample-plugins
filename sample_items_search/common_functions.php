<?php
// Common functions
// i18n alias function
function sample_items_search_i18n($hash, $echo = false) {
  return i18n(SAMPLE_ITEMS_SEARCH_ID . '/' . $hash, $echo);
}