<?php

class TimerController extends Controller
{
    private \Database $db;
    public function __construct()
    {
        $this->db = new Database();
    }
    public function show()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $start_timer = (bool)$_POST['timer'];
            if ($start_timer) {
                $this->db->query('INSERT INTO tasks (user_id, task_name, start_date, finished) VALUES(:user_id, :task_name, :start_date, :finished)');
                $this->db->bind(':user_id', (int)$_SESSION['user_id']);
                $this->db->bind(':start_date', date("Y-m-d H:i:s"));
                $this->db->bind(':task_name', $_POST['task_name']);
                $this->db->bind(':finished', 0);
                $this->db->execute();
            } else {
                $this->db->query('UPDATE tasks SET finished = 1, end_date = :end_date WHERE user_id = :user_id AND finished = 0');
                $this->db->bind(':user_id', (int)$_SESSION['user_id']);
                $this->db->bind(':end_date', date("Y-m-d H:i:s"));
                $this->db->execute();
            }
        }
        $this->db->query('SELECT start_date, task_name, id as taskId FROM tasks WHERE user_id = :user_id AND finished = 0');
        $this->db->bind(':user_id', (int)$_SESSION['user_id']);
        $this->db->execute();
        $tasks_in_progress = $this->db->fetch();
        $this->db->query('SELECT * FROM tasks WHERE user_id = :user_id AND finished = 1');
        $this->db->bind(':user_id', (int)$_SESSION['user_id']);
        $this->db->execute();
        $archived_tasks = $this->db->fetchAll();
        $this->view = $this->view('Timer', ['task_in_progress' => $tasks_in_progress, 'archived_tasks' => $archived_tasks]);
    }
    public function stop_timer()
    {
    }
}
