<?php
require_once 'db/models/Image.php';

class ImageDaoMysql implements ImageDao {
    private $pdo;

    public function __construct(PDO $driver) {
        $this->pdo = $driver;
    }

    public function add(Image $u) {
        $sql = $this->pdo->prepare("INSERT INTO images (url) VALUES (:url)");
        $sql->bindValue(':url', $u);
        $sql->execute();

        $u->setId($this->pdo->lastInsertId());
        return $u;
    }

    public function getAll() {
        $array = [];

        $sql = $this->pdo->query("SELECT * FROM images");
        if($sql->rowCount() > 0) {
            $data = $sql->fetchAll();

            foreach($data as $item) {
                $i = new Image();
                $i->setId($item['id']);
                $i->setUrl($item['url']);

                $array = $i;
            }
        }
        return $array;
    }

    public function getById($id) {
        $sql = $this->pdo->prepare("SELECT * FROM images WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $data = $sql->fetch();

            $i = new Image();
            $i->setId($data['id']);
            $i->setUrl($data['url']);

            return $i;
        } else {
            return false;
        }
    }

    public function delete($id) {
        $sql = $this->pdo->prepare("DELETE FROM images WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
    }
}
?>