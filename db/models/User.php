<?php

class User {
    private $id;
    private $name;
    private $location;
    private $ip;
    private $hash;

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

    public function getHash() {
        return $this->hash;
    }
    public function setHash($h) {
        $this->hash = $h;
    }
}

interface UserDao {
    public function add(User $u);
    public function getAll();
    public function getByHash($hash);
    public function getByName($name);
    public function getByLocation($location);
    public function update(User $u);
    public function delete($id);
}
?>