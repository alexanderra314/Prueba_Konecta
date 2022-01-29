<?php
  $page_title = 'Lista de productos';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  // page_require_level(2);
  $products = join_product_table();
 
?>
<?php include_once('layouts/header.php'); ?>
  <div class="row">
     <div class="col-md-12">
 
     </div>
    <div class="col-md-12">
      <div class="panel panel-default">
      <div class="pull-center">
           <h1 style="text-align: center;">PRODUCTOS</h1>
        </div>
        <div class="panel-heading clearfix">
        <div class="pull-left">
            <button class="btn btn-primary" id="btn_agregar_productos" onclick="ir_home()"></i>Home</button>
         </div>
         <div class="pull-right">
            <button class="btn btn-primary" id="btn_agregar_productos" onclick="traer_modal()"><i class="fa fa-plus"></i>Crear Productos</button>
         </div>
        </div>
        <div class="panel-body">
          <table class="table table-bordered" id="table_productos">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">ID</th>
                <th> NOMBRE DEL PRODUCTO</th>
                <th> REFERENCIA</th>
                <th class="text-center" style="width: 10%;"> PRECIO </th>
                <th class="text-center" style="width: 10%;"> PESO </th>
                <th class="text-center" style="width: 10%;"> CATEGORIA</th>
                <th class="text-center" style="width: 10%;"> STOCK</th>
                <th class="text-center" style="width: 10%;"> FECHA </th>
                <th class="text-center" style="width: 100px;"> EDITAR </th>
                <th class="text-center" style="width: 100px;"> ELIMINAR </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($products as $product):?> 
              <tr> 
                <td class="text-center"> <?php echo remove_junk($product['ID']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['Nombre_Producto']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['Referencia']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['Precio']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['Peso']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['Categoria']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['Stock']); ?></td>
                <td class="text-center"> <?php echo read_date($product['fecha_creacion']); ?></td>
                <td class="text-center"> <button class="btn btn-primary" id="btn_agregar_productos" onclick="editar(<?php echo $product['ID'] ?>)"><i class="fas fa-edit"></i></button></td>
                <td class="text-center"> <button class="btn btn-primary" id="btn_agregar_productos" onclick="eliminar(<?php echo $product['ID'] ?>)"><i class="far fa-trash-alt"></i></button></td>
   
              </tr>
             <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Large modal -->
<!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Large modal</button>-->

<div class="modal fade" id="miModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titulo">CREAR PRODUCTOS</h5>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="recipient-ID" class="col-form-label">ID DEL PRODUCTO:</label>
             <input type="text" class="form-control" id="ID" required>
          </div>
          <div class="mb-3">
            <label for="recipient-nombre" class="col-form-label">NOMBRE DEL PRODUCTO:</label>
             <input type="text" class="form-control" id="nombre" required>
          </div>
          <div class="mb-3">
            <label for="recipient-referencia" class="col-form-label">REFERENCIA:</label>
             <input type="text" class="form-control" id="referencia" required>
          </div>
          <div class="mb-3">
            <label for="recipient-precio" class="col-form-label">PRECIO:</label>
             <input type="number" class="form-control" id="precio" required>
          </div>
          <div class="mb-3">
            <label for="recipient-peso" class="col-form-label">PESO:</label>
             <input type="number" class="form-control" id="peso" required>
          </div>
          <div class="mb-3">
            <label for="recipient-categoria" class="col-form-label">CATEGORIA:</label>
             <input type="text" class="form-control" id="categoria" required>
          </div>
          <div class="mb-3">
            <label for="recipient-stock" class="col-form-label">STOCK:</label>
             <input type="number" class="form-control" id="stock" required>
          </div> 
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal" onclick="cerra_modal()">CERRAR</button>
        <button type="button" class="btn btn-primary" onclick="agg_productos()">AGREGAR</button>
        <!--<input type="submit" value="Enviar">-->
      </div>
    </div>
  </div>
</div>


<!--modal editar-->
<div class="modal fade" id="editar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titulo">EDITAR PRODUCTOS</h5>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="recipient-ID" class="col-form-label">ID DEL PRODUCTO:</label>
             <input type="text" class="form-control" id="ID_editar" required>
          </div>
          <div class="mb-3">
            <label for="recipient-nombre" class="col-form-label">NOMBRE DEL PRODUCTO:</label>
             <input type="text" class="form-control" id="nombre_edita" required>
          </div>
          <div class="mb-3">
            <label for="recipient-referencia" class="col-form-label">REFERENCIA:</label>
             <input type="text" class="form-control" id="referencia_edita" required>
          </div>
          <div class="mb-3">
            <label for="recipient-precio" class="col-form-label">PRECIO:</label>
             <input type="number" class="form-control" id="precio_edita" required>
          </div>
          <div class="mb-3">
            <label for="recipient-peso" class="col-form-label">PESO:</label>
             <input type="number" class="form-control" id="peso_edita" required>
          </div>
          <div class="mb-3">
            <label for="recipient-categoria" class="col-form-label">CATEGORIA:</label>
             <input type="text" class="form-control" id="categoria_edita" required>
          </div>
          <div class="mb-3">
            <label for="recipient-stock" class="col-form-label">STOCK:</label>
             <input type="number" class="form-control" id="stock_edita" required>
          </div> 
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal" onclick="cerra_modal_editar()">CANCELAR</button>
        <button type="button" class="btn btn-primary" onclick="editar_producto()" id="bton_editar_productos">EDITAR</button>

      </div>
    </div>
  </div>
</div>
  <?php include_once('layouts/footer.php'); ?>
