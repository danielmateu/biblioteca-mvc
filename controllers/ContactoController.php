<?php
class ContactoController extends Controller
{
    public function index()
    {
        $this->loadview('contacto');
    }

    // Método que envia el email al administrador
    public function send()
    {
        if (empty($_POST['enviar'])) {
            throw new Exception("No se ha enviado el formulario.");
        }

        // Tomamos los datos del formulario
        $nombre = $_POST['nombre'];
        $from = $_POST['email'];
        $asunto = $_POST['asunto'];
        $mensaje = $_POST['mensaje'];

        // Creamos el objeto Email
        $email = new Email(
            ADMIN_EMAIL,
            $from,
            $nombre,
            $asunto,
            $mensaje
        );

        // Enviamos el email
        $email->send();

        // Mostramos la vista de éxito
        Session::success("Email enviado correctamente.");

        // Redirigimos a la página de inicio
        redirect('welcome');
    }
}
