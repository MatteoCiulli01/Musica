var flagAudio = false;
var oldAudio;

document.addEventListener('play', function(e) //funzione per impedire la riproduzione di più file contemporaneamente
{
    if(flagAudio == false) //prima riproduzione di una canzone
    {
        flagAudio = true; //si indica che è stata riprodotta la prima canzone
        oldAudio = e.target; //viene salvata la canzone in una variabile
    }
    else if(e.target!=oldAudio) //dalla seconda riproduzione in poi (solo se un'altra canzone)
    {
        oldAudio.pause(); //viene messa in pausa la canzone salvata (quella riprodotta in precedenza)
        oldAudio.currentTime=0; //si azzera il timestamp della canzone
        oldAudio = e.target; //viene salvata la nuova canzone come l'ultima riprodotta
    }
}, true);

// Chiude il dropdown se si clicca fuori da esso
window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
        }
    }
    }
}