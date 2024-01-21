// constants
document.getElementById('chat-message').value = "";
const csrfToken = document.getElementById('data').getAttribute('data-token');
const currentUrl = window.location.href;

let id = window.location.href.split('/').pop();
let userId = document.getElementById('data').getAttribute('user-id')
let messages = document.getElementById('messages');
let page = 2;


// sending message to backend
function sendMessage(){
    let message = document.getElementById('chat-message').value;

    fetch(currentUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
        },
        body: JSON.stringify({
            message: message
        })
    })
        .then(response => {
            return response.json();
        })
        .then(data => {
            console.log(data);
            document.getElementById('chat-message').value = "";

        })
        .catch(error => {
            console.error(error);
        });
}
document.getElementById('chat-btn').addEventListener('click', function(){
    sendMessage();
});

document.addEventListener('keydown', function (event){
    if(event.code === "Enter"){
        sendMessage();
    }
});

// wyobrazcie sobie moi mili ze po nacisnieciu enter na stronie,
// submitowany jest formularz, po czym autoryzacji idzie sie pierdolic
// co uniemozliwia uzywanie pushera 😤😠😡🤬

function deleteMessage(messageId){
    console.log(messageId);

    // fetch('chats/message/' + messageId, {
    //     method: 'DELETE',
    //     headers: {
    //         'Content-Type': 'application/json',
    //         'X-CSRF-TOKEN': csrfToken,
    //     }
    // })
    //     .then(response => {
    //         window.location.href = response.headers.get('Location');
    //     })
    //     .catch(error => {
    //         console.error(error);
    //     });
}

function editMessage(){

}

function generateMessage(senderId, message, messageId){
    console.log(messageId);

    let html = "";
    html = '<div class="chat ' + (senderId == userId ? 'chat-end' : 'chat-start') + ' group relative">' +
        '<div class="chat-bubble ' + (senderId == userId ? 'chat-bubble-secondary' : '') + '">' + message + '</div>';

    if (senderId == userId) {
        html += '<div class="dropdown dropdown-bottom dropdown-end">' +
            '<div tabIndex="0" role="button" class="m-1 mb-3 invisible group-hover:visible"><i class="fa-solid fa-ellipsis"></i></div>' +
            '<ul tabIndex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">';

        let id = messageId;
        let modal = 'edit_modal' + id + '.showModal()';

        html += '<li><a onClick="' + modal + '">Edit</a></li>' +
            '<dialog id="edit_modal' + id + '" class="modal">' +
            '<div class="modal-box">' +
            '<form method="dialog">' +
            '<button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>' +
            '</form>' +
            '<h3 class="text-2xl mb-10">Edit message</h3>' +
            '<form method="POST" action="/chats/message/' + id + '" id="sendMessage" class="flex flex-col">' +
            '<?php echo method_field("put"); ?>' +
            '<?php echo csrf_field(); ?>' +
            '<textarea class="textarea textarea-bordered" name="message" rows="5">' + message + '</textarea>' +
            '<button class="btn btn-primary mt-10 w-1/4">Edit</button>' +
            '</form>' +
            '</div>' +
            '</dialog>' +
            '<li>' +
            '<button style="color:red;" onclick="deleteMessage(id)">Delete</button>' +
            '</li>';
        html += '</ul>' +
            '</div>';
    }
    html += '</div>';

    return html;
}


// receiving message
Echo.private(`chat.${id}`).listen('.chat.message', (data) => {
    const senderId = data.senderId
    const message = data.message;
    const messageId = data.messageId;
    console.log(messageId);
    const messageElement = generateMessage(senderId, message, messageId);
    messages.insertAdjacentHTML('beforeend', messageElement);


    // let newMessage = document.createElement('div');
    // let messageContent = document.createElement('div');
    // messageContent.innerText = data.message;
    // messageContent.classList.add('chat-bubble');
    // newMessage.classList.add('chat');
    // newMessage.classList.add('flex');
    // let isSender = (userId == data.senderId);
    // let chatClass = 'chat-start';
    // if (isSender) {
    //     newMessage.classList.add('justify-end');
    //     messageContent.classList.add('chat-bubble-secondary');
    //     chatClass = 'chat-end';
    // }
    //
    // newMessage.classList.add(chatClass);
    // newMessage.appendChild(messageContent);
    // messages.appendChild(newMessage);
});

// load more messages
document.getElementById('load-more').addEventListener('click', function () {

    fetch('/chats/' + id + '/load?page=' + page)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(response => {
            const data = JSON.parse(response);
            const moreMessages = data.moreMessages;
            const messages = data.messages;

            if(!moreMessages){
                document.getElementById('load-more').remove();
            }

            // weird way to iterate over messages,
            // but javascript is weird language in general
            for(let key in messages){
                if(messages.hasOwnProperty(key)){
                    let message = messages[key];
                    let messageElement = generateMessage(message.chat_member_id, message.message, message.id);
                    document.getElementById('messages').insertAdjacentHTML('afterbegin', messageElement);
                }
            }

            page++;
        })
        .catch(error => {
            console.error(error);
        });
});
