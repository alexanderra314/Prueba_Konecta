$(document).ready(function () {


});


function traer_modal(params) {
    $("#miModal").modal("show");
}
function traer_modal_venta(params) {
    $("#miModal_venta").modal("show");
}
function cerra_modal_venta(params) {
    $("#miModal_venta").modal("hide");
}
 
function cerra_modal_editar(params) {
    $("#editar").modal("hide");
}
function cerra_modal(params) {
    $("#miModal").modal("hide");
}


function agg_productos(params) {
   

    var ID = $("#ID").val();
    var nombre = $("#nombre").val();
    var referencia = $("#referencia").val();
    var precio = $("#precio").val();
    var peso = $("#peso").val();
    var categoria = $("#categoria").val();
    var stock = $("#stock").val();
   
    if(ID === '' || nombre ==='' || referencia ===''|| precio ==='' || peso === '' || categoria === '' || stock ===''){
        swal("Creacion de Productos", "todos los campos son obligatorios", "error")
    }else{

        $.ajax({
            url: '/Konecta/controller/crear_productos_controller.php',
            type: 'post',
            dataType: 'json',
            data: {
                ID: ID,
                nombre: nombre,
                referencia: referencia,
                precio: precio,
                peso: peso,
                categoria: categoria,
                stock: stock
            },
            success: function (data) {
                
                console.log(data);
                if (data) {
                    swal("Creacion de Productos", "Se creo los productos con exito", "success")
                      $("#miModal").modal("hide");
                      location.reload();
                } else {
                    swal("Creacion de Productos", "No se creo los productos con exito", "error")
                    $("#miModal").modal("hide");
                }
            }
        });
    }

}

function editar(id) {

        $ID = id;
 

    $.ajax({
        url: '/Konecta/controller/traer_productos_editar_controller.php',
        type: 'post',
        dataType: 'json',
        data: {
          ID: $ID
        },
        success: function (data) {
            console.log(data);
            if (data) {
            $('#editar').modal('show');
            $('#nombre_edita').val(data[0].Nombre_Producto);
            $('#referencia_edita').val(data[0].Referencia);
            $('#precio_edita').val(data[0].Precio);
            $('#peso_edita').val(data[0].Peso);
            $('#categoria_edita').val(data[0].Categoria);
            $('#stock_edita').val(data[0].Stock);
            $('#ID_editar').val(data[0].ID);
            }
        }
    });
}
function editar_producto(id) {


    var nombre = $('#nombre_edita').val();
    var referencia = $('#referencia_edita').val();
    var precio= $('#precio_edita').val();
    var peso= $('#peso_edita').val();
    var categoria = $('#categoria_edita').val();
    var stock = $('#stock_edita').val();
    var ID =  $('#ID_editar').val();
 

    $.ajax({
        url: '/Konecta/controller/editar_productos_controller.php',
        type: 'post',
        dataType: 'json',
        data: {
            ID: ID,
            nombre: nombre,
            referencia: referencia,
            precio: precio,
            peso: peso,
            categoria: categoria,
            stock: stock
        },
        success: function (data) {
            console.log(data);
            if (data) {
                $("#editar").modal("hide");
                swal("Edicion de Productos", "Se edito los productos con exito", "success")
                location.reload();
            } else {
                swal("Edicion de Productos", "No se edito los productos con exito", "error")
                $("#editar").modal("hide");
            }
        }
    });
}
function eliminar(id) {
    $ID = id;
    $.ajax({
        url: '/Konecta/controller/eliminar_producto_controller.php',
        type: 'post',
        dataType: 'json',
        data: {
            ID: $ID 
        },
        success: function (data) {
            console.log(data);
            if (data) {
            
         
                swal("Eliminacion de Productos", "Se elimino los productos con exito", "success")
                location.reload();
            } else {
             
                swal("Eliminacion de Productos", "No se elimino los productos con exito", "error")
            }
        }
    });
}

function ir_productos(params) {
    window.location.replace("/Konecta/productos.php");
}

function ir_home(params) {
    window.location.replace("/Konecta/home.php");
}
function ir_ventas(params) {
    window.location.replace("/Konecta/ventas.php");
}

function agg_venta() {
    var id = $('#id_producto_venta').val();
    var catindad_venta = $('#catindad_venta').val();
    console.log(id);
    console.log(catindad_venta);

    $.ajax({
        url: '/Konecta/controller/verificacion_ventas_cantidad_controller.php',
        type: 'post',
        dataType: 'json',
        data: {
            ID: id,
           cantidad: catindad_venta 
        },
        success: function (data) {
            console.log(data);
            if (data.success == true) {
                $("#miModal_venta").modal("hide");
                swal("Venta", "se guardo la venta con exito", "success")
                location.reload();
            } else if(data.success == 'NO_ID'){ 
                swal("Venta", "No se encontro el Id del Producto", "error")
                $("#miModal_venta").modal("hide");
                location.reload();
            }else if(data.success == 'NO_CANTIDAD'){
                $("#miModal_venta").modal("hide");
                location.reload();
                swal("Venta", "no hay suficiente Producto en stock", "error")
            }else if(data.success == 'ERROR_GUARDAR_VENTAS'){
                $("#miModal_venta").modal("hide");
                swal("Venta", "error al guardar la venta", "error")
                location.reload();
            }
        }
    });
 
}

function ir_logout(params) {
    window.location.replace("/Konecta/logout.php");
}

