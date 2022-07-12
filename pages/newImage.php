<?php
include_once 'partials/header.php';
?>

<h1>New Image</h1>

<form method="POST" action="newImageAction.php"
class="flex flex-col">
    <label>
        Url:
        <input type="text" name="url"/>
    </label>
    <input type="submit" value="save"/>
</form>

<?php
include_once 'partials/footer.php';
?>