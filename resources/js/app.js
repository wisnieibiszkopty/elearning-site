import './bootstrap';

// nie chce sie zmieniac :<
// document.addEventListener('DOMContentLoaded', function(){
//     let mode = localStorage.getItem('mode');
//     if(mode === null){
//         console.log('zmieniania');
//         localStorage.setItem('mode', false);
//         mode = false;
//     }

//     console.log(mode);

//     let changeModeButton = document.getElementById('change-mode');
//     changeModeButton.checked = mode;
// });

// let changeModeButton = document.getElementById('change-mode');
// changeModeButton.addEventListener('click', function(){
//     let mode = changeModeButton.checked;
//     console.log(mode);
//     localStorage.setItem('mode', mode);
// });

// let blob = document.getElementById('blob');

// document.body.addEventListener('pointermove', event => {
//     const { clientX, clientY } = event;
//     blob.style.left = `${clientX}px`;
//     blob.style.top = `${clientY}px`;
// });

let themeButtons = document.querySelectorAll('theme-controller');
themeButtons.forEach(function(button) {
    button.addEventListener('change', function() {
        if (this.checked) {
            console.log('Zaznaczono: ' + this.value);
        }
    });
});
