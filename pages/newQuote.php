<?php
include 'partials/header.php';
?>

<h1>New Quote</h1>

<form method="POST" action="newQuoteAction.php"
class="flex flex-col">
    <label>
        Content:
        <input type="text" name="content"/>
    </label>
    <label>
        Author:
        <input type="text" name="author"/>
    </label>
    <input type="submit" value="save"/>
</form>

<?php
include 'partials/footer.php';
?>