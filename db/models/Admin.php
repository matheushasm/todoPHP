<?php

class Admin {
    private $id;
    private $username;
    private $password;
    private $email;
    private $log;

    public function getId() {
        return $this->id;
    }
    public function setId($i) {
        $this->id = trim($i);
    }

    public function getUsername() {
        return $this->username;
    }
    public function setUsername($u) {
        $this->username = trim(strtolower($u));
    }

    public function getPassword() {
        return $this->password;
    }
    public function setPassword($p) {
        $this->password = trim($p);
    }

    public function getEmail() {
        return $this->email;
    }
    public function setEmail($e) {
        $this->email = trim(strtolower($e));
    }

    public function getLog() {
        return $this->log;
    }
    public function setLog($l) {
        $this->log = trim($l);
    }
}

interface AdminDao {
    public function getByUsername(Admin $u);
    public function saveLastLog($id);
}