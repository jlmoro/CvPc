SELECT pa.*,
e.nombre_completo AS nombre_encargado,
p.nombre_proveedor AS proveedor,
a.nombre AS area
FROM pantalla pa
LEFT JOIN encargados e ON pa.id_encargado = e.id
LEFT JOIN roles r ON e.id_rol = r.id
LEFT JOIN areas a ON r.id_area = a.id
LEFT JOIN proveedores p ON pa.id_proveedor = p.id
ORDER BY pa.created_at DESC
