<?php
require_once '../db/models/Admin.php';

class AdminDaoMysql implements AdminDao {
    private $pdo;

    public function __construct(PDO $driver) {
        $this->pdo = $driver;
    }

    public function getByUsername($user) {
        $sql = $this->pdo->prepare("SELECT * FROM admin WHERE username = :username");
        $sql->bindValue(':username', $user);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $data = $sql->fetch();

            $a = new Admin();
            $a->setId($data['id']);
            $a->setUsername($data['username']);
            $a->setPassword($data['password']);
            $a->setEmail($data['email']);
            $a->setLog($data['log']);

            return $a;
        } else {
            return false;
        }
    }
}