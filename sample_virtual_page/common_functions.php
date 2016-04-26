<?php
// Common functions
// Internationalization alias
function sample_vpage_i18n($hash, $echo = false) {
  return i18n(SAMPLE_VPAGE_ID . '/' . $hash, $echo);
}