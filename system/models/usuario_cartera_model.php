<?php
	/**
	 * Clase para administrar usuario cartera
	*/
	class Usuario_Cartera_Model{
		/**
		 * Propiedades
		*/
		private $id_usuario_cartera;
		private $id_usuario;
		private $id_cartera;

		/**
		 * Inicialización de valores
		*/
		function __construct(){
			$this->id_usuario_cartera = 0;
			$this->id_usuario = 0;
			$this->id_cartera = 0;
		}

		/**
		 * Gestión de datos
		*/
		/**
		 * id_usuario_cartera
		*/
		public function get_id_usuario_cartera(){
			return $this->id_usuario_cartera;
		}

		public function set_id_usuario_cartera($id){
			$this->id_usuario_cartera = $id;
		}

		/**
		 * id_usuario
		*/
		public function get_id_usuario(){
			return $this->id_usuario;
		}

		public function set_id_usuario($id){
			$this->id_usuario = $id;
		}

		/**
		 * id_cartera
		*/
		public function get_id_cartera(){
			return $this->id_cartera;
		}

		public function set_id_cartera($id){
			$this->id_cartera = $id;
		}
	}
?>