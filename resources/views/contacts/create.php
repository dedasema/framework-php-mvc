<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CREATE</title>
</head>

<body>
    <h1>Crear contacto</h1>
    <form action="/contacts" method="post">
        <div>
            <label>Nombre</label>
            <input type="text" name="name">
        </div>
        <br>
        <div>
            <label>Email</label>
            <input type="email" name="email">
        </div>
        <br>
        <div>
            <label>Teléfono</label>
            <input type="tel" name="phone">
        </div>
        <br>
        <input type="submit" value="Crear">
    </form>
</body>

</html>