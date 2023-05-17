<?php
    /**
     * Clase para administrar los archivos
    */
    class Clientes_Model{
        /**
         * Propiedades
        */
        private $dui;
        private $id_cliente;
        private $nombre_completo;
        private $telefono;
        private $estado;
        private $fecha_registro;
        private $id_cartera;

        /**
         * Inicialización de los valores
        */

        function __construct(){
            $this->dui = '';
            $this->id_cliente = 0;
            $this->nombre_completo = '';
            $this->telefono = 0;
            $this->estado = '';
            $this->fecha_registro = '';
            $this->id_cartera = 0;
        }

        /**
         * Getters y Setters
        */
        /**
         * dui
        */
        public function get_dui(){
            return $this->dui;
        }

        public function set_dui($dui){
            $this->dui = $dui;
        }

        /**
         * id_cliente
        */
        public function get_id_cliente(){
            return $this->id_cliente;
        }

        public function set_id_cliente($id_cliente){
            $this->id_cliente = $id_cliente;
        }

        /**
         * nombre_completo
        */
        public function get_nombre_completo(){
            return $this->nombre_completo;
        }

        public function set_nombre_completo($nombre){
            $this->nombre_completo = $nombre;
        }

        /**
         * telefono
        */
        public function get_telefono(){
            return $this->telefono;
        }

        public function set_telefono($telefono){
            $this->telefono = $telefono;
        }

        /**
         * estado
        */
        public function get_estado(){
            return $this->estado;
        }

        public function set_estado($estado){
            $this->estado = $estado;
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
         * id_cartera
        */
        public function get_id_cartera(){
            return $this->id_cartera;
        }

        public function set_id_cartera($id_cartera){
            $this->id_cartera = $id_cartera;
        }
    }
?>