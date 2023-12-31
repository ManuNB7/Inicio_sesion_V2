<?php

    require_once __DIR__.'/conexion.php';

    /**
     * Clase sesionModel
     * 
     * Modelo para la gestión de sesiones de usuario.
     */
    class sesionModel extends Conexion{

        private $tabla;
        private $id;
        private $correo;
        private $pw;
        private $nombre;
        private $perfil;
        public $error;

        /**
         * Constructor de la clase.
         * 
         * Inicializa las propiedades de la clase y llama al constructor de la clase padre (Conexion).
         */
        public function __construct() {
            parent::__construct();
            $this->tabla = "us_admin";
            $this->id = "id";
            $this->correo = "correo";
            $this->pw = "pw";
            $this->nombre = "nombre";
            $this->perfil = "perfil";
        }

        /**
         * Comprueba si las credenciales del usuario son válidas.
         */
        function comprobar_usuario($login,$pw){
            $sql = "SELECT ".$this->id.",".$this->perfil.",".$this->nombre.", ".$this->pw." 
            FROM ".$this->tabla." 
            WHERE ".$this->nombre."= ? OR ".$this->correo." = ?;";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bind_param('ss',$login,$login);
            $stmt->execute();
            $stmt->bind_result($id,$perfil,$nombre,$pwhash);
            $stmt->fetch();
            $stmt->close();

            $pwcorrecta = password_verify($pw,$pwhash);
            if(!$pwcorrecta){
                $this->error="Usuario y/o contraseña incorrectos";
                return false;
            } else {
                $_SESSION["id"] = $id;
                $_SESSION["perfil"] = $perfil;
                $_SESSION["nombre"] = $nombre;
                return true;
            }
        }
    }

?>