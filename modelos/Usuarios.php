<?php

/**
 * 
 */
include 'Conexion.php';

class Usuarios extends Conexion
{

	function __construct()
	{
		$this->connect_db();
	}

	/**
	 *  Método para limpiar las variables antes de poder registrar en la base de datos, esto se hace para evitar posibles inyecciones SQL en la base de datos.
	 */
	public function sanitize($var){
	  $clean = mysqli_real_escape_string($this->con, $var);
	  return $clean;
	}

	public function read(){
		$sql = "SELECT  usuarios.idusuarios, usuarios.nom_usuario, usuarios.correo, usuarios.created_at, roles.nom_rol FROM usuarios JOIN roles ON usuarios.idroles = roles.idroles";
		$res = mysqli_query($this->con, $sql);
		return $res;
	}

	public function search($id){
		$sql = "SELECT  usuarios.idusuarios, usuarios.nom_usuario, usuarios.correo, usuarios.created_at, roles.nom_rol FROM usuarios JOIN roles ON usuarios.idroles = roles.idroles WHERE usuarios.idusuarios='$id'";
		$res = mysqli_query($this->con, $sql);
		$return = mysqli_fetch_object($res);
		return $return ;
	}

	public function update($nombres,$apellidos,$telefono,$direccion,$correo_electronico, $id){
		$sql = "UPDATE clientes SET nombres='$nombres', apellidos='$apellidos', telefono='$telefono', direccion='$direccion', correo_electronico='$correo_electronico' WHERE id=$id";
		$res = mysqli_query($this->con, $sql);
		$resultado = ($res) ? true : false;
		return $resultado;
	}

	public function delete($id){
		$sql = "DELETE FROM usuarios WHERE idusuarios=$id";
		$res = mysqli_query($this->con, $sql);
		$resultado = ($res) ? true : false;
		return $resultado;
	}

}

?>