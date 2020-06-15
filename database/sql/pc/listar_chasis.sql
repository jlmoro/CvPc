SELECT *,
(
    SELECT p.nombre_proveedor
    FROM proveedores p
    WHERE p.id = pc.id_proveedor
)AS nombre_proveedor,
(
    SELECT e.nombre_completo
    FROM encargados e
    WHERE e.id = pc.id_encargado
)AS nombre_ecnargado
FROM pc
