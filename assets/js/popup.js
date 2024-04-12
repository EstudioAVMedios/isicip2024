// Obtener referencia al pop-up
const miPopUp = document.getElementById('miPopUp');

// Función para mostrar el pop-up automáticamente
function mostrarPopUp() {
    miPopUp.style.display = 'block';
}

// Función para ocultar el pop-up
function ocultarPopUp() {
    miPopUp.style.display = 'none';
}

// Mostrar el pop-up automáticamente al cargar la página
window.onload = function() {
    mostrarPopUp();
};
