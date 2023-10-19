<?php
    $cliente = new SoapClient(
        null, array(
            'location' => 'https://swcrud.000webhostapp.com/servicio.php',
            'uri' => 'https://swcrud.000webhostapp.com/servicio.php',
            'trace' => 1
        )
    );

    $correcto = false;

    $id = $_GET['id'];

    try
    {
        $respuesta = $cliente -> __soapCall("EliminarSitio", [$id]);

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
            header("Location: index.php?msg=Registro eliminado.");
        }
    else
    {
        echo "Error, no se ha eliminado el registro";
    }
?>