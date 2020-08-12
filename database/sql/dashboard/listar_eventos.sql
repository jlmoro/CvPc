-- SELECT et.id,et.nombre_tipo,et.sigla,
-- (
--     SELECT COUNT(e.id)
--     FROM eventos e
--     WHERE e.id_tipo_evento = et.id
-- )AS cantidad_eventos
-- FROM eventos_tipos et
-- ORDER BY cantidad_eventos DESC

SELECT
(
    SELECT COUNT(ei.id)
    FROM eventos_impresoras ei
)AS eventos_impresora,
(
    SELECT COUNT(ep.id)
    FROM eventos_pantalla ep
)AS eventos_pantalla,
(
    SELECT COUNT(pc.id)
    FROM eventos_pc pc
)AS eventos_pc
