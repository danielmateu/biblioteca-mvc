<?php
class Ejemplar extends Model
{
    // Propiedades
    public $id = 0;
    public $anyo = '';
    public $ediciones = '';
    public $estado = '';
    public $caracteristicas = '';
    public $idlibro = 0;

    protected static string $table = 'ejemplares';
}
