SELECT e.*,
et.nombre_tipo AS nombre_evento,
i.placa AS placa_impresora,
i.marca AS marca_impresora,
p.marca AS marca_pantalla,
p.placa AS placa_pantalla,
pc.placa AS placa_pc,
pc.marca AS marca_pc,
u.name AS usuario_actualiza,
re.estado_evento AS estado_evento
FROM eventos e
LEFT JOIN eventos_tipos et ON e.id_tipo_evento = et.id
LEFT JOIN impresora i ON e.id_impresora = i.id
LEFT JOIN pantalla p ON e.id_pantalla = p.id
LEFT JOIN pc ON e.id_pc = pc.id
LEFT JOIN users u ON e.updated_by = u.id
LEFT JOIN resolver_evento re ON e.id = re.id_evento
ORDER BY created_at DESC
