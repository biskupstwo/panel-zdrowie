<?php

class DeleteController extends Controller
{
    private \Database $db;
    public function __construct()
    {
        $this->db = new Database();
    }
    public function delete(){

    
        $this->db->query('DELETE FROM tasks WHERE id = :id');
        $this->db->bind(':id', $_GET['id']);
        $this->db->execute();
        //$this->view = $this->view('Timer', ['task_in_progress' => $tasks_in_progress, 'archived_tasks' => $archived_tasks]);
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
}