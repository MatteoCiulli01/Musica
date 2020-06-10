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

            switch (classname)
            {
                case "canzone":
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
                    break;

                case "album":
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
                    break;

                case "lezione":
                    switch(key)
                    {
                        case "id_lezione":
                            obj.id=classname.slice(0,3)+proprieta;
                            break;

                        case "data_ora":
                            proprieta = proprieta.slice(0,10) + "T" + proprieta.slice(11,16);

                            var br = document.createElement("br");
                            var divObj	= document.createElement("input");
                            divObj.className = classname + key; //esempio classname=canzone e key=titolo --> canzonetitolo
                            divObj.setAttribute("readonly", "true");
                            divObj.setAttribute("type", "datetime-local");
                            divObj.setAttribute("value", proprieta);
                            obj.appendChild(divObj);
                            obj.appendChild(br);
                            break;

                        case "url_mappa":
                            var br = document.createElement("br");
                            var iframeObj	= document.createElement("iframe");
                            iframeObj.className = classname + key; //esempio classname=canzone e key=titolo --> canzonetitolo
                            iframeObj.setAttribute("src", proprieta);
                            iframeObj.style.width = "250px";
                            iframeObj.style.height = "250px";
                            obj.appendChild(br);
                            obj.appendChild(iframeObj);
                            break;
                            
                        default:
                            var divObj	= document.createElement("div");
                            var text = document.createTextNode(proprieta);
                            divObj.appendChild(text);
                            divObj.className = classname + key; //esempio classname=canzone e key=titolo --> canzonetitolo
                            obj.appendChild(divObj);
                            break;
                    }
                    obj.style.fontWeight = "bold";
                    obj.style.fontSize = "22px";
                    break;

                case "mappa":
                    switch(key)
                    {
                        case "url_mappa":
                            var br = document.createElement("br");
                            var iframeObj = document.createElement("iframe");
                            iframeObj.className = classname + key; //esempio classname=canzone e key=titolo --> canzonetitolo
                            iframeObj.id = "frame" + obj.id; //esempio framemap1;
                            iframeObj.setAttribute("src", proprieta);
                            iframeObj.setAttribute("onmouseover", 'getLezioni(\''+ iframeObj.id +'\')');
                            iframeObj.style.width = "250px";
                            iframeObj.style.height = "250px";
                            obj.appendChild(br);
                            obj.appendChild(iframeObj);
                            break;

                        default:
                            var divObj	= document.createElement("div");
                            var text = document.createTextNode(proprieta);
                            divObj.appendChild(text);
                            divObj.className = classname + key; //esempio classname=canzone e key=titolo --> canzonetitolo
                            obj.appendChild(divObj);
                            break;
                    }
                    break;

                case "lezioneALL":
                    var annoMappa;
                    var nome;
                    switch(key)
                    {
                        case "anno":
                            annoMappa = proprieta;
                            break;

                        case "mese":
                            var arrayMesi;
                            var anno = annoMappa;
                            var input = document.createElement("input");

                            if(proprieta.length==1)
                            {
                                proprieta = "0" + proprieta;
                            }

                            if(obj.id.slice(3)>1)
                            {
                                arrayMesi = document.getElementsByClassName("lezioneALLmese");
                            }

                            if(arrayMesi != null && arrayMesi[arrayMesi.length-1].value == anno+"-"+proprieta)
                            {
                                break;
                            }
                            else
                            {
                                input.className = classname + key;
                                input.setAttribute("type", "month");
                                input.setAttribute("value", anno+"-"+proprieta); //esempio 2020-06
                                input.setAttribute("readonly", "true");
                                obj.appendChild(input);
                            }
                            break;

                        case "nome_insegnante":
                            nome = proprieta;
                            break;

                        case "cognome_insegnante":
                            var fullName = document.createElement("div");
                            fullName.innerHTML = "Insegnante: <b class=\"orange\">" +nome + " "+proprieta+"</b>";
                            fullName.className = "fullname_insegnante" + key;
                            obj.appendChild(fullName);
                            break;

                        case "utenti":
                            var allievi = document.createElement("div");
                            allievi.innerHTML="Allievi: <b>" + proprieta+ "</b>";
                            allievi.className = classname + key;
                            obj.appendChild(allievi);
                            break;
                        
                        default:
                            var divObj	= document.createElement("div");
                            var text = document.createTextNode(proprieta);
                            divObj.appendChild(text);
                            divObj.className = classname + key; //esempio classname=canzone e key=titolo --> canzonetitolo
                            obj.appendChild(divObj);
                            break;
                    }
                    break;
                
                default:
                    var divObj	= document.createElement("div");
                    var text = document.createTextNode(proprieta);
                    divObj.appendChild(text);
                    divObj.className = classname + key; //esempio classname=canzone e key=titolo --> canzonetitolo
                    obj.appendChild(divObj);
                    break;
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

        if(window.location.pathname == "/indexAdmin.php" && (classname.slice(0,3)=="can" || classname.slice(0,3)=="alb")) //solo per le canzoni nella pagina indexAdmin.php e le lezioni nella pagina pageLezioni.php
        {
            obj.appendChild(adminButtons(obj.id));
        }
        if(window.location.pathname == "/pageLezioniUser.php" && classname == "lezione")
        {
            obj.appendChild(lessonDeleteButtons(obj.id));
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

function lessonDeleteButtons(id)
{
    var divButtons = document.createElement("div");
    divButtons.className = "lessonDeleteButtons";
    var deleteBtn = document.createElement("img");
    deleteBtn.id="lessonDelete_"+id; //esempio: adminDelete_can1
    deleteBtn.setAttribute("src","./img/deletebtn.png");
    deleteBtn.setAttribute("onclick", "deleteObject('" + id + "')");
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

    case "lez":
        var id = objName.slice(3);
        //preparo la richiesta ajax
        xhr = new XMLHttpRequest();
        xhr.open("DELETE", 'api/apiLesson.php?id='+ id, true);
        //configuro la callback di risposta ok
        xhr.onload = function()
        {
            var obj = JSON.parse(xhr.response); //viene creato un oggetto dal JSON ricevuto
            getLezioniUser();
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

function getMappe()
{
    //preparo la richiesta ajax
    let xhr = new XMLHttpRequest();
    xhr.open("GETMAPS", 'api/apiLesson.php', true);
    //configuro la callback di risposta ok
    xhr.onload = function()
    {
        if(xhr.response=="")
        {
            document.getElementById("contentLezioni").innerHTML = "Non ci sono lezioni pianificate.";
            document.getElementById("contentLezioni").style.fontWeight = "bold";
            document.getElementById("contentLezioni").style.fontSize = "23px";
        }
        else
        {
            var obj = JSON.parse(xhr.response); //viene creato un oggetto dal JSON ricevuto
            output(obj, "mappa", "contentLezioni"); //output dell'oggetto lezione
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

function hideLezioniALL()
{
    document.getElementById("contentLezioniALL").style.display = "none";
}

function getLezioni(map)
{
    map = document.getElementById(map).src;
    var mappa = {"map": map};

    //preparo la richiesta ajax
    let xhr = new XMLHttpRequest();
    xhr.open("GETLEZ", 'api/apiLesson.php', true);
    //configuro la callback di risposta ok
    xhr.onload = function()
    {
        if(xhr.response=="")
        {
            document.getElementById("contentLezioniALL").style.display = "block";
            document.getElementById("contentLezioniALL").innerHTML = "Non ci sono lezioni pianificate.";
            document.getElementById("contentLezioniALL").style.fontWeight = "bold";
            document.getElementById("contentLezioniALL").style.fontSize = "23px";
            document.getElementById("contentLezioniALL").innerHTML += '<img id="btncloseLezioniALL" onclick="hideLezioniALL();" src="img/close.png">';
        }
        else
        {
            var obj = JSON.parse(xhr.response); //viene creato un oggetto dal JSON ricevuto
            document.getElementById("contentLezioniALL").style.display = "block";
            output(obj, "lezioneALL", "contentLezioniALL"); //output dell'oggetto lezione
            document.getElementById("contentLezioniALL").innerHTML+='<img id="btncloseLezioniALL" onclick="hideLezioniALL();" src="img/close.png">';
        }
    };
    //configuro la callback di errore
    xhr.onerror = function()
    { 
        alert('Errore');
    };
    //invio la richiesta ajax
    xhr.send(JSON.stringify(mappa));
}

function getLezioniUser()
{
    var user = document.getElementById("username").innerHTML;
    //preparo la richiesta ajax
    let xhr = new XMLHttpRequest();
    xhr.open("GETUSER", 'api/apiLesson.php?user='+user, true);
    //configuro la callback di risposta ok
    xhr.onload = function()
    {
        if(xhr.response=="")
        {
            document.getElementById("contentLezioni").innerHTML = "Non hai lezioni pianificate.";
            document.getElementById("contentLezioni").style.fontWeight = "bold";
            document.getElementById("contentLezioni").style.fontSize = "23px";
        }
        else
        {
            var obj = JSON.parse(xhr.response); //viene creato un oggetto dal JSON ricevuto
            output(obj, "lezione", "contentLezioni"); //output dell'oggetto lezione
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

let boolShowAddLezione = false;
function showAddLezione()
{
    if(boolShowAddLezione == false)
    {
        if(document.getElementById("LezInsegnante").options.length==0)
        {
            getInsegnantiDropdown();
        }

        document.getElementById("addLessonPanel").style.display = "block";
        boolShowAddLezione = true;
        document.documentElement.scrollTop = document.documentElement.scrollHeight;
    }
    else
    {
        document.getElementById("addLessonPanel").style.display = "none";
        boolShowAddLezione = false;
    }
}

function getInsegnantiDropdown()
{
    //preparo la richiesta ajax
    let xhr = new XMLHttpRequest();
    xhr.open("GETDROPINS", 'api/apiLesson.php', true);
    //configuro la callback di risposta ok
    xhr.onload = function()
    {
        if(xhr.response!="")
        {
            var obj = JSON.parse(xhr.response); //viene creato un oggetto dal JSON ricevuto
            var select = document.getElementById("LezInsegnante");
            for (i=0; i < obj.length; i++)
            {
                option = document.createElement('option');
                option.setAttribute('value', obj[i].id_insegnante);
                option.appendChild(document.createTextNode(obj[i].nomeInsegnante + " " + obj[i].cognomeInsegnante));
                select.appendChild(option);
            }

            getInsegnantiMap();
        }
    };
    //configuro la callback di errore
    xhr.onerror = function()
    { 
        alert('Errore');
    };
    //invio la richiesta ajax
    xhr.send();

    var today = new Date();

    var arrayToday = [new String(today.getMonth()+1), new String(today.getDate()), new String(today.getHours()), new String(today.getMinutes())];
    
    for(var i = 0; i<arrayToday.length;i++)
    {
        if(arrayToday[i].length==1)
        {
            arrayToday[i] = "0"+ arrayToday[i]; //vengono formattati tutti i dati per essere utilizzati nel javascript
        }
    }

    var date = today.getFullYear()+'-'+arrayToday[0]+'-'+arrayToday[1]+'T'+arrayToday[2]+':'+arrayToday[3]; //esempio 2020-06-08T16:20
    document.getElementById("LezDate").setAttribute("value", date);
    document.getElementById("LezDate").setAttribute("min", date);
}

function getInsegnantiMap()
{
    var idInsegnante = document.getElementById("LezInsegnante").value;
    //preparo la richiesta ajax
    let xhr = new XMLHttpRequest();
    xhr.open("GETINSMAPPA", 'api/apiLesson.php?ins='+idInsegnante, true);
    //configuro la callback di risposta ok
    xhr.onload = function()
    {
        if(xhr.response!="")
        {
            var obj = JSON.parse(xhr.response); //viene creato un oggetto dal JSON ricevuto
            document.getElementById("LezMappa").setAttribute("src", obj.url_mappa);
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

let flagAvailable = false;
function checkifLessonAvailable()
{
    var idInsegnante = document.getElementById("LezInsegnante").value;
    var date = document.getElementById("LezDate").value;

    //preparo la richiesta ajax
    let xhr = new XMLHttpRequest();
    xhr.open("CHECKINS", 'api/apiLesson.php?ins='+idInsegnante+"&date="+date, true);
    //configuro la callback di risposta ok
    xhr.onload = function()
    {
        if(xhr.response!="")
        {
            document.getElementById("LezStatus").innerHTML = "Orario non disponibile";
            flagAvailable = false;
        }
        else
        {
            document.getElementById("LezStatus").innerHTML = "";
            flagAvailable = true;
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

function addLezione()
{
    if(flagAvailable == true)
    {
        document.getElementById("LezStatus").innerHTML = "";
        
        var username = document.getElementById("username").innerHTML;
        var dataora = document.getElementById("LezDate").value;
        var idInsegnante = document.getElementById("LezInsegnante").value;

        if(dataora == "" || idInsegnante == "")
        {
            document.getElementById("LezStatus").innerHTML = "Inserisci tutti i dati";
        }
        else
        {
            var lesson = {Username: username, DataOra: dataora, Insegnante: idInsegnante};

            //preparo la richiesta ajax
            let xhr = new XMLHttpRequest();
            xhr.open("POST", 'api/apiLesson.php', true);
            //configuro la callback di risposta ok
            xhr.onload = function()
            {
                if(xhr.status==200)
                {
                    document.getElementById("LezStatus").innerHTML = "";
                    getLezioniUser();
                    showAddLezione();
                    flagAvailable = false;
                }
            };
            //configuro la callback di errore
            xhr.onerror = function()
            { 
                alert('Errore');
            };

            //invio la richiesta ajax
            xhr.send(JSON.stringify(lesson));
        }
    }
    else
    {
        document.getElementById("LezStatus").innerHTML = "Orario non disponibile";
    }
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
    //animazione di transizione del menu laterale
    document.getElementById("Dropdown").style.left= "100%";
    document.getElementById("Dropdown").style.transition= "left 200ms linear";
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