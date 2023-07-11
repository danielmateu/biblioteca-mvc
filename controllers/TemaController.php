<?php

class TemaController extends Controller
{
    // Metodos

    // Operacion por defecto
    public function index()
    {
        $this->list();
    }

    // Metodo list(): Muestra el listado de temas
    public function list(int $page = 1)
    {
        // Resultados por pagina
        $limit = RESULTS_PER_PAGE;
        $total = Tema::total();

        // Crear el objeto de la paginación
        $paginator = new Paginator('/Tema/list', $page, $limit, $total);

        // Obtener los temas
        $temas = Tema::orderBy('id', 'ASC', $limit, $paginator->getOffset());
        // Recupera la lista de temas y carga la vista. En la vista disponemos de una variable llamada $temas
        $this->loadView('tema/list', ['temas' => $temas, 'paginator' => $paginator]);
    }

    // Metodo show(): Muestra los detalles de un tema
    public function show(int $id = 0)
    {
        // Comprobar que revcibimos el id del tema por parámetro   
        if (!$id) {
            throw new NotFoundException("No se indicó el tema");
        }

        // Recupera el tema con el id especificado
        $tema = tema::find($id);

        // Si no existe el tema mostramos un error
        if (!$tema) {
            throw new Exception("No se encontró el tema $id");
        }

        // Carga la vista para mostrar detalles de un tema
        $this->loadView('tema/show', ['tema' => $tema]);
    }

    // Metodo create(): Muestra el formulario para crear un tema
    public function create()
    {
        if (!Login::oneRole(['ROLE_LIBRARIAN', 'ROLE_ADMIN'])) {
            Session::error("No tienes permisos para realizar esta acción");
            redirect('/');
        }
        // Carga la vista para crear un tema
        $this->loadView('tema/create');
    }

    // Metodo store(): Procesa los datos del formulario de creación de un tema
    public function store()
    {
        if (!Login::oneRole(['ROLE_LIBRARIAN', 'ROLE_ADMIN'])) {
            Session::error("No tienes permisos para realizar esta acción");
            redirect('/');
        }
        // Comprobar que llegan los datos por POST
        if (empty($_POST)) {
            throw new Exception('No se recibieron datos');
        }

        // Crear el tema
        $tema = new tema();

        // Recuperar los datos recibidos por POST
        $tema->id = $_POST['id'];
        $tema->tema = $_POST['tema'];
        $tema->descripcion = $_POST['descripcion'];

        // Guardar el tema en la base de datos
        try {
            //code...
            $tema->save();

            Session::flash('success', "tema $tema->tema creado correctamente");
            // Redireccionar a la lista de temas
            redirect("/tema/show/$tema->id");
        } catch (SQLException $ex) {
            //throw $th;
            Session::flash('error', 'No se pudo crear el tema');

            // Si estamos en modo debug, iremos a la página de error
            if (DEBUG) {
                throw new Exception($ex->getMessage());
            } else {
                // Si no estamos en modo debug, redireccionamos al formulario de creación
                redirect('/tema/create');
            }
        }
    }

    // Metodo edit(): Muestra el formulario para editar un tema
    public function edit(int $id = 0)
    {
        if (!Login::oneRole(['ROLE_LIBRARIAN', 'ROLE_ADMIN'])) {
            Session::error("No tienes permisos para realizar esta acción");
            redirect('/');
        }
        // Comprobamos que recibimmos el id del tema por parámetro
        if (!$id) {
            throw new NotFoundException("No se indicó el tema");
        }

        // Recuperar el tema con el id especificado
        $tema = tema::find($id);

        // Si no existe el tema mostramos un error
        if (!$tema) {
            throw new Exception("No se encontró el tema $id");
        }

        // Carga la vista para editar un tema
        $this->loadView('tema/edit', ['tema' => $tema]);
    }

    // Metodo update(): Procesa los datos del formulario de edición de un tema
    public function update()
    {
        if (!Login::oneRole(['ROLE_LIBRARIAN', 'ROLE_ADMIN'])) {
            Session::error("No tienes permisos para realizar esta acción");
            redirect('/');
        }
        // Si no llega el formulario con los datos, mostramos error
        if (empty($_POST)) {
            throw new Exception('No se recibieron datos');
        }

        // Recuperar el id via post
        $id = intval($_POST['id']);
        // Recuperar el tema con el id especificado
        $tema = tema::find($_POST['id']);

        // Si no existe el tema mostramos un error
        if (!$tema) {
            throw new Exception("No se encontró el tema $id");
        }

        // Recuperamos el resto de campos
        $tema->id = $_POST['id'];
        $tema->tema = $_POST['tema'];
        $tema->descripcion = $_POST['descripcion'];

        // Guardar el tema en la base de datos
        try {
            //code...
            $tema->update();
            Session::flash('success', "tema $tema->tema actualizado correctamente");
            // Redireccionar a la lista de temas
            redirect("/tema/edit/$id");
        } catch (SQLException $ex) {
            //throw $th;
            Session::flash('error', "No se pudo actualizar el tema $tema->tema");

            // Si estamos en modo debug, iremos a la página de error
            if (DEBUG) {
                throw new Exception($ex->getMessage());
            } else {
                // Si no estamos en modo debug, redireccionamos al formulario de edición
                redirect("/tema/edit/$id");
            }
        }
    }

    // Metodo delete(): Procesa los datos del formulario de borrado de un tema
    public function delete(int $id = 0)
    {
        if (!Login::oneRole(['ROLE_LIBRARIAN', 'ROLE_ADMIN'])) {
            Session::error("No tienes permisos para realizar esta acción");
            redirect('/');
        }
        // Comprobamos si llega el id del tema a borrar
        if (!$id) {
            throw new NotFoundException("No se indicó el tema");
        }

        // Recuperar el tema con el id especificado
        $tema = tema::find($id);

        // Si no existe el tema mostramos un error
        if (!$tema) {
            throw new Exception("No se encontró el tema $id");
        }

        // Cargamos la vista para confirmar el borrado del tema
        $this->loadView('tema/delete', ['tema' => $tema]);
    }

    // Metodo destroy(): Procesa los datos del borrado de un tema
    public function destroy()
    {
        if (!Login::oneRole(['ROLE_LIBRARIAN', 'ROLE_ADMIN'])) {
            Session::error("No tienes permisos para realizar esta acción");
            redirect('/');
        }
        // Comprobamos que llegue el formulario de confirmación
        if (empty($_POST)) {
            throw new Exception('No se recibieron datos');
        }

        // Recuperar el id via post
        $id = intval($_POST['id']);
        // Recuperamos el tema con el id especificado
        $tema = tema::find($_POST['id']);

        // Si no existe el tema mostramos un error
        if (!$tema) {
            throw new Exception("No se encontró el tema $id");
        }

        // Si el tema tiene ejemplares, no permitimos su borrado
        // if ($tema->hasMany('Ejemplar')) {
        //     throw new Exception("No se puede borrar el tema $tema->tema mientras tenga ejemplares");
        // }

        // Guardar el tema en la base de datos
        try {
            //code...
            $tema->deleteObject();
            Session::flash('success', "tema $tema->tema borrado correctamente");
            // Redireccionar a la lista de temas
            redirect('/tema');
        } catch (\Throwable $th) {
            //throw $th;
            Session::flash('error', "No se pudo borrar el tema $tema->tema");

            // Si estamos en modo debug, iremos a la página de error
            if (DEBUG) {
                throw new Exception($th->getMessage());
            } else {
                // Si no estamos en modo debug, redireccionamos al formulario de borrado
                redirect("/tema/delete/$id");
            }
        }
    }
}
