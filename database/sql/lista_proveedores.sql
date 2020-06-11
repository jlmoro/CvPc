SELECT *,
(
    SELECT COUNT(p.id)
    FROM pantalla p
    WHERE p.id_proveedor = pr.id
)AS cantidad_prov_pantalla,
(
    SELECT COUNT(im.id)
    FROM impresora im
    WHERE im.id_proveedor = pr.id
)AS cantidad_prov_impresora,
(
    SELECT COUNT(pc.id)
    FROM pc
    WHERE pc.id_proveedor = pr.id
)AS cantidad_prov_pc,
(
    SELECT SUM(cantidad_prov_pantalla + cantidad_prov_impresora + cantidad_prov_pc)
)AS suma_prov
FROM proveedores pr
