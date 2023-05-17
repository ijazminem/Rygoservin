<?php
	/**
	 * Clase para administrar las funcionalidades de las promesas de pago
	*/
	class Promesas_De_Pago_Controller{
		/**
		 * Propiedades
		*/
		private $table_name;

		/**
		 * Inicialziación de los datos
		*/
		function __construct(){
			$this->table_name = 'promesas_de_pago';
		}

		/**
		 * Funccion para insertar un dato a la tabla
		 * Devuelve: true || false
		*/
		public function insert($Promesas_De_Pago_Model){
			$val = false;

			$conexion = new Conexion();
			$cn = $conexion->connect();

			$query = $cn->prepare("INSERT INTO " . $this->table_name . " (saldo_total, descuento, total_pagar, numero_cuotas, valor_cuotas, fecha_pago, fecha_emision, id_usuario, dui) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

			$query->execute(array(
				$Promesas_De_Pago_Model->get_saldo_total(),
				$Promesas_De_Pago_Model->get_descuento(),
				$Promesas_De_Pago_Model->get_total_pagar(),
				$Promesas_De_Pago_Model->get_numero_cuotas(),
				$Promesas_De_Pago_Model->get_valor_cuotas(),
				$Promesas_De_Pago_Model->get_fecha_pago(),
				$Promesas_De_Pago_Model->get_fecha_emision(),
				$Promesas_De_Pago_Model->get_id_usuario(),
				$Promesas_De_Pago_Model->get_dui(),
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
		public function update($Promesas_De_Pago_Model){
			$val = false;

			$conexion = new Conexion();
			$cn = $conexion->connect();

			$query = $cn->prepare("UPDATE " . $this->table_name . " SET
				saldo_total = ?,
				descuento = ?,
				total_pagar = ?,
				numero_cuotas = ?,
				valor_cuotas = ?,
				fecha_pago = ?,
				fecha_emision = ?,
				id_usuario = ?,
				dui = ?
				WHERE id_promesa = ?");

			$query->execute(array(
				$Promesas_De_Pago_Model->get_saldo_total(),
				$Promesas_De_Pago_Model->get_descuento(),
				$Promesas_De_Pago_Model->get_total_pagar(),
				$Promesas_De_Pago_Model->get_numero_cuotas(),
				$Promesas_De_Pago_Model->get_valor_cuotas(),
				$Promesas_De_Pago_Model->get_fecha_pago(),
				$Promesas_De_Pago_Model->get_fecha_emision(),
				$Promesas_De_Pago_Model->get_id_usuario(),
				$Promesas_De_Pago_Model->get_dui(),
				$Promesas_De_Pago_Model->get_id_promesa(),
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
		public function delete($Promesas_De_Pago_Model){
			$val = false;

			$conexion = new Conexion();
			$cn = $conexion->connect();

			$query = $cn->prepare("DELETE FROM " . $this->table_name . " WHERE id_promesa = ?");

			$query->execute(array(
				$Promesas_De_Pago_Model->get_id_promesa()
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
				$promesa['saldo_total'] = $data['saldo_total'];
				$promesa['descuento'] = $data['descuento'];
				$promesa['total_pagar'] = $data['total_pagar'];
				$promesa['numero_cuotas'] = $data['numero_cuotas'];
				$promesa['valor_cuotas'] = $data['valor_cuotas'];
				$promesa['fecha_pago'] = $data['fecha_pago'];
				$promesa['fecha_emision'] = $data['fecha_emision'];
				$promesa['id_usuario'] = $data['id_usuario'];
				$promesa['dui'] = $data['dui'];

				$array[] = $promesa;
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

            $query = $cn->prepare("SELECT * FROM " . $this->table_name . " WHERE id_promesa = ?");

            $query->execute(array(
                $id
            ));

            foreach($query as $data){
                $Promesa = new Promesas_De_Pago_Model();

                $Promesa->set_id_promesa($data['id_promesa']);
                $Promesa->set_saldo_total($data['saldo_total']);
                $Promesa->set_descuento($data['descuento']);
                $Promesa->set_total_pagar($data['total_pagar']);
                $Promesa->set_numero_cuotas($data['numero_cuotas']);
                $Promesa->set_valor_cuotas($data['valor_cuotas']);
				$Promesa->set_fecha_pago($data['fecha_pago']);
                $Promesa->set_fecha_emision($data['fecha_emision']);
                $Promesa->set_id_usuario($data['id_usuario']);
                $Promesa->set_dui($data['dui']);
            }

            $cn = null;

            if(isset($Promesa)){
                return $Promesa;
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
				$promesa['id_promesa'] = $data['id_promesa'];
				$promesa['saldo_total'] = $data['saldo_total'];
				$promesa['descuento'] = $data['descuento'];
				$promesa['total_pagar'] = $data['total_pagar'];
				$promesa['numero_cuotas'] = $data['numero_cuotas'];
				$promesa['valor_cuotas'] = $data['valor_cuotas'];
				$promesa['fecha_pago'] = $data['fecha_pago'];
				$promesa['fecha_emision'] = $data['fecha_emision'];
				$promesa['id_usuario'] = $data['id_usuario'];
				$promesa['dui'] = $data['dui'];

				$array[] = $promesa;
			}

			$cn = null;

			if(isset($array)){
				return $array;
			}

			return null;
		}
	}
?>