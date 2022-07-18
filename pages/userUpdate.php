<?php
require_once '../config.php';
require_once '../db/dao/userDaoMysql.php';

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

include_once 'partials/header.php';
?>

<h1 class="p-2 text-xl font-bold">Edit User</h1>

<div class="p-4">
    <form method="POST" action="userUpdateAction.php"
    class="max-w-sm p-2 flex flex-col border-2 gap-4">

        <label class="w-full flex justify-between font-bold">
            ID:
            <input class="w-2/3 p-1 text-md font-normal text-center border"
            type="text" name="id" value="<?=$user->getId()?>" />
        </label>

        <label class="w-full flex justify-between font-bold">
            Name:
            <input class="w-2/3 p-1 text-md font-normal text-center border"
            type="text" name="name" value="<?=$user->getName()?>"/>
        </label>

        <label class="w-full flex justify-between font-bold">
            Location:
            <input class="w-2/3 p-1 text-md font-normal text-center border"
            type="text" name="location" value="<?=$user->getLocation()?>"/>
        </label>

        <label class="w-full flex justify-between font-bold">
            IP:
            <input class="w-2/3 p-1 text-md font-normal text-center border"
            type="text" name="ip" value="<?=$user->getIp()?>"/>
        </label>

        <label class="w-full flex justify-between font-bold">
            User_key:
            <input class="w-2/3 p-1 text-md font-normal text-center border"
            type="text" name="user_key" value="<?=$user->getUser_key()?>"/>
        </label>

        <input class="p-2 bg-blue-400 rounded" 
        type="submit" value="save"/>
    </form>
</div>
<?php include_once 'partials/footer.php'; ?>