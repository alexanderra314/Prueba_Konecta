<?php
  $page_title = 'Home Page';
  require_once('includes/load.php');
  if (!$session->isUserLoggedIn(true)) { redirect('index.php', false);}
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
  </div>
 <div class="col-md-12">
    <div class="panel">
      <div class="jumbotron text-center">
         <h1>KONECTA CAFETERIA</h1>
      </div>
    </div>
 </div>
 <div class="col-md-12">
    <div class="panel">
    <div class="text-center">
            <button class="btn btn-primary" id="producots" onclick="ir_productos()"><i class="fab fa-product-hunt"></i>PRODUCTOS</button>
         </div>
    </div>
 </div>
 
 <div class="col-md-12">
    <div class="panel">
    <div class="text-center">
            <button class="btn btn-primary" id="ventas" onclick="ir_ventas()"><i class="fas fa-shopping-cart"></i>VENTAS</button>
         </div>
    </div>
 </div>
 <div class="col-md-12">
    <div class="panel">
    <div class="text-center">
            <button class="btn btn-primary" id="producots" onclick="ir_logout()"><i class="fab fa-product-hunt"></i>SALIR</button>
         </div>
    </div>
 </div>
</div>
<?php include_once('layouts/footer.php'); ?>

