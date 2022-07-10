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

include 'partials/header.php';
?>

<h1>Edit User</h1>

<form method="POST" action="userUpdateAction.php"
class="flex flex-col">
    <label>
        ID:
        <input type="text" name="id" value="<?=$user->getId()?>" />
    </label>
    <label>
        Name:
        <input type="text" name="name" value="<?=$user->getName()?>"/>
    </label>
    <label>
        Location:
        <input type="text" name="location" value="<?=$user->getLocation()?>"/>
    </label>
    <label>
        IP:
        <input type="text" name="ip" value="<?=$user->getIp()?>"/>
    </label>
    <label>
        User_key:
        <input type="text" name="user_key" value="<?=$user->getUser_key()?>"/>
    </label>
    <input type="submit" value="save"/>
</form>

<?php include 'partials/footer.php'; ?>