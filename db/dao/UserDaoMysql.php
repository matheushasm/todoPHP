<?php 
require_once 'db/models/User.php';

class UserDaoMysql implements UserDao {
    private $pdo;

    public function __construct(PDO $driver) {
        $this->pdo = $driver;
    }

    public function add(User $u) {
        $sql = $this->pdo->prepare("INSERT INTO users (name, location, ip, user_key) VALUES (:name, :location, :ip, :user_key)");
        $sql->bindValue(':name', $u->getName());
        $sql->bindValue(':location', $u->getLocation());
        $sql->bindValue(':ip', $u->getIp());
        $sql->bindValue('user_key', $u->getUser_key());
    }

    public function getAll() {
        $array = [];

        $sql = $this->pdo->query("SELECT * FROM users");
        if($sql->rowCount() > 0) {
            $data = $sql->fetchAll();

            foreach($data as $item) {
                $u = new User();

                $u->setId($item['id']);
                $u->setName($item['name']);
                $u->setLocation($item['location']);
                $u->setIp($item['ip']);
                $u->setUser_key($item['user_key']);

                $array = $u;
            }
        }
        return $array;
    }

    public function getByUserKey($user_key) {
        $sql = $this->pdo->prepare("SELECT * FROM users WHERE user_key = :user_key");
        $sql->bindValue(':user_key', $user_key);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $data = $sql->fetch();

            $u = new User();
            $u->setId($data['id']);
            $u->setName($data['name']);
            $u->setLocation($data['location']);
            $u->setIp($data['ip']);
            $u->setUser_key($data['user_key']);

            return $u;   
        } else {
            return false;
        }
    }

    public function getByName($name) {
        $sql = $this->pdo->prepare("SELECT * FROM users WHERE name = :name");
        $sql->bindValue(':name', $name);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $data = $sql->fetch();

            $u = new User();
            $u->setId($data['id']);
            $u->setName($data['name']);
            $u->setLocation($data['location']);
            $u->setIp($data['ip']);
            $u->setUser_key($data['user_key']);

            return $u;   
        } else {
            return false;
        }
    }

    public function getByLocation($location) {
        $sql = $this->pdo->prepare("SELECT * FROM users WHERE location = :location");
        $sql->bindValue(':location', $location);
        $sql->execute();

        if($sql->rouCount() > 0) {
            $data = $sql->fetch();

            $u = new User();
            $u->setId($data['id']);
            $u->setName($data['name']);
            $u->setLocation($data['location']);
            $u->setIp($data['ip']);
            $u->setUser_key($data['user_key']);

            return $u;   
        } else {
            return false;
        }
    }

    public function update(User $u) {
        $sql = $this->pdo->prepare("UPDATE users SET 
            name = :name, 
            location = :location, 
            ip = :ip, 
            user_key = :user_key");
        $sql->bindValue(':name', $u->getName());
        $sql->bindValue(':location', $u->getLocation());
        $sql->bindValue(':ip', $u->getIp());
        $sql->bindValue(':user_key', $u->getUser_key());
        $sql->execute();

        return true;
    }

    public function delete($id) {
        $sql = $this->pdo("DELETE FROM users WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
    }
}
?>