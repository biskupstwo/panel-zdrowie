<?php 

class Controller {
    public function model($model) {
        require_once PROJECT_ROOT . '/Model/' . $model . ".php";
        return new $model();
    }

    public function view ($view, $data = []) {
        require_once PROJECT_ROOT . '/Views/' . $view . '.php';
    }
}