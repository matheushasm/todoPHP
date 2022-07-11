<?php
require '../config.php';
require '../db/dao/QuoteDaoMysql.php';

$quoteDao = new QuoteDaoMysql($pdo);

$id = filter_input(INPUT_POST, 'id');
$content = filter_input(INPUT_POST, 'content');
$author = filter_input(INPUT_POST, 'author');


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