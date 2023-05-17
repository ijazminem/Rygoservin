<?php
	/**
	 * Clase para administrar las funcionalidades para el modelo
	*/
	class Tipos_Usuarios_Controller{
		/**
		 * Propiedades
		*/
		private $table_name = '';

		/**
		 * Inicialización de valores
		*/
		function __construct(){
			$this->table_name = 'tipos_usuarios';
		}

		/**
		 * Funccion para insertar un dato a la tabla
		 * Devuelve: true || false
		*/
		public function insert($Tipos_Usuarios_Model){
			$val = false;

			$conexion = new Conexion();
			$cn = $conexion->connect();

			$query = $cn->prepare("INSERT INTO " . $this->table_name . " (nombre_tipo_usuario) VALUES (?)");

			$query->execute(array(
				$Tipos_Usuarios_Model->get_nombre_tipo_usuario()
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
		public function update($Tipos_Usuarios_Model){
			$val = false;

			$conexion = new Conexion();
			$cn = $conexion->connect();

			$query = $cn->prepare("UPDATE " . $this->table_name . " SET
				nombre_tipo_usuario = ?
				WHERE id_tipo_usuario = ?");

			$query->execute(array(
				$Tipos_Usuarios_Model->get_nombre_tipo_usuario(),
				$Tipos_Usuarios_Model->get_id_tipo_usuario()
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
		public function delete($Tipos_Usuarios_Model){
			$val = false;

			$conexion = new Conexion();
			$cn = $conexion->connect();

			$query = $cn->prepare("DELETE FROM " . $this->table_name . " WHERE id_tipo_usuario = ?");

			$query->execute(array(
				$Tipos_Usuarios_Model->get_id_tipo_usuario()
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
				$tipo_usuario['id_tipo_usuario'] = $data['id_tipo_usuario'];
				$tipo_usuario['nombre_tipo_usuario'] = $data['nombre_tipo_usuario'];

				$array[] = $tipo_usuario;
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

			$query = $cn->prepare("SELECT * FROM " . $this->table_name . " WHERE id_tipo_usuario = ?");

			$query->execute(array(
				$id
			));

			foreach($query as $data){
				$Tipos_Usuarios_Model = new Tipos_Usuarios_Model();

				$Tipos_Usuarios_Model->set_id_tipo_usuario($data['id_tipo_usuario']);
				$Tipos_Usuarios_Model->set_nombre_tipo_usuario($data['nombre_tipo_usuario']);
			}

			$cn = null;

			if(isset($Tipos_Usuarios_Model)){
				return $Tipos_Usuarios_Model;
			}

			return null;
		}
	}
?>