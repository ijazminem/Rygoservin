<?php
	/**
	 * Clase para administrar las gestiones
	*/
	class Gestiones_Model{
		/**
		 * Propiedades
		*/
		private $id_gestion;
		private $descripcion;
		private $id_sub_estado;
		private $fecha_registro;
		private $id_usuario;
		private $dui;

		/**
		 * Inicialización de valores
		*/
		function __construct(){
			$this->id_gestion = 0;
			$this->descripcion = '';
			$this->id_sub_estado = 0;
			$this->fecha_registro = '';
			$this->id_usuario = 0;
			$this->dui = '';
		}

		/**
		 * Gestión de datos
		*/
		/**
		 * id_gestion
		*/
		public function get_id_gestion(){
			return $this->id_gestion;
		}

		public function set_id_gestion($id_gestion){
			$this->id_gestion = $id_gestion;
		}

		/**
		 * descripcion
		*/
		public function get_descripcion(){
			return $this->descripcion;
		}

		public function set_descripcion($descripcion){
			$this->descripcion = $descripcion;
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
		 * id_sub_estado
		*/
		public function get_id_sub_estado(){
			return $this->id_sub_estado;
		}

		public function set_id_sub_estado($id){
			$this->id_sub_estado = $id;
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