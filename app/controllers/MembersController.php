<?php
class MembersController extends Controller
{
    public function create()
    {
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
            $ocupaciones = Member::occupations();
            $niveles = Member::educationLevels();
            $tiposSangre = Member::bloodTypes();
            $estadosCiviles = Member::maritalStatuses();
            $generos = Member::genders();
            $this->view('members/create', compact('ocupaciones', 'niveles', 'tiposSangre', 'estadosCiviles', 'generos', 'errors', 'member'));
            return;
        }
        if ($member->save()) {
            $this->redirect('index.php?controller=members&action=index');
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

    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            http_response_code(400);
            echo 'ID requerido';
            return;
        }
        $member = Member::findById($id);
        if (!$member) {
            http_response_code(404);
            echo 'Miembro no encontrado';
            return;
        }
        $ocupaciones = Member::occupations();
        $niveles = Member::educationLevels();
        $tiposSangre = Member::bloodTypes();
        $estadosCiviles = Member::maritalStatuses();
        $generos = Member::genders();
        $this->view('members/edit', compact('member', 'ocupaciones', 'niveles', 'tiposSangre', 'estadosCiviles', 'generos'));
    }

    public function update()
    {
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
            http_response_code(403);
            die('CSRF token inválido.');
        }

        $id = $_GET['id'] ?? $_POST['id'] ?? null;
        if (!$id) {
            http_response_code(400);
            die('ID faltante');
        }

        $member = new Member($_POST);
        $errors = $member->validate();

        if (!empty($errors)) {
            $ocupaciones = Member::occupations();
            $niveles = Member::educationLevels();
            $tiposSangre = Member::bloodTypes();
            $estadosCiviles = Member::maritalStatuses();
            $generos = Member::genders();
            $this->view('members/edit', compact('member', 'errors', 'ocupaciones', 'niveles', 'tiposSangre', 'estadosCiviles', 'generos'));
            return;
        }

        if ($member->update($id)) {
            $this->redirect('index.php?controller=members&action=index');
        } else {
            $errors = ['No se pudo actualizar. Intenta de nuevo.'];
            $ocupaciones = Member::occupations();
            $niveles = Member::educationLevels();
            $tiposSangre = Member::bloodTypes();
            $estadosCiviles = Member::maritalStatuses();
            $generos = Member::genders();
            $this->view('members/edit', compact('member', 'errors', 'ocupaciones', 'niveles', 'tiposSangre', 'estadosCiviles', 'generos'));
        }
    }

    public function delete()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            http_response_code(400);
            die('ID no proporcionado');
        }

        if (Member::delete($id)) {
            $this->redirect('index.php?controller=members&action=index');
        } else {
            http_response_code(500);
            echo 'Error al eliminar el registro';
        }
    }

    public function index()
    {
        $memberModel = new Member();
        $members = $memberModel->getAll();
        $this->view('members/index', compact('members'));
    }

    public function success()
    {
        $this->view('members/success');
    }
}
