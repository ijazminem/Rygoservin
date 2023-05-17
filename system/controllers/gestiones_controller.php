<?php
	/**
	 * Clase para administrar las funcionalidades de las gestiones
	*/
	class Gestiones_Controller{
		/**
		 * Propiedades
		*/
		private $table_name;

		/**
		 * Inicialziación de los datos
		*/
		function __construct(){
			$this->table_name = 'gestiones';
		}

		/**
		 * Funccion para insertar un dato a la tabla
		 * Devuelve: true || false
		*/
		public function insert($Gestiones_Model){
			$val = false;

			$conexion = new Conexion();
			$cn = $conexion->connect();

			$query = $cn->prepare("INSERT INTO " . $this->table_name . " (descripcion, fecha_registro, id_usuario, id_sub_estado, dui) VALUES (?, ?, ?, ?, ?)");

			$query->execute(array(
				$Gestiones_Model->get_descripcion(),
				$Gestiones_Model->get_fecha_registro(),
				$Gestiones_Model->get_id_usuario(),
				$Gestiones_Model->get_id_sub_estado(),
				$Gestiones_Model->get_dui(),
			));

			if($query->rowCount() > 0){
                $val = true;
            }

			$cn = null;

			return $val;
		}

		/**
		 * Funcion para actualizar los datos de la tabla
		 * Devuelve: true || false
		*/
		public function update($Gestiones_Model){
			$val = false;

			$conexion = new Conexion();
			$cn = $conexion->connect();

			$query = $cn->prepare("UPDATE " . $this->table_name . " SET
				descripcion = ?,
				fecha_registro = ?,
				id_usuario = ?,
				id_sub_estado = ?,
				dui = ?
				WHERE id_gestion = ?");

			$query->execute(array(
				$Gestiones_Model->get_descripcion(),
				$Gestiones_Model->get_fecha_registro(),
				$Gestiones_Model->get_id_usuario(),
				$Gestiones_Model->get_id_sub_estado(),
				$Gestiones_Model->get_dui(),
				$Gestiones_Model->get_id_gestion()
			));

			if($query->rowCount() > 0){
                $val = true;
            }

			$cn = null;

			return $val;
		}

		/**
		 * Funcion para eliminar un registro de la tabla
		*/
		public function delete($Gestiones_Model){
			$val = false;

			$conexion = new Conexion();
			$cn = $conexion->connect();

			$query = $cn->prepare("DELETE FROM " . $this->table_name . " WHERE id_gestion = ?");

			$query->execute(array(
				$Gestiones_Model->get_id_gestion()
			));

			if($query->rowCount() > 0){
                $val = true;
            }

			$cn = null;

			return $val;
		}

		/**
		 * Funcion para recuperar los datos de una tabla
		 * Devuelve: array en caso de que hayan datos, y devuelve null en caso de que no hayan registros
		*/
		public function select_all(){
			$conexion = new Conexion();
			$cn = $conexion->connect();

			$query = $cn->prepare("SELECT * FROM " . $this->table_name);

			$query->execute();

			foreach($query as $data){
				$gestion['id_gestion'] = $data['id_gestion'];
				$gestion['descripcion'] = $data['descripcion'];
				$gestion['fecha_registro'] = $data['fecha_registro'];
				$gestion['id_usuario'] = $data['id_usuario'];
				$gestion['id_sub_estado'] = $data['id_sub_estado'];
				$gestion['dui'] = $data['dui'];

				$array[] = $gestion;
			}

			$cn = null;

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

            $query = $cn->prepare("SELECT * FROM " . $this->table_name . " WHERE id_gestion = ?");

            $query->execute(array(
                $id
            ));

            foreach($query as $data){
                $Gestion = new Gestiones_Model();

                $Gestion->set_id_gestion($data['id_gestion']);
                $Gestion->set_descripcion($data['descripcion']);
                $Gestion->set_fecha_registro($data['fecha_registro']);
                $Gestion->set_id_usuario($data['id_usuario']);
                $Gestion->set_id_sub_estado($data['id_sub_estado']);
                $Gestion->set_dui($data['dui']);
            }

            $cn = null;

            if(isset($Gestion)){
                return $Gestion;
            }

            return null;
        }

		public function select_all_by_dui($dui){
			$conexion = new Conexion();
			$cn = $conexion->connect();

			$query = $cn->prepare("SELECT * FROM " . $this->table_name . " WHERE dui = ?");

			$query->execute(array(
				$dui
			));

			foreach($query as $data){
				$gestion['id_gestion'] = $data['id_gestion'];
				$gestion['descripcion'] = $data ['descripcion'];
				$gestion['fecha_registro'] = $data['fecha_registro'];
				$gestion['id_usuario'] = $data['id_usuario'];
				$gestion['id_sub_estado'] = $data['id_sub_estado'];
				$gestion['dui'] = $data['dui'];

				$array[] = $gestion;
			}

			$cn = null;

			if(isset($array)){
				return $array;
			}

			return null;
		}
	}
?>