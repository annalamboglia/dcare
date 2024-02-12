// Create WebSocket connection.
const socket = new WebSocket('ws://localhost:5006/websocketserver');

// Listen for messages
socket.addEventListener('message', function (event) {

    let str_split = event.data.split('|');

    let id_scheda = str_split[0];
    let tipo_scheda = str_split[1];
    let paziente = str_split[2];

    let conferma = confirm(`Vuoi essere reindirizzato alla ${tipo_scheda.replace('_', ' ')} di ${paziente}?`);

    if (conferma == true) {
        window.location = window.location.origin + "/presentation/pages/" + tipo_scheda + ".php?id=" + id_scheda + "&scheda"
    }
});