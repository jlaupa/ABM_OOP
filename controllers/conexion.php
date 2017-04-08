<?php
/**
 * Created by PhpStorm.
 * User: Jlaupa
 * Date: 08/04/2017
 * Time: 11:59 AM
 */
class Conexion extends PDO {
    private $tipo_de_base = 'mysql';
    private $host = 'jairolaupa.com';
    private $nombre_de_base = 'db_jlaupa';
    private $usuario = 'jlaupa';
    private $contrasena = 'queti';
    public function __construct() {
        //Sobreescribo el método constructor de la clase PDO.
        try{
            @parent::__construct($this->tipo_de_base.':host='.$this->host.';dbname='.$this->nombre_de_base, $this->usuario, $this->contrasena);
        }catch(PDOException $e){
            echo json_encode('Ha surgido un error y no se puede conectar a la base de datos. Detalle: ' . $e->getMessage());
            exit;
        }
    }
}