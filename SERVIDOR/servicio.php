<?php
    class Sitio
    {
        public function InsertarSitio($nombre, $estado, $pais, $tipo, $descripcion)
        {
            include 'conexion.php';
            $conectar = new Conexion();

            $consulta = $conectar -> prepare("INSERT INTO sitio(Nombre, Estado, Pais, Tipo, Descripcion) VALUES(:nombre, :estado, :pais, :tipo, :descripcion)");

            $consulta -> bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $consulta -> bindParam(":estado", $estado, PDO::PARAM_STR);
            $consulta -> bindParam(":pais", $pais, PDO::PARAM_STR);
            $consulta -> bindParam(":tipo", $tipo, PDO::PARAM_STR);
            $consulta -> bindParam(":descripcion", $descripcion, PDO::PARAM_STR);

            $consulta -> execute();
            return 1;
        }

        public function ObtenerSitio()
        {
            include 'conexion.php';
            $conectar = new Conexion();

            $consulta = $conectar -> prepare("SELECT * FROM sitio");

            $consulta -> execute();
            $consulta -> setFetchMode(PDO::FETCH_ASSOC);
            return $consulta -> fetchAll();
        }

        public function ModificarSitio($id, $nombre, $estado, $pais, $tipo, $descripcion)
        {
            include 'conexion.php';
            $conectar = new Conexion();

            $consulta = $conectar -> prepare("UPDATE sitio SET Nombre = :nombre, Estado = :estado, Pais = :pais, Tipo = :tipo, Descripcion = :descripcion WHERE ID = :id");

            $consulta -> bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $consulta -> bindParam(":estado", $estado, PDO::PARAM_STR);
            $consulta -> bindParam(":pais", $pais, PDO::PARAM_STR);
            $consulta -> bindParam(":tipo", $tipo, PDO::PARAM_STR);
            $consulta -> bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
            $consulta -> bindParam(":id", $id, PDO::PARAM_STR);

            $consulta -> execute();
            return 1;
        }

        public function EliminarSitio($id)
        {
            include 'conexion.php';
            $conectar = new Conexion();

            $consulta = $conectar -> prepare("DELETE FROM sitio WHERE ID = :id");

            $consulta -> bindParam("id", $id, PDO::PARAM_STR);
            $consulta -> execute();
            return 1;
        }

        public function ConsultarSitioID($id)
        {
            include 'conexion.php';
            $conectar = new Conexion();

            $consulta = $conectar -> prepare("SELECT * FROM sitio WHERE ID = :id");

            $consulta -> bindParam(":id", $id, PDO::PARAM_STR);

            $consulta -> execute();
            $consulta -> setFetchMode(PDO::FETCH_ASSOC);
            return $consulta -> fetch();
        }
    }

    try
    {
        $server = new SoapServer(
            null,
            ['uri' => 'https://swcrud.000webhostapp.com/servicio.php',]
        );

        $server -> setClass('Sitio');
        $server -> handle();
    }
    catch (SoapFault $e)
    {
        echo 'Error: ' . $e -> getMessage();
        exit;
    }
?>