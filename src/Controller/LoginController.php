<?php

class LoginController extends Controller
{

    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function login()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $login = $_POST['login'];
            $password = $_POST['password'];

            $data = [
                'login' => trim($login),
                'password' => trim($password),
            ];

            if ($this->userModel->login($data)) {
                $_SESSION['logged_in'] = true;
                $_SESSION['login'] = $data['login'];
                $_SESSION['error'] = '';
                $this->view('Dashboard');
            } else {
                $_SESSION['error'] = 'Something went wrong!';
                $this->view('Login');
            }
        } else {
            $this->view('Login');
        }
    }
    public function logout()
    {
        session_destroy();
        header("Location: /");
    }
}
