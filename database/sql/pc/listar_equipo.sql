SELECT eq.*,
fp.marca AS fuente_marca,
fp.potencia AS fuente_potencia,
mr.marca AS memoria1_marca,
mr.modelo_tecnologia AS memoria1_modelo,
mr.capacidad AS memoria1_capacidad,
mr2.marca AS memoria2_marca,
mr2.modelo_tecnologia AS memoria2_modelo,
mr2.capacidad AS memoria2_capacidad,
pt1.nombre AS periferico1_nombre,
pt2.nombre AS periferico2_nombre,
pt3.nombre AS periferico3_nombre,
pr.marca AS procesador_marca,
pr.modelo_tecnologia AS procesador_modelo,
pr.frecuencia AS procesador_frecuencia,
pb.marca_placa_base AS placa_marca,
pb.modelo_placa AS placa_modelo,
pc.placa AS chasis_placa,
pc.marca AS chasis_marca,
u.name AS usuario_nombre,
u.lastname AS usuario_apellido,
dd.tipo AS disco_tipo,
dd.marca AS disco_marca,
dd.capacidad AS disco_capacidad
FROM equipo eq
LEFT JOIN fuente_poder fp ON eq.id_fuente_poder = fp.id
LEFT JOIN memoria_ram mr ON eq.id_memoria_ram = mr.id
LEFT JOIN memoria_ram mr2 ON eq.id_memoria_ram_2 = mr2.id
LEFT JOIN perifericos_tipos pt1 ON eq.id_periferico_1 = pt1.id
LEFT JOIN perifericos_tipos pt2 ON eq.id_periferico_2 = pt2.id
LEFT JOIN perifericos_tipos pt3 ON eq.id_periferico_3 = pt3.id
LEFT JOIN procesador pr ON eq.id_procesador = pr.id
LEFT JOIN placa_base pb ON eq.id_placa_base = pb.id
LEFT JOIN pc ON eq.id_chasis = pc.id
LEFT JOIN users u ON eq.updated_by = u.id
LEFT JOIN disco_duro dd ON eq.id_disco = dd.id
