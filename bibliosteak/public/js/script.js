var currentUrl = window.location.href;

var apiUrl1 = window.location.protocol + "//" + window.location.hostname + ":" + window.location.port;
console.log(apiUrl1);

var apiUrl = currentUrl.replace(/\/[^\/]*$/, '') + '/api/';

var selected_search = document.getElementById('select-search');

function handleKeyPress(event) {
    console.log('handleKeyPress')
    if (event.key === 'Enter') {
        
        if (selected_search.value){
            sendRequest();
        }else{
            alert('vous devez choisir un critère de recheche')
        }
    }
}

var research = "";
var encodedResearch = encodeURIComponent(research);

console.log(apiUrl);
function sendRequest(){
switch (selected_search.value) {
    case 'titre':
        console.log(research.value);
        var url = apiUrl+"livres?page=1&id=&nom="+encodeURIComponent(document.getElementById('input-search').value);
        window.location.href = url;
        break;
    case 'auteur':
        var url = apiUrl+"livres?page=1&id=&auteur=" + encodeURIComponent(document.getElementById('input-search').value);
        window.location.href = url;
        break;
    case 'editeur':
        var url = apiUrl+"livres?page=1&id=&editeur=" + encodeURIComponent(document.getElementById('input-search').value);
        window.location.href = url;
        //test
        console.log(url);
        break;
    default:
        var url = apiUrl+"livres";
        window.location.href = url;
        break;
}


var request = new XMLHttpRequest();
request.open('GET', url, true);

request.onload = function () {
    if (request.status >= 200 && request.status < 400) {
        // Succès de la requête, traitement des données JSON
        var data = JSON.parse(request.responseText);
        displayResults(data);
    } else {
        // Gestion des erreurs
        console.error("La requête a échoué avec le statut :", request.status);
    }
};

request.onerror = function () {
    console.error("Erreur réseau");
};

request.send();
}

function displayResults(data) {
    var resultsDiv = document.getElementById('results');

    // Manipulez le DOM pour afficher les résultats comme vous le souhaitez
    // Par exemple, créez des éléments HTML pour chaque livre et ajoutez-les à resultsDiv
    for (var i = 0; i < data.length; i++) {
        var bookDiv = document.createElement('div');
        bookDiv.innerHTML = '<h2>' + data[i].titre + '</h2><p>Auteur : ' + data[i].auteur + '</p>';
        resultsDiv.appendChild(bookDiv);
    }
}



// Construire l'URL pour la requête AJAX


function displayAllBook(){

    var request = new XMLHttpRequest();
    
    request.open('GET', apiUrl+"livres", true);
    
    request.onload = function() {

        var data = JSON.parse(request.responseText);

        //Récupérer la div dans l'HTML où l'on va afficher le contenu de l'advice
        var displayBookDiv = document.getElementById('display-book');

        // Utiliser forEach pour itérer sur chaque livre et créer une carte pour chaque livre
        data['hydra:member'].forEach(function (livre) {
            // Créer un élément de carte pour chaque livre
            var livreCard = document.createElement('div');
            livreCard.classList.add('livre-card');
            livreCard.classList.add('col-md-3');

            // Remplacer LIVRE_ID par l'id réel du livre

            // Ajouter le contenu du livre à la carte
            livreCard.innerHTML =` 
                <div class="card-livre d-flex flex-column justify-content-center align-items-center">
                <a class="link-detail-book" href="${apiUrl1}/livre/detail/${livre.id}">
                    <img class="couverture-livre" src="${livre.image}" alt="${livre.nom}-couverture">
                    <h3 class="titre-livre h5">${livre.nom}</h3>
                    <p class="auteur-livre">Auteur: ${livre.auteur}</p>
                    <p class="note-livre">Note: ${livre.note}</p>
                </a>
                </div>`;

        // Ajouter la carte à la div d'affichage des livres
        displayBookDiv.appendChild(livreCard);

    });
    }
    request.send();
}
