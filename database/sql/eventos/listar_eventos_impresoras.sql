SELECT *,
(
    SELECT et.nombre_tipo
    FROM eventos_tipos et
    WHERE et.id = ei.id_tipo_evento
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
    SELECT u.name
    FROM users u
    WHERE u.id = ei.updated_by
)AS usuario_nombre_actualiza,
(
    SELECT u.lastname
    FROM users u
    WHERE u.id = ei.updated_by
)AS usuario_apellido_actualiza
FROM eventos_impresoras ei
