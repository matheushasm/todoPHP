<?php
require '../config.php';
require '../db/dao/QuoteDaoMysql.php';

$quoteDao = new QuoteDaoMysql($pdo);

$content = filter_input(INPUT_POST, 'content');
$author = filter_input(INPUT_POST, 'author');
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