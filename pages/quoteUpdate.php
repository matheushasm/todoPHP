<?php
require_once '../config.php';
require_once '../db/dao/QuoteDaoMysql.php';

$quoteDao = new QuoteDaoMysql($pdo);
$quote = false;

$id = filter_input(INPUT_GET, 'id');

if($id) {
    $quote = $quoteDao->getById($id);
}
if($quote === false) {
    header("location: admin.php");
    exit;
}

include_once 'partials/header.php';
?>

<h1>Edit Quote</h1>

<form method="POST" action="quoteUpdateAction.php"
class="flex flex-col">
    <label>
        <input type="hidden" name="id" value="<?=$quote->getId()?>"/>
    </label>
    <label>
        Content:
        <input type="text" name="content" value="<?=$quote->getContent()?>"/>
    </label>
    <label>
        Author:
        <input type="text" name="author" value="<?=$quote->getAuthor()?>"/>
    </label>
    <input type="submit" value="save"/>
</form>

<?php include_once 'partials/footer.php'; ?>