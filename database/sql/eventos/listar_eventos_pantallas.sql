SELECT *,
(
  SELECT et.nombre_tipo
  FROM eventos_tipos et
  WHERE et.id = ep.id_tipo_evento
)AS tipo_evento,
(
  SELECT i.marca
  FROM pantalla i
  WHERE i.id = ep.id_pantalla
)AS pantalla_marca,
(
  SELECT i.placa
  FROM pantalla i
  WHERE i.id = ep.id_pantalla
)AS pantalla_placa,
(
  SELECT i.modelo
  FROM pantalla i
  WHERE i.id = ep.id_pantalla
)AS pantalla_modelo,
(
  SELECT u.name
  FROM users u
  WHERE u.id = ep.updated_by
)AS usuario_nombre_actualiza,
(
  SELECT u.lastname
  FROM users u
  WHERE u.id = ep.updated_by
)AS usuario_apellido_actualiza,
(
    SELECT rep.estado_evento
    FROM resolver_evento_pantalla rep
    WHERE rep.id_evento = ep.id
)AS evento_estado,
(
    SELECT rep.fecha_resolver
    FROM resolver_evento_pantalla rep
    WHERE rep.id_evento = ep.id
)AS evento_fecha_resolver,
(
    SELECT a.nombre
    FROM pantalla p
    LEFT JOIN encargados ec ON p.id_encargado = ec.id
    LEFT JOIN roles r ON ec.id_rol = r.id
    LEFT JOIN areas a ON r.id_area = a.id
    WHERE p.id = ep.id_pantalla
)AS evento_area,
(
    SELECT u.name
    FROM resolver_evento_pantalla rep
    LEFT JOIN users u ON u.id = rep.id_usuario_resolver
    WHERE rep.id_evento = ep.id
)AS persona_nombre_asignado,
(
    SELECT u.lastname
    FROM resolver_evento_pantalla rep
    LEFT JOIN users u ON u.id = rep.id_usuario_resolver
    WHERE rep.id_evento = ep.id
)AS persona_apellido_asignado
FROM eventos_pantalla ep
