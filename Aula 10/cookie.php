<?php
setcookie("empresa", "Just Chronos", time() + 3600);
echo "Cookie criado";

var_dump($_COOKIE);
?>