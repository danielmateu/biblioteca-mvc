<?php
class Ejemplar extends Model
{
    // Propiedades
    public int $idlibro = 0;
    public int $anyo = 0;
    public string $edicion = '';
    public float $precio = 0;
    public string $estado = '';
    public string $caracteristicas = '';

    protected static string $table = 'ejemplares';
}
