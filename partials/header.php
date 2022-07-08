<?php 

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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>  

</head>
<body
style="background-image: url(<?='https://images.unsplash.com/photo-1542351567-cd7b06dc08d7?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxleHBsb3JlLWZlZWR8M3x8fGVufDB8fHx8&w=1000&q=80'?>);text-shadow: 1px 1px #000"
class="font-sans text-lg text-white bg-slate-900 select-none
        bg-neutral-900 bg-cover bg-center"
>
    <header class="fixed inset-x-0 p-4">
        <div class="flex justify-between ">
            <div>
                <input type="text" name="search" />
                <input type="submit" value="Search" />
            </div>

            <div id="weather" class="flex flex-col items-center justify-center rounded hidden hover:shadow-xl">
                <div class="flex p-2">
                    <img class="w-12 h-12 mr-2"/>
                    <div class="">
                        <h2 class="text-3xl"></h2>
                        <h4 class="text-center "></h4>
                    </div>
                </div>
            </div>
            <div id="fullWeather" class="bg-slate-900/80 rounded-xl overflow-hidden opacity-0 hidden ">
                <div id="fullWeatherLocation" class="p-2 text-xl font-bold bg-gray-700">Faro, Portugal</div>
                <div id="fullWeatherMain" class="p-2 flex justify-between">
                    <h4 class="text-5xl font-bold">20º C</h4>
                    <img/>
                </div>
                <div id="fullWeaderMinMax" class="p-2">
                    <h2 class="mb-2 text-2xl text-center">Cloud</h2>
                    <h4 class="text-sm font-bold text-center" >min/max</h4>
                </div>

                <div class="p-4 grid gap-4 grid-cols-2">
                    <div id="termal" class="bg-blue-500/50 overflow-hidden rounded-xl">
                        <div class="p-2 text-sm font-bold bg-gray-700 text-center">FELLS LIKE</div>
                        <h4 class="p-2 text-xl font-bold text-center"></h4>
                    </div> 
                    <div id="visibility" class="bg-blue-500/50 overflow-hidden rounded-xl">
                        <div class="p-2 text-sm font-bold bg-gray-700 text-center">VISIBILITY</div>
                        <h4 class="p-2 text-xl font-bold text-center"></h4>
                    </div> 
                    <div id="humity" class="bg-blue-500/50 overflow-hidden rounded-xl">
                        <div class="p-2 text-sm font-bold bg-gray-700 text-center">HUMIDITY</div>
                        <h4 class="p-2 text-xl font-bold text-center"></h4>
                    </div> 
                    <div id="wind" class="bg-blue-500/50 overflow-hidden rounded-xl">
                        <div class="p-2 text-sm font-bold bg-gray-700 text-center">WIND</div>
                        <h4 class="p-2 text-xl font-bold text-center"></h4>
                    </div> 
                    <div id="sunrise" class="bg-blue-500/50 overflow-hidden rounded-xl">
                        <div class="p-2 text-sm font-bold bg-gray-700 text-center">SUNRISE</div>
                        <h4 class="p-2 text-xl font-bold text-center"></h4>
                    </div> 
                    <div id="sunset" class="bg-blue-500/50 overflow-hidden rounded-xl">
                        <div class="p-2 text-sm font-bold bg-gray-700 text-center">SUNSET</div>
                        <h4 class="p-2 text-xl font-bold text-center"></h4>
                    </div> 
                </div>
            </div>
        </div>  
    </header>