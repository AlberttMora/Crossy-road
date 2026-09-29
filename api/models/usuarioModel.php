<?php
require_once('api/config/connection.php');

class usuarioModel
{
    private static $conn;

    public $id;
    public $nombre;

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

    public static function all()
    {
        self::init();

        $sql = 'SELECT * FROM usuario';
        $stmt = self::$conn->prepare($sql);
        $stmt->execute();

        $data = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $item = new self();
            $item->id = $row['id'];
            $item->nombre = $row['nombre'];
            $data[] = $item;
        }
        return $data;
    }

    public static function find($id)
    {
        self::init();

        $sql = 'SELECT * FROM usuario WHERE id = :id;';
        $stmt = self::$conn->prepare($sql);
        $stmt->execute(['id' => $id]);

        $item = null;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $item = new self();
            $item->id = $row['id'];
            $item->nombre = $row['nombre'];
        }
        return $item;
    }

    public static function findByNombre($nombre)
    {
        self::init();

        $sql = 'SELECT * FROM usuario WHERE nombre = :nombre;';
        $stmt = self::$conn->prepare($sql);
        $stmt->execute(['nombre' => $nombre]);

        $item = null;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $item = new self();
            $item->id = $row['id'];
            $item->nombre = $row['nombre'];
        }
        return $item;
    }

    public function save()
    {
        $query = 'INSERT INTO usuario (nombre) VALUES (:nombre);';
        $stmt = self::$conn->prepare($query);
        $stmt->execute([':nombre' => $this->nombre]);

        $this->id = self::$conn->lastInsertId();
    }
}
