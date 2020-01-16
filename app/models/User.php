<?php

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
	
	// Register User
    public function register($data)
    {
        $this->db->query('INSERT INTO user (firstname, surname, email, password) VALUES (:firstname, :surname, :email, :password)');
        // Bind values
        $this->db->bind(':firstname', $data['firstname']);
        $this->db->bind(':surname', $data['surname']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        // Execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function login($email, $password)
    {
        $this->db->query('SELECT * FROM user WHERE email = :email AND acount_status = 1');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        $hashed_password = $row->password;
        if(password_verify($password, $hashed_password)){
            return $row;
        } else {
            return false;
        }
    }

    // Find User By Email
    public function findUserByEmail($email)
    {
        $this->db->query('SELECT * FROM user WHERE email = :email');
        // Bind values
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        // Check row
        if($this->db->rowCount() > 0){
            return true;
        } else {
            return false;
        }
    }

    // Get User Role By Email
    public function getUserRoleByEmail($email)
    {
        $this->db->query('SELECT role FROM user WHERE email = :email');
        // Bind values
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        return $row;
    }

    // Get User By ID
    public function getUserById($id)
    {
        $this->db->query('SELECT * FROM user WHERE user_id = :id');
        // Bind values
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;
    }
}