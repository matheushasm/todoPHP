<?php
include_once 'partials/header.php';
?>

<h1 class="p-2 text-xl font-bold">New Quote</h1>

<div class="p-4">
    <form method="POST" action="newQuoteAction.php"
    class="max-w-sm p-2 flex flex-col border-2 gap-4">

        <label class="w-full flex justify-between font-bold">
            Content:
            <input class="w-2/3 p-1 text-md font-normal text-center border"
            type="text" name="content"/>
        </label>

        <label class="w-full flex justify-between font-bold">
            Author:
            <input class="w-2/3 p-1 text-md font-normal text-center border"
            type="text" name="author"/>
        </label>

        <input class="p-2 bg-blue-400 rounded"
        type="submit" value="save"/>
    </form>
</div>

<?php
include_once 'partials/footer.php';
?>