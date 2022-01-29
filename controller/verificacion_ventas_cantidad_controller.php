<?php include_once('../includes/load.php'); ?>
<?php
//zona declarativa-->

$ID = $_POST['ID'];
$cantidad = $_POST['cantidad']; 
$fecha_hoy = date("Y-m-d");
$verificar = verificar_cantidad($ID); 
if(empty($verificar)){
    $data_return['success'] = 'NO_ID';
} else {
    $operacion = $verificar[0]["stock"] - $cantidad;
    if($operacion > 0){
        $guardar_ventas = guardar_venta($ID,$cantidad,$fecha_hoy);
        if( $guardar_ventas ){
            $actualizar_stokc = updata_stock($ID,$operacion,$fecha_hoy);
            $data_return = true;
        }else{
            $data_return['success'] = 'ERROR_GUARDAR_VENTAS';
        }
    }else{
        $data_return['success'] = 'NO_CANTIDAD';
    }
}

print_r(json_encode($data_return));

?>




