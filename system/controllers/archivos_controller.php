<?php
    class Archivos_Controller{
        private $table_name = '';

        function __construct(){
            $this->table_name = 'archivos';
        }

        public function insert($Archivos_Model){
            $val = false;

            $conexion = new Conexion();
            $cn = $conexion->connect();

            $query = $cn->prepare("INSERT INTO " . $this->table_name . " (nombre, descripcion, archivo, fecha_registro, id_usuario, id_proceso) VALUES (?, ?, ?, ?, ?, ?)");

			$query->execute(array(
				$Archivos_Model->get_nombre(),
                $Archivos_Model->get_descripcion(),
                $Archivos_Model->get_archivo(),
                $Archivos_Model->get_fecha_registro(),
                $Archivos_Model->get_id_usuario(),
                $Archivos_Model->get_id_proceso()
			));

			if($query->rowCount() > 0){
                $val = true;
            }

			$cn = null;

			return $val;
        }

        public function update($Archivos_Model){
            $val = false;

            $conexion = new Conexion();
            $cn = $conexion->connect();

            $query = $cn->prepare("UPDATE " . $this->table_name . " SET
                nombre = ?,
                descripcion = ?,
                archivo = ?,
                fecha_registro = ?,
                id_usuario = ?,
                id_proceso = ?
                WHERE id_archivo = ?");

            $query->execute(array(
                $Archivos_Model->get_nombre(),
                $Archivos_Model->get_descripcion(),
                $Archivos_Model->get_archivo(),
                $Archivos_Model->get_fecha_registro(),
                $Archivos_Model->get_id_usuario(),
                $Archivos_Model->get_id_proceso(),
                $Archivos_Model->get_id_archivo()
            ));

            if($query->rowCount() > 0){
                $val = true;
            }

            $cn = null;

            return $val;
        }

        public function delete($Archivos_Model){
            $val = false;

            $conexion = new Conexion();
            $cn = $conexion->connect();

            $query = $cn->prepare("DELETE FROM " . $this->table_name . " WHERE id_archivo = ?");

            $query->execute(array(
                $Archivos_Model->get_id_archivo()
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
                $archivo['id_archivo'] = $data['id_archivo'];
                $archivo['nombre'] = $data['nombre'];
                $archivo['descripcion'] = $data['descripcion'];
                $archivo['archivo'] = $data['archivo'];
                $archivo['fecha_registro'] = $data['fecha_registro'];
                $archivo['id_usuario'] = $data['id_usuario'];
                $archivo['id_proceso'] = $data['id_proceso'];

                $array[] = $archivo;
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

            $query = $cn->prepare("SELECT * FROM " . $this->table_name . " WHERE id_archivo = ?");

            $query->execute(array(
                $id
            ));

            foreach($query as $data){
                $Archivo = new Archivos_Model();

                $Archivo->set_id_archivo($data['id_archivo']);
                $Archivo->set_nombre($data['nombre']);
                $Archivo->set_descripcion($data['descripcion']);
                $Archivo->set_archivo($data['archivo']);
                $Archivo->set_fecha_registro($data['fecha_registro']);
                $Archivo->set_id_usuario($data['id_usuario']);
                $Archivo->set_id_proceso($data['id_proceso']);
            }

            $cn = null;

            if(isset($Archivo)){
                return $Archivo;
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
                $archivo['id_archivo'] = $data['id_archivo'];
                $archivo['nombre'] = $data['nombre'];
                $archivo['descripcion'] = $data['descripcion'];
                $archivo['archivo'] = $data['archivo'];
                $archivo['fecha_registro'] = $data['fecha_registro'];
                $archivo['id_usuario'] = $data['id_usuario'];
                $archivo['id_proceso'] = $data['id_proceso'];

                $array[] = $archivo;
            }

            if(isset($array)){
                return $array;
            }

            return null;
        }
    }
?>