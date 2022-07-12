<?php
include_once 'partials/header.php';
?>

<div>
    <div>
        <form method="POST" action="loginPageAuth.php">
            <input type="text" name="username" placeholder="Username"/>
            <input type="password" name="password" placeholder="Password"/>
            <input type="submit"/>
        </div>
    </div>
</div>

<?php include_once 'partials/footer.php' ?>