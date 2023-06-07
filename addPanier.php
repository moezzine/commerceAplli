<?php

require_once("function.php");
$id=$_GET["id"];
addPanier($id);
header("location:monPanier.php");
?>