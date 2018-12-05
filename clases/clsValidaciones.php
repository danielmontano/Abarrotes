<?php 

class Validar{

	public static function NoVacio($dato){
		return !empty($dato);
	}
	
	public static function longitudMax($dato, $longitud){
		return strlen($dato) <= $longitud;
	}
}