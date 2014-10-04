<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require './clases/Leer.php';
        echo "<br>valor leido: " . Leer::get("nombre");
        echo "<br>valor leido: " . Leer::post("nombre");
        //echo "<br>valor leido: " . Leer::request("nombre");
                
        echo "<br>******************<br>";
        if (isset($_GET["nombre"])) {
            echo "valor leido: " . $_GET["nombre"];
        }
        ?>
    </body>
</html>
