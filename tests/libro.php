<?php

echo "<h1>Test del modelo Libro</h1>";

echo "<h2>Test del método getTemas()</h2>";

dump(Libro::find(1)->getTemas());
dump(Libro::find(25)->getTemas());

die('Fin del Test');


echo "<h2>Test del método addTema()</h2>";

$libro = Libro::find(1);
dump($libro->getTemas());

$libro->addTema(Tema::find(5));
dump($libro->getTemas());

die('Fin del Test');
