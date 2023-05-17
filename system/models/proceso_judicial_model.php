<?php
    /**
     * Clase para administrar proceso judicial
    */
    class Proceso_Judicial_Model{
        /**
         * Propiedades
        */
        private $id_proceso;
        private $descripcion;
        private $fecha_registro;
        private $id_usuario;
        private $dui;

        /**
         * Inicialización de los valores
        */
        function __construct(){
            $this->id_proceso = 0;
            $this->descripcion = '';
            $this->fecha_registro = '';
            $this->id_usuario = 0;
            $this->dui = '';
        }

        /**
         * Getter y Setters
        */
        /**
         * id_proceso
        */
        public function get_id_proceso(){
            return $this->id_proceso;
        }

        public function set_id_proceso($id){
            $this->id_proceso = $id;
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
         * dui
        */
        public function get_dui(){
            return $this->dui;
        }

        public function set_dui($dui){
            $this->dui = $dui;
        }
    }
?>