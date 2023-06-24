if(document.querySelector("#mapa")){
    const lat = 21.047692;
    const lng = -89.64429;
    const zoom = 16;

    var map = L.map('mapa').setView([lat, lng], zoom);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    L.marker([lat, lng]).addTo(map)
        .bindPopup('<h2 class="mapa__heading">DevWebcamp</h2> <p class="mapa__texto">Convención</p>')
        .openPopup();
}