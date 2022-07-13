let pomodoro = new Pomodoro(
    localStorage.time, 
    localStorage.shortBreak, 
    localStorage.longBreak, 
    localStorage.longBreakAfter, 
    localStorage.stopBell, 
    localStorage.startBell
);

getCurrentWeather();

const userName = c("form[name='userDataForm'] input[name='name']").value;
const fullLocation = c("form[name='userDataForm'] input[name='location']").value;
const userLocation = fullLocation.split(','); // Arry 0 => City, 1 => State, 2 => Country, 3 => Continet

let onBreak = false;
let breakCount = 0;

printWeather(userLocation[0]);
showTasks(localStorage.tasks);

if(!userName) {
    c('#unlogged').style.display = 'block';
    c('#todoMainFocus').display = 'none';
}


c("form[name='inputTasks']").addEventListener('submit', saveTodoFocus);
cs('#todoTaskArea .deleteTask').forEach(item => item.addEventListener('click', deleteThisTask));

c('#handleClockButton').addEventListener('click', showClock);
c('#handlePomodoroButton').addEventListener('click', showPomodoro);
c('#handleTimerButton').addEventListener('click', showTimer);

c('#timerButtonArea').addEventListener('click', showTimerConfigArea);
c('#timerConfigArea').addEventListener('mouseleave', showTimerConfigArea);
c('#configButtonArea').addEventListener('click', showConfigArea);
c('#userConfigurationArea').addEventListener('mouseleave', showConfigArea);

//SetUserName on data base
c('#handleSetUserButton').addEventListener('click', setUserName);

c('#handleSetPomodoroButton').addEventListener('click', openPomodoroConfigArea);
c('#handlePomodoroConfigClose').addEventListener('click', closePomodoroConfigArea);
c('#handleSavePomodoroConfig').addEventListener('click', handleSavePomodoroConfig);

c('#handlePomodoroPlay').addEventListener('click', pomodoroStart);
// c('#handlePomodoroPause').addEventListener('click', pomodoroPause);
c('#handlePomodoroStop').addEventListener('click', pomodoroStop);

c('#handleTimerPlay').addEventListener('click', timerStart);
c('#handleTimerPause').addEventListener('click', timerPause);
c('#handleTimerReset').addEventListener('click', timerReset);

switch(sessionStorage.location) {
    case 'clock':
        showClock()
    break;
    case 'pomodoro':
        showPomodoro()
    break;
    case 'timer':
        showTimer()
    break;
}

// EVENT FUNCTIOS
function showClock() {
    c('main #clock').style.display = 'block';
    c('main #timerArea').style.display = 'none';
    c('main #pomodoroArea').style.display = 'none';
    sessionStorage.location = 'clock';
}
function showPomodoro() {
    c('main #clock').style.display = 'none';
    c('main #timerArea').style.display = 'none';
    c('main #pomodoroArea').style.display = 'block';
    c('main #pomodoroArea h2').innerHTML = `${pomodoro.time}:00`;
    sessionStorage.location = 'pomodoro';
}
function showTimer() {
    if(sessionStorage.countTimer) {
        c('main #timerArea h2').innerHTML = sessionStorage.countTimer;
        c('main #timerArea #handleTimerReset').style.display = 'block';
    }
    c('main #timerArea').style.display = 'block';
    c('main #clock').style.display = 'none';
    c('main #pomodoroArea').style.display = 'none';
    sessionStorage.location = 'timer';
}
function showTimerConfigArea() {
    if(c('#timerConfigArea').style.display == 'block') {
        c('#timerConfigArea').style.display = 'none';
    } else {
        c('#timerConfigArea').style.display = 'block';
    }
}
function showConfigArea() {
    if(c('#userConfigurationArea').style.display == 'block') {
        c('#userConfigurationArea').style.display = 'none';
    } else {
        c('#userConfigurationArea').style.display = 'block';
    }
}
function closeTimerConfigArea() {
    if(c('#timerConfigArea').style.display == 'block') {
        c('#timerConfigArea').style.display = 'none';
    } else {
        c('#timerConfigArea').style.display = 'block';
    }
}
function closeConfigArea() {
    if(c('#userConfigurationArea').style.display == 'block') {
        c('#userConfigurationArea').style.display = 'none';
    } else {
        c('#userConfigurationArea').style.display = 'block';
    }
}

function setUserName() {
    c('#todoMainFocus').style.display = 'none';
    c('#unlogged').style.display = 'block';
}

//      TO_DO TASKS FUNCTIONS
function showTasks(t) {
    taskArea = c('#todoTaskArea');
    if(t) {
        taskList = t.split(',');

        let nodes = taskList.map( (task, index) => {
            let li = document.createElement('li');
            let bt = document.createElement('button');
    
            bt.classList.add('deleteTask');
            bt.id = index;
            bt.textContent = 'x';
    
            li.textContent = task;
            li.appendChild(bt);
    
            return li;
        })
        taskArea.append(...nodes);
    }
}
function saveTodoFocus() {
    let inputTask = c("form[name='inputTasks'] input[type='text']").value;

    if(inputTask) {
        if(localStorage.tasks) {
            localStorage.tasks = `${localStorage.tasks}, ${inputTask}`; 
        } else {
            localStorage.tasks = inputTask;
        }
    }
    window.location.reload(true);
}
function deleteThisTask(e) {
    let tasks = localStorage.tasks.split(',');
    let taskList = tasks.filter((item, index) => {
        if(index != e.target.id) {
            return item;
        }
    })

    localStorage.tasks = taskList.join();
    window.location.reload(true);
}

function openPomodoroConfigArea() {
    c('#pomodoroConfigurationArea').style.display = 'block';
    c('#pomodoroConfigurationArea').style.opacity = '1';

    setCurrentSelected( cs('#setPomodoroLength option'), pomodoro.time );
    setCurrentSelected( cs('#setPomodoroShortBreak option'), pomodoro.shortBreak );
    setCurrentSelected( cs('#setPomodoroLongBreak option'), pomodoro.longBreak );
    setCurrentSelected( cs('#setPomodorolongAfter option'), pomodoro.longBreakAfter );

    setCurrtentChecked( cs('#startBreakBell input'), pomodoro.stopBell );
    setCurrtentChecked( cs('#stopBreakBell input'), pomodoro.startBell );

    function setCurrentSelected(arr, value) {
        arr.forEach( item => {
            let key = item.getAttribute('value');
            if(key == value) {
                item.selected = true;
            }
        })
    }
    function setCurrtentChecked(arr, value) {
        arr.forEach( item => {
            let key = item.getAttribute('value');
            if(key == value) {
                item.checked = true;
            }
        })
    }
}
function closePomodoroConfigArea() {
    c('#pomodoroConfigurationArea').style.opacity = '0';
    c('#pomodoroConfigurationArea').style.display = 'none';
}
function handleSavePomodoroConfig() {
    cs('#startBreakBell input').forEach(item => handleSaveCheckedInputs(item, 'stopBell'));
    cs('#stopBreakBell input').forEach(item => handleSaveCheckedInputs(item, 'startBell'));

    cs('#setPomodoroLength option').forEach(item => handleSaveSelectedOption(item, 'time'))
    cs('#setPomodoroShortBreak option').forEach(item => handleSaveSelectedOption(item, 'shortBreak'))
    cs('#setPomodoroLongBreak option').forEach(item => handleSaveSelectedOption(item, 'longBreak'))
    cs('#setPomodorolongAfter option').forEach(item => handleSaveSelectedOption(item, 'longBreakAfter'))

    c('#pomodoroConfigurationArea').style.opacity = '0';
    c('#pomodoroConfigurationArea').style.display = 'none';

    sessionStorage.location = 'pomodoro';
    window.location.reload(true);

    function handleSaveCheckedInputs(item, storage) {
        if(item.checked) {
            localStorage.setItem(storage, parseInt(item.value));
        }
    }
    function handleSaveSelectedOption(item, storage) {
        if(item.selected) {
            localStorage.setItem(storage, parseInt(item.value));
        }
    }
}

//  POMODORO FUNCTIONS
function pomodoroStart() {
    c('#handlePomodoroPlay').style.display = 'none';
    // c('#handlePomodoroPause').style.display = 'block';
    c('#handlePomodoroStop').style.display = 'block';

    if(!onBreak) {
        c('main #pomodoroArea h2').style.color = 'white';
        pomodoroRun(pomodoro.stopBell);
    } else {
        c('main #pomodoroArea h2').style.color = 'yellow';
        pomodoroBreak(breakCount, pomodoro.startBell);
    }

    /*
        THE SAME BUTTON PLAY RUN PLAY & PAUSE FUNCTIONS
        WHEN FINISH PLAY, START PAUSE MODE
    */
    function pomodoroRun() {
        let minutes = pomodoro.time -1;
        let seconds =  60;

        pomodoroCount(minutes, seconds, pomodoro.stopBell);
        onBreak = true;
        checkNextStep();
    }
    function pomodoroBreak() {
        let minutes;
        let seconds = 60;
    
        if(breakCount === pomodoro.longBreakAfter) {
            minutes = pomodoro.longBreak;
        } else {
            minutes = pomodoro.shortBreak;
        }
        pomodoroCount(minutes, seconds, pomodoro.startBell);
        onBreak = false;
        breakCount++;
        checkNextStep();
    }
    function pomodoroPlayBell(soundNumber) {
        new Audio(`assets/sounds/${soundNumber}.wav`).play();
    }
    function pomodoroCount(minutes, seconds, bell) {
        const pomodoroInterval = setInterval(() => {
            if(seconds > 0) {
                seconds--;
                if(seconds === 0 && minutes > 0) {
                    minutes--;
                    seconds = 59;
                }
            } else {
                clearInterval(pomodoroInterval);
                pomodoroPlayBell(bell);
            }
            c('main #pomodoroArea h2').innerHTML = `${ (minutes < 10)? `0${minutes}`: minutes }:${ (seconds < 10)? `0${seconds}` : seconds }`;
        }, 1000);
    }
    function checkNextStep() {
        if(onBreak) {
            if(breakCount === pomodoro.longBreakAfter) {
                setTimeout(() => {
                    c('main #pomodoroArea h2').style.color = 'yellow';
                    c('main #pomodoroArea h2').innerHTML = `${ (pomodoro.longBreak < 10)? `0${pomodoro.longBreak}`: pomodoro.longBreak }:00`;
                }, (pomodoro.longBreak * 60000))
            } else {
                setTimeout(() => {
                    c('main #pomodoroArea h2').style.color = 'yellow';
                    c('main #pomodoroArea h2').innerHTML = `${ (pomodoro.shortBreak < 10)? `0${pomodoro.shortBreak}`: pomodoro.shortBreak }:00`;
                }, (pomodoro.shortBreak * 60000))
            }
        } else {
            setTimeout(() => {
                c('main #pomodoroArea h2').style.color = 'white';
                c('main #pomodoroArea h2').innerHTML = `${ (pomodoro.time < 10)? `0${pomodoro.time}`: pomodoro.time }:00`;
            }, (pomodoro.time * 60000))
        }
    }
}
function pomodoroStop() {
    window.location.reload(true);
}

//  TIMER FUNCTIONS
function timerStart() {
    if(sessionStorage.countTimer) {
        timerCount( currentTimer()[0], currentTimer()[1], currentTimer()[2] );
    } else {
        timerCount(0, 0, 0);
    }

    c('main #timerArea #handleTimerPlay').style.display = 'none';
    c('main #timerArea #handleTimerPause').style.display = 'block';
    c('main #timerArea #handleTimerReset').style.display = 'block';

    function currentTimer() {
        let result = [];
        let lastTimer = sessionStorage.countTimer.split(':');
        lastTimer.forEach( item => result.push( parseInt( item.trim() ) ) );
        return result;
    }
}
function timerPause() {
    const currentTime = c('main #timerArea h2').innerHTML;
    sessionStorage.countTimer = currentTime;
    window.location.reload(true);
    c('main #timerArea h2').innerHTML = currentTime;

    c('main #timerArea #handleTimerPlay').style.display = 'block';
    c('main #timerArea #handleTimerPause').style.display = 'none';
}
function timerReset() {
    c('main #timerArea h2').innerHTML = '00:00:00';
    sessionStorage.countTimer = '';
    window.location.reload(true);
}
function timerCount(minutes, seconds, mileseconds) {
    setInterval(() => {
        mileseconds++;
        if(mileseconds === 9) {
            seconds++;
            mileseconds = 0;
            if(seconds === 59) {
                minutes++;
                seconds = 0;
            }
        }
        c('main #timerArea h2').innerHTML = `${ (minutes < 10)? `0${minutes}`: minutes }:
                                            ${ (seconds < 10)? `0${seconds}` : seconds }:
                                            ${ (mileseconds < 10)? `0${mileseconds}` : mileseconds }`;
    }, 100);
}

//ONLOAD FUNCTIONS
function getCurrentWeather() {
        //Get and Print Weather
    const currentWeatherInterval = setInterval(() => {
        printCurrentTime();
    }, 1);

    function printCurrentTime() {
        let time = new Date();
        let h = time.getHours();
        let m = time.getMinutes();

        c('main #clock h2').innerHTML = `${ (h<10)? `0${h}` : h }:${ (m<10)? `0${m}` : m }`;
        c('main #clock h4 span').innerHTML = printCurrentDayState(h);
    }
    function printCurrentDayState(h) {
        if(h > 5 && h < 12) {
            return 'Good Morning ';
        } else if(h > 11 && h < 18) {
            return 'Good Afternoon ';
        } else if(h > 17 && h < 24) {
            return 'Good Evening ';
        } else if(h >= 0 && h < 5) {
            return 'Good Evening ';
        }
    }
}

// ONCLICK FUNCTIONS
function checkboxSelected(e, classItem) {
    cs(classItem).forEach( item => {
        if(item.checked) {
            item.checked = false;
        }
    })
    e.target.checked = true;
}