<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <!--<h1>Hola</h1>-->
        <?php
        //$v = Leer::get("nombre");   //estático

        /*
          $leer = new Leer();
          $v = $leer->get("nombre");  //instancia
         */
        ?>

        <form action="lectura.php" method="get">
            <input type="text" name="nombre[]" value="valor" />
            <input type="text" name="nombre[]" value="valor1" />
            <input type="file" name="archivo" />
            <input type="submit" value="enviar" />
        </form>
    </body>
</html>
