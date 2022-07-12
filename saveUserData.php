<?php
require_once 'config.php';
require_once __DIR__ . '/db/dao/UserDaoMysql.php';

$userDao = new UserDaoMysql($pdo);

$location = filter_input(INPUT_POST, 'location');
$ip = filter_input(INPUT_POST, 'ip');

$bytes = random_bytes(8);
$user_key = (string) bin2hex($bytes);
$cookieTime = time() + (86400 * 30);

$u = new User();
$u->setName('');
$u->setLocation($location ?: 'london');
$u->setIp($ip ?: 'none');
$u->setUser_key($user_key);

$userDao->add($u);


setcookie('user_key', $user_key, $cookieTime);

header("location: index.php");
exit;