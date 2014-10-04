<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require_once './clases/Leer.php';
        
          //echo "input: " . Leer::post("nombre") . "<br/>";
          //echo "archivo: " . Leer::post("archivo") . "<br/>";
          foreach ($_FILES["archivo"] as $key => $value){
          echo $key ." : ".$value ."<br/>";
          }
         
        /*
          echo $_FILES["archivo"]["error"] . "<br/>";
          if ($_FILES["archivo"]["error"] === UPLOAD_ERR_OK) {
          echo "sin error<br/>";
          $destino = "aqui.txt";
          $origen = $_FILES["archivo"]["tmp_name"];
          $origen = "hola.txt";
          if (is_uploaded_file($origen)) {
          echo "uploaded <br/>";
          } else {
          echo "no uploaded <br/>";
          }
          if (move_uploaded_file($origen, $destino)) {
          echo "ok<br/>";
          } else {
          echo "no<br/>";
          }
          } else {
          echo "con error<br/>";
          } */


        //echo "nombre: ".$_FILES["archivo"]["name"];
        if ($_FILES["archivo"]["name"] === "") {
            echo "Debes seleccionar un archivo";
            exit();
        }

        $destino = Leer::post("nombre");
        if ($destino == null) {
            //echo "Debes poner un nombre al archivo";
            //exit();
            $destino = $_FILES["archivo"]["name"];
        }

        $radio = Leer::post("radio");
        //echo "radio: " . $radio;
        if ($radio == null) {
            echo "Debes seleccionar una opcion";
            exit();
        }

        $origen = $_FILES["archivo"]["tmp_name"];
        $destino = "./subir/" . $destino;
        /* echo "<br />destino: ";
          echo substr($destino, 0, -3);
          echo substr($destino, -3);
          echo "<br />";
         */
        if ($_FILES["archivo"]["error"] !== UPLOAD_ERR_OK) {
            echo "error al subir archivo";
            exit();
        } else {
            if ($radio === "renombrar") {
                $n = pathinfo($destino);
                $ruta = "./subir/";
                $ext = $n["extension"];
                $nombreOg = $n["filename"];
                $cont = 1;
                $destino = $ruta . $nombreOg . "_$cont" . "." . $ext;
                while (file_exists($destino)) {
                    $cont++;
                    $destino = $ruta . $nombreOg . "_$cont" . "." . $ext;
                }
            }

            if (move_uploaded_file($origen, $destino)) {
                echo "Archivo Subido<br/>";
            } else {
                echo "No se ha podido subir el archivo<br/>";
            }
        }
        ?>
    </body>
</html>
