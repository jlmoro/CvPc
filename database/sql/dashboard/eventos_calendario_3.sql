-- SELECT rei.id, rei.id_evento, rei.fecha_resolver AS start,
-- (
--     SELECT et.sigla
--     FROM eventos_impresoras ei
--     LEFT JOIN eventos_tipos et ON ei.id_tipo_evento = et.id
--     WHERE ei.id = rei.id_evento
-- )AS title
-- FROM resolver_evento_impresora rei
-- WHERE rei.estado_evento = 2

SELECT ei.id, ei.id_detalle_evento, ei.id_impresora,
(
    SELECT et.sigla
    FROM eventos_tipos_descripcion etd
    LEFT JOIN eventos_tipos et ON etd.id_evento_tipo = et.id
    WHERE etd.id = ei.id_detalle_evento
)AS evento_sigla,
(
    SELECT a.nombre
    FROM impresora i
    LEFT JOIN encargados enc ON enc.id = i.id_encargado
    LEFT JOIN roles r ON r.id = enc.id_rol
    LEFT JOIN areas a ON a.id = r.id_area
    WHERE ei.id_impresora = i.id
)AS evento_area,
(
    SELECT CONCAT(evento_sigla ,', ' , evento_area)
)AS title,
(
    SELECT rei.fecha_resolver
    FROM resolver_evento_impresora rei
    WHERE rei.id_evento = ei.id
    AND rei.estado_evento = 2
)AS start
FROM eventos_impresoras ei
