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

<h1 class="p-2 text-xl font-bold">Edit Quote</h1>

<div class="p-4">
    <form method="POST" action="quoteUpdateAction.php"
    class="max-w-sm p-2 flex flex-col border-2 gap-4">

        <label >
            <input type="hidden" name="id" value="<?=$quote->getId()?>"/>
        </label>

        <label class="w-full flex justify-between font-bold">
            Content:
            <input class="w-2/3 p-1 text-md font-normal text-center border"
            type="text" name="content" value="<?=$quote->getContent()?>"/>
        </label>

        <label class="w-full flex justify-between font-bold">
            Author:
            <input class="w-2/3 p-1 text-md font-normal text-center border"
            type="text" name="author" value="<?=$quote->getAuthor()?>"/>
        </label>

        <input class="p-2 bg-blue-400 rounded"
        type="submit" value="save"/>
    </form>
</div>

<?php include_once 'partials/footer.php'; ?>