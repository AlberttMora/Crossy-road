<?php

$page = $_GET['page'] ?? 'juego';

switch ($page) {
    case 'ranking':
        include('views/ranking.php');
        break;
    case 'juego':
    default:
        include('views/juego.php');
        break;
}
