
function Cajas(recurso) {
    "use strict";
    let checkBoxes = document.querySelectorAll('input[type = "checkbox"]');
    for (let i = 0; i < checkBoxes.length; i++) {
         checkBoxes[i].checked = recurso.checked; 
    }
}



