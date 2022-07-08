<?php
require 'config.php';
require_once './requests/apiRequest.php';

include_once './partials/header.php';
?>

<main class="h-screen container m-auto flex flex-col justify-center items-center">
    <div class="p-6 flex flex-col items-center rounded hover:shadow-xl">
        <div id="clock">
            <h2 class="p-4 text-9xl font-bold"></h2>
            <h4 class="mt-20 mb-20 text-4xl text-center"></h4>
        </div>
        <div id="pomodoroArea"
        class="hidden">
            <h2 class="p-4 text-9xl font-bold"></h2>
            <div 
            class="w-full flex justify-center">
                <button id="handlePomodoroPlay"
                class="mr-2 p-2 text-2xl font-bold bg-slate-600/50 rounded hover:bg-slate-700/50">
                    Play
                </button>
                <!-- <button id="handlePomodoroPause"
                class="mr-2 p-2 text-2xl font-bold bg-slate-600/50 rounded hover:bg-slate-700/50 hidden">
                    Pause
                </button> -->
                <button id="handlePomodoroStop"
                class="mr-2 p-2 text-2xl font-bold bg-slate-600/50 rounded hover:bg-slate-700/50 hidden">
                    Stop
                </button>
            </div>
        </div>
        <div id="timerArea"
        class="hidden">
            <h2 class="p-4 text-8xl font-bold">00:00:00</h2>
            <div 
            class="w-full flex justify-center">
                <button id="handleTimerPlay"
                class="mr-2 p-2 text-2xl font-bold bg-slate-600/50 rounded hover:bg-slate-700/50">
                    Play
                </button>
                <button id="handleTimerPause"
                class="mr-2 p-2 text-2xl font-bold bg-slate-600/50 rounded hover:bg-slate-700/50 hidden">
                    Pause
                </button>
                <button id="handleTimerReset"
                class="mr-2 p-2 text-2xl font-bold bg-slate-600/50 rounded hover:bg-slate-700/50 hidden">
                    Reset
                </button>
            </div>
        </div>


        <div id="logged" class="hidden" >
            <div id="timerButtonArea" class="p-4 absolute left-[28%] top-[60%] cursor-pointer z-10 hidden hover:rounded hover:bg-slate-900/20">
                <i class="gg-timer"></i>
                <div id="timerConfigArea" class="mt-2 rounded hover:shadow-xl hidden">
                    <div id="handleClockButton" class="p-2 text-lg hover:bg-orange-400 hover:text-white ease-in duration-300">Clock</div>
                    <div id="handlePomodoroButton" class="p-2 text-lg  hover:bg-orange-400 hover:text-white ease-in duration-300">Pomodoro</div>
                    <div id="handleTimerButton" class="p-2 text-lg  hover:bg-orange-400 hover:text-white ease-in duration-300">Timer</div>
                    <hr/>
                    <div class="w-full p-1 text-center rounded bg-red-500/70 hover:bg-red-500/90">x</div>
                </div>
            </div>
            <div id="configButtonArea" class="ml-4 p-4 absolute left-[68%] top-[60%] cursor-pointer z-10 hidden hover:rounded hover:bg-slate-900/20">
                <i class="gg-more"></i>
                <div id="userConfigurationArea" class="mt-2 rounded hover:shadow-xl hidden">
                    <div id="handleSetUserButton" class="p-2 text-lg  hover:bg-orange-400 hover:text-white ease-in duration-300">Change User/Location</div>
                    <div id="handleSetPomodoroButton" class="p-2 text-lg  hover:bg-orange-400 hover:text-white ease-in duration-300">Set Pomodoro</div>
                    <hr/>
                    <div class="w-full p-1 text-center rounded bg-red-500/70 hover:bg-red-500/90">x</div>
                </div>
            </div>

            <div id="pomodoroConfigurationArea"
            class="absolute inset-y-0 inset-x-0 bg-slate-900/70 z-10 opacity-0 hidden">
                <div id="handlePomodoroConfigClose"
                class="absolute right-6 top-6 p-4 border rounded-full 
                bg-slate-900/50 text-3xl hover:bg-slate-900/80">
                    x
                </div>
                <div style="text-shadow: none;"
                class="m-auto p-4 mt-20 w-10/12 h-5/6 text-gray-900 rounded">
                    <h2 class="text-white text-center bg-sky-900/90">POMODORO CONFIG</h2>
                    <div class="flex">
                        <div class="flex-[3] flex flex-col justify-around bg-sky-400" >
                            <fieldset id="startBreakBell"
                            class="p-2 text-xl">
                                <legend class="text-2xl mb-4" >Start Break</legend>
                                <input value="1" type="checkbox" onclick="checkboxSelected(event, '#startBreakBell input')"/><span class="mr-4"> Song 1</span>
                                <input value="2" type="checkbox" onclick="checkboxSelected(event, '#startBreakBell input')"/><span class="mr-4"> Song 2</span>
                                <input value="3" type="checkbox" onclick="checkboxSelected(event, '#startBreakBell input')"/><span class="mr-4"> Song 3</span>
                                <input value="4" type="checkbox" onclick="checkboxSelected(event, '#startBreakBell input')"/><span class="mr-4"> Song 4</span>
                            </fieldset>
                            <fieldset  id="stopBreakBell"
                            class="p-2 text-xl">
                                <legend class="text-2xl mb-4" >Stop Break</legend>
                                <input value="1" type="checkbox" onclick="checkboxSelected(event, '#stopBreakBell input')"/><span class="mr-4"> Song 1</span>
                                <input value="2" type="checkbox" onclick="checkboxSelected(event, '#stopBreakBell input')"/><span class="mr-4"> Song 2</span>
                                <input value="3" type="checkbox" onclick="checkboxSelected(event, '#stopBreakBell input')"/><span class="mr-4"> Song 3</span>
                                <input value="4" type="checkbox" onclick="checkboxSelected(event, '#stopBreakBell input')"/><span class="mr-4"> Song 4</span>
                            </fieldset>
                        </div>
                        <div class="flex-1 flex flex-col p-4 bg-sky-500">
                            <h2>Time</h2>
                            <div class="p-2" >   
                                <label >Pomodoro Length</label><br/>
                                <select name="pomodoro" id="setPomodoroLength" class="p-1 border border-gray-900 rounded">
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
                            <div class="p-2" >   
                                <label>Short Break</label><br/>
                                <select name="pomodoro" id="setPomodoroShortBreak" class="p-1 border border-gray-900 rounded">
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
                            <div class="p-2" >   
                                <label>Long Break</label><br/>
                                <select name="pomodoro" id="setPomodoroLongBreak" class="p-1 border border-gray-900 rounded">
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
                            <div class="p-2" >   
                                <label>Long Break After</label><br/>
                                <select name="pomodoro" id="setPomodorolongAfter" class="p-1 border border-gray-900 rounded">
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
                            ease-in durantion-300">
                                Save
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>  

        <div id="unlogged" class="hidden">
            <form>
                <input id="userName" class="text-black" type="text" placeholder="What is your name?"/>
                <input id="userLocation" class="text-black" type="text" placeholder="What is your City?"/>
                <input type="submit" value="Save" class="p-1 border bg-slate-900/40 rounded hover:bg-slate-900/60 ease-in duration-300" />
            </form>
        </div>      
    </div>
</main>
<?php include_once './partials/footer.php';?>