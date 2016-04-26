<?php
// Common functions
// Internationalization alias
function sample_ipage_i18n($hash, $echo = false) {
  return i18n(SAMPLE_IPAGE_ID . '/' . $hash, $echo);
}