<?php
require_once 'conexion.php';
/**
 * Created by PhpStorm.
 * User: jLaupa
 * Date: 08/04/2017
 * Time: 12:25 PM
 */
class Consultas{

    public function consultar() {
            $conexion = new Conexion();
            $tabla = 'products';
            $and = '';
            $where = ' p.status = 1 ';
                   
            if (isset($_POST['id']) && $_POST['id'] > 0){
                $and = ' AND p.id = '.$_POST['id'];
            }
    
            $consulta = $conexion->prepare(' SELECT p.id , p.name, p.price, p.date_created
                                              FROM ' . $tabla . ' AS p ' . '
                                              WHERE ' . $where . $and .'
                                              ORDER BY id ASC');
            $consulta->execute();
            $result = $consulta->fetchAll(PDO::FETCH_ASSOC);
            $conexion = null;

        echo json_encode($result);
    }

    public function delete(){
            $conexion = new Conexion();
            $id=$_POST['id'];
            $result=array('text'=>'No se encontro id , intente eliminar de nuevo'
            , 'exito'=>false);
            if(is_numeric($id) && $id>0) {
                $consulta = $conexion->prepare('UPDATE products
                                               SET status = -1
                                               WHERE id = :id');
                $consulta->bindParam(':id', $id);
                $execute=$consulta->execute();
                if($execute){
                    $result=  array('text'=>'Se elimino correctamente el id :'.$id
                    , 'exito'=>true);
                }else{
                    $result= array('text'=>'No se pudo eliminar'
                    ,'exito'=>false);
                }
                $conexion = null;    
                // $result=array('exito'=>'Borrado logico exitoso');
            }
        echo json_encode($result);
    }   
    
}

if(isset($_GET['function'])) {
    $product= new Consultas();
    $product->$_GET['function']();
}