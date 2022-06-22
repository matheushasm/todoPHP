const c = (c) => document.querySelector(c);
const cs = (cs) => document.querySelectorAll(cs);

class User {
    constructor(name='', location) {
        this.name = name;
        this.location = location;
    }
}
class Pomodoro {
    constructor(time=25, shortBreak=5, longBreak=15, longBreakAfter=4, shortBell=1, longBell=1) {
        this.time = time;
        this.shortBreak = shortBreak;
        this.longBreak = longBreak;
        this.longBreakAfter = longBreakAfter;
        this.shortBell = shortBell;
        this.longBell = longBell;
    }
}

let user = new User(localStorage.username, localStorage.location);
let pomodoro = new Pomodoro(localStorage.time, 
                            localStorage.shortBreak, 
                            localStorage.longBreak, 
                            localStorage.longBreakAfter, 
                            localStorage.ShortBell, 
                            localStorage.longBell
);

setInterval(printCurrentTime, 1000);

if(user.name && user.location) {
    printWeather(user.location);
    showLoggedContent();



        // EVENT FUNCTIONS
    c('main').addEventListener('mouseover', showConfigButtons);
    c('main').addEventListener('mouseleave', hiddenConfigButtons);

    c('#handleClockButton').addEventListener('click', showClock);
    c('#handlePomodoroButton').addEventListener('click', showPomodoro);
    c('#handleTimerButton').addEventListener('click', showTimer);

    c('#timerButtonArea').addEventListener('click', showTimerArea);
    c('#configButtonArea').addEventListener('click', showConfigArea);
    c('#handleSetUserButton').addEventListener('click', resetUser);

    c('#handleSetPomodoroButton').addEventListener('click', openPomodoroConfigArea);
    c('#handlePomodoroConfigClose').addEventListener('click', closePomodoroConfigArea);
    c('#handleSavePomodoroConfig').addEventListener('click', handleSavePomodoroConfig);

    c('#handlePomodoroPlay').addEventListener('click', pomodoroStart);
} else {
    c('#unlogged').style.display = 'block';
    c('#unlogged input[type=submit]').addEventListener('click', saveUser);
}


//  FUNCTIONS
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
async function getWeather(location) {
    let response = await fetch(`https://api.openweathermap.org/data/2.5/weather?q=${location}&appid=87a5b62ad4b2fe6a87880936190ccd07&units=metric`);
    let json = await response.json();
    return json;
}

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
function convertTimeStamp(stamp) {
    const date = new Date(stamp * 1000);
    const h = date.getHours();
    const m = date.getMinutes();
    return `${ (h<10)? `0${h}` : h }:${ (m<10)? `0${m}` : m }`;
}


// EVENT FUNCTIOS
function showLoggedContent() {
    c('#logged').style.display = 'block';
    c('#weather').style.display = 'block';
}
function showConfigButtons() {
    c('#timerButtonArea').style.display = 'block';
    c('#configButtonArea').style.display = 'block';
}
function hiddenConfigButtons() {
    c('#timerButtonArea').style.display = 'none';
    c('#configButtonArea').style.display = 'none';
}
function showTimerArea() {
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
function resetUser() {
    localStorage.removeItem('username');
    localStorage.removeItem('location');
    window.location.reload(true);
}




function showClock() {
    c('main #clock').style.display = 'block';
    c('main #timerArea').style.display = 'none';
    c('main #pomodoroArea').style.display = 'none';
}
function showTimer() {
    c('main #timerArea').style.display = 'block';
    c('main #clock').style.display = 'none';
    c('main #pomodoroArea').style.display = 'none';
}
function showPomodoro(p) {
    c('main #clock').style.display = 'none';
    c('main #timerArea').style.display = 'none';
    c('main #pomodoroArea').style.display = 'block';
    c('main #pomodoroArea h2').innerHTML = `${pomodoro.time}:00`;
}



//  POMODORO EVENTS
function openPomodoroConfigArea() {
    c('#pomodoroConfigurationArea').style.display = 'block';
    c('#pomodoroConfigurationArea').style.opacity = '1';

    setSelected( cs('#setPomodoroLength option'), pomodoro.time );
    setSelected( cs('#setPomodoroShortBreak option'), pomodoro.shortBreak );
    setSelected( cs('#setPomodoroLongBreak option'), pomodoro.longBreak );
    setSelected( cs('#setPomodorolongAfter option'), pomodoro.longBreakAfter );
    setChecked( cs('#startBreakBell input'), pomodoro.shortBell );
    setChecked( cs('#stopBreakBell input'), pomodoro.longBell );




    function checkboxSelected() {

    }


    function setSelected(arr, value) {
        arr.forEach( item => {
            let key = item.getAttribute('value');
            if(key == value) {
                item.setAttribute('selected', 'selected');
            }
        })
    }
    function setChecked(arr, value) {
        arr.forEach( item => {
            let key = item.getAttribute('value');
            if(key == value) {
                item.setAttribute('checked', 'checked');
            }
        })
    }
}
function closePomodoroConfigArea() {
    c('#pomodoroConfigurationArea').style.opacity = '0';
    c('#pomodoroConfigurationArea').style.display = 'none';
}

function handleSavePomodoroConfig() {

    c('#pomodoroConfigurationArea').style.opacity = '0';
    c('#pomodoroConfigurationArea').style.display = 'none';


}
//  POMODORO FUNCTION
function pomodoroStart() {
    
    let shortBreak = pomodoro.shortBreak;
    let largeBreak = pomodoro.largeBreak;
    let longBreakAfter = pomodoro.longBreakAfter;

    let minutes = pomodoro.time -1;
    let seconds = 60;

    setInterval(() => {
        if(seconds > 0) {
            seconds--;
            if(seconds === 0 && minutes > 0) {
                minutes--;
                seconds = 59;
            }
        } else {

        }
        c('main #pomodoroArea h2').innerHTML = `${ (minutes < 10)? `0${minutes}`: minutes }:${ (seconds < 10)? `0${seconds}` : seconds }`;
    }, 1000);
}

