// Background Image API

const getImage = async () => {
    const server = 'https://api.pexels.com/v1';
    const key = '563492ad6f917000010000015f64f1588c31454d92826c04d7062525';

    const settings = {
        method: 'GET',
        headers: {
            Accept: 'application/json',
            'Content-Type': 'application/json',
            Authorization: key
        }
    };

    const response = await fetch(`${server}/search?query=nature`, settings);
    const json = await response.json();
    return json;
}

const getQuote = async () => {
    const settings = {
        method: 'GET',
        headers: {
            'X-RapidAPI-Key': '4f04132018msh45653bb27f48864p1efed2jsn176cff22d1ac',
            'X-RapidAPI-Host': 'world-of-quotes.p.rapidapi.com'
        }
    };
    
    const response = await fetch('https://world-of-quotes.p.rapidapi.com/v1/quotes/quote-of-the-day?category=inspirational', settings)
    const json = await response.json();
    return json;
}

const getWeather = () => {
    const server = 'https://api.openweathermap.org/data/2.5/weather?';
    const apiKey = '87a5b62ad4b2fe6a87880936190ccd07';
    let lat;
    let lon;

    navigator.geolocation.getCurrentPosition(sucess, error);

    function sucess(pos) {
        const crd = pos.coords;
        lat = crd.latitude;
        lon = crd.longitude
    }
    function error() {
        console.warn('ERROR');
    }

    console.log(lat, lon);
}
getWeather();