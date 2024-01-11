var currentUrl = window.location.href;

var apiUrl1 = window.location.protocol + "//" + window.location.hostname + ":" + window.location.port;
// console.log(apiUrl1);

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

var selected_search = document.getElementById('select-search');
var research = document.getElementById('input-search')

// console.log(apiUrl);

function sendRequest(){
    var request = new XMLHttpRequest();

    switch (selected_search.value) {
        case 'titre':
            var url = apiUrl+"livres?page=1&id=&nom=" + encodeURIComponent(document.getElementById('input-search').value);
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
            request.open('GET', apiUrl1+'/api/livres', true);
            window.location.href = apiUrl1+"/livres";
        break;
    }

    request.send();
}

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
            livreCard.innerHTML = `
                <div class="card-livre d-flex flex-column justify-content-center align-items-center">
                    <a class="link-detail-book" href="${apiUrl1}/livre/detail/${livre.id}">
                        <img class="couverture-livre" src="${livre.image}" alt="${livre.nom}-couverture">
                        <h3 class="titre-livre h5">${livre.nom}</h3>
                        <p class="auteur-livre">Auteur: ${livre.auteur}</p>
                        
                        <div class="note-livre">
                            ${generateStarRating(livre.note)}
                        </div>
                    </a>
                </div>`;
                
            function generateStarRating(note) {
                const maxStars = 5;
                const fullStars = Math.min(Math.floor(note), maxStars);
                const emptyStars = maxStars - fullStars;
                let starRatingHTML = '';

                // Afficher les étoiles remplies
                for (let i = 0; i < fullStars; i++) {
                    starRatingHTML += `<i class="bi bi-star-fill text-warning"></i>`;
                }

                // Afficher les étoiles vides
                for (let i = 0; i < emptyStars; i++) {
                    starRatingHTML += `<i class="bi bi-star"></i>`;
                }
                return starRatingHTML;
            }

        // Ajouter la carte à la div d'affichage des livres
        displayBookDiv.appendChild(livreCard);

    });
    }
    request.send();
}
