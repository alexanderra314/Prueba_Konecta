
// producto que más stock tiene.

SELECT * FROM `producto` WHERE Stock = (SELECT MAX(Stock) FROM producto);

//  producto más vendido
SELECT v.id_producto, p.nombre_Producto,COUNT(v.id_producto) AS total_vendido
FROM  venta v
INNER JOIN producto p ON p.ID = v.id_producto
GROUP BY v.id_producto