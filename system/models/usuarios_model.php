<?php
	/**
	 * Clase para administrar los usuarios
	*/
	class Usuarios_Model{
		/**
		 * Propiedades
		*/
		private $id_usuario;
		private $nombre_completo;
		private $correo;
		private $contrasena;
		private $habilitado;
		private $fecha_registro;
		private $id_tipo_usuario;

		/**
		 * Inicialización de valores
		*/
		function __construct(){
			$this->id_usuario = 0;
			$this->nombre_completo = '';
			$this->correo = '';
			$this->contrasena = '';
			$this->habilitado = 'No';
			$this->fecha_registro = '';
			$this->id_tipo_usuario = 0;
		}

		/**
		 * Gestión de datos
		*/
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
		 * nombre_completo
		*/
		public function get_nombre_completo(){
			return $this->nombre_completo;
		}

		public function set_nombre_completo($nombre){
			$this->nombre_completo = $nombre;
		}

		/**
		 * correo
		*/
		public function get_correo(){
			return $this->correo;
		}

		public function set_correo($correo){
			$this->correo = $correo;
		}

		/**
		 * contrasena
		*/
		public function get_contrasena(){
			return $this->contrasena;
		}

		public function set_contrasena($contrasena){
			$this->contrasena = $contrasena;
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
		 * fecha_registro
		*/
		public function get_fecha_registro(){
			return $this->fecha_registro;
		}

		public function set_fecha_registro($fecha){
			$this->fecha_registro = $fecha;
		}

		/**
		 * id_tipo_usuario
		*/
		public function get_id_tipo_usuario(){
			return $this->id_tipo_usuario;
		}

		public function set_id_tipo_usuario($tipo){
			$this->id_tipo_usuario = $tipo;
		}
	}
?>