<?php

class Project
{
    private $project_id;
    private $name;
    private $description;
    private $creation_date;
    private $project_manager;
    private $client_id;


    private \Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function create($data)
    {
        $this->db->query('INSERT INTO projects (name, description, creation_date, project_manager, client_id) VALUES(:name,:description,:creationDate,:projectManager,:clientId)');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':creationDate', $data['creationDate']);
        $this->db->bind(':projectManager', $data['projectManager']);
        $this->db->bind(':clientId', $data['clientId']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function findProjectByName($name)
    {
        $this->db->query('SELECT * FROM projects WHERE name = :name');
        $this->db->bind(':name', $name);
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

}