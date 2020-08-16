SELECT SUM(mr.capacidad) AS suma_ram
FROM memoria_ram mr
WHERE mr.id IN ( SELECT pr.id_memoria_ram FROM pc_ram pr WHERE pr.id_equipo = ? )
