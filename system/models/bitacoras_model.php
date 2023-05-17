<?php
    /**
     * Clase para administrar bitácoras
    */
    class Bitacoras_Model{
        /**
         * Propiedades
        */
        private $id_bitacora;
        private $descripcion;
        private $fecha_registro;
        private $id_usuario;
        private $id_proceso;

        /**
         * Inicialización de los valores
        */
        function __construct(){
            $this->id_bitacora = 0;
            $this->descripcion = '';
            $this->fecha_registro = '';
            $this->id_usuario = 0;
            $this->id_proceso = 0;
        }

        /**
         * Getter y Setters
        */
        /**
         * id_bitacora
        */
        public function get_id_bitacora(){
            return $this->id_bitacora;
        }

        public function set_id_bitacora($id){
            $this->id_bitacora = $id;
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