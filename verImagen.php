<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>        
        <form action = "verImagen.php" method = "get" enctype = "multipart/form-data">
            <?php
            $text = NULL;
            if (isset($_GET["text"])) {
                $text = $_GET["text"];
            }
            if ($text === NULL || $text == "") {
                echo '  
                        <input type="text" id="text" name="text" value="" />
                        <label for="text">Extension del archivo</label>
                        <br/><input type = "submit" /> ';
            } else {
                if ($text == "png" || $text == "jpg" || $text == "jpeg" ||
                        $text == "gif") {
                    echo '<img src = "leer.php?id=' . $text . '" width = "500"/>';
                } else {
                    echo ("<h1>id incorrecto</h1>");
                }
            }
            ?>  
            <br/>
            <input type="reset" name="reset" value="Reiniciar"><br />
        </form>
    </body>
</html>
