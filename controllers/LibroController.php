<?php

class LibroController extends Controller
{

    // Metodo create(): Muestra el formulario para crear un nuevo libro
    public function create()
    {
        // comprueba que el usuario esté identificado
        Login::check();

        // carga la vista del formulario
        $this->loadView('libro/create');
    }

    // Metodo store(): Procesa los datos del formulario de nuevo libro
    public function store()
    {
        // comprueba que el usuario esté identificado
        Login::check();

        // comprueba que llegue el formulario con los datos
        if (empty($_POST['guardar']))
            throw new Exception('No se recibieron datos');

        // TODO: comprueba que los datos recibidos en el formulario sean correctos


        // TODO: crea un nuevo libro
        // $libro = new Libro();
        // $libro->titulo = $_POST['titulo'];
        // $libro->autor = $_POST['autor'];
        // $libro->editorial = $_POST['editorial'];
        // $libro->paginas = $_POST['paginas'];

        // TODO: guarda el libro en la BDD


        // TODO: redirige a la portada

    }

    // Metodo list(): Muestra el listado de libros
    public function list()
    {
        // Muestra todos los libros
    }

    // Metodo show(): Muestra los datos de un libro
    public function show(int $id = 0)
    {
        // comprueba que llega el id del libro
        if (!$id)
            throw new Exception('No se indicó el libro a mostrar');
    }

    // Metodo edit(): Muestra el formulario de edición de un libro
    public function edit(int $id = 0)
    {
        // comprueba que el usuario esté identificado
        Login::check();

        // comprueba que llega el id del libro a editar
        if (!$id)
            throw new Exception('No se indicó el libro a editar');
    }

    // Metodo update(): Aplica los cambios de un libro
    public function update()
    {
        // comprueba que el usuario esté identificado
        Login::check();

        // comprueba que llegue el formulario con los datos
        if (empty($_POST['actualizar']))
            throw new Exception('No se recibieron datos');
    }

    // Metodo delete(): Elimina un libro
    public function delete(int $id = 0)
    {
        // comprueba que el usuario esté identificado
        Login::check();

        // comprueba que llega el id del libro a eliminar
        if (!$id)
            throw new Exception('No se indicó el libro a eliminar');
    }

    // Método destroy(): Procesa el borrado de un libro
    public function destroy()
    {
        // comprueba que el usuario esté identificado
        Login::check();

        // comprueba que llegue el formulario de confirmación
        if (empty($_POST['borrar']))
            throw new Exception('No se recibió confirmación');
    }
}
