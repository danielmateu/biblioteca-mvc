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

        // Carga la vista para mostrar detalles de un libro
        $this->loadView('libro/show', ['libro' => $libro]);
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
}
