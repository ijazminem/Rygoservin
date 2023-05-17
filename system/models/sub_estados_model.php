<?php
    /**
     * Clase para administrar proceso judicial
    */
    class Sub_Estados_Model{
        /**
         * Propiedades
        */
        private $id_sub_estado;
        private $descripcion;
        private $habilitado;
        private $id_estado;

        /**
         * Inicialización de los valores
        */
        function __construct(){
            $this->id_sub_estado = 0;
            $this->descripcion = '';
            $this->habilitado = 'No';
            $this->id_estado = 0;
        }

        /**
         * Getter y Setters
        */
        /**
         * id_sub_estado
        */
        public function get_id_sub_estado(){
            return $this->id_sub_estado;
        }

        public function set_id_sub_estado($id_sub_estado){
            $this->id_sub_estado = $id_sub_estado;
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
         * habilitado
        */
        public function get_habilitado(){
            return $this->habilitado;
        }

        public function set_habilitado($habilitado){
            $this->habilitado = $habilitado;
        }

        /**
         * id_estado
        */
        public function get_id_estado(){
            return $this->id_estado;
        }

        public function set_id_estado($id_estado){
            $this->id_estado = $id_estado;
        }
    }
?>