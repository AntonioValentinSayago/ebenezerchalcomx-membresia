<?php
// app/controllers/MembersController.php
class MembersController extends Controller
{
    public function create()
    {
        // Generar CSRF token
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        $ocupaciones = Member::occupations();
        $niveles = Member::educationLevels();
        $tiposSangre = Member::bloodTypes();
        $estadosCiviles = Member::maritalStatuses();
        $generos = Member::genders();
        $this->view('members/create', compact('ocupaciones', 'niveles', 'tiposSangre', 'estadosCiviles', 'generos'));
    }

    public function store()
    {
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
            http_response_code(403);
            die('CSRF token inválido.');
        }
        $member = new Member($_POST);
        $errors = $member->validate();
        if (!empty($errors)) {
            // Re-render con errores
            $ocupaciones = Member::occupations();
            $niveles = Member::educationLevels();
            $tiposSangre = Member::bloodTypes();
            $estadosCiviles = Member::maritalStatuses();
            $generos = Member::genders();
            $this->view('members/create', compact('ocupaciones', 'niveles', 'tiposSangre', 'estadosCiviles', 'generos', 'errors', 'member'));
            return;
        }
        if ($member->save()) {
            $this->redirect('index.php?controller=members&action=success');
        } else {
            $errors = ['No se pudo guardar el registro. Intenta de nuevo.'];
            $ocupaciones = Member::occupations();
            $niveles = Member::educationLevels();
            $tiposSangre = Member::bloodTypes();
            $estadosCiviles = Member::maritalStatuses();
            $generos = Member::genders();
            $this->view('members/create', compact('ocupaciones', 'niveles', 'tiposSangre', 'estadosCiviles', 'generos', 'errors', 'member'));
        }
    }

    public function success()
    {
        $this->view('members/success');
    }

    // app/controllers/MembersController.php

    public function index()
    {
        require_once __DIR__ . '/../models/Member.php';
        $memberModel = new Member();

        // Obtener todos los registros
        $members = $memberModel->getAll();

        // Cargar la vista
        require __DIR__ . '/../views/index.php';
    }

}
