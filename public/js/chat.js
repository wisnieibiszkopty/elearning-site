// sending message to backend
document.getElementById('chat-btn').addEventListener('click', function(){
   let message = document.getElementById('chat-message').value;
   document.getElementById('chat-message').value = "";
   let csrfToken = document.getElementById('data').getAttribute('data-token');
   let currentUrl = window.location.href;

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
       })
       .catch(error => {
           console.error(error);
       });

});

// receiving message
let id = window.location.href.split('/').pop();
let userId = document.getElementById('data').getAttribute('user-id')
let messages = document.getElementById('messages');

Echo.private(`chat.${id}`).listen('.chat.message', (data) => {
    let newMessage = document.createElement('div');
    let messageContent = document.createElement('div');
    messageContent.innerText = data.message;
    messageContent.classList.add('chat-bubble');
    newMessage.classList.add('chat');
    newMessage.classList.add('flex');
    let isSender = (userId == data.senderId);
    let chatClass = 'chat-start';
    console.log(isSender);
    if(isSender){
        console.log('ajzda');
        newMessage.classList.add('justify-end');
        messageContent.classList.add('chat-bubble-secondary');
        chatClass = 'chat-end';
    }

    newMessage.classList.add(chatClass);
    newMessage.appendChild(messageContent);
    messages.appendChild(newMessage);
});

// load more messages
let page = 2;

// when all messages all loaded i need to remove 'load more' button, but i don't know how yet
document.getElementById('load-more').addEventListener('click', function (){

    fetch('/chats/' + id + '/load?page=' + page)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(data => {
            //document.getElementById('load-more-wrapper').remove();
            document.getElementById('messages').insertAdjacentHTML('afterbegin', data);
            page++;
        })
        .catch(error => {
            console.error(error);
        });
});
