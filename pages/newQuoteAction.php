<?php
require_once '../config.php';
require_once '../db/dao/QuoteDaoMysql.php';

$quoteDao = new QuoteDaoMysql($pdo);

$content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);
$author = filter_input(INPUT_POST, 'author', FILTER_SANITIZE_STRING);
if($content && $author) {
    $q = new Quote();
    $q->setContent($content);
    $q->setAuthor($author);

    $quoteDao->add($q);

    header("location: admin.php");
    exit;
} 
header("location: newQuote.php");
exit;
?>