class User {
    constructor(name, location='london') {
        this.name = name;
        this.location = location;
    }
}
let user = new User(localStorage.username, localStorage.location);

setInterval(printCurrentTime, 1000);

if(user.name && user.location) {
    printWeather(user.location);
        //  STYLE FUNCTIONS
    document.querySelector('#logged').style.display = 'block';
    document.querySelector('#weather').style.display = 'block';
    document.querySelector('#timerButtonArea').style.display = 'block';
    document.querySelector('#configButtonArea').style.display = 'block';
        // EVENT FUNCTIONS
    document.querySelector('#timerButtonArea').addEventListener('click', showTimerButton);
    document.querySelector('#configButtonArea').addEventListener('click', showConfigButton);
    document.querySelector('#handleSetUserButton').addEventListener('click', resetUser);
} else {
    document.querySelector('#unlogged').style.display = 'block';
    document.querySelector('#unlogged button').addEventListener('click', saveUser);
}


//  FUNCTIONS
// API WEATHER REQUEST
async function printWeather(city) {
    let weather = await getWeather(city);

    const weatherIcon = document.querySelector('#weather img');
    const weatherDegree = document.querySelector('#weather h2');
    const weatherLocation = document.querySelector('#weather h4');

    weatherIcon.setAttribute('src', `http://openweathermap.org/img/w/${weather.weather[0].icon}.png`);
    weatherDegree.innerHTML = `${weather.main.temp.toFixed()}º C`;
    weatherLocation.innerHTML = weather.name;


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

    document.querySelector('main h2').innerHTML = `${ (h<10)? `0${h}` : h }:${ (m<10)? `0${m}` : m }`;
    document.querySelector('main h4').innerHTML = printCurrentDayState(h);
}
function printCurrentDayState(h) {
    if(h > 5 && h < 12) {
        return `Good Morning ${user.name}`;
    } else if(h > 12 && h < 18) {
        return `Good Afternoon ${user.name}`;
    } else if(h > 18 && h < 24) {
        return `Good Evening ${user.name ? user.name : ''}`;
    } else if(h >= 0 && h < 5) {
        return `Good Evening ${user.name}`;
    }
}


// EVENT FUNCTIOS
function showTimerButton() {
    if(document.querySelector('#timerConfigArea').style.display == 'block') {
        document.querySelector('#timerConfigArea').style.display = 'none';
    } else {
        document.querySelector('#timerConfigArea').style.display = 'block';
    }
}
function showConfigButton() {
    if(document.querySelector('#userConfigurationArea').style.display == 'block') {
        document.querySelector('#userConfigurationArea').style.display = 'none';
    } else {
        document.querySelector('#userConfigurationArea').style.display = 'block';
    }
}
function saveUser() {
    const nameInput = document.querySelector('#unlogged #userName');
    const locationInput = document.querySelector('#unlogged #userLocation');

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

