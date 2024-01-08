
function handleKeyPress(event) {
    console.log('handleKeyPress')
    if (event.key === 'Enter') {
        sendRequest();
    }
}

function sendRequest(){
var request = new XMLHttpRequest();

request.open('GET', 'https://127.0.0.1:8000/api', true);

request.onload = function(){
    var data = JSON.parse(request.responseText);

    console.log(data);
}

request.send();
}

function displayAllBook(){

    var request = new XMLHttpRequest();
    
    request.open('GET', 'https://127.0.0.1:8000/api/livres', true);
    
    request.onload = function() {

        var data = JSON.parse(request.responseText);

        //Récupérer la div dans l'HTML où l'on va afficher le contenu de l'advice
        var apiDataElement = document.getElementById('display-book');

        //Injection du contenu de l'advice dans la div
        apiDataElement.textContent = data;

        const premierLivreInfos = data['hydra:member'][0].nom;
        console.log("Informations du premier livre :", premierLivreInfos);
    }
    request.send();

    document.addEventListener('DOMContentLoaded', function() {
        displayAllBook();
    });
    
    // document.addEventListener("DOMContentLoaded", displayAllBook);
}


// window.location.href = "https://www.example.com/nouvelle-page";