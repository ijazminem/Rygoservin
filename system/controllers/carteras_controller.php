<?php
	/**
	 * Clase para administrar las funcionalidades de las carteras
	*/
	class Carteras_Controller{
		/**
		 * Propiedades
		*/
		private $table_name;

		/**
		 * Inicialziación de los datos
		*/
		function __construct(){
			$this->table_name = 'carteras';
		}

		/**
		 * Funccion para insertar un dato a la tabla
		 * Devuelve: true || false
		*/
		public function insert($Cartera_Model){
			$val = false;

			$conexion = new Conexion();
			$cn = $conexion->connect();

			$query = $cn->prepare("INSERT INTO " . $this->table_name . " (nombre_cartera, descripcion, correo_contacto) VALUES (?, ?, ?)");

			$query->execute(array(
				$Cartera_Model->get_nombre_cartera(),
				$Cartera_Model->get_descripcion(),
				$Cartera_Model->get_correo_contacto(),
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
		public function update($Cartera_Model){
			$val = false;

			$conexion = new Conexion();
			$cn = $conexion->connect();

			$query = $cn->prepare("UPDATE " . $this->table_name . " SET
				nombre_cartera = ?,
				descripcion = ?,
				correo_contacto = ?
				WHERE id_cartera = ?");

			$query->execute(array(
				$Cartera_Model->get_nombre_cartera(),
				$Cartera_Model->get_descripcion(),
				$Cartera_Model->get_correo_contacto(),
				$Cartera_Model->get_id_cartera()
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
		public function delete($Cartera_Model){
			$val = false;

			$conexion = new Conexion();
			$cn = $conexion->connect();

			$query = $cn->prepare("DELETE FROM " . $this->table_name . " WHERE id_cartera = ?");

			$query->execute(array(
				$Cartera_Model->get_id_cartera()
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
				$cartera['id_cartera'] = $data['id_cartera'];
				$cartera['nombre_cartera'] = $data['nombre_cartera'];
				$cartera['descripcion'] = $data['descripcion'];
				$cartera['correo_contacto'] = $data['correo_contacto'];

				$array[] = $cartera;
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

            $query = $cn->prepare("SELECT * FROM " . $this->table_name . " WHERE id_cartera = ?");

            $query->execute(array(
                $id
            ));

            foreach($query as $data){
                $Cartera = new Carteras_Model();

                $Cartera->set_id_cartera($data['id_cartera']);
                $Cartera->set_nombre_cartera($data['nombre_cartera']);
                $Cartera->set_descripcion($data['descripcion']);
                $Cartera->set_correo_contacto($data['correo_contacto']);
            }

            $cn = null;

            if(isset($Cartera)){
                return $Cartera;
            }

            return null;
        }
	}
?>