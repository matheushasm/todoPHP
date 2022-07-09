<?php 

class Quote {
    private $id;
    private $content;
    private $author;

    public function getId() {
        return $this->id;
    }
    public function setId($i) {
        $this->id = $i;
    }

    public function getContent() {
        return $this->content;
    }
    public function setContent($c) {
        $this->content = $c;
    }

    public function getAuthor() {
        return $this->author;
    }
    public function setAuthor($a) {
        $this->author = $a;
    }
}

interface QuoteDao {
    public function add(Quote $q);
    public function getAll();
    public function getById($id);
    public function delete($id);
}
?>