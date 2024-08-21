// assets/js/script.js

document.addEventListener('DOMContentLoaded', function() {
    // Asegúrate de que el DOM esté completamente cargado antes de ejecutar el script

    function showPopup() {
        document.getElementById('logoutPopup').style.display = 'flex';
    }

    function hidePopup() {
        document.getElementById('logoutPopup').style.display = 'none';
    }

    function confirmLogout() {
        // Aquí puedes manejar la lógica para cerrar sesión
        // Por ejemplo, redirigir al usuario a la página de cierre de sesión
        window.location.href = "/logout"; // Asegúrate de tener una ruta de logout definida en tu servidor
    }

    // Asignar las funciones a los eventos de los botones
    document.querySelector('#cer').addEventListener('click', showPopup);
    document.querySelector('.cancel').addEventListener('click', hidePopup);
    document.querySelector('.confirm').addEventListener('click', confirmLogout);
});
