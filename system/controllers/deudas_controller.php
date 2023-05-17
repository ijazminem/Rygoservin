<?php
	/**
	 * Clase para administrar las funcionalidades de las deudas
	*/
	class Deudas_Controller{
		/**
		 * Propiedades
		*/
		private $table_name;

		/**
		 * Inicialziación de los datos
		*/
		function __construct(){
			$this->table_name = 'deudas';
		}

		/**
		 * Funccion para insertar un dato a la tabla
		 * Devuelve: true || false
		*/
		public function insert($Deudas_Model){
			$val = false;

			$conexion = new Conexion();
			$cn = $conexion->connect();

			$query = $cn->prepare("INSERT INTO " . $this->table_name . " (dui, fecha_registro, id_usuario) VALUES (?, ?, ?)");

			$query->execute(array(
				$Deudas_Model->get_dui(),
				$Deudas_Model->get_fecha_registro(),
				$Deudas_Model->get_id_usuario(),
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
		public function update($Deudas_Model){
			$val = false;

			$conexion = new Conexion();
			$cn = $conexion->connect();

			$query = $cn->prepare("UPDATE " . $this->table_name . " SET
				dui = ?,
				fecha_registro = ?,
				id_usuario = ?
				WHERE id_deuda = ?");

			$query->execute(array(				
				$Deudas_Model->get_dui(),
				$Deudas_Model->get_fecha_registro(),
				$Deudas_Model->get_id_usuario(),
				$Deudas_Model->get_id_deuda(),
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
		public function delete($Deudas_Model){
			$val = false;

			$conexion = new Conexion();
			$cn = $conexion->connect();

			$query = $cn->prepare("DELETE FROM " . $this->table_name . " WHERE id_deuda = ?");

			$query->execute(array(
				$Deudas_Model->get_id_deuda()
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
				$deuda['id_deuda'] = $data['id_deuda'];
				$deuda['fecha_registro'] = $data['fecha_registro'];
				$deuda['id_usuario'] = $data['id_usuario'];
				$deuda['dui'] = $data['dui'];

				$array[] = $deuda;
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

            $query = $cn->prepare("SELECT * FROM " . $this->table_name . " WHERE id_deuda = ?");

            $query->execute(array(
                $id
            ));

            foreach($query as $data){
                $Deuda = new Deudas_Model();

                $Deuda->set_id_deuda($data['id_deuda']);
                $Deuda->set_fecha_registro($data['fecha_registro']);
                $Deuda->set_id_usuario($data['id_usuario']);
                $Deuda->set_dui($data['dui']);
            }

            $cn = null;

            if(isset($Deuda)){
                return $Deuda;
            }

            return null;
        }

        /**
         * 
        */
        public function select_all_by_dui($dui){
			$conexion = new Conexion();
			$cn = $conexion->connect();

			$query = $cn->prepare("SELECT * FROM " . $this->table_name . " WHERE dui = ?");

			$query->execute(array(
				$dui
			));

			foreach($query as $data){
				$deuda['id_deuda'] = $data['id_deuda'];
				$deuda['fecha_registro'] = $data['fecha_registro'];
				$deuda['id_usuario'] = $data['id_usuario'];
				$deuda['dui'] = $data['dui'];

				$array[] = $deuda;
			}

			$cn = null;

			if(isset($array)){
				return $array;
			}

			return null;
		}
	}
?>