<?php

session_start();

$_SESSION["usuarios"] = "Vinicius";

echo "Usuario armazenado na sessao <br><pre>";

var_dump($_SESSION);

echo "</pre>";

?>