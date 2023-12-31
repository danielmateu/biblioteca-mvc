<?php

/* Clase Template
 *
 * Se usa para generar las partes comunes de todas las vistas
 *
 * autor: Robert Sallent
 * última revisión: 16/03/2023
 *
 */

class Template implements TemplateInterface
{

    // ficheros CSS para usar con este template
    protected static array $css = ['/css/style.css'];

    /*****************************************************************************
     * CSS
     *****************************************************************************/
    // método que prepara los links a todos los ficheros CSS configurados arriba
    public static function getCss()
    {
        $html = "";

        foreach (get_called_class()::$css as $file)
            $html .= "<link rel='stylesheet' type='text/css' href='$file'>\n";

        return $html;
    }

    public static function getBootstrap()
    {
        $html = "";

        $html .= '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">';

        return $html;
    }

    /*****************************************************************************
     * LOGIN / LOGOUT
     *****************************************************************************/
    // retorna los enlaces a login/logout
    public static function getLogin()
    {

        // si el usuario no está identificado, retorna el botón de LogIn
        if (Login::guest())
            return "
               <div class='derecha'>
                    <a class='button' href='/Login'>LogIn</a>
               </div>
        ";

        $user = Login::user(); // recupera el usuario identificado

        // si el usuario es administrador...
        if (Login::isAdmin())
            return "
                 <div class='derecha'>
                    <span>Bienvenido <a class='negrita' href='/User/home'>$user->displayname</a> 
                    (<span class='cursiva'>$user->email</span>)
                    , eres <a class='negrita' href='/Admin'>administrador</a>.</span> 
                    <a class='button' href='/Logout'>LogOut</a>
                 </div>
            ";

        // si el usuario no es administrador...
        if (Login::check())
            return "
                 <div class='derecha'>
                    <span>Bienvenido <a href='/User/home'>$user->displayname</a>
                    (<span class='cursiva'>$user->email</span>).</span> 
                    <a class='button' href='/Logout'>LogOut</a>
                 </div>
            ";
    }


    /*****************************************************************************
     * HEADER
     *****************************************************************************/
    // retorna el header
    public static function getHeader(string $titulo = '')
    {
        $name = APP_NAME;

        return "
            <header class='primary'>
                <figure>
                    <a href='/'>
                        <img style='width:100%;' alt='FastLight Logo'
                             src='/images/template/fastlight.png'>
                    </a>
                </figure>
                <hgroup>
            	   <h1>$titulo en $name</h1>
                </hgroup>  
            </header>
        ";
    }

    public static function getHeaderAlt(string $titulo = '')
    {
        $name = APP_NAME;

        return "
            <header class='primary'>
                <h1>$titulo en $name</h1>
            </header>
        ";
    }


    /*****************************************************************************
     * MENÚ
     *****************************************************************************/
    // retorna el menú principal
    public static function getMenu()
    {
        $html  = "<ul class='navBar'>";
        $html .=   "<li><a href='/'>Inicio</a></li>";

        $html .=   "<li><a href='/Libro'>Libros</a></li>";
        $html .=   "<li><a href='/Libro/create'>Crear Libro</a></li>";

        $html .=   "<li><a href='/Socio'>Socios</a></li>";
        $html .=   "<li><a href='/Socio/create'>Crear Socio</a></li>";

        $html .=   "<li><a href='/Tema'>Temas</a></li>";
        $html .=   "<li><a href='/Tema/create'>Crear Tema</a></li>";

        $html .=   "<li><a href='/Contacto'>Contacto</a></li>";

        // if (Login::isAdmin() && (DB_ERRORS || LOG_ERRORS || LOG_LOGIN_ERRORS))
        //     $html .=   "<li><a href='/Error/list'>Errores</a></li>";
        $html .= "</ul>";

        return $html;
    }

    public static function getMenuBootstrap()
    {
        $html = "<nav class='px-4 navbar navbar-expand navbar-light bg-light align-items-center justify-content-between'>";

        $html .= "<a class='navbar-brand d-none d-md-block' href='/'>Biblioteca</a>";

        $html .= "<div class='collapse navbar-collapse' id='navbarSupportedContent'>";

        $html .= "<ul class='navbar-nav'>";

        // Añadimos la clase active a la página actual
        $active = $_SERVER['REQUEST_URI'] == '/Libro' ? 'active fw-semibold' : '';
        $html .= "<li class='nav-item '><a href='/Libro' class='nav-link $active'>Libros</a></li>";

        if (Login::oneRole(['ROLE_LIBRARIAN', 'ROLE_ADMIN'])) {
            $active = $_SERVER['REQUEST_URI'] == '/Socio' ? 'active fw-semibold' : '';
            $html .= "<li class='nav-item '><a href='/Socio' class='nav-link $active'>Socios</a></li>";
        }

        $active = $_SERVER['REQUEST_URI'] == '/Tema' ? 'active fw-semibold' : '';
        $html .= "<li class='nav-item '><a href='/Tema' class='nav-link $active'>Temas</a></li>";

        $active = $_SERVER['REQUEST_URI'] == '/Contacto' ? 'active fw-semibold' : '';
        $html .= "<li class='nav-item '><a href='/Contacto' class='nav-link $active'>Contacto</a></li>";

        // Si estamos logueados y somos administradores mostramos el botón de administración
        if (Login::oneRole(['ROLE_LIBRARIAN', 'ROLE_ADMIN'])) {
            $active = $_SERVER['REQUEST_URI'] == '/User' ? 'active fw-semibold' : '';
            $html .= "<li class='nav-item'><a href='/User/list' class='nav-link $active'>Usuarios</a></li>";
        }

        $html .= "</ul>";
        $html .= "</div>";

        // Si estamos logueados mostramos el nombre del usuario y el botón de logout
        if (Login::check()) {
            $user = Login::user();
            $html .= "<div class='d-flex justify-content-between gap-2 flex-wrap'>";
            $html .= "<ul class='navbar-nav'>";

            $active = $_SERVER['REQUEST_URI'] == '/User' ? 'active fw-semibold' : '';
            $html .= "<li class='nav-item d-none d-md-block'><a href='/User/home' class='nav-link $active'>$user->displayname</a></li>";
            $html .= "<li class='nav-item'><a href='/Logout' class='nav-link'>Logout</a></li>";
            $html .= "</ul>";
            $html .= "</div>";
        } else {
            $active = $_SERVER['REQUEST_URI'] == '/Login' ? 'active fw-semibold' : '';
            $html .= "<div class='nav-item'><a href='/Login' class='nav-link $active'>Login</a></div>";
        }

        $html .= "</nav>";

        return $html;
    }



    /*****************************************************************************
     * MIGAS
     *****************************************************************************/
    // retorna el elementos migas
    public static function getBreadCrumbs(array $migas = []): string
    {
        // asegura que esté el enlace a Inicio
        $migas = ["Inicio" => "/"] + $migas;

        // preparamos el migas a partir del array 
        $html = "<nav aria-label='Breadcrumb' class='breadcrumbs'>";
        $html .= "<ul>";

        foreach ($migas as $miga => $ruta) {
            $html .= "<li>";
            $html .= $ruta ? "<a href='$ruta'>$miga</a>" : $miga;
            $html .= "</li>";
        }

        $html .= "</ul>";
        $html .= "</nav>";
        return $html;
    }


    /*****************************************************************************
     * MENSAJES FLASHEADOS DE ÉXITO Y ERROR
     *****************************************************************************/
    // muestra mensajes de éxito flasheados
    public static function getSuccess()
    {

        return ($mensaje = Session::getFlash('success')) ?
            <<<EOT
            <div class="mensajeExito" onclick="this.remove()">
            	<div>
            		<h2>Operación realizada con éxito</h2>
            		<p>$mensaje</p>
            		<p class="mini cursiva">-- Clic para cerrar --</p>
        		</div>
            </div>
EOT : '';
    }

    // muestra mensajes de warning flasheados
    public static function getWarning()
    {

        return ($mensaje = Session::getFlash('warning')) ?
            <<<EOT
            <div class="mensajeWarning" onclick="this.remove()">
            	<div>
            		<h2>Hay advertencias:</h2>
            		<p>$mensaje</p>
            		<p class="mini cursiva">-- Clic para cerrar --</p>
        		</div>
            </div>
EOT : '';
    }

    // muestra mensajes de error flasheados
    public static function getError()
    {

        return ($mensaje = Session::getFlash('error')) ?
            <<<EOT
            <div class="mensajeError" onclick="this.remove()">
            	<div>
            		<h2>Se ha producido un error</h2>
            		<p>$mensaje</p>
            		<p class="mini cursiva">-- Clic para cerrar --</p>
        		</div>
            </div>
EOT : '';
    }

    // muestra los mensajes de success, error y warning flasheados
    public static function getFlashes()
    {
        return self::getSuccess() . self::getWarning() . self::getError();
    }


    /*****************************************************************************
     * FILTROS DE BÚSQUEDA
     *****************************************************************************/
    // retorna el formulario para realizar filtros y búsquedas
    public static function filterForm(
        string $action = '/',   // URL donde se enviará el formulario
        array $fields = [],     // lista de campos para el desplegable campo de búsqueda
        array $orders = [],      // lista de campos para el desplegable orden
        string $selectedField = '',
        string $selectedOrder = ''

    ) {
        $html = "<form method='POST' class='filtro derecha' action='$action'>";
        $html .= "<input type='text' name='texto' placeholder='Buscar...'> ";
        $html .= "<select name='campo'>";

        foreach ($fields as $nombre => $valor) {
            $html .= "<option value='$valor' ";
            $html .= $selectedField == $nombre ? 'selected' : '';
            $html .= ">$nombre</option>";
        }

        $html .= "</select>";

        $html .= "<label>Ordenar por:</label>";
        $html .= "<select name='campoOrden'>";

        foreach ($orders as $nombre => $valor) {
            $html .= "<option value='$valor' ";
            $html .= $selectedOrder == $nombre ? 'selected' : '';
            $html .= ">$nombre</option>";
        }

        return $html . "</select>
    				<input type='radio' name='sentidoOrden' value='ASC'>
    				<label>Ascendente</label>
    				<input type='radio' name='sentidoOrden' value='DESC' checked>
    				<label>Descendente</label>
    				<input class='button' type='submit' name='filtrar' value='Filtrar'>
    			</form>";
    }

    // retorna el formulario de "quitar filtro"
    public static function removeFilterForm(
        Filter $filtro,
        string $action = '/'
    ) {

        return "<form class='filtro derecha' method='POST' action='$action'>
					<label>$filtro</label>
					<input class='button' style='display:inline' type='submit' 
					       name='quitarFiltro' value='Quitar filtro'>
				</form>";
    }

    /*****************************************************************************
     * FOOTER
     *****************************************************************************/
    // retorna el footer
    public static function getFooter()
    {
        return "
        <footer class='primary'>
            
            <p>Desarrollado por <a href='#'>
                Daniel Mateu</a> - Barcelona 2023.

                <a href='#'>
                    <img src='/images/template/linkedin.png' alt='LinkedIn'>
                </a>
                <a href='#'>
                    <img src='/images/template/github.png' alt='GitHub'>
                </a>
            </p>
        </footer>";
    }

    // retorna el footer de la página de login alternativo
    public static function getAltFooter()
    {
        return "
        <footer class='p-2 mt-5 border-top text-center'>
        &copy;
        <?= date('Y') ?>
        - Desarrollo Web en Entorno Servidor por <a
        target='_blank'
        href='https://daniel-mateu-portfolio.vercel.app/' >Daniel Mateu</a>
        </footer>";
    }
}
