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
    public function list(int $page = 1)
    {

        // Comprobar si hay un filtro de búsqueda
        $filtro = Filter::apply('libros');

        $limit = RESULTS_PER_PAGE; // Resultados por página
        // $total = Libro::total(); // Total de libros
        $total = $filtro ?
            Libro::filteredResults($filtro) :
            Libro::total(); // Total de libros

        // Crea el objeto paginador
        $paginator = new Paginator('/Libro/list', $page, $limit, $total);

        // Recupera los libros para la página actual
        // $libros = Libro::orderBy('titulo', 'ASC', $limit, $paginator->getOffset());
        $libros = $filtro ?
            Libro::filter($filtro, $limit, $paginator->getOffset()) : Libro::orderBy('id', 'ASC', $limit, $paginator->getOffset());

        // Recupera la lista de libros y carga la vista. En la vista disponemos de una variable llamada $libros
        $this->loadView('Libro/list', [
            'libros' => $libros,
            'paginator' => $paginator,
            'filtro' => $filtro
        ]);
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
        // Obtenemos los temas del libro
        $temas = $libro->getTemas();

        // Carga la vista para mostrar detalles y ejemplares de un libro
        $this->loadView('libro/show', [
            'libro' => $libro,
            'ejemplares' => $ejemplares,
            'temas' => $temas
        ]);
    }

    // Metodo create(): Muestra el formulario para crear un libro
    public function create()
    {
        if (!Login::oneRole(['ROLE_USER', 'ROLE_ADMIN'])) {
            Session::error("No tienes permisos para crear un libro");
            redirect('/');
        }
        // Auth::oneRole(['ROLE_USER', 'ROLE_ADMIN']);
        // Carga la vista para crear un libro
        // $this->loadView('libro/create');
        $listaTemas = Tema::orderBy('tema', 'ASC');

        $this->loadView('libro/create', ['listaTemas' => $listaTemas]);
    }

    // Metodo store(): Procesa los datos del formulario de creación de un libro
    public function store()
    {
        if (!Login::oneRole(['ROLE_USER', 'ROLE_ADMIN'])) {
            Session::error("No tienes permisos para crear un libro");
            redirect('/');
        }
        // Auth::oneRole(['ROLE_USER', 'ROLE_ADMIN']);
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

            // Si llega el fichero con la portada
            if (Upload::arrive('portada')) {
                $libro->portada = Upload::save(
                    // nombre del input
                    'portada',
                    // Ruta de la carpeta de destino
                    '../public/' . BOOK_IMAGE_FOLDER,
                    // Generar un nombre aleatorio
                    true,
                    // Tamaño máximo
                    124000,
                    // timpo mime
                    'image/*',
                    // Prefijo del nombre
                    'book_'
                );
                $libro->update();
            }

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
        } catch (UploadException $ex) {
            Session::flash('error', 'El libro se guardó correctamente pero no se pudo subir la portada');

            if (DEBUG) {
                throw new Exception($ex->getMessage());
            } else {
                redirect("/Libro/edit/$libro->id");
            }
        }
    }

    // Metodo edit(): Muestra el formulario para editar un libro
    public function edit(int $id = 0)
    {
        if (!Login::oneRole(['ROLE_USER', 'ROLE_ADMIN'])) {
            Session::error("No tienes permisos para realizar esta acción");
            redirect('/');
        }
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

        // Obtenemos los ejemplares del libro
        $ejemplares = $libro->hasMany('Ejemplar');
        // Obtenemos los temas del libro
        $temas = $libro->getTemas();

        // Todos los temas ordenados por nombre asc
        $listaTemas = Tema::orderBy('tema', 'ASC');
        // Temas que no tiene el libro
        $listaTemas = array_diff($listaTemas, $temas);

        // Carga la vista para editar un libro
        $this->loadView('libro/edit', [
            'libro' => $libro,
            'ejemplares' => $ejemplares,
            'temas' => $temas,
            'listaTemas' => $listaTemas
        ]);
    }

    // Metodo update(): Procesa los datos del formulario de edición de un libro
    public function update()
    {
        if (!Login::oneRole(['ROLE_USER', 'ROLE_ADMIN'])) {
            Session::error("No tienes permisos para realizar esta acción");
            redirect('/');
        }
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

            // Si llega el fichero con la portada, haremos un segundo update
            $secondUpdate = false; // Flag para saber si se ha hecho el segundo update
            $oldCover = $libro->portada; // Guardamos la portada anterior

            if (Upload::arrive('portada')) {
                $libro->portada = Upload::save(
                    // nombre del input
                    'portada',
                    // Ruta de la carpeta de destino
                    '../public/' . BOOK_IMAGE_FOLDER,
                    // Generar un nombre aleatorio
                    true,
                    // Tamaño máximo
                    0,
                    // timpo mime
                    'image/*',
                    // Prefijo del nombre
                    'book_'
                );
                $secondUpdate = true;
            }

            // Si hay que eliminar portada, el libro tenia una anterior y no llega una nueva
            if (isset($_POST['eliminarportada']) && $oldCover && !Upload::arrive('portada')) {
                $libro->portada = null;
                $secondUpdate = true;
            }

            if ($secondUpdate) {
                $libro->update();
                @unlink('../public/' . BOOK_IMAGE_FOLDER . $oldCover); // Eliminamos la portada anterior
            }

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
        } catch (UploadException $ex) {
            Session::flash('error', 'El libro se actualizó correctamente pero no se pudo subir la portada');

            if (DEBUG) {
                throw new Exception($ex->getMessage());
            } else {
                redirect("/Libro/edit/$libro->id"); // Redireccionamos al formulario de edición
            }
        }
    }

    // Metodo delete(): Procesa los datos del formulario de borrado de un libro
    public function delete(int $id = 0)
    {
        if (!Login::oneRole(['ROLE_USER', 'ROLE_ADMIN'])) {
            Session::error("No tienes permisos para realizar esta acción");
            redirect('/');
        }
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
        if (!Login::oneRole(['ROLE_USER', 'ROLE_ADMIN'])) {
            Session::error("No tienes permisos para realizar esta acción");
            redirect('/');
        }
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

            // Si el libro tenía portada, la eliminamos
            if ($libro->portada) {
                @unlink('../public/' . BOOK_IMAGE_FOLDER . '/' . $libro->portada);
            }

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

    // Añade un tema a un libro
    public function addTema()
    {
        if (!Login::oneRole(['ROLE_USER', 'ROLE_ADMIN'])) {
            Session::error("No tienes permisos para realizar esta acción");
            redirect('/');
        }
        // Comprobamos que llegue el formulario de confirmación
        if (empty($_POST['add'])) {
            throw new Exception('No se recibieron datos');
        }

        // Recuperar el id del libro via post
        $idLibro = intval($_POST['idlibro']);
        // Recuperar el id del tema via post
        $idTema = intval($_POST['idtema']);
        // Recuperamos el libro con el id especificado
        $libro = Libro::find($idLibro);
        // Recuperamos el tema con el id especificado
        $tema = Tema::find($idTema);

        // Si no se indica tema y libro
        if (!$idLibro || !$idTema) {
            throw new Exception("No se indicó el libro o el tema");
        }

        // Si no existe el libro mostramos un error
        if (!$libro) {
            throw new Exception("No se encontró el libro $idLibro");
        }

        // Si no existe el tema mostramos un error
        if (!$tema) {
            throw new Exception("No se encontró el tema $idTema");
        }

        // Recuperamos el tema a partir del id que llega por post
        $tema = Tema::find(intval($_POST['idtema']));


        // Guardar el libro en la base de datos
        try {
            //code...
            $libro->addTema($tema);
            Session::flash('success', "Tema $tema->tema añadido correctamente al libro $libro->titulo");
            redirect("/Libro/edit/$idLibro");
        } catch (SQLException $th) {
            //throw $th;
            Session::flash('error', "No se pudo añadir el tema $tema->tema al libro $libro->titulo");

            // Si estamos en modo debug, iremos a la página de error
            if (DEBUG) {
                throw new Exception($th->getMessage());
            } else {
                // Si no estamos en modo debug, redireccionamos al formulario de borrado
                redirect("/Libro/edit/$idLibro");
            }
        }
    }
}
