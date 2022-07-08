<?php

class Image {
    private $id;
    private $url;

    public function getId() {
        return $this->id;
    }
    public function setId($i) {
        $this->id = $i;
    }

    public function getUrl() {
        return $this->url;
    }
    public function setUrl($u) {
        $this->url = $u;
    }
}

interface ImageDao {
    public function add(Image $i);
    public function getAll();
    public function getById($id);
    public function delete($id);
}
?>