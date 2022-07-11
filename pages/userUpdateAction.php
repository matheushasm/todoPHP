<?php
require '../config.php';
require '../db/dao/userDaoMysql.php';

$userDao = new UserDaoMysql($pdo);

$id = filter_input(INPUT_POST, 'id');
$name = filter_input(INPUT_POST, 'name');
$location = filter_input(INPUT_POST, 'location');
$ip = filter_input(INPUT_POST, 'ip');
$user_key = filter_input(INPUT_POST, 'user_key');

if($id) {
    $user = new User();
    $user->setId($id);
    $user->setName($name);
    $user->setLocation($location);
    $user->setIp($ip);
    $user->setUser_key($user_key);

    $userDao->update($user);

    header("location: admin.php");
    exit;
} 

header("location: userUpdate.php");
exit;
?>