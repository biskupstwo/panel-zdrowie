<?php

class ClientController extends Controller
{

    private $clientModel;

    public function __construct()
    {
        $this->clientModel = $this->model('Client');
    }

    function createClient()
    {
        $data = [
            'name' => '',
            'nameError' => '',
            'surname' => '',
            'surnameError' => '',
            'email' => '',
            'emailError' => '',
            'phoneNumber' => '',
            'phoneNumberError' => '',
            'companyName' => '',
            'companyNameError' => '',
            'city' => '',
            'cityNameError' => '',
            'postalCode' => '',
            'postalCodeNameError' => '',
            'street' => '',
            'streetNameError' => '',
        ];

        $clientnameValidation = "/^[a-zA-Z0-9]*$/";
        $phoneNumberValidation = "/^[0-9]{9}$/";

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'name' => trim($_POST['name']),
                'nameError' => '',
                'surname' => trim($_POST['surname']),
                'surnameError' => '',
                'email' => trim($_POST['email']),
                'emailError' => '',
                'phoneNumber' => trim($_POST['phoneNumber']),
                'phoneNumberError' => '',
                'companyName' => trim($_POST['companyName']),
                'companyNameError' => '',
                'city' => trim($_POST['city']),
                'cityNameError' => '',
                'postalCode' => trim($_POST['postalCode']),
                'postalCodeNameError' => '',
                'street' => trim($_POST['street']),
                'streetNameError' => '',
            ];

            if (empty($data['name'])) {
                $data['nameError'] = 'Podaj imię.';
            } elseif (!preg_match($clientnameValidation, $data['name'])) {
                $data['nameError'] = 'Imie może zawierać tylko litery i znaki.';
            }

            if (empty($data['surname'])) {
                $data['surnameError'] = 'Podaj nazwisko.';
            } elseif (!preg_match($clientnameValidation, $data['surname'])) {
                $data['surnameError'] = 'Nazwisko może zawierać tylko litery i znaki.';
            }

            if (empty($data['email'])) {
                $data['emailError'] = 'Podaj email.';
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['emailError'] = 'Błędny format.';
            } else {
                if ($this->clientModel->findClientByEmail($data['email'])) {
                    $data['emailError'] = 'Email jest zajęty.';
                }
            }
            if (empty($data['phoneNumber'])) {
                $data['phoneNumberError'] = 'Podaj numer telefonu.';
            } elseif (!preg_match($phoneNumberValidation, $data['phoneNumber'])) {
                $data['phoneNumberError'] = 'Numer telefonu musi składać się z dziewięciu cyfr';
            }
            if (empty($data['companyName'])) {
                $data['companyNameError'] = 'Podaj nazwę firmy.';
            }
            if (empty($data['nameError']) &&
                empty($data['surnameError']) &&
                empty($data['emailError']) &&
                empty($data['phoneNumberError']) &&
                empty($data['companyNameError']) &&
                empty($data['cityNameError']) &&
                empty($data['postalCodeNameError']) &&
                empty($data['streetNameError'])
            ) {
                if ($this->clientModel->insert($data)) {
                    $this->view('Login');
                } else {
                    die('Coś poszło nie tak.');
                }
            }
        }
        $this->view('Client', $data);
    }
}