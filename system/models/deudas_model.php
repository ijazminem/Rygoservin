<?php
	/**
	 * Clase para administrar las Deudas
	*/
	class Deudas_Model{
		/**
		 * Propiedades
		*/
		private $id_deuda;
		private $fecha_registro;
		private $id_usuario;
		private $dui;

		/**
		 * Inicialización de valores
		*/
		function __construct(){
			$this->id_deuda = 0;
			$this->fecha_registro = '';
			$this->id_usuario = 0;
			$this->dui = '';
		}

		/**
		 * Gestión de datos
		*/
		/**
		 * id_deuda
		*/
		public function get_id_deuda(){
			return $this->id_deuda;
		}

		public function set_id_deuda($id_deuda){
			$this->id_deuda = $id_deuda;
		}

		/**
		 * fecha_registro
		*/
		public function get_fecha_registro(){
			return $this->fecha_registro;
		}

		public function set_fecha_registro($fecha){
			$this->fecha_registro = $fecha;
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
		 * dui
		*/
		public function get_dui(){
			return $this->dui;
		}

		public function set_dui($dui){
			$this->dui = $dui;
		}
	}
?>