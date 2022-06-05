<?php
class ViewProjectController extends Controller
{
    private \Database $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    public function viewProject()
    {
        $this->db->query('SELECT * FROM projects');
        $this->db->execute();
        $projects = $this->db->fetchAll();
        $this->view = $this->view('viewProject', ['projects' => $projects]);
    }
}
