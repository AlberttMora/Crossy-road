<?php
require_once('api/models/partidaModel.php');

class partidaController
{
    public function store($request)
    {
        try {
            $partida = new partidaModel();
            $partida->usuario_id = $request['usuario_id'];
            $partida->puntaje = $request['puntaje'];
            $partida->duracion_segundos = $request['duracion_segundos'];
            $partida->save();

            echo json_encode(['status' => 'ok']);
        } catch (PDOException $e) {
            echo json_encode(['error' => 'No se pudo guardar la partida']);
        }
    }

    public function ranking()
    {
        $data = partidaModel::ranking();
        echo json_encode($data);
    }
}
