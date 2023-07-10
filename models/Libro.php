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
    public $portada = '';

    // Métodos no heredados
    public function getTemas(): array
    {
        $consulta = "SELECT t.* FROM temas t INNER JOIN temas_libros tl ON t.id=tl.idtema WHERE tl.idlibro=$this->id";

        // Retorna una lista detemas
        return (DB_CLASS)::selectAll($consulta, 'Tema');
    }

    // Añade un tema al libro
    public function addTema(Tema $tema): int
    {
        $consulta = "INSERT INTO temas_libros (idlibro, idtema) VALUES ($this->id, $tema->id)";

        return (DB_CLASS)::insert($consulta);
    }
}
