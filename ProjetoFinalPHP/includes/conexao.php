<?php

$conn = pg_connect("
    host=localhost
    port=5432
    dbname=gameintel
    user=postgres
    password=postgres
");

if(!$conn){
    die("Erro ao conectar com o banco PostgreSQL");
}

?>
