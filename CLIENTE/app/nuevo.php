<?php
    $cliente = new SoapClient(
        null, array(
            'location' => 'https://swcrud.000webhostapp.com/servicio.php',
            'uri' => 'https://swcrud.000webhostapp.com/servicio.php',
            'trace' => 1
        )
    );

    if(isset($_POST['submit']))
    {
        $correcto = false;

        $nombre = $_POST['nombre'];
        $estado = $_POST['estado'];
        $pais = $_POST['pais'];
        $tipo = $_POST['tipo'];
        $descripcion = $_POST['descripcion'];

        try
        {
            $respuesta = $cliente -> __soapCall("InsertarSitio", [$nombre, $estado, $pais, $tipo, $descripcion]);

            if($respuesta == 1)
            {
                $correcto = true;
            }
        }
        catch (SoapFault $e)
        {
            echo $e -> getMessage();
        }

        if($correcto == true)
        {
            header("Location: index.php?msg=Nuevo registro guardado.");
        }
        else
        {
            echo "Error, no se ha guardado el registro";
        }
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
    <script src="../js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color:aliceblue;">
        Sitios Turísticos
    </nav>

    <div class="container">
        <div class="text-center mb-4">
            <h3>Agregar nuevo sitio turístico</h3>
            <p class="text-muted">Complete los siguientes campos para añadir un nuevo sitio turístico</p>
        </div>

        <div class="container d-flex justify-content-center">
            <form action="" method="post" style="width:50vw; min-width:300px;" autocomplete="off">
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre del sitio turístico" required>
                </div>

                <div class="col">
                    <label class="form-label">Tipo:</label>
                    <input type="text" class="form-control" id="tipo" name="tipo" placeholder="Ingrese el tipo de sitio." required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Estado (opcional):</label>
                    <input type="text" class="form-control" id="estado" name="estado" placeholder="Ingrese el estado donde se encuentra.">
                </div>    

                <div class="col">
                    <label class="form-label">País:</label>
                    <input type="text" class="form-control" id="pais" name="pais" placeholder="Ingrese el país donde se encuentra." required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Descripción (opcional):</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" placeholder="Agregue una breve descripción del sitio turístico."></textarea>
                </div>
            </div>

            <div>
                <a href="index.php" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary" name="submit"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
            </div>
            </form>
        </div>
    </div>
</body>
</html>