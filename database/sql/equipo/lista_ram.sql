SELECT
mr.marca as ram_marca,
mr.modelo_tecnologia AS ram_modelo,
mr.serial AS ram_serial,
mr.capacidad AS ram_capacidad,
mr.frecuencia AS ram_frecuencia
FROM pc_ram pr
LEFT JOIN memoria_ram mr ON pr.id_memoria_ram = mr.id
WHERE pr.id_equipo = ?
