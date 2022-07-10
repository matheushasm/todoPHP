<?php
require '../config.php';
require '../db/dao/userDaoMysql.php';

$userDao = new UserDaoMysql($pdo);

$user = false;
$id = filter_input(INPUT_GET, 'id');

if($id) {
    $user = $userDao->getById($id);
}
if($user === false) {
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