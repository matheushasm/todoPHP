const body = document.querySelector('body');
const clock = document.querySelector('#clockArea');
const footer = document.querySelector('footer');


loadBgImage();
loadDailyQuote();

setInterval(() => getCurrentTime(), 1000);

async function loadBgImage() {
    const bgImageApi = await getImage();
    const bgImages = bgImageApi.photos;
    const photoIndex = Math.floor(Math.random() * bgImages.length);
    body.style.backgroundImage = `url('${bgImages[photoIndex].src.original}')`;
}

async function loadDailyQuote() {
    const quote = await getQuote();
    footer.querySelector('p').innerHTML = `"${quote.quote}"`;
    footer.querySelector('p small').innerHTML = quote.author;
}

function getCurrentTime() {
    const time = new Date();
    const h = (time.getHours() < 10)? `0${time.getHours()}` : time.getHours();
    const m = (time.getMinutes() < 10)? `0${time.getMinutes()}` : time.getMinutes();
    const s = (time.getSeconds() < 10)? `0${time.getSeconds()}` : time.getSeconds();

    clock.innerHTML = `${h}:${m}`;
    return h;
}