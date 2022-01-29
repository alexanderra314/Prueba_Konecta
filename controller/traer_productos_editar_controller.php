<?php include_once('../includes/load.php'); ?>
<?php
//zona declarativa

$ID = $_POST['ID'];
 
$editar = traer_productos_editar($ID);


print_r(json_encode($editar));

?>




