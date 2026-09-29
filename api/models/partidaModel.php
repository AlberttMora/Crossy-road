<?php
require_once('api/config/connection.php');

class partidaModel
{
    private static $conn;

    public $id;
    public $usuario_id;
    public $puntaje;
    public $duracion_segundos;
    public $fecha;

    // Viene del JOIN con usuario
    public $nombre_usuario;

    public function __construct()
    {
        self::init();
    }

    public static function init()
    {
        if (self::$conn == null) {
            $db = new Database();
            self::$conn = $db->getConnection();
        }
    }

    public static function ranking()
    {
        self::init();

        $sql = 'SELECT p.id, p.puntaje, p.duracion_segundos, p.fecha, u.nombre AS nombre_usuario
                FROM partida p
                JOIN usuario u ON p.usuario_id = u.id
                ORDER BY p.puntaje DESC';

        $stmt = self::$conn->prepare($sql);
        $stmt->execute();

        $data = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $item = new self();
            $item->id = $row['id'];
            $item->puntaje = $row['puntaje'];
            $item->duracion_segundos = $row['duracion_segundos'];
            $item->fecha = $row['fecha'];
            $item->nombre_usuario = $row['nombre_usuario'];
            $data[] = $item;
        }
        return $data;
    }

    public function save()
    {
        $query = 'INSERT INTO partida (usuario_id, puntaje, duracion_segundos) VALUES (:usuario_id, :puntaje, :duracion_segundos);';
        $stmt = self::$conn->prepare($query);
        $stmt->execute([
            ':usuario_id' => $this->usuario_id,
            ':puntaje' => $this->puntaje,
            ':duracion_segundos' => $this->duracion_segundos
        ]);
    }
}
