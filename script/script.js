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
            var key = Object.keys(array[element])[property]; //nome della proprietà
            var proprieta = Object.values(array[element])[property]; //valore della proprietà

            if(classname=="canzone")
            {
                switch(key)
                {
                    case "id_canzone":
                        obj.id=classname.slice(0,3)+proprieta; //esempio classname=canzone e id=1 --> can1
                        break;
                    case "url_canzone":
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
                        break;
                    
                    case "titolo":
                        var br = document.createElement("br");
                        var divObj	= document.createElement("div");
                        var text = document.createTextNode(proprieta);
                        divObj.appendChild(text);
                        divObj.className = classname + key; //esempio classname=canzone e key=titolo --> canzonetitolo
                        obj.appendChild(divObj);
                        obj.appendChild(br);
                        break;

                    case "url_cover":
                        var divObj = document.createElement("img");
                        divObj.className="canzonealbumcover";
                        var urlalbumcover = Object.values(array[element])[property]; //salva l'url nella variabile
                        divObj.setAttribute("src",urlalbumcover);
                        obj.appendChild(divObj);
                        break;

                    default:
                        var divObj	= document.createElement("div");
                        var text = document.createTextNode(proprieta);
                        divObj.appendChild(text);
                        divObj.className = classname + key; //esempio classname=canzone e key=titolo --> canzonetitolo
                        obj.appendChild(divObj);
                        break;
                }
            }
            else
            {
                var divObj	= document.createElement("div");
                var text = document.createTextNode(proprieta);
                divObj.appendChild(text);
                divObj.className = classname + key; //esempio classname=canzone e key=titolo --> canzonetitolo
                obj.appendChild(divObj);
            }
            
            /*
            //generazione delle proprietà dell'oggetto in HTML
            if(key == "url_canzone" && classname=="canzone") //output dell'url canzone
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
            else if(key == "titolo" && classname=="canzone") //output del titolo della canzone
            {
                var br = document.createElement("br");
                var divObj	= document.createElement("div");
                var text = document.createTextNode(proprieta);
                divObj.appendChild(text);
                divObj.className = classname + key; //esempio classname=canzone e key=titolo --> canzonetitolo
                obj.appendChild(divObj);
                obj.appendChild(br);
            }
            else if(key=="url_cover" && classname=="canzone") //output della cover dell'album della canzone
            {
                var divObj = document.createElement("img");
                divObj.className="canzonealbumcover";
                var urlalbumcover = Object.values(array[element])[property]; //salva l'url nella variabile
                divObj.setAttribute("src",urlalbumcover);
                obj.appendChild(divObj);
            }
            else
            {
                var divObj	= document.createElement("div");
                var text = document.createTextNode(proprieta);
                divObj.appendChild(text);
                divObj.className = classname + key; //esempio classname=canzone e key=titolo --> canzonetitolo
                obj.appendChild(divObj);
            }*/
            document.getElementById(div).appendChild(obj);
        }

        if(window.location.pathname == "/indexAdmin.php")
        {
            obj.appendChild(adminButtons(obj.id));
        }
        i++;
    }
}

function adminButtons(id)
{
    var divButtons = document.createElement("div");
    divButtons.className = "adminButtons";
    var deleteBtn = document.createElement("img");
    deleteBtn.id="adminDelete_"+id; //esempio: adminDelete_can1
    /*deleteBtn.className = "btn btn-info";*/
    deleteBtn.setAttribute("src","./img/deletebtn.png");
    deleteBtn.setAttribute("onclick", "deleteObject('" + id + "')");
    var editBtn = document.createElement("img");
    editBtn.id="adminEdit_"+id; //esempio: adminEdit_canzone1
    /*editBtn.className = "btn btn-info";*/
    editBtn.setAttribute("src","./img/editbtn.png");

    divButtons.appendChild(editBtn);
    divButtons.appendChild(deleteBtn);

    return divButtons;
}

function deleteObject(objName)
{
    if(objName.slice(0,3)=="can")
    {
        var id = objName.slice(3,4);
        //preparo la richiesta ajax
        let xhr = new XMLHttpRequest();
        xhr.open("DELETE", 'api/apiSong.php?id='+ id, true);
        //configuro la callback di risposta ok
        xhr.onload = function()
        {
            console.log(xhr.response);
            var obj = JSON.parse(xhr.response); //viene creato un oggetto dal JSON ricevuto

            getCanzoni();
            
        };
        //configuro la callback di errore
        xhr.onerror = function()
        { 
            alert('Errore');
        };
        //invio la richiesta ajax
        xhr.send();
    }
}

function getArtisti()
{
    //preparo la richiesta ajax
    let xhr = new XMLHttpRequest();
    xhr.open("GET", 'api/apiArtist.php', true);
    //configuro la callback di risposta ok
    xhr.onload = function()
    {
        var obj = JSON.parse(xhr.response); //viene creato un oggetto dal JSON ricevuto
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
    xhr.open("GET", 'api/apiSong.php', true); 
    //configuro la callback di risposta ok
    xhr.onload = function()
    {
        var obj = JSON.parse(xhr.response); //viene creato un oggetto dal JSON ricevuto
        output(obj, "canzone", "contentCanzoni"); //output dell'oggetto canzone
    };
    //configuro la callback di errore
    xhr.onerror = function()
    { 
        alert('Errore');
    };
    //invio la richiesta ajax
    xhr.send();
}

function getCanzoniLite() //output delle canzoni per gli utenti non loggati
{
    //preparo la richiesta ajax
    let xhr = new XMLHttpRequest();
    xhr.open("GETNOTLOGGED", 'api/apiSong.php', true);
    //configuro la callback di risposta ok
    xhr.onload = function()
    {
        var obj = JSON.parse(xhr.response); //viene creato un oggetto dal JSON ricevuto
        output(obj, "canzone", "contentCanzoni"); //output dell'oggetto canzone
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

    //preparo la richiesta ajax
    let xhr = new XMLHttpRequest();
    xhr.open("POST", 'api/apiUser.php', true);
    //configuro la callback di risposta ok
    xhr.onload = function()
    {
        if(xhr.status==200)
        {
            if(isNaN(parseFloat(xhr.response))) //se la risposta non è un numero (l'account è già esistente o non sono stati inseriti tutti i dati)
            {
                document.getElementById("status").innerHTML = xhr.response;
            }
            else
            {
                document.getElementById("modulo").style.display = "none"; //nasconde il div di signup
                document.getElementById("status").style.display = "none"; //nasconde il div di stato del signup
                document.getElementById("attEmail").style.display = "block"; //mostra il div di conferma
                
                document.getElementById('conf').onclick = function()
                {
                    document.getElementById("attEmail").style.display = "none"; 
                    document.getElementById("check").style.display = "block"; 
                    document.getElementById("us").innerHTML = document.getElementById("Username").value; //assegna al p us il valore dell'username inserito in modo di mostrarlo a video nel div check
                    countdown();//avvia la funzione countdown che dopo tot secondi reindizzerà alla pagina login
                };
            
            }
        }
    };
    //configuro la callback di errore
    xhr.onerror = function()
    { 
        alert('Errore');
    };

    //invio la richiesta ajax
    xhr.send(JSON.stringify(user));
}

function matchCredenziali() //controllo della presenza dell'utente con il login
{
    var username = document.getElementById("Username").value;
    var password = document.getElementById("Password").value;

    //viene creato l'utente per mandare i parametri all'API
    var user = {Username: username, Password: password};

    xhr = new XMLHttpRequest();
    xhr.open("MATCH", 'api/apiUser.php', true);

    xhr.onload = function()
    {
        if(xhr.status==200)
        {
            try
            {
                var login = JSON.parse(xhr.response);
                if(login.admin==1) //se l'admin ha effettuato il login
                {
                    page("./indexAdmin.php");
                }
                else //per gli utenti normali
                {
                    page("./indexUser.php");
                }
            }
            catch(e) //nel caso non sia trovato un utente
            {
                document.getElementById("status").innerHTML=xhr.response;
            }
        }
    };
    xhr.onerror = function()
    { 
        alert('Errore');
    };

    xhr.send(JSON.stringify(user));
}

function page(page) //metodo semplificato per cambiare pagina
{
    document.location.href = page;
}

var seconds = 5;    
function countdown() { //countdown reindirizzamento pagina
    seconds = seconds - 1;
    if (seconds < 0) {
        page("./LogIn.php");
    } else {
        document.getElementById("countdown").innerHTML = seconds;
        window.setTimeout("countdown()", 1000);
    }
}

/* Quando si clicca sul bottone si apre il dropdown */
function DropdownFunction()
{
    document.getElementById("Dropdown").classList.toggle("show");
    var w = window.innerWidth
    || document.documentElement.clientWidth
    || document.body.clientWidth;
    document.getElementById("Dropdown").style.left = w - document.getElementById("Dropdown").offsetWidth + "px";
}