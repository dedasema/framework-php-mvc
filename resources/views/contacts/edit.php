<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDIT</title>
</head>

<body>
    <h1>Actualizar contacto</h1>
    <form action="/contacts/<?= $contact['id'] ?>" method="post">
        <div>
            <label>Nombre</label>
            <input type="text" name="name" value="<?= $contact['name'] ?>">
        </div>
        <br>
        <div>
            <label>Email</label>
            <input type="email" name="email" value="<?= $contact['email'] ?>">
        </div>
        <br>
        <div>
            <label>Teléfono</label>
            <input type="tel" name="phone" value="<?= $contact['phone'] ?>">
        </div>
        <br>
        <input type="submit" value="Editar">
    </form>
</body>

</html>