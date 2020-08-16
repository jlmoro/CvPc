SELECT
dd.tipo AS disco_tipo,
dd.marca as disco_marca,
dd.modelo AS disco_modelo,
dd.serial AS disco_serial,
dd.rpm AS disco_rpm,
dd.capacidad AS disco_capacidad,
dd.tecnologia AS disco_tecnologia
FROM pc_disco_duro pd
LEFT JOIN disco_duro dd ON pd.id_disco = dd.id
WHERE pd.id_equipo = ?
