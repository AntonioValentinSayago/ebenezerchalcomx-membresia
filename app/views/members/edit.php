<?php
$base = rtrim(BASE_URL, '/');
$action = "$base/index.php?controller=members&action=update&id=" . urlencode(isset($member->id) ? $member->id : '');
include __DIR__ . '/form.php';
