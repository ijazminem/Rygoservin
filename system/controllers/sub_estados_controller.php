<?php
    class Sub_Estados_Controller{
        private $table_name = '';

        function __construct(){
            $this->table_name = 'sub_estados';
        }

        public function insert($Sub_Estados_Model){
            $val = false;

            $conexion = new Conexion();
            $cn = $conexion->connect();

            $query = $cn->prepare("INSERT INTO " . $this->table_name . " (descripcion, habilitado, id_estado) VALUES (?, ?, ?)");

			$query->execute(array(
                $Sub_Estados_Model->get_descripcion(),
                $Sub_Estados_Model->get_habilitado(),
                $Sub_Estados_Model->get_id_estado()
			));

			if($query->rowCount() > 0){
                $val = true;
            }

			$cn = null;

			return $val;
        }

        public function update($Sub_Estados_Model){
            $val = false;

            $conexion = new Conexion();
            $cn = $conexion->connect();

            $query = $cn->prepare("UPDATE " . $this->table_name . " SET
                descripcion = ?,
                habilitado = ?,
                id_estado = ?
                WHERE id_sub_estado = ?");

            $query->execute(array(
                $Sub_Estados_Model->get_descripcion(),
                $Sub_Estados_Model->get_habilitado(),
                $Sub_Estados_Model->get_id_estado(),
                $Sub_Estados_Model->get_id_sub_estado()
            ));

            if($query->rowCount() > 0){
                $val = true;
            }

            $cn = null;

            return $val;
        }
        
        public function delete($Sub_Estados_Model){
            $val = false;

            $conexion = new Conexion();
            $cn = $conexion->connect();

            $query = $cn->prepare("DELETE FROM " . $this->table_name . " WHERE id_sub_estado = ?");

            $query->execute(array(
                $Sub_Estados_Model->get_id_sub_estado()
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
                $sub_estado['id_sub_estado'] = $data['id_sub_estado'];
                $sub_estado['descripcion'] = $data['descripcion'];
                $sub_estado['habilitado'] = $data['habilitado'];
                $sub_estado['id_estado'] = $data['id_estado'];

                $array[] = $sub_estado;
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

            $query = $cn->prepare("SELECT * FROM " . $this->table_name . " WHERE id_sub_estado = ?");

            $query->execute(array(
                $id
            ));

            foreach($query as $data){
                $Sub_Estado = new Sub_Estados_Model();

                $Sub_Estado->set_id_sub_estado($data['id_sub_estado']);
                $Sub_Estado->set_descripcion($data['descripcion']);
                $Sub_Estado->set_habilitado($data['habilitado']);
                $Sub_Estado->set_id_estado($data['id_estado']);
            }

            $cn = null;

            if(isset($Sub_Estado)){
                return $Sub_Estado;
            }

            return null;
        }

        /**
         * 
        */
        public function select_all_by_id_estado_habilitado($id, $habilitado){
            $conexion = new Conexion();
            $cn = $conexion->connect();

            $query = $cn->prepare("SELECT * FROM " . $this->table_name . " WHERE id_estado = ?  AND habilitado = ?");

            $query->execute(array(
                $id,
                $habilitado
            ));

            foreach($query as $data){
                $sub_estado['id_sub_estado'] = $data['id_sub_estado'];
                $sub_estado['descripcion'] = $data['descripcion'];
                $sub_estado['habilitado'] = $data['habilitado'];
                $sub_estado['id_estado'] = $data['id_estado'];

                $array[] = $sub_estado;
            }

            if(isset($array)){
                return $array;
            }

            return null;
        }

        /**
         * 
        */
        public function select_all_by_id_estado($id){
            $conexion = new Conexion();
            $cn = $conexion->connect();

            $query = $cn->prepare("SELECT * FROM " . $this->table_name . " WHERE id_estado = ?");

            $query->execute(array(
                $id
            ));

            foreach($query as $data){
                $sub_estado['id_sub_estado'] = $data['id_sub_estado'];
                $sub_estado['descripcion'] = $data['descripcion'];
                $sub_estado['habilitado'] = $data['habilitado'];
                $sub_estado['id_estado'] = $data['id_estado'];

                $array[] = $sub_estado;
            }

            if(isset($array)){
                return $array;
            }

            return null;
        }
    }
?>