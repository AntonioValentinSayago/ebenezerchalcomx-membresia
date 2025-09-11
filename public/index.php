<?php
// public/index.php
session_start();

require __DIR__ . '/../app/config/config.php';
require __DIR__ . '/../app/core/Database.php';
require __DIR__ . '/../app/core/Controller.php';
require __DIR__ . '/../app/controllers/MembersController.php';
require __DIR__ . '/../app/models/Member.php';

// ✅ Corregido: acción por defecto es "index", no "create"
$controller = $_GET['controller'] ?? 'members';
$action = $_GET['action'] ?? 'index';

switch ($controller) {
    case 'members':
    default:
        $ctrl = new MembersController();
        if ($action === 'create') {
            $ctrl->create();
        } elseif ($action === 'store' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $ctrl->store();
        } elseif ($action === 'edit') {
            $ctrl->edit();
        } elseif ($action === 'update' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $ctrl->update();
        } elseif ($action === 'delete') {
            $ctrl->delete();
        } elseif ($action === 'success') {
            $ctrl->success();
        } elseif ($action === 'index') {
            $ctrl->index();
        } else {
            http_response_code(404);
            echo 'Ruta no encontrada';
        }
        break;
}
