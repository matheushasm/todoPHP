<?php
session_start();

if(isset($_SESSION['admin_key'])) {
    header("location: admin.php");
    exit;
}
include_once 'partials/header.php';
?>
<div class="w-full h-full flex justify-center items-center bg-slate-900">
    <div class="w-1/4 h-2/6 ">
        <form class="p-4 flex flex-col border-2 border-cyan-600 rounded"
        method="POST" action="loginPageAuth.php">
            <input class="p-4 mb-2 bg-transparent text-lg text-white  outline-none"
            type="text" name="username" placeholder="Username"/>
            <input class="p-4 mb-2 bg-transparent text-lg text-white  outline-none"
            type="password" name="password" placeholder="Password"/>
            <input class="w-2/5 h-12 p-4 m-auto mb-2 bg-cyan-600 text-lg text-white text-center leading-3 rounded"
            type="submit" value="Login"/>
        </div>
    </div>
</div>

<?php include_once 'partials/footer.php' ?>