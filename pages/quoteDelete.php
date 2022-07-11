<?php
require '../config.php';
require '../db/dao/QuoteDaoMysql.php';

$quoteDao = new QuoteDaoMysql($pdo);
$id = filter_input(INPUT_GET, 'id');

if($id) {
    $quoteDao->delete($id);
}
header("location: admin.php");
exit;
?>