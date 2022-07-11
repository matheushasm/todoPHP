<?php 

class Quote {
    private $id;
    private $content;
    private $author;

    public function getId() {
        return $this->id;
    }
    public function setId($i) {
        $this->id = trim($i);
    }

    public function getContent() {
        return $this->content;
    }
    public function setContent($c) {
        $this->content = trim(ucfirst($c));
    }

    public function getAuthor() {
        return $this->author;
    }
    public function setAuthor($a) {
        $this->author = trim(ucfirst($a));
    }
}

interface QuoteDao {
    public function add(Quote $q);
    public function getAll();
    public function getById($id);
    public function update(Quote $u);
    public function delete($id);
}
?>