<?php
// app/core/Controller.php
class Controller {
    protected function view($view, $data = []) {
        extract($data);
        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/' . $view . '.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    protected function redirect($route) {
        $url = rtrim(BASE_URL, '/') . '/' . ltrim($route, '/');
        header("Location: " . $url);
        exit;
    }
}
