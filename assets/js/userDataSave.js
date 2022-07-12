const form = document.querySelector("form[name='userDataForm']");
const inputLocation = document.querySelector("form[name='userDataForm'] input[name='location']");
const inputIp = document.querySelector("form[name='userDataForm'] input[name='ip']"); 

async function setUserData() {
    let response = await fetch('https://api.db-ip.com/v2/free/self');
    let json = await response.json();

    inputLocation.value = `${json.city}, ${json.stateProv}, ${json.countryName}, ${json.continentName}`;
    inputIp.value = json.ipAddress;

    form.submit();
}
setUserData();