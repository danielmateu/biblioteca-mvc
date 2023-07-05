<?php

class LibroController extends Controller
{
    // Metodos

    // Operacion por defecto
    public function index()
    {
        $this->list();
    }

    // Metodo list(): Muestra el listado de libros
    public function list()
    {
        // Recupera la lista de libros y carga la vista. En la vista disponemos de una variable llamada $libros
        $this->loadView('libro/list', ['libros' => Libro::all()]);
    }

    // Metodo show(): Muestra los detalles de un libro
    public function show(int $id = 0)
    {
        // Comprobar que revcibimos el id del libro por parámetro   
        if (!$id) {
            throw new NotFoundException("No se indicó el libro");
        }

        // Recupera el libro con el id especificado
        $libro = Libro::find($id);

        // Si no existe el libro mostramos un error
        if (!$libro) {
            throw new Exception("No se encontró el libro $id");
        }

        // Obtenemos los ejemplares del libro
        $ejemplares = $libro->hasMany('Ejemplar');

        // Carga la vista para mostrar detalles y ejemplares de un libro
        $this->loadView('libro/show', [
            'libro' => $libro,
            'ejemplares' => $ejemplares
        ]);
    }

    // Metodo create(): Muestra el formulario para crear un libro
    public function create()
    {
        // Carga la vista para crear un libro
        $this->loadView('libro/create');
    }

    // Metodo store(): Procesa los datos del formulario de creación de un libro
    public function store()
    {
        // Comprobar que llegan los datos por POST
        if (empty($_POST)) {
            throw new Exception('No se recibieron datos');
        }

        // Crear el libro
        $libro = new Libro();

        // Recuperar los datos recibidos por POST
        // $libro->id = $_POST['id'];
        $libro->isbn = $_POST['isbn'];
        $libro->titulo = $_POST['titulo'];
        $libro->editorial = $_POST['editorial'];
        $libro->autor = $_POST['autor'];
        $libro->idioma = $_POST['idioma'];
        $libro->ediciones = intval($_POST['ediciones']);
        $libro->edadrecomendada = intval($_POST['edadrecomendada']);

        // Guardar el libro en la base de datos

        try {
            //code...
            $libro->save();

            Session::flash('success', "Libro $libro->titulo creado correctamente");
            // Redireccionar a la lista de libros
            redirect("/Libro/show/$libro->id");
        } catch (SQLException $ex) {
            //throw $th;
            Session::flash('error', 'No se pudo crear el libro');

            // Si estamos en modo debug, iremos a la página de error
            if (DEBUG) {
                throw new Exception($ex->getMessage());
            } else {
                // Si no estamos en modo debug, redireccionamos al formulario de creación
                redirect('/Libro/create');
            }
        }
    }

    // Metodo edit(): Muestra el formulario para editar un libro
    public function edit(int $id = 0)
    {
        // Comprobamos que recibimmos el id del libro por parámetro
        if (!$id) {
            throw new NotFoundException("No se indicó el libro");
        }

        // Recuperar el libro con el id especificado
        $libro = Libro::find($id);

        // Si no existe el libro mostramos un error
        if (!$libro) {
            throw new Exception("No se encontró el libro $id");
        }

        // Carga la vista para editar un libro
        $this->loadView('libro/edit', ['libro' => $libro]);
    }

    // Metodo update(): Procesa los datos del formulario de edición de un libro
    public function update()
    {
        // Si no llega el formulario con los datos, mostramos error
        if (empty($_POST)) {
            throw new Exception('No se recibieron datos');
        }

        // Recuperar el id via post
        $id = intval($_POST['id']);
        // Recuperar el libro con el id especificado
        $libro = Libro::find($_POST['id']);

        // Si no existe el libro mostramos un error
        if (!$libro) {
            throw new Exception("No se encontró el libro $id");
        }

        // Recuperamos el resto de campos
        $libro->isbn = $_POST['isbn'];
        $libro->titulo = $_POST['titulo'];
        $libro->editorial = $_POST['editorial'];
        $libro->autor = $_POST['autor'];
        $libro->idioma = $_POST['idioma'];
        $libro->ediciones = intval($_POST['ediciones']);
        $libro->edadrecomendada = intval($_POST['edadrecomendada']);

        // Guardar el libro en la base de datos
        try {
            //code...
            $libro->update();
            Session::flash('success', "Libro $libro->titulo actualizado correctamente");
            // Redireccionar a la lista de libros
            redirect("/Libro/edit/$id");
        } catch (SQLException $ex) {
            //throw $th;
            Session::flash('error', "No se pudo actualizar el libro $libro->titulo");

            // Si estamos en modo debug, iremos a la página de error
            if (DEBUG) {
                throw new Exception($ex->getMessage());
            } else {
                // Si no estamos en modo debug, redireccionamos al formulario de edición
                redirect("/Libro/edit/$id");
            }
        }
    }

    // Metodo delete(): Procesa los datos del formulario de borrado de un libro
    public function delete(int $id = 0)
    {
        // Comprobamos si llega el id del libro a borrar
        if (!$id) {
            throw new NotFoundException("No se indicó el libro");
        }

        // Recuperar el libro con el id especificado
        $libro = Libro::find($id);

        // Si no existe el libro mostramos un error
        if (!$libro) {
            throw new Exception("No se encontró el libro $id");
        }

        // Cargamos la vista para confirmar el borrado del libro
        $this->loadView('libro/delete', ['libro' => $libro]);
    }

    // Metodo destroy(): Procesa los datos del borrado de un libro
    public function destroy()
    {
        // Comprobamos que llegue el formulario de confirmación
        if (empty($_POST)) {
            throw new Exception('No se recibieron datos');
        }

        // Recuperar el id via post
        $id = intval($_POST['id']);
        // Recuperamos el libro con el id especificado
        $libro = Libro::find($_POST['id']);

        // Si no existe el libro mostramos un error
        if (!$libro) {
            throw new Exception("No se encontró el libro $id");
        }

        // Si el libro tiene ejemplares, no permitimos su borrado
        // if ($libro->hasMany('Ejemplar')) {
        //     throw new Exception("No se puede borrar el libro $libro->titulo mientras tenga ejemplares");
        // }

        // Guardar el libro en la base de datos
        try {
            //code...
            $libro->deleteObject();
            Session::flash('success', "Libro $libro->titulo borrado correctamente");
            // Redireccionar a la lista de libros
            redirect('/Libro');
        } catch (\Throwable $th) {
            //throw $th;
            Session::flash('error', "No se pudo borrar el libro $libro->titulo");

            // Si estamos en modo debug, iremos a la página de error
            if (DEBUG) {
                throw new Exception($th->getMessage());
            } else {
                // Si no estamos en modo debug, redireccionamos al formulario de borrado
                redirect("/Libro/delete/$id");
            }
        }
    }
}
