SELECT etd.id,
(
    SELECT et.nombre_tipo
    FROM eventos_tipos et
    WHERE et.id = etd.id_evento_tipo
)AS evento_nombre,
(
    SELECT et.sigla
    FROM eventos_tipos et
    WHERE et.id = etd.id_evento_tipo
)AS evento_sigla,
(
    SELECT COUNT(ei.id)
    FROM eventos_impresoras ei
    WHERE ei.id_detalle_evento = etd.id
)AS cant_printer,
(
    SELECT COUNT(ep.id)
    FROM eventos_pantalla ep
    WHERE ep.id_detalle_evento = etd.id
)AS cant_pantalla,
(
    SELECT COUNT(epc.id)
    FROM eventos_pc epc
    WHERE epc.id_tipo_evento = etd.id
)AS cant_pc,
(
    SELECT SUM(cant_printer + cant_pantalla + cant_pc)

)AS cantidad_eventos
FROM eventos_tipos_descripcion etd
-- GROUP BY evento_sigla
