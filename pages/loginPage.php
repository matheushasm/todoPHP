<?php
session_start();

if(isset($_SESSION['admin_key'])) {
    header("location: admin.php");
    exit;
}
include_once 'partials/header.php';
?>
<div class="w-full h-full flex justify-center items-center bg-slate-900">
    <div class="container p-4">
        <form class="m-auto p-2 max-w-sm flex flex-col border-2 border-cyan-600 rounded-md"
        method="POST" action="loginPageAuth.php">
            <input class="p-2 mt-2 mb-2 bg-transparent text-lg text-white text-center border-b border-white/40 outline-none"
            type="text" name="username" placeholder="Username"/>
            <input class="p-2 mt-2 mb-6 bg-transparent text-lg text-white text-center border-b border-white/40 outline-none"
            type="password" name="password" placeholder="Password"/>
            <input class="p-4 m-auto mb-2 bg-cyan-600 text-lg text-white text-center leading-3 rounded hover:bg-cyan-600/40 ease-in duration-150 "
            type="submit" value="Login"/>
        </div>
    </div>
</div>

<?php include_once 'partials/footer.php' ?>