<?php

class LibroController extends Controller
{
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
            throw new Exception("No se indicó el libro");
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
}
