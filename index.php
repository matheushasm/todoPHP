<?php
require_once 'config.php';
require_once __DIR__ . '/db/dao/ImageDaoMysql.php';
require_once __DIR__ . '/db/dao/QuoteDaoMysql.php';
require_once __DIR__ . '/db/dao/UserDaoMysql.php';

$user_key = $_COOKIE['user_key'];

$imageDao = new ImageDaoMysql($pdo);
$quoteDao = new QuoteDaoMysql($pdo);
$userDao = new UserDaoMysql($pdo);

$bgImage = $imageDao->getAll();
$quote = $quoteDao->getAll();
$user = $userDao->getByUserKey($user_key);

if(!$user) {
    header("location: getUserData.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>To Do</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href='https://css.gg/timer.css' rel='stylesheet'>
    <link href='https://css.gg/more.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>  

    <style>
        body {
            width: 100%;
            height: 100vh;
            background-image: url(<?=$bgImage[2]->getUrl()?>);
            text-shadow: 1px 1px #000;
            overflow: hidden;
        }

    </style>
    <link rel="stylesheet" href="assets/css/style.css" />
</head>
<body class="font-sans text-lg text-white bg-slate-900 bg-neutral-900 bg-cover bg-center bg-no-repeat select-none">

    <form name="userDataForm" method="POST" action="saveUserData.php">
        <input type="hidden" name="name" value="<?=$user->getName()?>"/>
        <input type="hidden" name="location" value="<?=$user->getLocation()?>" />
        <input type="hidden" name="ip" />
    </form>

    <header class="fixed top-0 left-0 right-0">
        <div class="flex justify-between ">

            <div id="hamButtom" class="ml-2 flex items-center justify-center cursor-pointer sm:hidden">
                <div class="h-10 flex flex-col justify-between p-2 bg-white/60 rounded">
                    <div class="w-8 h-1 bg-black rounded"></div>
                    <div class="w-8 h-1 bg-black rounded"></div>
                    <div class="w-8 h-1 bg-black rounded"></div>
                </div>
            </div>

            <div class=""></div>

            <div id="weather" class="flex flex-col items-center justify-center bg-slate-800/5 rounded hover:shadow-xl">
                <div class="flex p-2">
                    <img class="w-12 h-12 mr-2"/>
                    <div class="">
                        <h2 class="text-3xl"></h2>
                        <h4 class="text-center "></h4>
                    </div>
                </div>
            </div>
            <div id="fullWeather" class="w-0 bg-slate-900/80 rounded-xl overflow-hidden ease-in-out duration-300 hidden lg:w-auto lg:h-0">
                <div id="fullWeatherLocation" class="p-1 text-xl font-bold bg-gray-700 hidden lg:block">Faro, Portugal</div>

                <div id="fullWeatherMain" class="p-2 flex justify-between hidden lg:flex">
                    <h4 class="text-4xl font-bold">20º C</h4>
                    <img/>
                </div>

                <div id="fullWeaderMinMax" class="p-2 hidden lg:block">
                    <h2 class="mb-2 text-2xl text-center">Cloud</h2>
                    <h4 class="text-sm font-bold text-center" >min/max</h4>
                </div>

                <div class="flex gap-1 lg:grid lg:grid-cols-3 lg:p-2">
                    <div id="termal" class="bg-blue-500/50 overflow-hidden rounded">
                        <div class="p-1 text-sm bg-gray-700 text-center">FELLS LIKE</div>
                        <h4 class="p-1 text-sm text-center"></h4>
                    </div> 
                    <div id="visibility" class="bg-blue-500/50 overflow-hidden rounded">
                        <div class="p-1 text-sm bg-gray-700 text-center">VISIBILITY</div>
                        <h4 class="p-1 text-sm text-center"></h4>
                    </div> 
                    <div id="humity" class="bg-blue-500/50 overflow-hidden rounded">
                        <div class="p-1 text-sm bg-gray-700 text-center">HUMIDITY</div>
                        <h4 class="p-1 text-sm text-center"></h4>
                    </div> 
                    <div id="wind" class="bg-blue-500/50 overflow-hidden rounded">
                        <div class="p-1 text-sm bg-gray-700 text-center">WIND</div>
                        <h4 class="p-1 text-sm text-center"></h4>
                    </div> 
                    <div id="sunrise" class="bg-blue-500/50 overflow-hidden rounded">
                        <div class="p-1 text-sm bg-gray-700 text-center">SUNRISE</div>
                        <h4 class="p-1 text-sm text-center"></h4>
                    </div> 
                    <div id="sunset" class="bg-blue-500/50 overflow-hidden rounded">
                        <div class="p-1 text-sm bg-gray-700 text-center">SUNSET</div>
                        <h4 class="p-1 text-sm text-center"></h4>
                    </div> 
                </div>
            </div>
        </div>  <!-- MOBILE MENU -->
        <div id="mobileMenu" class="w-full h-0 bg-black/70 overflow-hidden">
                <ul>
                    <li id="handleClockMobileButton" class="p-1 text-center">Clock</li>
                    <li id="handlePomodoroMobileButton" class="p-1 text-center">Pomodoro</li>
                    <li id="handleTimerMobileButton" class="p-1 text-center">Timer</li>
                    <li id="handleSetUserMobileButton" class="p-1 text-center">Set Name</li>
                    <li id="handleSetPomodoroMobileButton" class="p-1 text-center">Set Pomodoro</li>
                </ul>
            </div>
    </header>


    <main class="h-full container m-auto flex flex-col justify-center items-center">
        <div class="w-full flex flex-col items-center rounded hover:shadow-xl">
            <div class="flex items-center">

                <div id="timerButtonArea" 
                    class="mr-10 p-2 cursor-pointer hover:bg-slate-900/20 rounded hidden sm:block lg:mr-16">
                    <i class="gg-timer"></i>
                    <div id="timerConfigArea" class="absolute rounded hover:shadow-xl hidden">
                        <div id="handleClockButton" class="p-2 text-lg hover:bg-orange-400 hover:text-white ease-in duration-300">Clock</div>
                        <div id="handlePomodoroButton" class="p-2 text-lg  hover:bg-orange-400 hover:text-white ease-in duration-300">Pomodoro</div>
                        <div id="handleTimerButton" class="p-2 text-lg  hover:bg-orange-400 hover:text-white ease-in duration-300">Timer</div>
                    </div>
                </div>

                <div id="clock">
                    <h2 class="text-7xl font-bold text-center sm:text-8xl lg:text-9xl"></h2>
                    <h4 class="mt-2 mb-10 text-2xl text-center sm:text-3xl lg:text-4xl"><span></span><?=$user->getName()?></h4>
                </div>

                <div id="pomodoroArea" class="hidden">
                    <h2 class="text-9xl font-bold"></h2>
                    <div class="w-full flex justify-center">
                        <button id="handlePomodoroPlay"
                        class="mr-2 p-2 text-2xl font-bold bg-slate-600/50 rounded hover:bg-slate-700/50"
                        >Play</button>
                        <!-- <button id="handlePomodoroPause"
                        class="mr-2 p-2 text-2xl font-bold bg-slate-600/50 rounded hover:bg-slate-700/50 hidden">
                            Pause
                        </button> -->
                        <button id="handlePomodoroStop"
                        class="mr-2 p-2 text-2xl font-bold bg-slate-600/50 rounded hover:bg-slate-700/50 hidden"
                        >Stop</button>
                    </div>
                </div>

                <div id="timerArea" class="hidden">
                    <h2 class="text-8xl font-bold">00:00:00</h2>
                    <div 
                    class="w-full flex justify-center">
                        <button id="handleTimerPlay"
                            class="mr-2 p-2 text-2xl font-bold bg-slate-600/50 rounded hover:bg-slate-700/50"
                        >Play</button>

                        <button id="handleTimerPause"
                            class="mr-2 p-2 text-2xl font-bold bg-slate-600/50 rounded hover:bg-slate-700/50 hidden"
                        >Pause</button>

                        <button id="handleTimerReset"
                        class="mr-2 p-2 text-2xl font-bold bg-slate-600/50 rounded hover:bg-slate-700/50 hidden"
                        >Reset</button>
                    </div>
                </div>

                <div id="configButtonArea" class="ml-10 p-2 cursor-pointer hover:bg-slate-900/20 rounded hidden sm:block lg:ml-16">
                        <i class="gg-more"></i>
                        <div id="userConfigurationArea" class="absolute rounded hover:shadow-xl hidden">
                            <div id="handleSetUserButton" class="p-2 text-lg  hover:bg-orange-400 hover:text-white ease-in duration-300">Set Name</div>
                            <div id="handleSetPomodoroButton" class="p-2 text-lg  hover:bg-orange-400 hover:text-white ease-in duration-300">Set Pomodoro</div>
                        </div>
                </div>
            </div>

            <!-- Todo Area -->
            <div id="todoArea" class="mt-4 w-3/4">
                <div id="todoTaskArea" 
                    class="grid grid-cols-1 gap-4 text-sm font-bold text-white list-none overflow-y-auto md:grid-cols-2 xl:grid-cols-3"
                >
                </div>

                <form name="inputTasks" class="flex mt-4">
                    <input class="w-full p-2 bg-black/10 text-lg text-center font-bold border-b-2 border-white outline-none placeholder:text-white"
                        type="text" autofocus placeholder="To Do Tasks" />
                    <input class="ml-4 p-1 bg-slate-900/20 text-lg font-bold cursor-pointer hover:text-orange-500/80 ease-in duration-150 rounded" 
                        type="submit" value="Save" />
                </form>
            </div>

            <!-- Pomodoro config Area -->
            <div id="pomodoroConfigurationArea" class="absolute inset-y-0 inset-x-0 bg-slate-900/70 z-10 opacity-0 hidden">
                <div id="handlePomodoroConfigClose" 
                    class="absolute right-6 top-8 p-2 text-center border rounded-3xl 
                    bg-slate-900/50 text-xl hover:bg-slate-900/80"
                >x</div>

                <div id="pomodoroConfigFieldsArea" class="m-auto p-4 mt-20 w-full h-full text-gray-900">
                    <h2 class="text-white text-center bg-sky-900/90">POMODORO CONFIG</h2>
                    <div class="flex">
                        <div class="p-4 flex-[3] flex flex-col justify-around bg-sky-400" >
                            <fieldset id="startBreakBell" class="flex flex-col text-lg  sm:flex-row">
                                <legend class="text-xl font-bold" >Start Break</legend>
                                <input value="1" type="checkbox" onclick="checkboxSelected(event, '#startBreakBell input')"/><span class="mr-4"> Song 1</span>
                                <input value="2" type="checkbox" onclick="checkboxSelected(event, '#startBreakBell input')"/><span class="mr-4"> Song 2</span>
                                <input value="3" type="checkbox" onclick="checkboxSelected(event, '#startBreakBell input')"/><span class="mr-4"> Song 3</span>
                                <input value="4" type="checkbox" onclick="checkboxSelected(event, '#startBreakBell input')"/><span class="mr-4"> Song 4</span>
                            </fieldset>
                            <fieldset  id="stopBreakBell" class="flex flex-col text-lg  sm:flex-row">
                                <legend class="text-xl font-bold" >Stop Break</legend>
                                <input value="1" type="checkbox" onclick="checkboxSelected(event, '#stopBreakBell input')"/><span class="mr-4"> Song 1</span>
                                <input value="2" type="checkbox" onclick="checkboxSelected(event, '#stopBreakBell input')"/><span class="mr-4"> Song 2</span>
                                <input value="3" type="checkbox" onclick="checkboxSelected(event, '#stopBreakBell input')"/><span class="mr-4"> Song 3</span>
                                <input value="4" type="checkbox" onclick="checkboxSelected(event, '#stopBreakBell input')"/><span class="mr-4"> Song 4</span>
                            </fieldset>
                        </div>
                        <div class="p-4 flex-1 flex flex-col text-md bg-sky-500">
                            <h2>Time</h2>
                            <div class="p-2">   
                                <label class="font-bold">Pomodoro Length</label><br/>
                                <select name="pomodoro" id="setPomodoroLength" class="border border-gray-900 rounded">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                    <option value="25">25</option>
                                    <option value="30">30</option>
                                    <option value="35">35</option>
                                    <option value="40">40</option>
                                    <option value="45">45</option>
                                    <option value="50">50</option>
                                    <option value="55">55</option>
                                </select>
                            </div>
                            <div class="p-2">   
                                <label class="font-bold">Short Break</label><br/>
                                <select name="pomodoro" id="setPomodoroShortBreak" class="border border-gray-900 rounded">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                    <option value="25">25</option>
                                    <option value="30">30</option>
                                    <option value="35">35</option>
                                    <option value="40">40</option>
                                    <option value="45">45</option>
                                    <option value="50">50</option>
                                    <option value="55">55</option>
                                </select>
                            </div>
                            <div class="p-2">   
                                <label class="font-bold">Long Break</label><br/>
                                <select name="pomodoro" id="setPomodoroLongBreak" class="border border-gray-900 rounded">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                    <option value="25">25</option>
                                    <option value="30">30</option>
                                    <option value="35">35</option>
                                    <option value="40">40</option>
                                    <option value="45">45</option>
                                    <option value="50">50</option>
                                    <option value="55">55</option>
                                </select>
                            </div>
                            <div class="p-2">   
                                <label class="font-bold">Long Break After</label><br/>
                                <select name="pomodoro" id="setPomodorolongAfter" class="border border-gray-900 rounded">
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                </select>
                            </div>
                            <button id="handleSavePomodoroConfig"
                                class="p-2 bg-orange-600 text-white rounded 
                                hover:bg-orange-500 hover:text-black 
                                ease-in durantion-300"
                            >Save</button>
                        </div>
                    </div>
                </div>
            </div>


            <div id="unlogged" class="w-full hidden">
                <form class="flex m-auto mt-4 w-3/4"
                name="userNameSave" method="POST" action="saveUserName.php">
                    <input class="w-full p-2 bg-transparent text-xl font-bold text-center border-b-2 border-white outline-none placeholder:text-white"
                        name="name" type="text" autofocus placeholder="What is your name?"/>
                    <input class="ml-4 p-1 bg-slate-900/20 text-xl font-bold cursor-pointer hover:text-orange-500/80 ease-in duration-150 rounded" 
                        type="submit" value="Save"  />
                </form>
            </div>      
        </div>
    </main>


    <footer class="p-2 absolute bottom-2 left-0 right-0
        text-xl ease-in duration-150 hover:pt-0 hover:shadow-xl
        overflow-hidden"
    >
        <p class="container m-auto text-sm text-center break-normal sm:text-lg xl:text-xl"><?=$quote[7]->getContent()?></p>
        <p class="container m-auto text-sm text-center sm:text-lg xl:text-xl"><small><?=$quote[4]->getAuthor()?></small></p> 
    </footer>
    <div class="p-2 absolute bottom-1 left-2 cursor-pointer">
        <a href="./pages/loginPage.php" target="_blank">...</a>
    </div>

    <script type="text/javascript" src="./assets/js/script.js"></script>
</body>
</html>