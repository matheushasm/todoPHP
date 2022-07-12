<?php
session_start();
require_once '../config.php';
require_once '../db/dao/AdminDaoMysql.php';

$adminDao = new AdminDaoMysql($pdo);
$admin = false;

$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

if($username && $password) {

    $admin = $adminDao->getByUsername($username);
    if($admin) {
        if($password === $admin->getPassword()) {
            $adminDao->saveLastLog($admin->getId());
            $_SESSION['admin_key'] = true;
            header("location: admin.php");
            exit;
        }
    }
}
header("location: loginPage.php");
exit;
?>