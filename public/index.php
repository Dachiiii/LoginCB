<?php

require "../DB.php";
require "../Route.php";
require "../Home.php";
require "../Template.php";
require "../Validate.php";

session_start();

$router = new Router();

$router->route($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);

?>