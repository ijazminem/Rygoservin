<?php
	/**
	 * Clase para administrar las funcionalidades de los estados
	*/
	class Estados_Controller{
		/**
		 * Propiedades
		*/
		private $table_name;

		/**
		 * Inicialziación de los datos
		*/
		function __construct(){
			$this->table_name = 'estados';
		}

		/**
		 * Funccion para insertar un dato a la tabla
		 * Devuelve: true || false
		*/
		public function insert($Estados_Model){
			$val = false;

			$conexion = new Conexion();
			$cn = $conexion->connect();

			$query = $cn->prepare("INSERT INTO " . $this->table_name . " (descripcion, habilitado, id_cartera) VALUES (?, ?, ?)");

			$query->execute(array(
				$Estados_Model->get_descripcion(),
				$Estados_Model->get_habilitado(),
				$Estados_Model->get_id_cartera(),
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
		public function update($Estados_Model){
			$val = false;

			$conexion = new Conexion();
			$cn = $conexion->connect();

			$query = $cn->prepare("UPDATE " . $this->table_name . " SET
				descripcion = ?,
				habilitado = ?,
				id_cartera = ?
				WHERE id_estado = ?");

			$query->execute(array(
				$Estados_Model->get_descripcion(),
				$Estados_Model->get_habilitado(),
				$Estados_Model->get_id_cartera(),
				$Estados_Model->get_id_estado()
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
		public function delete($Estados_Model){
			$val = false;

			$conexion = new Conexion();
			$cn = $conexion->connect();

			$query = $cn->prepare("DELETE FROM " . $this->table_name . " WHERE id_estado = ?");

			$query->execute(array(
				$Estados_Model->get_id_estado()
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
				$estado['id_estado'] = $data['id_estado'];
				$estado['descripcion'] = $data['descripcion'];
				$estado['habilitado'] = $data['habilitado'];
				$estado['id_cartera'] = $data['id_cartera'];

				$array[] = $estado;
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

            $query = $cn->prepare("SELECT * FROM " . $this->table_name . " WHERE id_estado = ?");

            $query->execute(array(
                $id
            ));

            foreach($query as $data){
                $Estado = new Estados_Model();

                $Estado->set_id_estado($data['id_estado']);
                $Estado->set_descripcion($data['descripcion']);
                $Estado->set_habilitado($data['habilitado']);
                $Estado->set_id_cartera($data['id_cartera']);
            }

            $cn = null;

            if(isset($Estado)){
                return $Estado;
            }

            return null;
        }

        /**
         * 
        */
        public function select_all_by_id_cartera($id){
			$conexion = new Conexion();
			$cn = $conexion->connect();

			$query = $cn->prepare("SELECT * FROM " . $this->table_name . " WHERE id_cartera = ?");

			$query->execute(array(
				$id
			));

			foreach($query as $data){
				$estado['id_estado'] = $data['id_estado'];
				$estado['descripcion'] = $data['descripcion'];
				$estado['habilitado'] = $data['habilitado'];
				$estado['id_cartera'] = $data['id_cartera'];

				$array[] = $estado;
			}

			$cn = null;

			if(isset($array)){
				return $array;
			}

			return null;
		}

		// 
		public function select_all_by_id_cartera_habilitado($id, $habilitado){
			$conexion = new Conexion();
			$cn = $conexion->connect();

			$query = $cn->prepare("SELECT * FROM " . $this->table_name . " WHERE id_cartera = ? AND habilitado = ?");

			$query->execute(array(
				$id,
				$habilitado
			));

			foreach($query as $data){
				$estado['id_estado'] = $data['id_estado'];
				$estado['descripcion'] = $data['descripcion'];
				$estado['habilitado'] = $data['habilitado'];
				$estado['id_cartera'] = $data['id_cartera'];

				$array[] = $estado;
			}

			$cn = null;

			if(isset($array)){
				return $array;
			}

			return null;
		}
	}
?>