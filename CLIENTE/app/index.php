<?php
    $cliente = new SoapClient(
        null, array(
            'location' => 'https://swcrud.000webhostapp.com/servicio.php',
            'uri' => 'https://swcrud.000webhostapp.com/servicio.php',
            'trace' => 1
        )
    );

    try
    {
        $respuesta = $cliente -> __soapCall("ObtenerSitio", []);

        $resultado = json_encode($respuesta, true);
        $datos = json_decode($resultado, true);
    }
    catch (SoapFault $e)
    {
        echo $e -> getMessage();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>CRUD</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/tabla.css">
    <script src="../js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color:aliceblue;">
        Sitios Turísticos
    </nav>

    <div class="container">
        <?php
            if(isset($_GET['msg']))
            {
                $msg = $_GET['msg'];
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                '.$msg.'
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
            }
        ?>
        <a href="nuevo.php" class="btn btn-dark mb-3"><i class="fa-regular fa-plus"></i> Nuevo</a>

        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Estado</th>
                    <th scope="col">País</th>
                    <th scope="col">Tipo</th>
                    <th class="limited-width" scope="col">Descripción</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($datos as $item) { ?>
                <tr>
                    <th scope="row"><?php echo $item['ID']; ?></th>
                    <td><?php echo $item['Nombre']; ?></td>
                    <td><?php echo $item['Estado']; ?></td>
                    <td><?php echo $item['Pais']; ?></td>
                    <td><?php echo $item['Tipo']; ?></td>
                    <td class="limited-width"><?php echo $item['Descripcion']; ?></td>
                    <td>
                        <a href="editar.php?id=<?php echo $item['ID']; ?>" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                        <a href="eliminar.php?id=<?php echo $item['ID']; ?>" class="link-dark"><i class="fa-solid fa-trash fs-5"></i></a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>