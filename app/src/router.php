<?php
// router.php
if (preg_match('/\.(?:png|jpg|jpeg|gif)$/', $_SERVER["REQUEST_URI"])) {
  return false;    // Serve the requested resource as-is.
} else {
  include __DIR__ . '/index.php';
}
