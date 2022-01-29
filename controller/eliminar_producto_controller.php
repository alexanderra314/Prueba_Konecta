<?php include_once('../includes/load.php'); ?>
<?php
//zona declarativa

$ID = $_POST['ID'];

 
$eliminar = eliminar_producto($ID);


print_r(json_encode($eliminar));

?>




