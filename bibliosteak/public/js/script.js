
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


// window.location.href = "https://www.example.com/nouvelle-page";