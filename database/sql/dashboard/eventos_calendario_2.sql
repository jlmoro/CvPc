SELECT ep.id, ep.id_detalle_evento, ep.id_pantalla,
(
    SELECT et.sigla
    FROM eventos_tipos_descripcion etd
    LEFT JOIN eventos_tipos et ON etd.id_evento_tipo = et.id
    WHERE etd.id = ep.id_detalle_evento
)AS evento_sigla,
(
    SELECT a.nombre
    FROM pantalla p
    LEFT JOIN encargados enc ON enc.id = p.id_encargado
    LEFT JOIN roles r ON r.id = enc.id_rol
    LEFT JOIN areas a ON a.id = r.id_area
    WHERE ep.id_pantalla = p.id
)AS evento_area,
(
    SELECT CONCAT(evento_sigla ,', ' , evento_area)
)AS title,
(
    SELECT rep.fecha_resolver
    FROM resolver_evento_pantalla rep
    WHERE rep.id_evento = ep.id
    AND rep.estado_evento BETWEEN 2 and 3
)AS start
FROM eventos_pantalla ep
