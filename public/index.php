<?php
// public/index.php
session_start();

require __DIR__ . '/../app/config/config.php';
require __DIR__ . '/../app/core/Database.php';
require __DIR__ . '/../app/core/Controller.php';
require __DIR__ . '/../app/controllers/MembersController.php';
require __DIR__ . '/../app/models/Member.php';

// Detectar ruta desde REQUEST_URI
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = str_replace('/public', '', $path); // Ajustar si tu dominio apunta directo a /public

$segments = array_values(array_filter(explode('/', $path)));

$controller = $segments[0] ?? 'members';
$action = $segments[1] ?? 'create';

switch ($controller) {
    case 'members':
    default:
        $ctrl = new MembersController();
        if ($action === 'create') {
            $ctrl->create();
        } elseif ($action === 'store' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $ctrl->store();
        } elseif ($action === 'success') {
            $ctrl->success();
        } else {
            http_response_code(404);
            echo 'Ruta no encontrada';
        }
        break;
}
