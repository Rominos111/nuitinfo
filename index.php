<?php
session_start();

#Affichage des message de debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


#Configurations
include_once("./includes/classes/obj/database.php");

#Fonctions utiles
include_once("./includes/classes/utils.php");

#Affichage de la page web
include("./includes/classes/view.php");

?>
