<?php
include 'partials/header.php';

$user = getenv('USER_NAME');
$pass = getenv('PASS_WORD');
echo $user.$pass;
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

<?php include 'partials/footer.php' ?>