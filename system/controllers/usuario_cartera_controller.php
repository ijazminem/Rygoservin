<?php
	/**
	 * Clase para administrar las funcionalidades de los usuarios carteras
	*/
	class Usuario_Cartera_Controller{
		/**
		 * Propiedades
		*/
		private $table_name;

		/**
		 * Inicialziación de los datos
		*/
		function __construct(){
			$this->table_name = 'usuario_cartera';
		}

		/**
		 * Funccion para insertar un dato a la tabla
		 * Devuelve: true || false
		*/
		public function insert($Usuario_Cartera_Model){
			$val = false;

			$conexion = new Conexion();
			$cn = $conexion->connect();

			$query = $cn->prepare("INSERT INTO " . $this->table_name . " (id_usuario, id_cartera) VALUES (?, ?)");

			$query->execute(array(
				$Usuario_Cartera_Model->get_id_usuario(),
				$Usuario_Cartera_Model->get_id_cartera(),
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
		public function update($Usuario_Cartera_Model){
			$val = false;

			$conexion = new Conexion();
			$cn = $conexion->connect();

			$query = $cn->prepare("UPDATE " . $this->table_name . " SET
				id_usuario = ?,
				id_cartera = ?
				WHERE id_usuario_cartera = ?");

			$query->execute(array(
				$Usuario_Cartera_Model->get_id_usuario(),
				$Usuario_Cartera_Model->get_id_cartera(),
				$Usuario_Cartera_Model->get_id_usuario_cartera(),
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
		public function delete($Usuario_Cartera_Model){
			$val = false;

			$conexion = new Conexion();
			$cn = $conexion->connect();

			$query = $cn->prepare("DELETE FROM " . $this->table_name . " WHERE id_usuario_cartera = ?");

			$query->execute(array(
				$Usuario_Cartera_Model->get_id_usuario_cartera()
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
				$usuario_cartera['id_usuario_cartera'] = $data['id_usuario_cartera'];
				$usuario_cartera['id_usuario'] = $data['id_usuario'];
				$usuario_cartera['id_cartera'] = $data['id_cartera'];

				$array[] = $usuario_cartera;
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

            $query = $cn->prepare("SELECT * FROM " . $this->table_name . " WHERE id_usuario_cartera = ?");

            $query->execute(array(
                $id
            ));

            foreach($query as $data){
                $Usuario_Cartera = new Usuario_Cartera_Model();

                $Usuario_Cartera->set_id_usuario_cartera($data['id_usuario_cartera']);
                $Usuario_Cartera->set_id_usuario($data['id_usuario']);
                $Usuario_Cartera->set_id_cartera($data['id_cartera']);
            }

            $cn = null;

            if(isset($Usuario_Cartera)){
                return $Usuario_Cartera;
            }

            return null;
        }

        /**
         * 
        */
        public function select_by_id_usuario_join_carteras($id_usuario){
        	$conexion = new Conexion();
            $cn = $conexion->connect();

            $query = $cn->prepare("SELECT * FROM " . $this->table_name . " AS UC 
            INNER JOIN carteras AS C 
            ON UC.id_cartera = C.id_cartera 
            WHERE UC.id_usuario = ?");

            $query->execute(array(
                $id_usuario
            ));

            foreach($query as $data){
            	$usuario_cartera['id_usuario_cartera'] = $data['id_usuario_cartera'];
                $usuario_cartera['id_usuario'] = $data['id_usuario'];
				$usuario_cartera['id_cartera'] = $data['id_cartera'];
				$usuario_cartera['nombre_cartera'] = $data['nombre_cartera'];

				$array[] = $usuario_cartera;
            }

            $cn = null;

            if(isset($array)){
                return $array;
            }

            return null;
        }
	}
?>