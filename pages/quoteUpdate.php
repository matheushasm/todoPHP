<?php
require '../config.php';
require '../db/dao/QuoteDaoMysql.php';

$quoteDao = new QuoteDaoMysql($pdo);
$quote = false;

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_INT);

if($id) {
    $quote = $quoteDao->getById($id);
}
if($quote === false) {
    header("location: admin.php");
    exit;
}

include 'partials/header.php';
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

<?php include 'partials/footer.php'; ?>