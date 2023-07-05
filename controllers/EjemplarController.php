<?php
class EjemplarController extends Controller
{

    // Método para crear un nuevo ejemplar
    public function create(int $idlibro = 0)
    {
        $libro = Libro::find($idlibro);
        // Si no hay libro
        if (!$libro) {
            throw new NotFoundException("No se ha encontrado el libro con id $idlibro");
        }

        // Cargamos la vista para crear el ejemplar
        $this->loadView('ejemplar/create', [
            'libro' => $libro
        ]);
    }

    // Método para guardar un nuevo ejemplar
    public function store()
    {
        // Comprobamos si llega el formulario con los datos
        if (empty($_POST)) {
            throw new Exception('No se han recibido datos');
        }

        // Creamos un nuevo ejemplar
        $ejemplar = new Ejemplar();

        // Recuperamos los datos del form
        $ejemplar->idlibro  = $_POST['idlibro'];
        $ejemplar->anyo     = $_POST['anyo'];
        $ejemplar->edicion  = $_POST['edicion'];
        $ejemplar->precio   = $_POST['precio'];
        $ejemplar->estado   = $_POST['estado'];
        $ejemplar->caracteristicas = $_POST['caracteristicas'];

        // Intentamos guardar el ejemplar
        try {
            //code...
            $ejemplar->save();
            Session::flash('success', 'Ejemplar creado correctamente');
            // Redirigimos a la vista de ejemplares del libro
            redirect("/Libro/edit/$ejemplar->idlibro");
        } catch (\Throwable $th) {
            //throw $th;
            Session::flash('error', 'No se ha podido crear el ejemplar');

            // Si estamos en modo debug, mostramos el error
            if (DEBUG) {
                throw new Exception($th->getMessage());
            } else {
                redirect(`/Ejemplar/create/$ejemplar->idlibro`);
            }
        }
    }

    // Método para editar un ejemplar
    public function edit(int $id)
    {
    }

    // Método para actualizar un ejemplar
    public function update()
    {
    }

    // Método para borrar un ejemplar
    public function delete(int $id)
    {
    }

    // Método para confirmar el borrado de un ejemplar
    public function destroy()
    {
    }

    // Método para mostrar un ejemplar
    public function show(int $id)
    {
    }
}
