<?php

class UserController extends Controller
{



    public function home()
    {
        Auth::check(); // solo para usuarios identificados

        // método responsable de mostrar la portada

        $this->loadView('user/home', [
            'user' => Login::get()
        ]);
    }

    public function list()
    {
        Auth::check(); // solo para usuarios identificados

        // método responsable de mostrar el listado de usuarios
        $this->loadView('user/list', [
            'users' => User::all()
        ]);
    }

    public function show(int $id = 0)
    {
        // Método responsable de mostrar los detalles del User
        Auth::check(); // solo para usuarios identificados

        // Recuperamos el id vía GET
        $id = empty($_GET['id']) ? 0 : $_GET['id'];

        // Si no nos llega el id
        if (!$id) {
            throw new Exception('No se indicó el usuario a mostrar');
        }

        // Recuperamos el usuario
        $user = User::find($id);

        // Si no existe el usuario
        if (!$user) {
            throw new Exception('No existe el usuario indicado');
        }

        // Mostramos la vista de detalles
        $this->loadView('user/show', [
            'user' => $user
        ]);
    }

    public function create()
    {
        // Solo para administradores
        Auth::admin();

        // método responsable de mostrar el formulario de creación de usuarios
        $this->loadView('user/create');
    }

    public function store()
    {
        Auth::admin(); // solo para administradores

        // Si no se recibe el formulari
        if (empty($_POST['guardar'])) {
            throw new Exception('No se recibió el formulario');
        }

        // Creamos el nuevo usuario
        $user = new User();

        // Encriptamos los passwords y los comparamos
        $user->password = md5($_POST['password']);
        $repeat = md5($_POST['repeat-password']);

        // Recuperamos los datos del formulario
        $user->displayname = $_POST['displayname'];
        $user->email = $_POST['email'];
        $user->phone = $_POST['phone'];
        $user->addRole('ROLE_USER', $_POST['roles']);

        // Si los passwords no coinciden
        if ($user->password != $repeat) {
            throw new Exception('Los passwords no coinciden');
        }

        try {
            //code...
            $user->save();

            // Si llega el fichero con la imagen
            if (Upload::arrive('portada')) {
                // Guardamos la imagen
                $user->picture = Upload::save(
                    'portada',
                    // Ruta donde se guardará la imagen
                    '../public/' . USER_IMAGE_FOLDER,
                    // Nombre aleatorio
                    true,
                    // Tamaño máximo (en bytes)
                    124000,
                    'image/*',
                    'user_'
                );

                $user->update();
            }

            Session::success("Usuario $user->displayname creado correctamente");
            redirect('/');
        } catch (SQLException $ex) {
            //throw $th;
            Session::error('Error al crear el usuario');

            // Si estamos en modo debug
            if (DEBUG) {
                // Mostramos la traza
                throw new Exception($ex->getMessage());
            } else {
                // Redirigimos a la página anterior
                redirect('/User/create');
            }
        } catch (UploadException $ex) {
            Session::error('Error al subir la imagen');

            if (DEBUG) {
                throw new Exception($ex->getMessage());
            }
            redirect('/User/create');
        }
    }
}
