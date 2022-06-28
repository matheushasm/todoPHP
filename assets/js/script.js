class User {
    constructor(name='', location) {
        this.name = name;
        this.location = location;
    }
}
class Pomodoro {
    constructor(time=25, shortBreak=5, longBreak=15, longBreakAfter=4, stopBell=1, startBell=1) {
        this.time = time;
        this.shortBreak = shortBreak;
        this.longBreak = longBreak;
        this.longBreakAfter = longBreakAfter;
        this.stopBell = stopBell;
        this.startBell = startBell;
    }
}

const c = (c) => document.querySelector(c);
const cs = (cs) => document.querySelectorAll(cs);

let user = new User(localStorage.username, localStorage.location);
let pomodoro = new Pomodoro(localStorage.time, localStorage.shortBreak, localStorage.longBreak, 
                            localStorage.longBreakAfter, localStorage.stopBell, localStorage.startBell);

setInterval(() => {
    printCurrentTime();

    //  TIMES FUNCTION
    //  PRINT CURRENT TIME
    function printCurrentTime() {
        let time = new Date();
        let h = time.getHours();
        let m = time.getMinutes();

        c('main #clock h2').innerHTML = `${ (h<10)? `0${h}` : h }:${ (m<10)? `0${m}` : m }`;
        c('main #clock h4').innerHTML = printCurrentDayState(h);
    }
    function printCurrentDayState(h) {
        if(h > 5 && h < 12) {
            return `Good Morning ${user.name}`;
        } else if(h > 11 && h < 18) {
            return `Good Afternoon ${user.name}`;
        } else if(h > 17 && h < 24) {
            return `Good Evening ${user.name ? user.name : ''}`;
        } else if(h >= 0 && h < 5) {
            return `Good Evening ${user.name}`;
        }
    }
}, 1);

if(user.name && user.location) {
    let onBreak = false;
    let breakCount = 0;

    printWeather(user.location);
    showLoggedContent();

    c('main').addEventListener('mouseover', showConfigButtons);
    c('main').addEventListener('mouseleave', hiddenConfigButtons);

    c('#handleClockButton').addEventListener('click', showClock);
    c('#handlePomodoroButton').addEventListener('click', showPomodoro);
    c('#handleTimerButton').addEventListener('click', showTimer);

    c('#timerButtonArea').addEventListener('click', showTimerConfigArea);
    c('#configButtonArea').addEventListener('click', showConfigArea);
    c('#handleSetUserButton').addEventListener('click', resetUser);

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
    function showLoggedContent() {
        c('#logged').style.display = 'block';
        c('#weather').style.display = 'block';
    }
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
    function showConfigButtons() {
        c('#timerButtonArea').style.display = 'block';
        c('#configButtonArea').style.display = 'block';
    }
    function hiddenConfigButtons() {
        c('#timerButtonArea').style.display = 'none';
        c('#configButtonArea').style.display = 'none';
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
    function resetUser() {
        localStorage.removeItem('username');
        localStorage.removeItem('location');
        sessionStorage.location = 'clock';
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
    /*
    function pomodoroPause() {
        let realTime = pomodoro.time;
        let currentTime = c('main #pomodoroArea h2').innerHTML;
    }
    */
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
} else {
    c('#unlogged').style.display = 'block';
    c('#unlogged input[type=submit]').addEventListener('click', saveUser);

    function saveUser() {
        const nameInput = c('#unlogged #userName');
        const locationInput = c('#unlogged #userLocation');
    
        if(nameInput.value && locationInput.value) {
            localStorage.username = nameInput.value;
            localStorage.location = locationInput.value;
            document.location.reload(true);
        } else {
            alert("Please, make shure you have filled all fields info." );
        }
    }
}

// API WEATHER REQUEST
async function printWeather(cityLocation) {
    let w = await getWeather(cityLocation);

    c('#weather img').setAttribute('src', `http://openweathermap.org/img/w/${w.weather[0].icon}.png`);
    c('#weather h2').innerHTML = `${w.main.temp.toFixed()}º C`;
    c('#weather h4').innerHTML = w.name;

    c('#weather').addEventListener('mouseover', printFullWeather);
    c('#fullWeather').addEventListener('mouseleave', removeFullWeather);

    c('#fullWeatherLocation').innerHTML = `${w.name}, ${w.sys.country}`;
    c('#fullWeatherMain img').setAttribute('src', `http://openweathermap.org/img/w/${w.weather[0].icon}.png`);
    c('#fullWeatherMain h4').innerHTML = `${w.main.temp.toFixed()}º C`;
    c('#fullWeaderMinMax h2').innerHTML = w.weather[0].main;
    c('#fullWeaderMinMax h4').innerHTML = `min: ${w.main.temp_min.toFixed()} / max: ${w.main.temp_max.toFixed()}`;

    c('#termal h4').innerHTML = `${w.main.feels_like.toFixed()}º C`;
    c('#visibility h4').innerHTML = `${w.visibility.toFixed()} m`;
    c('#humity h4').innerHTML = `${w.main.humidity}%`;
    c('#wind h4').innerHTML = `${w.wind.speed.toFixed()} Km/h`;
    c('#sunrise h4').innerHTML = `${convertTimeStamp(w.sys.sunrise)}`;
    c('#sunset h4').innerHTML = `${convertTimeStamp(w.sys.sunset)}`;

    async function getWeather(location) {
        let response = await fetch(`https://api.openweathermap.org/data/2.5/weather?q=${location}&appid=87a5b62ad4b2fe6a87880936190ccd07&units=metric`);
        let json = await response.json();
        return json;
    }
    function printFullWeather() {
        c('#weather').style.display = 'none';
        c('#fullWeather').style.display = 'block';
        c('#fullWeather').style.opacity = '1';
    }
    function removeFullWeather() {
        c('#fullWeather').style.opacity = '0';
        c('#fullWeather').style.display = 'none';
        c('#weather').style.display = 'block';
    }
    function convertTimeStamp(stamp) {
        const date = new Date(stamp * 1000);
        const h = date.getHours();
        const m = date.getMinutes();
        return `${ (h<10)? `0${h}` : h }:${ (m<10)? `0${m}` : m }`;
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