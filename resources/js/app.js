import './bootstrap';

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
       themeControllers.forEach(function(radioButton){
           if(radioButton.value === theme){
               radioButton.checked = true;
           }
       })
   }
});
