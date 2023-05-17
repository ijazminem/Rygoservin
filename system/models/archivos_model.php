<?php
    /**
     * Clase para administrar los archivos
    */
    class Archivos_Model{
        /**
         * Propiedades
        */
        private $id_archivo;
        private $nombre;
        private $descripcion;
        private $archivo;
        private $fecha_registro;
        private $id_usuario;
        private $id_proceso;

        /**
         * Inicialización de los valores
        */
        function __construct(){
            $this->id_archivo = 0;
            $this->nombre = '';
            $this->descripcion = '';
            $this->archivo = '';
            $this->fecha_registro = '';
            $this->id_usuario = 0;
            $this->id_proceso = 0;
        }

        /**
         * Getter y Setters
        */
        /**
         * id_archivo
        */
        public function get_id_archivo(){
            return $this->id_archivo;
        }

        public function set_id_archivo($id){
            $this->id_archivo = $id;
        }

        /**
         * nombre
        */
        public function get_nombre(){
            return $this->nombre;
        }

        public function set_nombre($nombre){
            $this->nombre = $nombre;
        }

        /**
         * descripcion
        */
        public function get_descripcion(){
            return $this->descripcion;
        }

        public function set_descripcion($descripcion){
            $this->descripcion = $descripcion;
        }

        /**
         * archivo
        */
        public function get_archivo(){
            return $this->archivo;
        }

        public function set_archivo($archivo){
            $this->archivo = $archivo;
        }

        /**
         * fecha_registro
        */
        public function get_fecha_registro(){
            return $this->fecha_registro;
        }

        public function set_fecha_registro($fecha){
            $this->fecha_registro = $fecha;
        }

        /**
         * id_usuario
        */
        public function get_id_usuario(){
            return $this->id_usuario;
        }

        public function set_id_usuario($id){
            $this->id_usuario = $id;
        }

        /**
         * id_proceso
        */
        public function get_id_proceso(){
            return $this->id_proceso;
        }

        public function set_id_proceso($id_proceso){
            $this->id_proceso = $id_proceso;
        }
    }
?>