<?php
  $page_title = 'Lista de ventas';
  require_once('includes/load.php');
 

?>
<?php
$ventas = find_all_sale();
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-6">
  
  </div>
</div>
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <strong>
           
            <button class="btn btn-primary" id="btn_agregar_productos" onclick="ir_home()"></i>HOME</button>
          </strong>
          <div class="pull-right">
          <button class="btn btn-primary" id="btn_agregar_productos" onclick="traer_modal_venta()"><i class="fa fa-plus"></i>Nueva Venta</button>
          </div>
        </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#ID VENTA</th>
                <th class="text-center" style="width: 50px;">#PRODUCTO_ID</th>
                <th> Nombre del producto </th>
                <th class="text-center" style="width: 15%;"> Cantidad</th> 
                <th class="text-center" style="width: 15%;"> Fecha </th>
                <!--<th class="text-center" style="width: 100px;"> Acciones </th>-->
             </tr>
            </thead>
           <tbody>
             <?php foreach ($ventas as $venta):?>
             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td><?php echo remove_junk($venta['Prodcuto_id']); ?></td>
               <td><?php echo remove_junk($venta['nombre']); ?></td> 
               <td class="text-center"><?php echo $venta['cantidad']; ?></td> 
               <td class="text-center"><?php echo $venta['fecha_creacion']; ?></td> 
             </tr>
             <?php endforeach;?>
           </tbody>
         </table>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="miModal_venta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titulo">NUEVA VENTA</h5>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="recipient-ID" class="col-form-label">ID DEL PRODUCTO:</label>
             <input type="text" class="form-control" id="id_producto_venta" required>
          </div>
          <div class="mb-3">
            <label for="recipient-catindad" class="col-form-label">CANTIDAD:</label>
             <input type="text" class="form-control" id="catindad_venta" required>
          </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal" onclick="cerra_modal_venta()">CERRAR</button>
        <button type="button" class="btn btn-primary" onclick="agg_venta()">GUARDAR</button>
        <!--<input type="submit" value="Enviar">-->
      </div>
    </div>
  </div>
</div>
<?php include_once('layouts/footer.php'); ?>
