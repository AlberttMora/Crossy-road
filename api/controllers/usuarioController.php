<?php
require_once('api/models/usuarioModel.php');

class usuarioController
{
    public function store($request)
    {
        $existente = usuarioModel::findByNombre($request['nombre']);

        if ($existente !== null) {
            echo json_encode(['error' => 'Ese nombre ya está en uso']);
            return;
        }

        $usuario = new usuarioModel();
        $usuario->nombre = $request['nombre'];
        $usuario->save();

        echo json_encode(['status' => 'ok', 'id' => $usuario->id]);
    }
}
