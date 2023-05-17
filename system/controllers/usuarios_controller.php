<?php
	/**
	 * Clase para administrar las funcionalidades de los usuarios
	*/
	class Usuarios_Controller{
		/**
		 * Propiedades
		*/
		private $table_name;

		/**
		 * Inicialziación de los datos
		*/
		function __construct(){
			$this->table_name = 'usuarios';
		}

		/**
		 * Funccion para insertar un dato a la tabla
		 * Devuelve: true || false
		*/
		public function insert($Usuarios_Model){
			$val = false;

			$conexion = new Conexion();
			$cn = $conexion->connect();

			$query = $cn->prepare("INSERT INTO " . $this->table_name . " (nombre_completo, correo, contrasena, habilitado, fecha_registro, id_tipo_usuario) VALUES (?, ?, ?, ?, ?, ?)");

			$query->execute(array(
				$Usuarios_Model->get_nombre_completo(),
				$Usuarios_Model->get_correo(),
				$Usuarios_Model->get_contrasena(),
				$Usuarios_Model->get_habilitado(),
				$Usuarios_Model->get_fecha_registro(),
				$Usuarios_Model->get_id_tipo_usuario(),
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
		public function update($Usuarios_Model){
			$val = false;

			$conexion = new Conexion();
			$cn = $conexion->connect();

			$query = $cn->prepare("UPDATE " . $this->table_name . " SET
				nombre_completo = ?,
				correo = ?,
				contrasena = ?,
				habilitado = ?,
				fecha_registro = ?,
				id_tipo_usuario = ?
				WHERE id_usuario = ?");

			$query->execute(array(
				$Usuarios_Model->get_nombre_completo(),
				$Usuarios_Model->get_correo(),
				$Usuarios_Model->get_contrasena(),
				$Usuarios_Model->get_habilitado(),
				$Usuarios_Model->get_fecha_registro(),
				$Usuarios_Model->get_id_tipo_usuario(),
				$Usuarios_Model->get_id_usuario(),
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
		public function delete($Usuarios_Model){
			$val = false;

			$conexion = new Conexion();
			$cn = $conexion->connect();

			$query = $cn->prepare("DELETE FROM " . $this->table_name . " WHERE id_usuario = ?");

			$query->execute(array(
				$Usuarios_Model->get_id_usuario()
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
				$usuario['id_usuario'] = $data['id_usuario'];
				$usuario['nombre_completo'] = $data['nombre_completo'];
				$usuario['correo'] = $data['correo'];
				$usuario['contrasena'] = $data['contrasena'];
				$usuario['habilitado'] = $data['habilitado'];
				$usuario['fecha_registro'] = $data['fecha_registro'];
				$usuario['id_tipo_usuario'] = $data['id_tipo_usuario'];

				$array[] = $usuario;
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

			$query = $cn->prepare("SELECT * FROM " . $this->table_name . " WHERE id_usuario = ?");

			$query->execute(array(
				$id
			));

			foreach($query as $data){
				$Usuario = new Usuarios_Model();

				$Usuario->set_id_usuario($data['id_usuario']);
				$Usuario->set_nombre_completo($data['nombre_completo']);
				$Usuario->set_correo($data['correo']);
				$Usuario->set_contrasena($data['contrasena']);
				$Usuario->set_habilitado($data['habilitado']);
				$Usuario->set_fecha_registro($data['fecha_registro']);
				$Usuario->set_id_tipo_usuario($data['id_tipo_usuario']);
			}

			$cn = null;

			if(isset($Usuario)){
				return $Usuario;
			}

			return null;
		}

		/**
		 * Funcion para verificar el inicio de sesion del usuario
		 * Devuelve un número entero que sería el id del tipo de usuario, devuelve 0 si no coincidieron los datos, devuelve -1 si el usuario no está habilitado
		*/
		public function login($Usuarios_Model){
			$id_tipo_usuario = 0;

			$conexion = new Conexion();
			$cn = $conexion->connect();

			$query = $cn->prepare("SELECT * FROM " . $this->table_name . " WHERE correo = ?");

			$query->execute(array(
				$Usuarios_Model->get_correo()
			));

			foreach($query as $data){
				if(md5($Usuarios_Model->get_contrasena()) == $data['contrasena']){
					$Usuario = new Usuarios_Model();

					$Usuario->set_id_usuario($data['id_usuario']);
					$Usuario->set_nombre_completo($data['nombre_completo']);
					$Usuario->set_correo($data['correo']);
					$Usuario->set_contrasena($data['contrasena']);
					$Usuario->set_habilitado($data['habilitado']);
					$Usuario->set_fecha_registro($data['fecha_registro']);
					$Usuario->set_id_tipo_usuario($data['id_tipo_usuario']);
				}
			}

			if(isset($Usuario)){
				return $Usuario;
			}

			return null;
		}

		/**
		 * 
		*/
		public function select_all_join(){
			$conexion = new Conexion();
			$cn = $conexion->connect();

			$query = $cn->prepare("SELECT * FROM " . $this->table_name . " AS U 
				INNER JOIN tipos_usuarios AS TU
				ON TU.id_tipo_usuario = U.id_tipo_usuario");

			$query->execute();

			foreach($query as $data){
				$usuario['id_usuario'] = $data['id_usuario'];
				$usuario['nombre_completo'] = $data['nombre_completo'];
				$usuario['correo'] = $data['correo'];
				$usuario['contrasena'] = $data['contrasena'];
				$usuario['habilitado'] = $data['habilitado'];
				$usuario['fecha_registro'] = $data['fecha_registro'];
				$usuario['id_tipo_usuario'] = $data['id_tipo_usuario'];
				$usuario['nombre_tipo_usuario'] = $data['nombre_tipo_usuario'];

				$array[] = $usuario;
			}

			$cn = null;

			if(isset($array)){
				return $array;
			}

			return null;
		}

		/**
		 * Funcion para recuperar un valor a través de su correo
		 * Devuelve: Modelo con sus datos en caso de que haya encontrado una coincidencia, null en caso de que no haya encontrado ninguna coincidencia
		*/
		public function select_by_correo($correo){
			$conexion = new Conexion();
			$cn = $conexion->connect();

			$query = $cn->prepare("SELECT * FROM " . $this->table_name . " WHERE correo = ?");

			$query->execute(array(
				$correo
			));

			foreach($query as $data){
				$Usuario = new Usuarios_Model();

				$Usuario->set_id_usuario($data['id_usuario']);
				$Usuario->set_nombre_completo($data['nombre_completo']);
				$Usuario->set_correo($data['correo']);
				$Usuario->set_contrasena($data['contrasena']);
				$Usuario->set_habilitado($data['habilitado']);
				$Usuario->set_fecha_registro($data['fecha_registro']);
				$Usuario->set_id_tipo_usuario($data['id_tipo_usuario']);
			}

			$cn = null;

			if(isset($Usuario)){
				return $Usuario;
			}

			return null;
		}
	}
?>