SELECT *,
(
    SELECT etd.nombre
    FROM eventos_tipos_descripcion etd
    WHERE etd.id = ei.id_detalle_evento
)AS tipo_evento,
(
    SELECT i.marca
    FROM impresora i
    WHERE i.id = ei.id_impresora
)AS impresora_marca,
(
    SELECT i.placa
    FROM impresora i
    WHERE i.id = ei.id_impresora
)AS impresora_placa,
(
    SELECT i.modelo
    FROM impresora i
    WHERE i.id = ei.id_impresora
)AS impresora_modelo,
(
    SELECT rei.estado_evento
    FROM resolver_evento_impresora rei
    WHERE rei.id_evento = ei.id

)AS evento_estado,
(
    SELECT rei.fecha_resolver
    FROM resolver_evento_impresora rei
    WHERE rei.id_evento = ei.id

)AS evento_fecha_resolver,
(
    SELECT u.name
    FROM users u
    WHERE u.id = ei.updated_by
)AS usuario_nombre_actualiza,
(
    SELECT u.lastname
    FROM users u
    WHERE u.id = ei.updated_by
)AS usuario_apellido_actualiza,
(
     SELECT rei.fecha_resolver
    FROM resolver_evento_impresora rei
    WHERE rei.id_evento = ei.id
)AS evento_fecha_resolver,
(
    SELECT u.name
    FROM resolver_evento_impresora rei
    LEFT JOIN users u ON rei.id_usuario_resolver = u.id
    WHERE rei.id_evento = ei.id
)AS nombre_usuario_asignado,
(
    SELECT u.lastname
    FROM resolver_evento_impresora rei
    LEFT JOIN users u ON rei.id_usuario_resolver = u.id
    WHERE rei.id_evento = ei.id
)AS apellido_usuario_asignado,
(
    SELECT a.nombre
    FROM impresora im
    LEFT JOIN encargados e ON im.id_encargado = e.id
    LEFT JOIN roles r ON e.id_rol = r.id
    LEFT JOIN areas a ON r.id_area = a.id
    WHERE im.id = ei.id_impresora
)AS evento_area
FROM eventos_impresoras ei
