
// The scroll goes directly at the bottom
let messagesGroup = document.getElementById('messagesGroup');
messagesGroup.scrollTop = messagesGroup.scrollHeight;

/**
 * My in "messagesGroup", all messages enter in DB by registered users.
 */
let buttonSend = document.getElementById('buttonSend');

let xhr = new XMLHttpRequest();
xhr.onload = function () {
    const messages = JSON.parse(xhr.responseText);
    messages.forEach(message => {
        messagesGroup.innerHTML += `
        <div class='flexColumn messages'>
                <div class='flexRow width100'>
                       <p class='width30 colorBlue bold'>${message.user['pseudo']}</p>
                       <p class='colorGrey'>${message.date}</p>
                </div>
                <p class='text'>${message.message}</p>
            </div>
    `;
    });
}

xhr.open('GET', '/api/messages');
xhr.send();

/**
 * Adding a message to the database.
 */

buttonSend.addEventListener('click', function(e) {
    e.preventDefault();
    let inputIdPseudo = document.getElementById('inputIdPseudo').value;
    let inputMessage = document.getElementById('inputMessage').value;
    let dateMessage = document.getElementById('inputDate').value;

    if(!inputIdPseudo || !inputMessage){
        console.log("All data are not set");
    }
    else {
        let xhr = new XMLHttpRequest();
        xhr.onload = function () {
            const response = JSON.parse(xhr.responseText);
            if(response.hasOwnProperty('error') && response.hasOwnProperty('message')){
                const div = document.createElement('div');
                div.classList.add('alert', `alert-${response.error}`);
                div.setAttribute('role', 'alert');
                div.innerHTML = response.message;
                document.body.appendChild(div);
            }
        }

        const messageData = {
            'message': inputMessage,
            'date': dateMessage.toLocaleString(),
            'user': inputIdPseudo,
        };

        xhr.open('POST', '/api/messages');
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.send(JSON.stringify(messageData));
    }

    document.location.reload();
});


