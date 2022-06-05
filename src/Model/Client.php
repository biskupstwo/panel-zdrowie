<?php

class Client
{

    private $client_id;
    private $name;
    private $surname;
    private $email;
    private $phone_number;
    private $company_name;
    private $city;
    private $postal_code;
    private $street;

    private \Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function insert($data)
    {
        $this->db->query('INSERT INTO clients (name, surname, email, phone_number, company_name,city,postal_code,street) VALUES(:name, :surname, :email, :phoneNumber, :companyName,:city,:postalCode,:street)');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':surname', $data['surname']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':phoneNumber', $data['phoneNumber']);
        $this->db->bind(':companyName', $data['companyName']);
        $this->db->bind(':city', $data['city']);
        $this->db->bind(':postalCode', $data['postalCode']);
        $this->db->bind(':street', $data['street']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function findClientByEmail($email)
    {
        $this->db->query('SELECT * FROM clients WHERE email = :email');
        $this->db->bind(':email', $email);
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllClients()
    {
        $this->db->query('SELECT * FROM clients');
        $this->db->execute();
        return $this->db->fetchAll();
    }
}