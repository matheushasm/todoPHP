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
        $this->id = $i;
    }

    public function getName() {
        return $this->name;
    }
    public function setName($n) {
        $this->name = $n;
    }

    public function getLocation() {
        return $this->location;
    }
    public function setLocation($l) {
        $this->location = $l;
    }

    public function getIp() {
        return $this->ip;
    }
    public function setIp($i) {
        $this->ip = $i;
    }

    public function getUser_key() {
        return $this->key;
    }
    public function setUser_key($k) {
        $this->key = $k;
    }
}

interface UserDao {
    public function add(User $u);
    public function getAll();
    public function getByUserKey($user_key);
    public function getByName($name);
    public function getByLocation($location);
    public function update(User $u);
    public function delete($id);
}
?>