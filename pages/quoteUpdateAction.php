<?php
require_once '../config.php';
require_once '../db/dao/QuoteDaoMysql.php';

$quoteDao = new QuoteDaoMysql($pdo);

$id = filter_input(INPUT_POST, 'id');
$content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);
$author = filter_input(INPUT_POST, 'author', FILTER_SANITIZE_STRING);


if($content && $author) {
    $q = new Quote();

    $q->setId($id);
    $q->setContent($content);
    $q->setAuthor($author);

    $quoteDao->update($q);

    header("location: admin.php");
    exit;
} 

header("location: quoteUpdate.php");
exit;
?>