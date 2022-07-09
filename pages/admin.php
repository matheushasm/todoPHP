<?php 
require '../config.php';

require '../db/dao/UserDaoMysql.php';
require '../db/dao/QuoteDaoMysql.php';
require '../db/dao/ImageDaoMysql.php';

$userDao = new UserDaoMysql($pdo);
$userList = $userDao->getAll();

$quoteDao = new QuoteDaoMysql($pdo);
$quoteList = $quoteDao->getAll();

$imageDao = new ImageDaoMysql($pdo);
$imageList = $imageDao->getAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin To_Do</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <header 
    class="mt-4 flex justify-center"
    >
        <div class="flex rounded overflow-hidden">
            <div class="p-2 px-12 bg-purple-900/60">Images</div>
            <div class="p-2 px-12 bg-purple-900/60">Quotes</div>
            <div class="p-2 px-12 bg-purple-900/60">Users</div>
        </div>
    </header>

    <table> 
        <h2>Users</h2>
        <tr>
            <th>ID</th>
            <th>NAME</th>
            <th>LOCATION</th>
            <th>IP</th>
        </tr>
        <?php foreach($userList as $user): ?>
        <tr>
            <td><?=$user->getId();?></td>
            <td><?=$user->getName();?></td>
            <td><?=$user->getLocation();?></td>
            <td><?=$user->getIp();?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <table> 
        <h2>Quotes</h2>
        <tr>
            <th>ID</th>
            <th>CONTENT</th>
            <th>AUTHOR</th>
        </tr>
        <?php foreach($quoteList as $quote): ?>
        <tr>
            <td><?=$quote->getId();?></td>
            <td><?=$quote->getContent();?></td>
            <td><?=$quote->getAuthor();?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <div>
        <?php foreach($imageList as $image): ?>
            <div class="w-32 h-32">
                <img src="<?=$image->getUrl()?>" alt=""/>
                <div><?=$image->getId()?></div>
            </div>

        <?php endforeach; ?>
    </div>


</body>
</html>

