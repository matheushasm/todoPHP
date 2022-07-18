<?php 
session_start();
require_once '../config.php';

require_once '../db/dao/UserDaoMysql.php';
require_once '../db/dao/QuoteDaoMysql.php';
require_once '../db/dao/ImageDaoMysql.php';

include_once 'partials/header.php';

$userDao = new UserDaoMysql($pdo);
$userList = $userDao->getAll();

$quoteDao = new QuoteDaoMysql($pdo);
$quoteList = $quoteDao->getAll();

$imageDao = new ImageDaoMysql($pdo);
$imageList = $imageDao->getAll();

if(!isset($_SESSION['admin_key'])) {
    header("location: loginPage.php");
    exit;
}
?>
<div class="p-4 overflow-hidden">
    
    <section class="mb-8 hover:overflow-y-auto" >
        <div class="mb-4">
            <h2 class="text-xl font-bold">Users</h2>
            <span>Total: <?=count($userList)?> users</span>
        </div>

        <table class="w-[900px]">  
            <thead class="bg-blue-400">
                <tr>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>LOCATION</th>
                    <th>IP</th>
                    <th>ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($userList as $user): ?>
                    <tr class="border">
                        <td class="p-2 text-center border"><?=$user->getId();?></td>
                        <td class="p-2 text-center border"><?=$user->getName();?></td>
                        <td class="p-2 text-center border"><?=$user->getLocation();?></td>
                        <td class="p-2 text-center border"><?=$user->getIp();?></td>
                        <td class="p-2 text-center border">
                            <a href="userUpdate.php?id=<?=$user->getId()?>"> [Edit] </a>
                            <a href="userDelete.php?id=<?=$user->getId()?>"> [Delete] </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>

    <section class="mb-8 hover:overflow-auto">

        <div class="mb-4">
            <h2 class="text-xl font-bold">Quotes</h2>
            <span>Total: <?=count($quoteList)?> quotes</span>
        </div>

        <a class="p-1 bg-orange-400" href="newQuote.php" >Add New Quote</a>

        <table class="w-[900px]"> 
            <thead class="bg-blue-400">
                <tr>
                    <th>ID</th>
                    <th>CONTENT</th>
                    <th>AUTHOR</th>
                    <th>ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($quoteList as $quote): ?>
                    <tr class="border">
                        <td class="p-2 text-center border"><?=$quote->getId();?></td>
                        <td class="p-2 text-center border"><?=$quote->getContent();?></td>
                        <td class="p-2 text-center border"><?=$quote->getAuthor();?></td>
                        <td class="p-2 text-center border">
                            <a href="quoteUpdate.php?id=<?=$quote->getId()?>"> [Edit] </a>
                            <a href="quoteDelete.php?id=<?=$quote->getId()?>"> [Delete] </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>

    <section>

        <div class="mb-4">
            <h2 class="text-xl font-bold">Images</h2>
            <span>Total: <?=count($imageList)?> images</span>
        </div>

        <a class="p-1 bg-orange-400" href="newImage.php">Add new Image</a>

        <div class="grid grid-cols-2 gap-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5">
            <?php foreach($imageList as $image): ?>
                <div class="bg-black/50">
                    <img src="<?=$image->getUrl()?>" alt=""/>
                    <div class="flex justify-around p-1" >
                        <div class="w-full mr-2 p-1 text-center bg-white"><?=$image->getId()?></div>
                        <a class="w-full p-1 text-center bg-white" href="imageDelete.php?id=<?=$image->getId()?>">X</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

</div>
<?php include_once 'partials/footer.php';