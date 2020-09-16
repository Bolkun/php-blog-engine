<?php

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function register($data)
    {
        $this->db->query('INSERT INTO user (firstname, surname, email, password, ip, verification_code) 
          VALUES (:firstname, :surname, :email, :password, :ip, :verification_code)');
        $this->db->bind(':firstname', $data['firstname']);
        $this->db->bind(':surname', $data['surname']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':ip', $data['ip']);
        $this->db->bind(':verification_code', $data['verification_code']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function setEmail($data)
    {
        $this->db->query('UPDATE user SET email = :new_email WHERE email = :session_email');
        $this->db->bind(':new_email', $data['email']);
        $this->db->bind(':session_email', $_SESSION['user_email']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function setPassword($data)
    {
        $this->db->query('UPDATE user SET password = :new_password WHERE email = :session_email');
        $this->db->bind(':new_password', $data['new_password']);
        $this->db->bind(':session_email', $_SESSION['user_email']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateAccountStatus($data)
    {
        $this->db->query('UPDATE user SET account_status = :account_status WHERE email = :email');
        $this->db->bind(':account_status', $data['account_status']);
        $this->db->bind(':email', $data['email']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateVerificationCode($data, $verification_code)
    {
        $this->db->query('UPDATE user SET verification_code = :verification_code WHERE email = :email');
        $this->db->bind(':verification_code', $verification_code);
        $this->db->bind(':email', $data['email']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updatePasswordTries($data)
    {
        $this->db->query('UPDATE user SET password_tries = :password_tries WHERE email = :email');
        $this->db->bind(':password_tries', $data['password_tries']);
        $this->db->bind(':email', $data['email']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function login($email, $password)
    {
        $this->db->query('SELECT * FROM user WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        $hashed_password = $row->password;

        // Compare password with hashed password from DB
        if (password_verify($password, $hashed_password)) {
            return $row;
        } else {
            return false;
        }
    }

    public function findUserIPs($ip)
    {
        $this->db->query('SELECT COUNT(*) AS "ip_count" FROM user WHERE ip = :ip');
        $this->db->bind(':ip', $ip);

        $row = $this->db->single();

        if ($row->ip_count < 6) {
            return true;
        } else {
            return false;
        }
    }

    public function findUserByEmail($email)
    {
        $this->db->query('SELECT * FROM user WHERE email = :email');
        $this->db->bind(':email', $email);

        $this->db->single();

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getUserRoleByEmail($email)
    {
        $this->db->query('SELECT role FROM user WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        return $row;
    }

    public function getUserAccountStatusByEmail($email)
    {
        $this->db->query('SELECT account_status FROM user WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        return $row;
    }

    public function getUserVerificationCodeByEmail($email)
    {
        $this->db->query('SELECT verification_code FROM user WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        return $row;
    }

    public function getPasswordTries($data)
    {
        $this->db->query('SELECT password_tries FROM user WHERE email = :email');
        $this->db->bind(':email', $data['email']);

        $row = $this->db->single();

        return $row;
    }

    public function getUserById($id)
    {
        $this->db->query('SELECT * FROM user WHERE user_id = :id');
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;
    }

}