<?php
    class Conexion extends PDO
    {
        private $host = "localhost";
        private $bd = "id21422253_turismo";
        private $user = "id21422253_diegojv";
        private $password = "DyD161216*";

        public function __construct()
        {
            try 
            {
                parent::__construct('mysql:host='.$this->host.';dbname='.$this->bd.';charset=UTF8',$this->user,$this->password,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
            }
            catch (Exception $th)
            {
                echo 'error: ' . $th->getMessage();
                exit;
            }
        }
    }
?>