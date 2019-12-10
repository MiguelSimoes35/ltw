let country = document.getElementById('country');
country.addEventListener('input', countryChanged);

function countryChanged(event) {
    let selected = event.target.value;
    
    let request = new XMLHttpRequest();
    request.addEventListener("load", updateCities);
    request.open("get", "../database/get_cities.php?country=" + selected, true);
    request.send();
}

function updateCities() {
    console.log(this.responseText);
    let cities = JSON.parse(this.responseText);
    console.log(cities);
    let list = document.getElementById("city");
    list.innerHTML = "<option value=\"undefined\"></option>"; // Clean current countries

    for (city in cities) {
        let item = document.createElement("option");
        item.setAttribute('value', cities[city].city);
        item.innerHTML = cities[city].city;
        list.appendChild(item);
    }
}


let date = new Date();

let today = date.toISOString().split('T')[0];
date.setDate(date.getDate() + 1);
let tomorrow = date.toISOString().split('T')[0];

document.getElementById('checkin').setAttribute('min', today);
document.getElementById('checkout').setAttribute('min', tomorrow);

let checkin = document.getElementById('checkin');
checkin.addEventListener('input', updateCheckout);

function updateCheckout(event) {
    let selected = event.target.value;
    let newDate = new Date(selected);
    newDate.setDate(newDate.getDate() + 1);

    document.getElementById('checkout').setAttribute('min', newDate.toISOString().split('T')[0]);
}

