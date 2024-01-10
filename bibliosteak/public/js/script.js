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

var selected_search = document.getElementById('select-search');
var research = document.getElementById('input-search');

function sendRequest() {
    var request = new XMLHttpRequest();

    switch (selected_search.value) {
        case 'titre':
            window.location.href = "https://127.0.0.1:8000/api/livres?page=1&id=&nom=" + encodeURIComponent(research.value);
            break;
        case 'auteur':
            window.location.href = "https://127.0.0.1:8000/api/livres?page=1&id=&auteur=" + encodeURIComponent(research.value);
            break;
        case 'editeur':
            window.location.href = "https://127.0.0.1:8000/api/livres?page=1&id=&editeur=" + encodeURIComponent(research.value);
            break;
        default:
            window.location.href = "https://127.0.0.1:8000/livres";
            break;
    }

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
    // Manipulez le DOM pour afficher les résultats comme vous le souhaitez
    // Par exemple, créez des éléments HTML pour chaque livre et ajoutez-les à la page
    var resultsDiv = document.getElementById('results');
    resultsDiv.innerHTML = ""; // Clear previous results

    for (var i = 0; i < data.length; i++) {
        var bookDiv = document.createElement('div');
        bookDiv.innerHTML = '<h2>' + data[i].title + '</h2><p>Auteur : ' + data[i].author + '</p>';
        resultsDiv.appendChild(bookDiv);
    }
}


function displayAllBook(){

    var request = new XMLHttpRequest();
    
    request.open('GET', 'https://127.0.0.1:8000/api/livres', true);
    
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
                <a class="link-detail-book" href="https://127.0.0.1:8000/livre/detail/${livre.id}">
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


// window.location.href = "https://www.example.com/nouvelle-page";