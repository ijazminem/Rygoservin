<?php
    class Bitacoras_Controller{
        private $table_name = '';

        function __construct(){
            $this->table_name = 'bitacoras';
        }

        public function insert($Bitacoras_Model){
            $val = false;

            $conexion = new Conexion();
            $cn = $conexion->connect();

            $query = $cn->prepare("INSERT INTO " . $this->table_name . " (descripcion, fecha_registro, id_usuario, id_proceso) VALUES (?, ?, ?, ?)");

            $query->execute(array(
                $Bitacoras_Model->get_descripcion(),
                $Bitacoras_Model->get_fecha_registro(),
                $Bitacoras_Model->get_id_usuario(),
                $Bitacoras_Model->get_id_proceso()
            ));

            if($query->rowCount() > 0){
                $val = true;
            }

            $cn = null;

            return $val;
        }

        public function update($Bitacoras_Model){
            $val = false;

            $conexion = new Conexion();
            $cn = $conexion->connect();

            $query = $cn->prepare("UPDATE " . $this->table_name . " SET
                descripcion = ?,
                fecha_registro = ?,
                id_usuario = ?,
                id_proceso = ?
                WHERE id_bitacora = ?");

            $query->execute(array(
                $Bitacoras_Model->get_descripcion(),
                $Bitacoras_Model->get_fecha_registro(),
                $Bitacoras_Model->get_id_usuario(),
                $Bitacoras_Model->get_id_proceso(),
                $Bitacoras_Model->get_id_bitacora()
            ));

            if($query->rowCount() > 0){
                $val = true;
            }

            $cn = null;

            return $val;
        }

        public function delete($Bitacoras_Model){
            $val = false;

            $conexion = new Conexion();
            $cn = $conexion->connect();

            $query = $cn->prepare("DELETE FROM " . $this->table_name . " WHERE id_bitacora = ?");

            $query->execute(array(
                $Bitacoras_Model->get_id_bitacora()
            ));

            if($query->rowCount() > 0){
                $val = true;
            }

            $cn = null;

            return $val;
        }
        
        public function select_all(){
            $conexion = new Conexion();
            $cn = $conexion->connect();

            $query = $cn->prepare("SELECT * FROM " . $this->table_name);

            $query->execute();

            foreach($query as $data){
                $bitacora['id_bitacora'] = $data['id_bitacora'];
                $bitacora['descripcion'] = $data['descripcion'];
                $bitacora['fecha_registro'] = $data['fecha_registro'];
                $bitacora['id_usuario'] = $data['id_usuario'];
                $bitacora['id_proceso'] = $data['id_proceso'];

                $array[] = $bitacora;
            }

            if(isset($array)){
                return $array;
            }

            return null;
        }

        /**
         * Funcion para recuperar un valor a través de su id
         * Devuelve: Modelo con sus datos en caso de que haya encontrado una coincidencia, null en caso de que no haya encontrado ninguna coincidencia
        */
        public function select_by_id($id){
            $conexion = new Conexion();
            $cn = $conexion->connect();

            $query = $cn->prepare("SELECT * FROM " . $this->table_name . " WHERE id_bitacora = ?");

            $query->execute(array(
                $id
            ));

            foreach($query as $data){
                $Bitacora = new Bitacoras_Model();

                $Bitacora->set_id_bitacora($data['id_bitacora']);
                $Bitacora->set_descripcion($data['descripcion']);
                $Bitacora->set_fecha_registro($data['fecha_registro']);
                $Bitacora->set_id_usuario($data['id_usuario']);
                $Bitacora->set_id_proceso($data['id_proceso']);
            }

            $cn = null;

            if(isset($Bitacora)){
                return $Bitacora;
            }

            return null;
        }

        /**
         * 
        */
        public function select_all_by_id_proceso($id){
            $conexion = new Conexion();
            $cn = $conexion->connect();

            $query = $cn->prepare("SELECT * FROM " . $this->table_name . " WHERE id_proceso = ?");

            $query->execute(array(
                $id
            ));

            foreach($query as $data){
                $bitacora['id_bitacora'] = $data['id_bitacora'];
                $bitacora['descripcion'] = $data['descripcion'];
                $bitacora['fecha_registro'] = $data['fecha_registro'];
                $bitacora['id_usuario'] = $data['id_usuario'];
                $bitacora['id_proceso'] = $data['id_proceso'];

                $array[] = $bitacora;
            }

            if(isset($array)){
                return $array;
            }

            return null;
        }
    }
?>