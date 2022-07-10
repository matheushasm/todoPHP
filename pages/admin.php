<?php 
require '../config.php';

require '../db/dao/UserDaoMysql.php';
require '../db/dao/QuoteDaoMysql.php';
require '../db/dao/ImageDaoMysql.php';

include 'partials/header.php';

$userDao = new UserDaoMysql($pdo);
$userList = $userDao->getAll();

$quoteDao = new QuoteDaoMysql($pdo);
$quoteList = $quoteDao->getAll();

$imageDao = new ImageDaoMysql($pdo);
$imageList = $imageDao->getAll();

?>

<div    
class="mt-4 flex justify-center"
>
    <div class="flex rounded overflow-hidden">
        <div onclick="showUsers()" id="handleUsersButton" class="p-2 px-12 bg-purple-900/60">Users</div>
        <div onclick="showQuotes()" id="handleQuotesButton" class="p-2 px-12 bg-purple-900/60">Quotes</div>
        <div onclick="showImages()" id="handleImagesButton" class="p-2 px-12 bg-purple-900/60">Images</div>
    </div>
</div>

<section id="usersArea"
class=""
>
    <h2>Users</h2>
    <table> 
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
            <td>
                <a href="userUpdate.php?id=<?=$user->getId()?>"> [Edit] </a>
                <a href="userDelete.php?id=<?=$user->getId()?>"> [Delete] </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</section>

<section id="quotesArea"
class=""
>
    <h2>Quotes</h2>
    <a href="newQuote.php">Add New Quote</a>
    <table> 
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
</section>

<section id="imagesArea"
class=""
>
    <h2>Images</h2>
    <a href="newImage.php">Add new Image</a>
    <?php foreach($imageList as $image): ?>
        <div class="w-32 h-32">
            <img src="<?=$image->getUrl()?>" alt=""/>
            <div><?=$image->getId()?></div>
        </div>

    <?php endforeach; ?>
</section>




<script type="text/javascript">
    function showUsers() {

    }
    function showQuotes() {
        
    }
    function showImages() {
        
    }
</script>

<?php include 'partials/footer.php';