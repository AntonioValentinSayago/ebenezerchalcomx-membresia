<?php
$base = rtrim(BASE_URL, '/');
$action = "$base/index.php?controller=members&action=update&id=" . urlencode($member->id);
include __DIR__ . '/form.php';
