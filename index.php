<?php
$timezone = date_default_timezone_set('Europe/Lisbon');
$time = date('H:i');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>To Do</title>
    <link rel="stylesheet" href="" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script type="text/javascript" src="./assets/js/api.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/geolocator/2.1.5/geolocator.min.js"></script>
</head>
<body style="text-shadow: 1px 1px #000"
    class="font-sans text-lg text-white bg-slate-900 select-none
            bg-neutral-900 bg-cover bg-center">

    <header class="fixed inset-x-0 p-4">
        <div class="flex justify-between ">
            <div>
                <input type="text" name="search" />
                <input type="submit" value="Search" />
            </div>
            <div>Weather</div>

        </div>  
    </header>

    <div class="h-screen container m-auto flex flex-col justify-center items-center ">
        <div class="p-6 flex flex-col items-center rounded hover:shadow-xl">
            <h2 id="clockArea" class="p-4 text-[10rem] font-bold"><?=$time;?></h2>
            <h4 id="clientName" class="mt-20 text-4xl"></h4>
        </div>
    </div>

    <footer class="fixed bottom-2 inset-x-0 h-18
            flex flex-col items-center
            text-xl ease-in duration-300 
            overflow-hidden">
            <p class="container m-auto text-center break-normal"></p>
            <p class="container m-auto text-center"><small></small></p> 
    </footer>

    <script type="text/javascript" src="./assets/js/script.js"></script>
</body>
</html>