<?php
 
 
function find_all($table) {
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("SELECT * FROM ".$db->escape($table));
   }
}
 
function find_by_sql($sql)
{
  global $db;
  $result = $db->query($sql);
  $result_set = $db->while_loop($result);
 return $result_set;
}
/*--------------------------------------------------------------*/
/*  Function for Find data from table by id
/*--------------------------------------------------------------*/
function find_by_id($table,$id)
{
  global $db;
  $id = (int)$id;
    if(tableExists($table)){
          $sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE id='{$db->escape($id)}' LIMIT 1");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
     }
}
/*--------------------------------------------------------------*/
/* Function for Delete data from table by id
/*--------------------------------------------------------------*/
 
 
function count_by_id($table){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(id) AS total FROM ".$db->escape($table);
    $result = $db->query($sql);
     return($db->fetch_assoc($result));
  }
}
/*--------------------------------------------------------------*/
/* Determine if database table exists
/*--------------------------------------------------------------*/
function tableExists($table){
  global $db;
  $table_exit = $db->query('SHOW TABLES FROM '.DB_NAME.' LIKE "'.$db->escape($table).'"');
      if($table_exit) {
        if($db->num_rows($table_exit) > 0)
              return true;
         else
              return false;
      }
  }
 /*--------------------------------------------------------------*/
 /* Login with the data provided in $_POST,
 /* coming from the login form.
/*--------------------------------------------------------------*/
  function authenticate($username='', $password='') {
    global $db;
    $username = $db->escape($username);
    $password = $db->escape($password);
    $sql  = sprintf("SELECT id,usuario,password FROM usuario WHERE usuario ='%s' LIMIT 1", $username);
 
    $result = $db->query($sql);
   
    if($db->num_rows($result)){
      $user = $db->fetch_assoc($result);
      $password_request = sha1($password);
      if($password_request === $user['password'] ){
        return $user['id'];
      }
    }
   return false;
  }
 

   function agg_productos($ID,$nombre,$referencia,$precio,$peso,$categoria,$stock,$fecha_hoy){
    global $db;
    $ID = (int)$ID;
    $nombre = $nombre;
    $referencia =  $referencia;
    $precio = (int) $precio;
    $peso = (int) $peso;
    $categoria  = $categoria;
    $stock = (int) $stock;
    $sql = '';
    $sql = 'INSERT INTO producto';
    $sql .=" (ID,Nombre_Producto,Referencia, Precio, Peso, Categoria, Stock, fecha_creacion";
    $sql .=") VALUES (";
    $sql .=" {$ID}, '{$nombre}', '{$referencia}', {$precio}, {$peso}, '{$categoria}', {$stock},  '{$fecha_hoy}'";
    $sql .=")";
    $result = $db->query($sql);
    return $result;
   }


  /*--------------------------------------------------------------*/
  /* Find current log in user by session id
  /*--------------------------------------------------------------*/
  function current_user(){
      static $current_user;
      global $db;
      if(!$current_user){
         if(isset($_SESSION['user_id'])):
             $user_id = intval($_SESSION['user_id']);
             $current_user = find_by_id('users',$user_id);
        endif;
      }
    return $current_user;
  }
 
 
 function updateLastLogIn($user_id)
	{
		global $db;
    $date = make_date();
    $sql = "UPDATE usuario SET fecha_logueo='{$date}' WHERE id ='{$user_id}' LIMIT 1";
    $result = $db->query($sql);
    return ($result && $db->affected_rows() === 1 ? true : false);
	}


 
  function join_product_table(){
     global $db;
     $sql  =" SELECT * FROM producto";
     $result = find_by_sql($sql);
    return $result;

   }
 

   function traer_productos_editar($id){
     global $db;
    // $p_name = remove_junk($db->escape($product_name));
     $sql = "SELECT * FROM producto WHERE ID = $id";
     $result = find_by_sql($sql);
     return $result;
   }

 
  /*--------------------------------------------------------------*/
  /* actulizacion de producto
  /*--------------------------------------------------------------*/
  function update_productos($ID,$nombre,$referencia,$precio,$peso,$categoria,$stock,$fecha_hoy){
    global $db;
    $ID = (int)$ID;
    $nombre = $nombre;
    $referencia =  $referencia;
    $precio = (int) $precio;
    $peso = (int) $peso;
    $categoria  = $categoria;
    $stock = (int) $stock;
    $stock = (int) $stock;
    $sql = "UPDATE producto SET Nombre_Producto='{$nombre}',Referencia='{$referencia}',Precio={$precio},Peso={$peso},Categoria='{$categoria}',Stock={$stock},fecha_modifica='{$fecha_hoy}' WHERE ID={$ID}";
    $result = $db->query($sql);
    return($db->affected_rows() === 1 ? true : false);

  }
  /*--------------------------------------------------------------*/
  /* eliminacion de producto
  /*--------------------------------------------------------------*/
 function eliminar_producto($id){
   global $db;
   $ID = (int)$id;
   $sql   = " DELETE FROM producto WHERE ID = {$ID}";
   $result = $db->query($sql);
   return $result;
 }
 
 /*--------------------------------------------------------------*/
 /* trae todas la ventas
 /*--------------------------------------------------------------*/
 function find_all_sale(){
   global $db;
   $sql  = "SELECT p.ID as Prodcuto_id, p.Nombre_Producto AS nombre, v.id, v.cantidad, v.fecha_creacion";
   $sql .= " FROM venta v"; 
   $sql .= " INNER JOIN producto p ON p.ID = v.id_producto"; 
   $sql .= " ORDER BY v.fecha_creacion DESC";
   return find_by_sql($sql);
 }
 /*--------------------------------------------------------------*/
 /* verificacon de stock
 /*--------------------------------------------------------------*/
function verificar_cantidad($ID){
  global $db;
  $sql  = "SELECT stock FROM producto s WHERE ID = {$ID}";  
  $result = find_by_sql($sql);

  return $result;
}
/*--------------------------------------------------------------*/
/* Function for Generate sales report by two dates
/*--------------------------------------------------------------*/
function guardar_venta($id,$cantidad,$fecha_hoy){
  global $db;
  $ID = (int)$id;
  $cantidad = (int)$cantidad;
  $sql = '';
  $sql = 'INSERT INTO venta';
  $sql .=" (id_producto, cantidad, fecha_creacion";
  $sql .=") VALUES (";
  $sql .=" {$ID}, {$cantidad},  '{$fecha_hoy}'";
  $sql .=")";
  $result = $db->query($sql);
  return $result;

}
/*--------------------------------------------------------------*/
/* Function actualiza el stock
/*--------------------------------------------------------------*/
function  updata_stock($ID,$stock,$fecha_hoy){
  global $db;
  $ID = (int)$ID;
  $stock = $stock;

  $sql = "UPDATE producto SET Stock={$stock},fecha_modifica='{$fecha_hoy}' WHERE ID={$ID}";
  $result = $db->query($sql);
  return($db->affected_rows() === 1 ? true : false);
}


?>
