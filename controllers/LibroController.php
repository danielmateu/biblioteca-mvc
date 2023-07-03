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
        // Recupera el libro con el id especificado
        $libro = Libro::all($id);

        // Si no existe el libro mostramos un error
        if (!$libro) {
            
        }

        // Carga la vista para mostrar detalles de un libro
        $this->loadView('libro/show', ['libro' => $libro]);
    }
}
