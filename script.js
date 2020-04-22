function post(psw)
{
var xhr = new XMLHttpRequest();
var eMail = document.getElementById('eMail').value;
var Username = document.getElementById('Username').value;
var Sesso = document.getElementById('Sesso').value;
//asincrona
xhr.open("POST",'api/apiUtente.php', true); //DA CAPIRE QUALE URL UTILIZZARE
//configuro la callback di risposta ok
xhr.onload = function(message) {
    //scrivo la risposta nel body della pagina
    document.getElementById('insert').innerHTML = xhr.response;
};
//configuro la callback di errore
xhr.onerror = function(error) { 
    alert('Errore');
};
//invio la richista ajax
xhr.send(JSON.stringify({
"eMail":eMail,
"Username":Username,
"Sesso":Sesso,
"TCP":TC    
}));
}