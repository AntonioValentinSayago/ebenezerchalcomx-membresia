<?php
// app/controllers/MembersController.php
class MembersController extends Controller
{
    public function index()
    {
        $memberModel = new Member();
        $members = $memberModel->getAll();
        $this->view('members/index', compact('members'));
    }

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
        $this->view('members/create', compact('ocupaciones','niveles','tiposSangre','estadosCiviles','generos'));
    }

    public function store()
    {
        if ($_POST['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
            die('CSRF token inválido.');
        }
        $member = new Member($_POST);
        $errors = $member->validate();
        if (!empty($errors)) {
            $this->view('members/create', compact('errors','member'));
            return;
        }
        $member->save();
        $this->redirect('index.php?controller=members&action=index');
    }

    public function edit()
    {
        $id = $_GET['id'] ?? null;
        $member = Member::findById($id);
        if (!$member) die("Miembro no encontrado");

        $ocupaciones = Member::occupations();
        $niveles = Member::educationLevels();
        $tiposSangre = Member::bloodTypes();
        $estadosCiviles = Member::maritalStatuses();
        $generos = Member::genders();

        $this->view('members/edit', compact('member','ocupaciones','niveles','tiposSangre','estadosCiviles','generos'));
    }

    public function update()
    {
        if ($_POST['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
            die('CSRF token inválido.');
        }
        $member = new Member($_POST);
        $member->id = $_POST['id'];
        $errors = $member->validate();
        if (!empty($errors)) {
            $this->view('members/edit', compact('errors','member'));
            return;
        }
        $member->update();
        $this->redirect('index.php?controller=members&action=index');
    }

    public function delete()
    {
        $id = $_GET['id'] ?? null;
        if ($id) Member::delete($id);
        $this->redirect('index.php?controller=members&action=index');
    }
}
