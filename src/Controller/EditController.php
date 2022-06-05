<?php

class EditController extends Controller
{
    private \Database $db;
    public function __construct()
    {
        $this->db = new Database();
    }
    public function edit()
    {
        $data = [
            'task_name' => ''
        ];
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $_POST = filter_input_array(INPUT_POST);
            $data = [
                'task_name' => trim($_POST['task_name'])
            ];
            $this->db->query('UPDATE tasks SET task_name = :task_name WHERE id = :id');
            $this->db->bind(':task_name', $data['task_name']);
            $this->db->bind(':id', $_SESSION['tid']);
            $this->db->execute();
        }
        $this->db->query('SELECT * FROM tasks WHERE id = :id');
        $this->db->bind(':id', $_SESSION['tid']);
        $this->db->execute();
        $task = $this->db->fetchAll();
        $this->view('edit', $task);
    }
}