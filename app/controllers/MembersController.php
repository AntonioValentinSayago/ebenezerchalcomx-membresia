<?php
// app/controllers/MembersController.php
class MembersController extends Controller
{
    public function create()
    {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        $member = new Member(); // En blanco

        $ocupaciones = Member::occupations();
        $niveles = Member::educationLevels();
        $tiposSangre = Member::bloodTypes();
        $estadosCiviles = Member::maritalStatuses();
        $generos = Member::genders();

        $this->view('members/form', compact('member', 'ocupaciones', 'niveles', 'tiposSangre', 'estadosCiviles', 'generos'));
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

        // Cargar la vista correcta
        $this->view('members/index', compact('members'));
    }

    public function edit()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            $this->redirect('index.php?controller=members&action=index');
        }

        $member = Member::findById($id);

        if (!$member) {
            die('Miembro no encontrado.');
        }

        // Generar CSRF token si no existe
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        $ocupaciones = Member::occupations();
        $niveles = Member::educationLevels();
        $tiposSangre = Member::bloodTypes();
        $estadosCiviles = Member::maritalStatuses();
        $generos = Member::genders();

        $this->view('members/form', compact('member', 'ocupaciones', 'niveles', 'tiposSangre', 'estadosCiviles', 'generos'));
    }

    public function update()
    {
        $id = $_POST['id'] ?? null;

        if (!$id || !isset($_POST['csrf_token']) || $_POST['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
            http_response_code(403);
            die('CSRF token inválido o ID faltante.');
        }

        $member = new Member($_POST);
        $errors = $member->validate();

        if (!empty($errors)) {
            $ocupaciones = Member::occupations();
            $niveles = Member::educationLevels();
            $tiposSangre = Member::bloodTypes();
            $estadosCiviles = Member::maritalStatuses();
            $generos = Member::genders();
            $this->view('members/form', compact('ocupaciones', 'niveles', 'tiposSangre', 'estadosCiviles', 'generos', 'errors', 'member'));
            return;
        }

        if ($member->update($id)) {
            $this->redirect('index.php?controller=members&action=success');
        } else {
            $errors = ['No se pudo actualizar el registro. Intenta de nuevo.'];
            $ocupaciones = Member::occupations();
            $niveles = Member::educationLevels();
            $tiposSangre = Member::bloodTypes();
            $estadosCiviles = Member::maritalStatuses();
            $generos = Member::genders();
            $this->view('members/form', compact('ocupaciones', 'niveles', 'tiposSangre', 'estadosCiviles', 'generos', 'errors', 'member'));
        }
    }

    public function delete()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            die('ID requerido para eliminar.');
        }

        if (Member::delete($id)) {
            $this->redirect('index.php?controller=members&action=index');
        } else {
            die('Error al eliminar el miembro.');
        }
    }




}
