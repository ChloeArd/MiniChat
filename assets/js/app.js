/**
 * My in "messagesGroup", all messages enter in DB by registered users.
 */
let buttonSend = document.getElementById('buttonSend');
let messagesGroup = document.getElementById('messagesGroup');

/**
 * My in "messagesGroup", all messages enter in DB by registered users.
 */
let xhr = new XMLHttpRequest();
xhr.onload = function () {
    const messages = JSON.parse(xhr.responseText);
    messages.forEach(message => {
        messagesGroup.innerHTML += `
        <div id='${message.id}' class='flexColumn messages'>
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

if (buttonSend) {
    buttonSend.addEventListener('click', function (e) {
        e.preventDefault();
        let inputIdPseudo = document.getElementById('inputIdPseudo').value;
        let inputPseudo = document.getElementById('inputPseudo').value;
        let inputMessage = document.getElementById('inputMessage').value;
        let dateMessage = document.getElementById('inputDate').value;

        if (!inputIdPseudo || !inputMessage) {
            console.log("All data are not set");
        } else {
            let xhr = new XMLHttpRequest();
            xhr.onload = function () {
                const response = JSON.parse(xhr.responseText);
                if (response.hasOwnProperty('error') && response.hasOwnProperty('message')) {
                    const div = document.createElement('div');
                    div.classList.add('alert', `alert-${response.error}`);
                    div.setAttribute('role', 'alert');
                    div.innerHTML = response.message;
                    document.body.appendChild(div);
                    setInterval(function () {
                        div.style.display = 'none';
                    }, 5000);
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

        //add a new messages in the end of "messagesGroup" after pressing send / "envoyer" -> so that it is dynamic.
        /*$("#messagesGroup").append("<div class='flexColumn messages'>" +
            "<div class='flexRow width100'>" +
            "<p class='width30 colorBlue bold'>" + inputPseudo + "</p>" +
            "<p class='colorGrey'>" + dateMessage.toLocaleString() + "</p>" +
            "</div>" +
            "<p class='text'>" + inputMessage + "</p>" +
            "</div>");
            */
        document.getElementById("inputMessage").value = "";

    });
}

let buttonRefresh = document.getElementById("buttonRefresh");

//Refresh the page for display the messages.
if (buttonRefresh) {
    buttonRefresh.addEventListener("click", function () {
        document.location.reload();
    });
}

charger();


if (document.getElementById("error")) {
    closeModal("error");
}

if (document.getElementById("success")) {
    closeModal("success");
}

// We check if there are no new messages in BDD every 2s, what makes the code dynamic.
function charger() {
    setTimeout(function () {
        let lastIdMessage = $('.messages:first').attr('id'); // We get the last ID
        $.ajax({
            'url': "/api/charger/index.php?id=" + lastIdMessage, // We pass the last ID to the load file
            'type': 'GET',
            'success': function (html) {
                console.log(lastIdMessage)
                $('#messagesGroup').prepend(html); // We add the new message at the end
            }
        });
        charger();
    }, 2000);
}

/**
 * close the modal windows.
 * @param idModal
 */
function closeModal (idModal) {
    document.getElementById("closeModal").addEventListener("click", function () {
        document.getElementById(idModal).style.display = "none";
    });
}

