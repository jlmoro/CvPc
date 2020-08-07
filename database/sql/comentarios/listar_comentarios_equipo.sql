SELECT ec.id,ec.comentario,ec.created_at,
(
    SELECT u.name
    FROM users u
    WHERE u.id = ec.created_by
)AS usuario_nombre,
(
    SELECT u.lastname
    FROM users u
    WHERE u.id = ec.created_by
)AS usuario_apellido,
(
    SELECT u.foto
    FROM users u
    WHERE u.id = ec.created_by
)AS usuario_foto
FROM equipo_comentarios ec
WHERE ec.id_equipo = 4
