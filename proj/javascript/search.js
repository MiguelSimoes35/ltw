let warning = document.getElementById('warning');

if (warning != null) {
    setTimeout(function () {
        warning.style.opacity = 0;
        setTimeout(function () {let body = document.getElementsByTagName('body')[0]; body.removeChild(warning);}, 1000)
    }, 10000, );
}


let country = document.getElementById('country');
if (country != null)
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


let checkin = document.getElementById('checkin');
let checkout = document.getElementById('checkout');

if (checkin != null && checkout != null) {
    checkin.setAttribute('min', today);
    checkout.setAttribute('min', tomorrow);

    checkin.addEventListener('input', updateCheckout);
}

function updateCheckout(event) {
    let selected = event.target.value;
    let newDate = new Date(selected);
    newDate.setDate(newDate.getDate() + 1);

    checkout.setAttribute('min', newDate.toISOString().split('T')[0]);
    checkout.setAttribute('value', newDate.toISOString().split('T')[0]);
}


let request = new XMLHttpRequest();
request.addEventListener("load", colorFavorites);
request.open("get", "../database/get_favorites.php", true);
request.send();

function colorFavorites() {
    let response = JSON.parse(this.responseText);

    for (let i = 0; i < response.length; i++) {
        let favorite = document.getElementById("favorite_place_id=" + response[i].place_id);
        if (favorite != null)
            favorite.style.color = 'red';
    }
}

let elements = document.getElementsByClassName('favorite');

if (elements.length != 0)
    for (let it = 0; it < elements.length; it++)
        elements[it].addEventListener('click', favoritePressed);

function favoritePressed(event) {
    let selected = event.target.id;
    console.log(selected);
    let parts = selected.split('=');
    let place_id = parts[1];

    let request = new XMLHttpRequest();
    request.addEventListener("load", colorFavoriteButton);
    request.open("get", "../database/favorite.php?place_id=" + place_id, true);
    request.send();
}

function colorFavoriteButton() {
    console.log(this.responseText);
    let response = JSON.parse(this.responseText);
    let favorite = document.getElementById("favorite_place_id=" + response["place"]);
    favorite.style.color = response["color"];
}

function deleteNotificationPressed(event) {
    let id = event.target.id;
    let request = new XMLHttpRequest();
    request.addEventListener("load", removeNotification);
    request.open("get", "../database/delete_notification.php?id=" + id, true);
    request.send();
}

function removeNotification() {
    console.log(this.responseText);
    let response = JSON.parse(this.responseText);
    let notification = document.getElementById(response["id"]);
    notification.style.opacity = 0
    setTimeout(function (notification) {
        let notifications = document.getElementById("notifications");
        notifications.removeChild(notification);
    }, 1000, notification);
}



