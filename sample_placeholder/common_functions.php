<?php
// i18n alias function
function sample_placeholder_i18n($hash, $echo = false) {
  return i18n(SAMPLE_PLACEHOLDER_ID . '/' . $hash, $echo);
}