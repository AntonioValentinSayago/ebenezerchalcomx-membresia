<?php
$base = rtrim(BASE_URL, '/');

// Validamos que $member->id exista antes de usar urlencode
$id = isset($member->id) ? urlencode($member->id) : '';

$action = "$base/index.php?controller=members&action=update&id=$id";

include __DIR__ . '/form.php';
