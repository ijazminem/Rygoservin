<?php
	/**
	 * Clase para administrar las promesas de pago
	*/
	class Promesas_De_Pago_Model{
		/**
		 * Propiedades
		*/
		private $id_promesa;
		private $saldo_total;
		private $descuento;
		private $total_pagar;
		private $numero_cuotas;
		private $valor_cuotas;
		private $fecha_pago;
		private $fecha_emision;
		private $id_usuario;
		private $dui;

		/**
		 * Inicialización de valores
		*/
		function __construct(){
			$this->id_promesa = 0;
			$this->saldo_total = 0.0;
			$this->descuento = 0;
			$this->total_pagar = 0.0;
			$this->numero_cuotas = 0;
			$this->valor_cuotas = 0.0;
			$this->fecha_pago = '';
			$this->fecha_emision = '';
			$this->id_usuario = 0;
			$this->dui = '';
		}

		/**
		 * Gestión de datos
		*/
		/**
		 * id_promesa
		*/
		public function get_id_promesa(){
			return $this->id_promesa;
		}

		public function set_id_promesa($id){
			$this->id_promesa = $id;
		}

		/**
		 * saldo_total
		*/
		public function get_saldo_total(){
			return $this->saldo_total;
		}

		public function set_saldo_total($total){
			$this->saldo_total = $total;
		}

		/**
		 * descuento
		*/
		public function get_descuento(){
			return $this->descuento;
		}

		public function set_descuento($descuento){
			$this->descuento = $descuento;
		}

		/**
		 * total_pagar
		*/
		public function get_total_pagar(){
			return $this->total_pagar;
		}

		public function set_total_pagar($total){
			$this->total_pagar = $total;
		}

		/**
		 * numero_cuotas
		*/
		public function get_numero_cuotas(){
			return $this->numero_cuotas;
		}

		public function set_numero_cuotas($numero){
			$this->numero_cuotas = $numero;
		}

		/**
		 * valor_cuotas
		*/
		public function get_valor_cuotas(){
			return $this->valor_cuotas;
		}

		public function set_valor_cuotas($valor){
			$this->valor_cuotas = $valor;
		}

		/**
		 * fecha_pago
		*/
		public function get_fecha_pago(){
			return $this->fecha_pago;
		}

		public function set_fecha_pago($fecha){
			$this->fecha_pago = $fecha;
		}

		/**
		 * fecha_emision
		*/
		public function get_fecha_emision(){
			return $this->fecha_emision;
		}

		public function set_fecha_emision($fecha){
			$this->fecha_emision = $fecha;
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