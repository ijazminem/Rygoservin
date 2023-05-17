<?php
    class Clientes_Controller{
        private $table_name = '';

        function __construct(){
            $this->table_name = 'clientes';
        }

        public function insert($Clientes_Model){
            $val = false;

            $conexion = new Conexion();
            $cn = $conexion->connect();

            $query = $cn->prepare("INSERT INTO " . $this->table_name . " (dui, id_cliente, nombre_completo, telefono, estado, fecha_registro, id_cartera) VALUES (?, ?, ?, ?, ?, ?, ?)");

			$query->execute(array(
				$Clientes_Model->get_dui(),
                $Clientes_Model->get_id_cliente(),
                $Clientes_Model->get_nombre_completo(),
                $Clientes_Model->get_telefono(),
                $Clientes_Model->get_estado(),
                $Clientes_Model->get_fecha_registro(),
                $Clientes_Model->get_id_cartera()
			));

			if($query->rowCount() > 0){
                $val = true;
            }

			$cn = null;

			return $val;
        }

        public function update($Clientes_Model){
            $val = false;

            $conexion = new Conexion();
            $cn = $conexion->connect();

            $query = $cn->prepare("UPDATE " . $this->table_name . " SET
                id_cliente = ?,
                nombre_completo = ?,
                telefono = ?,
                estado = ?,
                fecha_registro = ?,
                id_cartera = ?
                WHERE dui = ?");

            $query->execute(array(
                $Clientes_Model->get_id_cliente(),
                $Clientes_Model->get_nombre_completo(),
                $Clientes_Model->get_telefono(),
                $Clientes_Model->get_estado(),
                $Clientes_Model->get_fecha_registro(),
                $Clientes_Model->get_id_cartera(),
                $Clientes_Model->get_dui()
            ));

            if($query->rowCount() > 0){
                $val = true;
            }

            $cn = null;

            return $val;
        }
        
        public function delete($Clientes_Model){
            $val = false;

            $conexion = new Conexion();
            $cn = $conexion->connect();

            $query = $cn->prepare("DELETE FROM " . $this->table_name . " WHERE dui = ?");

            $query->execute(array(
                $Clientes_Model->get_dui()
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
                $clientes['dui'] = $data['dui'];
                $clientes['id_cliente'] = $data['id_cliente'];
                $clientes['nombre_completo'] = $data['nombre_completo'];
                $clientes['telefono'] = $data['telefono'];
                $clientes['estado'] = $data['estado'];
                $clientes['fecha_registro'] = $data['fecha_registro'];
                $clientes['id_cartera'] = $data['id_cartera'];

                $array[] = $clientes;
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

            $query = $cn->prepare("SELECT * FROM " . $this->table_name . " WHERE dui = ?");

            $query->execute(array(
                $id
            ));

            foreach($query as $data){
                $Cliente = new Clientes_Model();

                $Cliente->set_dui($data['dui']);
                $Cliente->set_id_cliente($data['id_cliente']);
                $Cliente->set_nombre_completo($data['nombre_completo']);
                $Cliente->set_telefono($data['telefono']);
                $Cliente->set_estado($data['estado']);
                $Cliente->set_fecha_registro($data['fecha_registro']);
                $Cliente->set_id_cartera($data['id_cartera']);
            }

            $cn = null;

            if(isset($Cliente)){
                return $Cliente;
            }

            return null;
        }

        /**
         * 
        */
        public function select_all_id_cartera($id){
            $conexion = new Conexion();
            $cn = $conexion->connect();

            $query = $cn->prepare("SELECT * FROM " . $this->table_name . " WHERE id_cartera = ?");

            $query->execute(array(
                $id
            ));

            foreach($query as $data){
                $clientes['dui'] = $data['dui'];
                $clientes['id_cliente'] = $data['id_cliente'];
                $clientes['nombre_completo'] = $data['nombre_completo'];
                $clientes['telefono'] = $data['telefono'];
                $clientes['estado'] = $data['estado'];
                $clientes['fecha_registro'] = $data['fecha_registro'];
                $clientes['id_cartera'] = $data['id_cartera'];

                $array[] = $clientes;
            }

            $cn = null;

            if(isset($array)){
                return $array;
            }

            return null;
        }
    }
?>