<?php
$base = rtrim(BASE_URL, '/');
$action = "$base/index.php?controller=members&action=store";

if (!isset($member)) {
    $member = new Member();
}

include __DIR__ . '/form.php';
