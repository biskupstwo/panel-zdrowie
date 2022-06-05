<?php

class RegisterController extends Controller
{

    private $userModel;

    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function register()
    {
        $data = [
            'username' => '',
            'usernameError' => '',
            'surname' => '',
            'surnameError' => '',
            'login' => '',
            'loginError' => '',
            'email' => '',
            'emailError' => '',
            'password' => '',
            'passwordError' => '',
            
            'confirm_password' => '',
            'confirmPasswordError' => '',
            'user_role'=>''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'username' => trim($_POST['username']),
                'usernameError' => '',
                'surname' => trim($_POST['surname']),
                'surnameError' => '',
                'login' => trim($_POST['login']),
                'loginError' => '',
                'email' => trim($_POST['email']),
                'emailError' => '',
                'password' => trim($_POST['password']),
                'passwordError' => '',
                
                'confirmPassword' => trim($_POST['confirmPassword']),
                'user_role' => '0',
                'confirmPasswordError' => ''
            ];
            //Regex tylko litery i liczby
            $usernameValidation = "/^[a-zA-Z0-9]*$/";

            if (empty($data['username'])) {
                $data['usernameError'] = 'Podaj imię.';
            } elseif (!preg_match($usernameValidation, $data['username'])) {
                $data['usernameError'] = 'Imie może zawierać tylko litery i znaki.';
            }

            if (empty($data['surname'])) {
                $data['surnameError'] = 'Podaj nazwisko.';
            } elseif (!preg_match($usernameValidation, $data['surname'])) {
                $data['surnameError'] = 'Nazwisko może zawierać tylko litery i znaki.';
            }

            if (empty($data['email'])) {
                $data['emailError'] = 'Podaj email.';
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['emailError'] = 'Błędny format.';
            } else {
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['emailError'] = 'Email jest zajęty.';
                }
            }

            if (empty($data['password'])) {
                $data['passwordError'] = 'Podaj hasło.';
            } elseif (strlen($data['password']) < 6) {
                $data['passwordError'] = 'Hasło musi mieć przynajmniej 6 znaków';
            }

            if (empty($data['login'])) {
                $data['loginError'] = 'Podaj login.';
            } elseif (strlen($data['login']) < 5) {
                $data['loginError'] = 'Login musi mieć przynajmniej 5 znaków';
            } elseif (!preg_match($usernameValidation, $data['login'])) {
                $data['loginError'] = 'Login może zawierać tylko litery i znaki.';
            } elseif ($this->userModel->findUserByLogin($data['login'])) {
                    $data['loginError'] = 'Login jest zajęty.';
            }
            if (empty($data['confirmPassword'])) {
                $data['confirmPasswordError'] = 'Podaj hasło.';
            } else {
                if ($data['password'] != $data['confirmPassword']) {
                    $data['confirmPasswordError'] = 'Hasła nie pasują spróbuj ponownie';
                }
            }

            if (empty($data['usernameError']) &&
                empty($data['emailError']) &&
                empty($data['passwordError']) &&
                empty($data['confirmPasswordError']) &&
                empty($data['loginError']) &&
                empty($data['surnameError'])
            ) {
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                if ($this->userModel->register($data)) {
                    header("Location: /login");
                } else {
                    die('Coś poszło nie tak.');
                }
            }
        }
        $this->view('Register', $data);
    }
}