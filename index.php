<?php
// require_once './requests/apiRequest.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>To Do</title>
    <link rel="stylesheet" href="assets/css/style.css" />
    <script src="https://cdn.tailwindcss.com"></script>

    <link href='https://css.gg/timer.css' rel='stylesheet'>
    <link href='https://css.gg/more.css' rel='stylesheet'>

</head>
<body
style="background-image: url(<?='https://images4.alphacoders.com/359/3596.jpg'//$bgImage;?>);text-shadow: 1px 1px #000"
class="font-sans text-lg text-white bg-slate-900 select-none
        bg-neutral-900 bg-cover bg-center"  
>
    <header class="fixed inset-x-0 p-4">
        <div class="flex justify-between ">
            <div>
                <input type="text" name="search" />
                <input type="submit" value="Search" />
            </div>

            <div id="weather" class="flex flex-col items-center justify-center rounded hover:shadow-xl hidden">
                <div class="flex p-2">
                    <img class="w-10 h-10 mr-2"/>
                    <div class="">
                        <h2 class="text-3xl"></h2>
                        <h4 class="text-center "></h4>
                    </div>
                </div>
            </div>
        </div>  
    </header>

    <main class="h-screen container m-auto flex flex-col justify-center items-center ">
        <div class="p-6 flex flex-col items-center rounded hover:shadow-xl">
            <h2 class="p-4 text-[10rem] font-bold"></h2>
            <h4 class="mt-20 mb-20 text-4xl none"></h4>

            <div id="logged" class="hidden" >
                <div id="timerButtonArea" class="fixed left-[30%] top-[60%] cursor-pointer hidden">
                    <i class="gg-timer"></i>
                    <div id="timerConfigArea" class="mt-2 p-2 bg-slate-900/40 rounded hover:shadow-xl hidden">
                        <div id="handleClockButton" class="hover:underline">Clock</div>
                        <div id="handlePomodoroButton" class="hover:underline">Pomodoro</div>
                        <div id="handleTimerButton" class="hover:underline">Timer</div>
                    </div>
                </div>
                <div id="configButtonArea" class="ml-4 absolute left-[68%] top-[62%] cursor-pointer hidden">
                    <i class="gg-more"></i>
                    <div id="userConfigurationArea" class="mt-2 p-2 bg-slate-900/40 rounded hover:shadow-xl hidden">
                        <div id="handleSetUserButton" class="hover:underline">Change User/Location</div>
                        <div id="handleSetPomodoroButton" class="hover:underline">Set Pomodoro</div>
                    </div>
                </div>
            </div>  

            <div id="unlogged" class="hidden">
                <input id="userName" class="text-black" type="text" placeholder="What is your name?"/>
                <input id="userLocation" class="text-black" type="text" placeholder="What is your City?"/>
                <button>Save</button>
            </div>      
        </div>
    </main>

    <footer class="fixed bottom-2 inset-x-0 h-18
            flex flex-col items-center
            text-xl ease-in duration-300 
            overflow-hidden">
            <p class="container m-auto text-center break-normal"><?='Loren Ipsun Loren Ipsun Loren Ipsun Loren Ipsun'//$quote->content;?></p>
            <p class="container m-auto text-center"><small><?='Loren Ipsun'//$quote->originator->name;?></small></p> 
    </footer>

    <script type="text/javascript" src="./assets/js/script.js"></script>
</body>
</html>