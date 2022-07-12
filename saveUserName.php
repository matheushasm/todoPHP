<?php
require_once 'config.php';
require_once __DIR__ . '/db/dao/UserDaoMysql.php';

$userDao = new UserDaoMysql($pdo);

$name = filter_input(INPUT_POST, 'name');

if($name) {
    $data = $userDao->getByUserKey($_COOKIE['user_key']);

    if($data) {
        $data->setName($name);
        $userDao->update($data);
    }
}
header("location: index.php");
exit;