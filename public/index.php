<?php
// public/index.php
session_start();

require __DIR__ . '/../app/config/config.php';
require __DIR__ . '/../app/core/Database.php';
require __DIR__ . '/../app/core/Controller.php';
require __DIR__ . '/../app/controllers/MembersController.php';
require __DIR__ . '/../app/models/Member.php';

// Enrutamiento simple por query string: ?controller=members&action=create
$controller = $_GET['controller'] ?? 'members';
$action = $_GET['action'] ?? 'create';

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
