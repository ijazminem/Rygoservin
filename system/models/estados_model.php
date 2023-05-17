<?php
	/**
	 * Clase para administrar los estados
	*/
	class Estados_Model{
		/**
		 * Propiedades
		*/
		private $id_estado;
		private $descripcion;
		private $habilitado;
		private $id_cartera;

		/**
		 * Inicialización de valores
		*/
		function __construct(){
			$this->id_estado = 0;
			$this->descripcion = '';
			$this->habilitado = 'No';
			$this->id_cartera = 0;
		}

		/**
		 * Gestión de datos
		*/
		/**
		 * id_estado
		*/
		public function get_id_estado(){
			return $this->id_estado;
		}

		public function set_id_estado($id_estado){
			$this->id_estado = $id_estado;
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
		 * habilitado
		*/
		public function get_habilitado(){
			return $this->habilitado;
		}

		public function set_habilitado($habilitado){
			$this->habilitado = $habilitado;
		}

		/**
		 * id_cartera
		*/
		public function get_id_cartera(){
			return $this->id_cartera;
		}

		public function set_id_cartera($id_cartera){
			$this->id_cartera = $id_cartera;
		}
	}
?>