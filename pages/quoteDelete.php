<?php
require_once '../config.php';
require_once '../db/dao/QuoteDaoMysql.php';

$quoteDao = new QuoteDaoMysql($pdo);
$id = filter_input(INPUT_GET, 'id');

if($id) {
    $quoteDao->delete($id);
}
header("location: admin.php");
exit;
?>