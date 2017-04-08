<?php
/**
 * Created by PhpStorm.
 * User: Jlaupa
 * Date: 08/04/2017
 * Time: 11:58 AM
 */
require_once 'conexion.php';
class Product{
    var $id;
    var $name;
    var $price;
    const TABLA = 'products';
    
    public function getId() {
        return $this->id;
    }
    public function getName() {
        return $this->name;
    }
    public function setName($name) {
        $this->name = $name;
    }
    public function getPrice() {
        return $this->price;
    }
    public function setPrice($price) {
        $this->price = $price;
    }
    public function getStatus() {
        return $this->status;
    }
    public function setStatus($status) {
        $this->price = $status;
    }
    public function __construct($name, $price, $id=null) {
        $this->name = $name;
        $this->price = $price;
        $this->id = $id;
    }

    public function importar(){
        $hoy    =   date('Y-m-d H:i:s');
        $conexion = new Conexion();
        $consulta = $conexion->prepare(' INSERT INTO ' . self::TABLA . ' (id,name, price,date_created,status) VALUES(:id, :name, :price, :date_created, 1)');
        $consulta->bindParam(':id', $this->id);
        $consulta->bindParam(':name', $this->name);
        $consulta->bindParam(':price', $this->price);
        $consulta->bindParam(':date_created', $hoy);
        $consulta->execute();
        /*echo '<br>';
        var_dump($consulta->errorInfo());*/

        $conexion = null;
    }

}
//ingenio para correr una funcion dentro de la clase
if(isset($_GET['function'])) {
    $product= new Product();
    $product->$_GET['function']();
}

$data = file_get_contents("../pub/products.json");
$products = json_decode($data, true);

foreach ($products as $product) {
   /* echo '<pre>';
    var_dump($product);
    echo '</pre>';*/
    $producto = new Product($product['name'], $product['price'],$product['id']);
    $producto->importar();
    echo '<br>'.$producto->getName() . ' se ha guardado correctamente con el id: ' . $producto->getId();

}

?>