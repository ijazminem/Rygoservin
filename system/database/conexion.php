<?php
    /**
     * Clase para administrar las conexiones a la base de datos
    */
    class Conexion{
        /**
         * Propiedades
        */
        private $host;
        private $db;
        private $user;
        private $password;
        private $charset;

        /**
         * Inicialización de valores
        */
        public function __construct(){
            $this->host     = 'localhost';
            $this->db       = 'rygo';
            $this->user     = 'root';
            $this->password = '';
            $this->charset  = 'utf8mb4';
        }

        /**
         * Función para realizar la conexión a la base de datos
         * Si se establece la conexión se devuelve un objeto de tipo PDO.
         * En caso de error muestra un mensaje con el error de conexión.
        */
        public function connect(){
            try{
                $connection = "mysql:host=" . $this->host . ";dbname=" . $this->db . ";charset=" . $this->charset;
                $options = [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                    PDO::ATTR_PERSISTENT         => true,
                ];
                
                $pdo = new PDO($connection, $this->user, $this->password, $options);
                
                return $pdo;
            }catch(PDOException $e){
                print_r('Error connection: ' . $e->getMessage());
            }
        }
    }
?>