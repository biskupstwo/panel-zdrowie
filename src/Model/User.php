<?php

class User
{
    private $user_id;
    private $username;
    private $surname;
    private $login;
    private $email;
    private $password;

    private \Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getUserById($id)
    {
        return 'User: ' . $id;
    }

    public function register($data)
    {
        $this->db->query('INSERT INTO users (username, user_role, surname, login, email, password) VALUES(:username, :user_role, :surname, :login, :email, :password)');

        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':user_role', 0);
        $this->db->bind(':surname', $data['surname']);
        $this->db->bind(':login', $data['login']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function login($data)
    {
        $this->db->query('SELECT PASSWORD, id, user_role FROM users WHERE login = :login');
        $this->db->bind(':login', $data['login']);
        $this->db->execute();
        $query = $this->db->fetch();
        if ($this->db->rowCount() > 0 && password_verify($data['password'], $query['PASSWORD'])) {
            $_SESSION['user_role'] = $query['user_role'];
            $_SESSION['user_id'] = $query['id'];
            return true;
        } else {
            return false;
        }
    }
    public function findUserByEmail($email)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function findUserByLogin($login)
    {
        $this->db->query('SELECT * FROM users WHERE login = :login');

        $this->db->bind(':login', $login);

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
