<?php

$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; charset=iso-8859-1';
mail('ddelapuenteenriquez@gmail.com', 'hola', 'hola', implode($headers));

?>
