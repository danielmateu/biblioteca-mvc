<?php
// Clase libro, forma parte del modelo
class Libro extends Model
{
    // Propiedades
    public $id = 0;
    public $isbn = '';
    public $titulo = '';
    public $editorial = '';
    public $autor = '';
    public $idioma = '';
    public $ediciones = '';
    public $edadrecomendada = 0;
}
