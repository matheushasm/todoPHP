    // API WEATHER REQUEST
    async function printWeather(cityName) {
        let w = await getWeather(cityName);

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
        c('#sunrise h4').innerHTML = `${convertTimeStamp(w.sys.sunrise)} h`;
        c('#sunset h4').innerHTML = `${convertTimeStamp(w.sys.sunset)} h`;

        async function getWeather(cityName) {
            let response = await fetch(`https://api.openweathermap.org/data/2.5/weather?q=${cityName}&appid=87a5b62ad4b2fe6a87880936190ccd07&units=metric`);
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