<?php include_once('../includes/load.php'); ?>
<?php
//zona declarativa

$ID = $_POST['ID'];
$nombre = $_POST['nombre'];
$referencia = $_POST['referencia'];
$precio = $_POST['precio'];
$peso = $_POST['peso'];
$categoria = $_POST['categoria'];
$stock = $_POST['stock'];
$fecha_hoy = date("Y-m-d");
 
$editar = update_productos($ID,$nombre,$referencia,$precio,$peso,$categoria,$stock,$fecha_hoy);


print_r(json_encode($editar));

?>




