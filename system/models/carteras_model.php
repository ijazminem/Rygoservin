<?php
	/**
	 * Clase para administrar las carteras
	*/
	class Carteras_Model{
		/**
		 * Propiedades
		*/
		private $id_cartera;
		private $nombre_cartera;
		private $descripcion;
		private $correo_contacto;

		/**
		 * Inicialización de valores
		*/
		function __construct(){
			$this->id_cartera = 0;
			$this->nombre_cartera = '';
			$this->descripcion = '';
			$this->correo_contacto = '';
		}

		/**
		 * Gestión de datos
		*/
		/**
		 * id_cartera
		*/
		public function get_id_cartera(){
			return $this->id_cartera;
		}

		public function set_id_cartera($id){
			$this->id_cartera = $id;
		}

		/**
		 * nombre_cartera
		*/
		public function get_nombre_cartera(){
			return $this->nombre_cartera;
		}

		public function set_nombre_cartera($nombre_cartera){
			$this->nombre_cartera = $nombre_cartera;
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
		 * correo_contacto
		*/
		public function get_correo_contacto(){
			return $this->correo_contacto;
		}

		public function set_correo_contacto($correo){
			$this->correo_contacto = $correo;
		}
	}
?>