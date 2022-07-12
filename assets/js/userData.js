

// setTimeout(userDataForm, 1000);


setUserData();


async function setUserData() {
    let response = await fetch('https://api.db-ip.com/v2/free/self');
    let json = await response.json();
    console.log(json);
}

function userDataForm() {
    document.getElementById("userDataForm").submit();
}
