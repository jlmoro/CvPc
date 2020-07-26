SELECT rei.id, rei.id_evento, rei.fecha_resolver AS start,
(
    SELECT et.sigla
    FROM eventos_impresoras ei
    LEFT JOIN eventos_tipos et ON ei.id_tipo_evento = et.id
    WHERE ei.id = rei.id_evento
)AS title
FROM resolver_evento_impresora rei
WHERE rei.estado_evento = 2
