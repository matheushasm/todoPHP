<?php
require_once __DIR__ . '../../models/Quote.php';

class QuoteDaoMysql implements QuoteDao {
    private $pdo;

    public function __construct(PDO $driver) {
        $this->pdo = $driver;
    }

    public function add(Quote $q) {
        $sql = $this->pdo->prepare("INSERT INTO quotes (content, author) VALUES (:content, :author)");
        $sql->bindValue(':content', $q->getContent());
        $sql->bindValue(':author', $q->getAuthor());
        $sql->execute();

        $q->setId($this->pdo->lastInsertId());
        return $q;
    }

    public function getAll() {
        $array = [];

        $sql = $this->pdo->query("SELECT * FROM quotes");
        if($sql->rowCount() > 0) {}
        $data = $sql->fetchAll();

        foreach($data as $item) {
            $q = new Quote();
            $q->setId($item['id']);
            $q->setContent($item['content']);
            $q->setAuthor($item['author']);

            $array[] = $q;
        }
        return $array;
    }

    public function getById($id) {
        $sql = $this->pdo->prepare("SELECT * FROM quotes WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $data = $sql->fetch();

            $q = new Quote();
            $q->setId($data['id']);
            $q->setContent($data['content']);
            $q->setAuthor($data['author']);

            return $q;
        } else {
            return false;
        }
    }

    public function update(Quote $u) {
        $sql = $this->pdo->prepare("UPDATE quotes SET content = :content, author = :author WHERE id = :id");
        $sql->bindValue(':content', $u->getContent());
        $sql->bindValue(':author', $u->getAuthor());
        $sql->bindValue(':id', $u->getId());
        $sql->execute();
    }

    public function delete($id) {
        $sql = $this->pdo->prepare("DELETE FROM quotes WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
    }
}