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
        //echo "Destino: $destino <br/>";
        if ($destino !== NULL && $destino !== "") {
            $subir->setDestino($destino);
            //echo $subir->getDestino() . "<br/>";
        }
        
        $carpeta = Leer::post("radioCrear");
        if ($carpeta === "si") {
            $subir->setCrearCarpeta("TRUE");
        }
              

        $politica = Leer::post("radio");
        //echo "radio: " . $radio;
        if ($politica == null) {
            echo "Debes seleccionar una opcion <br/> Reemplazar o renombrar";
            //exit();
        } else {
            //echo "$politica <br/>";
            if ($politica==="renombrar") {
                $subir->setAccion("1");
            } else if ($politica==="reemplazar") {
                $subir->setAccion("2");
            }

            //probar extensiones
            $subir->addExtension("txt");
            /*$subir->addExtension("log");
            $subir->addExtension("bat");
            $subir->addExtension("pdf");*/
            
            //probar tipos
            //  $tipos = $subir->getTipo();
            //echo "Tipos: $tipos";
            
            $subir->addTipo("text/plain");
            $subir->addTipo("text/html");
            $subir->addTipo("application/acad");            
            //echo "Tipos: $tipos";
            
            $subir->subir();
            echo($subir->getMensajeError());
        }
        ?>
    </body>
</html>
