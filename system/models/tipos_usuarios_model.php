<?php
	/**
	 * Clase para administrar los tipos de usuarios
	*/
	class Tipos_Usuarios_Model{
		/**
		 * Propiedades
		*/
		private $id_tipo_usuario;
		private $nombre_tipo_usuario;

		/**
		 * Inicialización de valores
		*/
		function __construct(){
			$this->id_tipo_usuario = 0;
			$this->nombre_tipo_usuario = '';
		}

		/**
		 * Gestión de datos
		*/
		/**
		 * id_tipo_usuario
		*/
		public function get_id_tipo_usuario(){
			return $this->id_tipo_usuario;
		}

		public function set_id_tipo_usuario($id){
			$this->id_tipo_usuario = $id;
		}

		/**
		 * nombre_tipo_usuario
		*/
		public function get_nombre_tipo_usuario(){
			return $this->nombre_tipo_usuario;
		}

		public function set_nombre_tipo_usuario($nombre){
			$this->nombre_tipo_usuario = $nombre;
		}
	}
?>