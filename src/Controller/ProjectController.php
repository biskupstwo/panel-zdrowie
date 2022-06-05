<?php

class ProjectController extends Controller
{
    private $projectModel;
    private $clientModel;

    public function __construct()
    {
        $this->projectModel = $this->model('Project');
        $this->clientModel = $this->model('Client');
    }

    function createProject()
    {
        $clients = $this->clientModel->getAllClients();
        $convertedClients = [];
        foreach ($clients as &$value) {
            $convertedClients += [$value['client_id'] => $value['company_name']];
        }

        $data = [
            'name' => '',
            'nameError' => '',
            'description' => '',
            'descriptionError' => '',
            'creationDate' => '',
            'creationDateError' => '',
            'projectManager' => '',
            'projectManagerError' => '',
            'clientId' => '',
            'clientIdError' => '',
            'clients' => $convertedClients
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'name' => trim($_POST['name']),
                'nameError' => '',
                'description' => trim($_POST['description']),
                'descriptionError' => '',
                'creationDate' => trim($_POST['creationDate']),
                'creationDateError' => '',
                'projectManager' => trim($_POST['projectManager']),
                'projectManagerError' => '',
                'clientId' => trim($_POST['clientId']),
                'clientIdError' => '',
                'clients' => $convertedClients
            ];

            if (empty($data['name'])) {
                $data['nameError'] = 'Podaj nazwę projektu.';
            } elseif ($this->projectModel->findProjectByName($data['name'])) {
                $data['nameError'] = 'Podana nazwa istnieje.';
            }

            if (empty($data['description'])) {
                $data['descriptionError'] = 'Dodaj opis.';
            }

            if (empty($data['clientId'])) {
                $data['clientIdError'] = 'Wybierz klienta';
            }

            if (empty($data['projectManager'])) {
                $data['projectManagerError'] = 'Wpisz menadżera projektu.';
            }

            if (empty($data['creationDate'])) {
                $data['creationDateError'] = 'Podaj datę';
            }

            if (empty($data['nameError']) &&
                empty($data['descriptionError']) &&
                empty($data['creationDateError']) &&
                empty($data['clientIdError']) &&
                empty($data['projectManagerError'])) {
                if ($this->projectModel->create($data)) {
                    $this->view('Login');
                } else {
                    die('Coś poszło nie tak.');
                }
            }
        }
        $this->view('Project', $data);
    }
}