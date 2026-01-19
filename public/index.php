<?php

session_start();

require_once __DIR__ . '/../app/core/Router.php';

$router = new router();

$router->dispatch();
?>