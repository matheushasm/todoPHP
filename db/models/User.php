<?php

class User {
    private $id;
    private $name;
    private $location;
    private $ip;
    private $userKey;

    public function getId() {
        return $this->id;
    }
    public function setId($i) {
        $this->id = trim($i);
    }

    public function getName() {
        return $this->name;
    }
    public function setName($n) {
        $this->name = trim(ucfirst($n));
    }

    public function getLocation() {
        return $this->location;
    }
    public function setLocation($l) {
        $this->location = trim(ucfirst($l));
    }

    public function getIp() {
        return $this->ip;
    }
    public function setIp($i) {
        $this->ip = trim($i);
    }

    public function getUser_key() {
        return $this->userKey;
    }
    public function setUser_key($k) {
        $this->userKey = trim($k);
    }
}

interface UserDao {
    public function add(User $u);
    public function getAll();
    public function getById($id);
    public function getByUserKey($user_key);
    public function getByName($name);
    public function getByLocation($location);
    public function update(User $u);
    public function delete($id);
}
?>