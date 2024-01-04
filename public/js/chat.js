// sending message to backend
document.getElementById('chat-btn').addEventListener('click', function(){
   let message = document.getElementById('chat-message').value;
   let csrfToken = document.getElementById('csrf-token').getAttribute('data-token');
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

Echo.private(`chat.${id}`).listen('.chat.message', (e) => {
    console.log(e);
});

