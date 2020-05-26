SELECT i.*,
e.nombre_completo AS nombre_encargado,
p.nombre_proveedor AS proveedor,
a.nombre AS area
FROM impresora i
LEFT JOIN encargados e ON i.id_encargado = e.id
LEFT JOIN roles r ON e.id_rol = r.id
LEFT JOIN areas a ON r.id_area = a.id
LEFT JOIN proveedores p ON i.id_proveedor = p.id
ORDER BY i.created_at DESC
