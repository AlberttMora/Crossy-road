<?php
require_once('api/controllers/usuarioController.php');
require_once('api/controllers/partidaController.php');

$entidad = $_GET['entidad'] ?? '';
$action = $_GET['action'] ?? '';

header('Content-Type: application/json');

switch ($entidad) {
    case 'usuario':
        $controller = new usuarioController();

        switch ($action) {
            case 'store':
                $controller->store($_POST);
                break;
            default:
                echo json_encode(['error' => 'Accion no valida']);
                break;
        }
        break;

    case 'partida':
        $controller = new partidaController();

        switch ($action) {
            case 'store':
                $controller->store($_POST);
                break;
            case 'ranking':
                $controller->ranking();
                break;
            default:
                echo json_encode(['error' => 'Accion no valida']);
                break;
        }
        break;

    default:
        echo json_encode(['error' => 'Entidad no valida']);
        break;
}
