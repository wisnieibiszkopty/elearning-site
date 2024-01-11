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

document.addEventListener('DOMContentLoaded', function () {
   let themeControllers = document.querySelectorAll('.theme-controller');
   themeControllers.forEach(function(radioButton){
      radioButton.addEventListener('change', function(){
          if(radioButton.checked){
              let theme = radioButton.value;
              localStorage.setItem('theme', theme);
          }
      });
   });

   let theme = localStorage.getItem('theme');
   if(theme){
       console.log(theme);
       themeControllers.forEach(function(radioButton){
           if(radioButton.value === theme){
               radioButton.checked = true;
           }
       })
   }
});
