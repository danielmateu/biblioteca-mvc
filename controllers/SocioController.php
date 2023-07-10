<?php

class SocioController extends Controller
{
    // Metodos

    // Operacion por defecto
    public function index()
    {
        $this->list();
    }

    // Metodo list(): Muestra el listado de socios
    public function list()
    {
        // Recupera la lista de socios y carga la vista. En la vista disponemos de una variable llamada $socios
        $this->loadView('socio/list', ['socios' => socio::all()]);
    }

    // Metodo show(): Muestra los detalles de un socio
    public function show(int $id = 0)
    {
        // Comprobar que revcibimos el id del socio por parámetro   
        if (!$id) {
            throw new NotFoundException("No se indicó el socio");
        }

        // Recupera el socio con el id especificado
        $socio = socio::find($id);

        // Si no existe el socio mostramos un error
        if (!$socio) {
            throw new Exception("No se encontró el socio $id");
        }

        // Carga la vista para mostrar detalles de un socio
        $this->loadView('socio/show', ['socio' => $socio]);
    }

    // Metodo create(): Muestra el formulario para crear un socio
    public function create()
    {
        // Carga la vista para crear un socio
        $this->loadView('socio/create');
    }

    // Metodo store(): Procesa los datos del formulario de creación de un socio
    public function store()
    {
        // Comprobar que llegan los datos por POST
        if (empty($_POST)) {
            throw new Exception('No se recibieron datos');
        }

        // Crear el socio
        $socio = new socio();

        // Recuperar los datos recibidos por POST
        $socio->dni = $_POST['dni'];
        $socio->nombre = $_POST['nombre'];
        $socio->apellidos = $_POST['apellidos'];
        $socio->poblacion = $_POST['poblacion'];

        // Guardar el socio en la base de datos
        try {
            //code...
            $socio->save();

            // Si llega el fichero con la foto del socio, la guardamos
            if (Upload::arrive('foto')) {

                $socio->foto = Upload::save(
                    'foto', // Nombre del campo file del formulario
                    '../public/' . SOCIO_IMAGE_FOLDER, // Ruta donde se guardará el fichero
                    true, // generar nombre único
                    124000, // Tamaño máximo
                    'image/*', // Tipo mime permitido
                    'profile_' // Prefijo para el nombre del fichero
                );

                // Guardar el socio en la base de datos
                $socio->update();
            }

            Session::flash('success', "socio $socio->nombre creado correctamente");
            // Redireccionar a la lista de socios
            redirect("/socio/show/$socio->id");
        } catch (SQLException $ex) {
            //throw $th;
            Session::flash('error', 'No se pudo crear el socio');

            // Si estamos en modo debug, iremos a la página de error
            if (DEBUG) {
                throw new Exception($ex->getMessage());
            } else {
                // Si no estamos en modo debug, redireccionamos al formulario de creación
                redirect('/socio/create');
            }
        } catch (UploadException $ex) {
            //throw $th;
            Session::flash('error', 'No se pudo subir la foto del socio');

            // Si estamos en modo debug, iremos a la página de error
            if (DEBUG) {
                throw new Exception($ex->getMessage());
            } else {
                // Si no estamos en modo debug, redireccionamos al formulario de creación
                redirect('/Socio/edit/' . $socio->id); // Redireccionar a la lista de socios
            }
        }
    }

    // Metodo edit(): Muestra el formulario para editar un socio
    public function edit(int $id = 0)
    {
        // Comprobamos que recibimmos el id del socio por parámetro
        if (!$id) {
            throw new NotFoundException("No se indicó el socio");
        }

        // Recuperar el socio con el id especificado
        $socio = socio::find($id);

        // Si no existe el socio mostramos un error
        if (!$socio) {
            throw new Exception("No se encontró el socio $id");
        }

        // Carga la vista para editar un socio
        $this->loadView('socio/edit', ['socio' => $socio]);
    }

    // Metodo update(): Procesa los datos del formulario de edición de un socio
    public function update()
    {
        // Si no llega el formulario con los datos, mostramos error
        if (empty($_POST)) {
            throw new Exception('No se recibieron datos');
        }

        // Recuperar el id via post
        $id = intval($_POST['id']);
        // Recuperar el socio con el id especificado
        $socio = socio::find($_POST['id']);

        // Si no existe el socio mostramos un error
        if (!$socio) {
            throw new Exception("No se encontró el socio $id");
        }

        // Recuperamos el resto de campos
        $socio->dni = $_POST['dni'];
        $socio->nombre = $_POST['nombre'];
        $socio->apellidos = $_POST['apellidos'];
        $socio->poblacion = $_POST['poblacion'];


        // Guardar el socio en la base de datos
        try {
            //code...
            $socio->update();

            $secondUpdate = false; // Flag para controlar si hay que hacer un segundo update
            $oldFoto = $socio->foto; // Guardamos el nombre de la foto antigua

            // Si llega el fichero con la foto del socio, la guardamos
            if (Upload::arrive('foto')) {
                $socio->foto = Upload::save(
                    'foto', // Nombre del campo file del formulario
                    '../public/' . SOCIO_IMAGE_FOLDER, // Ruta donde se guardará el fichero
                    true, // generar nombre único
                    0, // Tamaño máximo
                    'image/*', // Tipo mime permitido
                    'profile_' // Prefijo para el nombre del fichero
                );

                $secondUpdate = true; // Hay que hacer un segundo update
            }

            // Si hay que eliminar la foto antigua, el socio tenia una anterior y no llega una nueva
            if (isset($_POST['eliminarperfil']) && $oldFoto && !Upload::arrive('foto')) {
                $socio->foto = NULL;
                $secondUpdate = true;
            }

            if ($secondUpdate) {
                $socio->update();
                @unlink('../public/' . SOCIO_IMAGE_FOLDER . $oldFoto); // Eliminar la foto antigua  
            }

            Session::flash('success', "socio $socio->titulo actualizado correctamente");
            // Redireccionar a la lista de socios
            redirect("/socio/edit/$id");
        } catch (SQLException $ex) {
            //throw $th;
            Session::flash('error', "No se pudo actualizar el socio $socio->titulo");

            // Si estamos en modo debug, iremos a la página de error
            if (DEBUG) {
                throw new Exception($ex->getMessage());
            } else {
                // Si no estamos en modo debug, redireccionamos al formulario de edición
                redirect("/socio/edit/$id");
            }
        }
    }

    // Metodo delete(): Procesa los datos del formulario de borrado de un socio
    public function delete(int $id = 0)
    {
        // Comprobamos si llega el id del socio a borrar
        if (!$id) {
            throw new NotFoundException("No se indicó el socio");
        }

        // Recuperar el socio con el id especificado
        $socio = socio::find($id);

        // Si no existe el socio mostramos un error
        if (!$socio) {
            throw new Exception("No se encontró el socio $id");
        }

        // Cargamos la vista para confirmar el borrado del socio
        $this->loadView('socio/delete', ['socio' => $socio]);
    }

    // Metodo destroy(): Procesa los datos del borrado de un socio
    public function destroy()
    {
        // Comprobamos que llegue el formulario de confirmación
        if (empty($_POST)) {
            throw new Exception('No se recibieron datos');
        }

        // Recuperar el id via post
        $id = intval($_POST['id']);
        // Recuperamos el socio con el id especificado
        $socio = socio::find($_POST['id']);

        // Si no existe el socio mostramos un error
        if (!$socio) {
            throw new Exception("No se encontró el socio $id");
        }

        // Si el socio tiene ejemplares, no permitimos su borrado
        // if ($socio->hasMany('Ejemplar')) {
        //     throw new Exception("No se puede borrar el socio $socio->titulo mientras tenga ejemplares");
        // }

        // Guardar el socio en la base de datos
        try {
            //code...
            $socio->deleteObject();

            // Si el socio tenía una foto, la borramos
            if ($socio->foto) {
                @unlink('../public/' . SOCIO_IMAGE_FOLDER . $socio->foto);
            }

            Session::flash('success', "socio $socio->nombre $socio->apellidos borrado correctamente");
            // Redireccionar a la lista de socios
            redirect('/socio');
        } catch (\Throwable $th) {
            //throw $th;
            Session::flash('error', "No se pudo borrar el socio $socio->nombre $socio->apellidos");

            // Si estamos en modo debug, iremos a la página de error
            if (DEBUG) {
                throw new Exception($th->getMessage());
            } else {
                // Si no estamos en modo debug, redireccionamos al formulario de borrado
                redirect("/socio/delete/$id");
            }
        }
    }
}
