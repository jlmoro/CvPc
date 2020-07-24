SELECT et.id,et.nombre_tipo,et.sigla,
(
    SELECT COUNT(e.id)
    FROM eventos e
    WHERE e.id_tipo_evento = et.id
)AS cantidad_eventos
FROM eventos_tipos et
ORDER BY cantidad_eventos DESC
