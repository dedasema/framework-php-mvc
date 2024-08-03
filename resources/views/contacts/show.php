<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHOW</title>
</head>
<body>
    <p>Detalle de contacto</p>
    <a href="/contacts/<?= $contact['id'] ?>/edit">Editar</a>
    <a href="/contacts">Volver</a>
    <p>Nombre: <?= $contact['name'] ?></p>
    <p>Email: <?= $contact['email'] ?></p>
    <p>Teléfono: <?= $contact['phone'] ?></p>

    <form action="/contacts/<?= $contact['id'] ?>/delete" method="post">
        <input type="submit" value="Eliminar">
    </form>
</body>
</html>