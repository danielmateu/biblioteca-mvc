<?php

/* Funciones helper para simplificar tareas habituales
 *
 *
 * autor: Robert Sallent
 * última revisión: 31/03/2023
 *
 */

// FUNCIONES PARA DEPURACIÓN
// dump
function dump($thing)
{
    echo "<pre>";
    var_dump($thing);
    echo "</pre>";
}

// dump and die
function dd($thing, string $message = 'Fin de la ejecución.')
{
    dump($thing);
    die($message);
}



// FUNCIONES PARA ARRAYS Y STRINGS
function arrayToString(
    array $lista,               // array
    bool $brackets = true,      // si colocamos corchetes o no
    bool $associative = true    // si el array es asociativo

): string {
    $texto = '';

    foreach ($lista as $clave => $valor)
        $texto .= $associative ? "$clave => $valor, " : "$valor, ";

    return $brackets ? '[ ' . rtrim($texto, ', ') . ' ]' : rtrim($texto, ', ');
}



// REDIRECCIONES Y URLS
// redirect (usa el método redirect() de la clase URL)
function redirect(
    string $url = '/',  // URL a la que redirigir
    int $delay = 0,     // retardo
    bool $die = true    // finalizar la ejecución tras redirección
) {
    URL::redirect($url, $delay, $die);
}

// Acortar un texto a un número de caracteres
function shorten(string $text, int $length = 20): string
{
    return strlen($text) > $length ? substr($text, 0, $length) . '...' : $text;
}

// Añadir clase active a un elemento de menú si la URL coincide
function active(string $url): string
{
    return URL::current() === $url ? 'active' : '';
}
