sdocument.getElementById('contactForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Evita que el formulario se envíe

    // Aquí podrías agregar lógica para enviar el formulario (por ejemplo, con AJAX)
    // Por simplicidad, solo mostramos un mensaje de éxito en la consola
    console.log('Formulario enviado con éxito');
});
