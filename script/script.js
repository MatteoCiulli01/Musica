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
            else if(classname=="album")
            {
                switch(key)
                {
                    case "id_album":
                        obj.id=classname.slice(0,3)+proprieta; //esempio classname=album e id=1 --> alb1
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

        if(window.location.pathname == "/indexAdmin.php" && (classname.slice(0,3)=="can" || classname.slice(0,3)=="alb")) //solo per le canzoni nella pagina indexAdmin.php
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
    /*
    var editBtn = document.createElement("img");
    editBtn.id="adminEdit_"+id; //esempio: adminEdit_canzone1
    //editBtn.className = "btn btn-info";
    editBtn.setAttribute("src","./img/editbtn.png");

    divButtons.appendChild(editBtn);*/
    divButtons.appendChild(deleteBtn);

    return divButtons;
}

function deleteObject(objName)
{
    let xhr;
    switch(objName.slice(0,3))
    {
    case "can":
        var id = objName.slice(3); //esempio: objName= can56 -> id= 56
        //preparo la richiesta ajax
        xhr = new XMLHttpRequest();
        xhr.open("DELETE", 'api/apiSong.php?id='+ id, true);
        //configuro la callback di risposta ok
        xhr.onload = function()
        {
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
        break;
    
    case "alb":
        var id = objName.slice(3);
        //preparo la richiesta ajax
        xhr = new XMLHttpRequest();
        xhr.open("DELETE", 'api/apiAlbum.php?id='+ id, true);
        //configuro la callback di risposta ok
        xhr.onload = function()
        {
            var obj = JSON.parse(xhr.response); //viene creato un oggetto dal JSON ricevuto
            getAlbum();
            getCanzoni();
        };
        //configuro la callback di errore
        xhr.onerror = function()
        { 
            alert('Errore');
        };
        //invio la richiesta ajax
        xhr.send();
        break;

    default:
        break;
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

function getAlbum()
{
    //preparo la richiesta ajax
    let xhr = new XMLHttpRequest();
    xhr.open("GET", 'api/apiAlbum.php', true); 
    //configuro la callback di risposta ok
    xhr.onload = function()
    {
        var obj = JSON.parse(xhr.response); //viene creato un oggetto dal JSON ricevuto
        output(obj, "album", "contentAlbum"); //output dell'oggetto canzone
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
                document.getElementById("SignUpStatus").innerHTML = xhr.response;
            }
            else
            {
                document.getElementById("modulo_signup").style.display = "none"; //nasconde il div di signup
                document.getElementById("SignUpStatus").style.display = "none"; //nasconde il div di stato del signup*/
                document.getElementById("attEmail").style.display = "block"; //mostra il div di conferma 
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

var boolShowAddCanzone = false;
function showAddCanzone()
{
    if(boolShowAddCanzone == false)
    {
        if(document.getElementById("CanAlbum").options.length==0)
        {
            getAlbumDropdown();
        }
        
        document.getElementById("addSongPanel").style.display = "block";
        boolShowAddCanzone = true;
    }
    else
    {
        document.getElementById("addSongPanel").style.display = "none";
        boolShowAddCanzone = false;
    }
}

var boolShowAddAlbum = false;
function showAddAlbum()
{
    if(boolShowAddAlbum == false)
    {
        if(document.getElementById("AlbArtist").options.length==0)
        {
            getArtistDropdown();
        }

        document.getElementById("addAlbumPanel").style.display = "block";
        boolShowAddAlbum = true;
    }
    else
    {
        document.getElementById("addAlbumPanel").style.display = "none";
        boolShowAddAlbum = false;
    }
}

function addCanzone()
{
    var titolo = document.getElementById("CanTitle").value;
    var genere = document.getElementById("CanGenre").value;
    var anno = document.getElementById("CanYear").value;
    var album = document.getElementById("CanAlbum").value;
    var path = document.getElementById("CanFile").value.replace(/^.*[\\\/]/, '');
    var file = document.getElementById("CanFile").files[0];

    var fr = new FileReader();

    if(titolo == "" || genere == "" || anno == "" || album == "" || path == "")
    {
        document.getElementById("CanStatus").innerHTML = "Inserisci tutti i dati";
    }
    else if(anno < 0 || anno > new Date().getFullYear() || isNaN(anno))
    {
        document.getElementById("CanStatus").innerHTML = "Inserisci un anno valido";
    }
    else
    {
        fr.onloadend = function(evt)
        {
            var song = {Titolo: titolo, Genere: genere, Anno: anno, Path: path, Album: album, File: btoa(evt.target.result)};

            //preparo la richiesta ajax
            let xhr = new XMLHttpRequest();
            xhr.open("POST", 'api/apiSong.php', true);
            //configuro la callback di risposta ok
            xhr.onload = function()
            {
                if(xhr.status==200)
                {
                    document.getElementById("CanStatus").innerHTML = "";
                    getCanzoni();
                    showAddCanzone();
                }
            };
            //configuro la callback di errore
            xhr.onerror = function()
            { 
                alert('Errore');
            };

            //invio la richiesta ajax
            xhr.send(JSON.stringify(song));
        };
        fr.readAsBinaryString(file);
    }
}

function addAlbum()
{
    var nome = document.getElementById("AlbName").value;
    var genere = document.getElementById("AlbGenre").value;
    var anno = document.getElementById("AlbYear").value;
    var artista = document.getElementById("AlbArtist").value;
    var path = document.getElementById("AlbFile").value.replace(/^.*[\\\/]/, '');
    var file = document.getElementById("AlbFile").files[0];

    var fr = new FileReader();

    if(nome == "" || genere == "" || anno == "" || artista == "" || path == "")
    {
        document.getElementById("AlbStatus").innerHTML = "Inserisci tutti i dati";
    }
    else if(anno < 0 || anno > new Date().getFullYear() || isNaN(anno))
    {
        document.getElementById("AlbStatus").innerHTML = "Inserisci un anno valido";
    }
    else
    {
        fr.onloadend = function(evt)
        {
            var song = {Nome: nome, Genere: genere, Anno: anno, Artista: artista, Path: path, File: btoa(evt.target.result)};

            //preparo la richiesta ajax
            let xhr = new XMLHttpRequest();
            xhr.open("POST", 'api/apiAlbum.php', true);
            //configuro la callback di risposta ok
            xhr.onload = function()
            {
                if(xhr.status==200)
                {
                    document.getElementById("AlbStatus").innerHTML = "";
                    getAlbum();
                    showAddAlbum();
                }
            };
            //configuro la callback di errore
            xhr.onerror = function()
            { 
                alert('Errore');
            };

            //invio la richiesta ajax
            xhr.send(JSON.stringify(song));
        };
        fr.readAsBinaryString(file);
    }
}

function checkifMP3()
{
    var filePath = document.getElementById("CanFile").value;

    var allowed = /(\.mp3)$/i;

    if (!allowed.exec(filePath))
    { 
        document.getElementById("CanStatus").innerHTML = "Inserisci un file con estensione .mp3";
        document.getElementById("CanFile").value = "";
        return false;
    }
    else
    {
        document.getElementById("CanStatus").innerHTML = "";
        return true;
    }
}

function checkifImage()
{
    var filePath = document.getElementById("AlbFile").value;

    var allowed = /(\.png|\.jpg|\.jpeg)$/i;

    if (!allowed.exec(filePath))
    { 
        document.getElementById("AlbStatus").innerHTML = "Inserisci un'immagine con estensione .png, .jpg o .jpeg";
        document.getElementById("AlbFile").value = "";
        return false;
    }
    else
    {
        document.getElementById("AlbStatus").innerHTML = "";
        return true;
    }
}

function getAlbumDropdown()
{
    //preparo la richiesta ajax
    let xhr = new XMLHttpRequest();
    xhr.open("GETDROPDOWN", 'api/apiAlbum.php', true);
    //configuro la callback di risposta ok
    xhr.onload = function()
    {
        var obj = JSON.parse(xhr.response); //viene creato un oggetto dal JSON ricevuto
        var select = document.getElementById("CanAlbum");
        for (i=0; i < obj.length; i++)
        {
            option = document.createElement('option');
            option.setAttribute('value', obj[i].id_album);
            option.appendChild(document.createTextNode(obj[i].nomeAlbum+ " - " + obj[i].nomeArtista));
            select.appendChild(option);
        } 
    };
    //configuro la callback di errore
    xhr.onerror = function()
    { 
        alert('Errore');
    };
    //invio la richiesta ajax
    xhr.send();
}
function modCod()
{
    var username = document.getElementById("Username").value;
    var cod = document.getElementById("confCoderr").value;
    let xhr = new XMLHttpRequest();
    //asincrona
    xhr.open("MATCH",'api/apiCod.php', true);
    //configuro la callback di risposta ok
    xhr.onload = function()
    {
        var ret = JSON.parse(xhr.response);
        if(ret.result==true)
        {
            document.getElementById("codErr").style.display = "none";
            document.getElementById("check2").style.display = "block";
            document.getElementById("us2").innerHTML = document.getElementById("Username").value; //assegna al p us il valore dell'username inserito in modo di mostrarlo a video nel div check
            countdown();//avvia la funzione countdown che dopo tot secondi reindizzerà alla pagina login
        }
        else if(ret.result==false)
        {
            document.getElementById("confCoderr").value = "";
            document.getElementById("error2").innerHTML = "Codice errato";
        }
    };
    //configuro la callback di errore
    xhr.onerror = function(error) { 
        alert('Errore');
    };
    //invio la richista ajax
    xhr.send(JSON.stringify({
    "username":username,
    "confirm_code":cod   
    }));
}
function getArtistDropdown()
{
    //preparo la richiesta ajax
    let xhr = new XMLHttpRequest();
    xhr.open("GETDROPDOWN", 'api/apiArtist.php', true);
    //configuro la callback di risposta ok
    xhr.onload = function()
    {
        var obj = JSON.parse(xhr.response); //viene creato un oggetto dal JSON ricevuto
        var select = document.getElementById("AlbArtist");
        for (i=0; i < obj.length; i++)
        {
            option = document.createElement('option');
            option.setAttribute('value', obj[i].id_artista);
            option.appendChild(document.createTextNode(obj[i].nomeArtista));
            select.appendChild(option);
        }
    };
    //configuro la callback di errore
    xhr.onerror = function()
    { 
        alert('Errore');
    };
    //invio la richiesta ajax
    xhr.send();
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
                if(login.result != false)
                {
                    if(login.admin==1) //se l'admin ha effettuato il login
                    {
                        page("./indexAdmin.php");
                    }
                    else //per gli utenti normali
                    {
                        page("./indexUser.php");
                    }
                }
                else
                {
                    document.getElementById("modulo_signup").style.display = "none";
                    document.getElementById("codErr").style.display = "block";
                }
            }
            catch(e) //nel caso non sia trovato un utente
            {
                document.getElementById("LogInStatus").innerHTML=xhr.response;
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
function controlloCod()
{
    var confirm_code = document.getElementById('confCod').value;
    var username = document.getElementById("Username").value;
    let xhr = new XMLHttpRequest();
    xhr.open("MATCH", 'api/apiCod.php', true);
    //configuro la callback di risposta ok
    xhr.onload = function()
    {
        var ret = JSON.parse(xhr.response);
        if(ret.result==true)
        {
            document.getElementById("attEmail").style.display = "none";
            document.getElementById("check").style.display = "block";

            document.getElementById("us").innerHTML = document.getElementById("Username").value; //assegna al p us il valore dell'username inserito in modo di mostrarlo a video nel div check
            countdown();//avvia la funzione countdown che dopo tot secondi reindizzerà alla pagina login
        }
        else if(ret.result==false)
        {
            document.getElementById("confCod").value = "";
            document.getElementById("error").innerHTML = "Codice errato";
        }
    };
    //configuro la callback di errore
    xhr.onerror = function()
    { 
        alert('Errore');
    };

    xhr.send(JSON.stringify({
        "confirm_code":confirm_code,
        "username":username 
        }));
}

// Execute a function when the user releases a key on the keyboard
document.addEventListener("keyup", function(event)
{
    var inputLogin = document.getElementById("Username");
    var inputPass = document.getElementById("Password");

    if(event.target == inputLogin || event.target == inputPass)
    {
        if (event.keyCode == 13)
        {
            if(window.location.pathname == "/SignUp.php")
            {
                document.getElementById("signupBtn").click();
            }
            else if(window.location.pathname == "/LogIn.php")
            {
                document.getElementById("login").click();
            }
        }
    }
    else
    {
        return;
    }
});