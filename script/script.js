function output(array, classname, div)
{
    document.getElementById(div).innerHTML = "";
    if(!Array.isArray(array))
    {
        array=Array.from(array); //sarà un array lo devi accettare
    }
    
    //per ogni classe vengono creati gli elementi html di una tabella
    var i=1;
    for(var element in array) //ciclo per ogni oggetto nell'array
    {
        var obj = document.createElement("div");
        obj.className = classname;
        obj.id=classname.slice(0,3)+i; //esempio classname=artist e i=1 --> art1
        
        for(var property in Object.values(array[element])) //ciclo per ogni proprietà dell'oggetto
        {
            var key; //nome della proprietà
            var proprieta; //valore della proprietà
            
            //generazione delle proprietà dell'oggetto in HTML
            if(property == 5 && classname=="canzone") //output dell'url canzone
            {
                var br = document.createElement("br");
                var divObj = document.createElement("audio");
                divObj.classname="canzoneaudio";
                divObj.setAttribute("controls",true);
                var urlcanzone = Object.values(array[element])[property]; //salva l'url nella variabile
                divObj.innerHTML ='<source src="'+urlcanzone+'" />';
                obj.appendChild(br);
                obj.appendChild(divObj);
                //var urlcanzone = Object.values(array[element])[property]; //salva l'url nella variabile
                //document.getElementById(div).innerHTML+='<audio controls><source src="'+urlcanzone+'" /></audio>';
                //non inserisce l'url delle canzoni
            }
            else if(property == 0 && classname=="canzone") //output del titolo della canzone
            {
                var br = document.createElement("br");
                var divObj	= document.createElement("div");
                proprieta = Object.values(array[element])[property];
                key = Object.keys(array[element])[property];
                var text = document.createTextNode(proprieta);
                divObj.appendChild(text);
                divObj.className = classname + key; //esempio classname=canzone e key=titolo --> canzonetitolo
                obj.appendChild(divObj);
                obj.appendChild(br);
            }
            else
            {
                var divObj	= document.createElement("div");
                proprieta = Object.values(array[element])[property];
                key = Object.keys(array[element])[property];
                var text = document.createTextNode(proprieta);
                divObj.appendChild(text);
                divObj.className = classname + key; //esempio classname=canzone e key=titolo --> canzonetitolo
                obj.appendChild(divObj);
            }
            document.getElementById(div).appendChild(obj);
        }
        i++;
    }
}

function getArtisti()
{
    //preparo la richiesta ajax
    let xhr = new XMLHttpRequest();
    xhr.open("GET", 'api/apiArtist.php', true); //DA CAPIRE QUALE URL UTILIZZARE
    //configuro la callback di risposta ok
    xhr.onload = function()
    {
        var obj = JSON.parse(xhr.response); //viene creato un array dal JSON ricevuto dopo aver modificato la risposta per creare l'array in modo corretto
        output(obj, "artista", "contentArtisti");
        
    };
    //configuro la callback di errore
    xhr.onerror = function()
    { 
        alert('Errore');
    };
    //invio la richiesta ajax
    xhr.send();
}

function getCanzoni()
{
    //preparo la richiesta ajax
    let xhr = new XMLHttpRequest();
    xhr.open("GET", 'api/apiSong.php', true); //DA CAPIRE QUALE URL UTILIZZARE
    //configuro la callback di risposta ok
    xhr.onload = function()
    {
        var obj = JSON.parse(xhr.response); //viene creato un array dal JSON ricevuto dopo aver modificato la risposta per creare l'array in modo corretto
        output(obj, "canzone", "contentCanzoni");
    };
    //configuro la callback di errore
    xhr.onerror = function()
    { 
        alert('Errore');
    };
    //invio la richiesta ajax
    xhr.send();
}

function setUtente()
{
    var genderRadios = document.getElementsByName("gender");
    var Sex = null;
    for (var i = 0, length = genderRadios.length; i < length; i++) //controlla tutti i radio button del sesso
    {
        if (genderRadios[i].checked)
        {
            Sex = genderRadios[i].value;
            break;
        }
    }
    //viene creato l'utente per mandare i parametri all'API
    var user = {Username: document.getElementById("Username").value, eMail: document.getElementById("eMail").value, Password: document.getElementById("Password").value, Sesso: Sex, Admin: "0"};

    console.log(user);
    //preparo la richiesta ajax
    let xhr = new XMLHttpRequest();
    xhr.open("POST", 'api/apiUser.php', true); //DA CAPIRE QUALE URL UTILIZZARE
    //configuro la callback di risposta ok
    xhr.onload = function()
    {
        var obj = JSON.parse(xhr.response);
    };
    //configuro la callback di errore
    xhr.onerror = function()
    { 
        alert('Errore');
    };

    //invio la richiesta ajax
    xhr.send(JSON.stringify(user));
}