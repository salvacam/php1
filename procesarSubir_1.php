<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require_once './clases/Leer.php';
        require_once './clases/Subir.php';

        $subir = new Subir("archivo");

        $nombre = Leer::post("nombre");
        //echo "$nombre<br/>";
        //echo "nombre: " . $subir->getNombre() . "<br/>";
        if ($nombre !== NULL && $nombre !== "") {
            //echo "asigna nombre<br/>";
            $subir->setNombre($nombre);
            //echo "nombre: " . $subir->getNombre() . "<br/>";
        }

        $destino = Leer::post("destino");
        echo $subir->getDestino() . "<br/>";
        if ($destino !== NULL && $destino !== "") {
            $subir->getDestino($destino);
            echo $subir->getDestino() . "<br/>";
        }
        
        $subir->subir();
        echo($subir->getMensajeError());
        ?>
    </body>
</html>
