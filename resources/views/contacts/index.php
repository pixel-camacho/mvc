<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Listado de contáctos</h1>

    <a href="/contacts/create">Crear contacto</a>

    <ul>
        <?php foreach($contacts as $contact): ?>
            <li>
                <a href="/contacts/<?= $contact['Id'] ?>">
                    <?= $contact['name'] ?>
                </a>
            </li>
        <?php endforeach ?>
    </ul>

</body>
</html>