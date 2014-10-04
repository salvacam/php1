<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form action = "procesarSubir_1.php" method = "post" enctype = "multipart/form-data">
            <input type="text" id="text" name="nombre" value="" />
            <label for="text">Nombre del archivo</label>
            <br />
            <br /><input type="text" id="text" name="destino" value="" />
            <label for="text">Destino del archivo</label>
            <br />
            <br />
            <input type = "file" name = "archivo" />  
            <br />
            <br />
            <input type="radio" id="radio1" name="radio" value="reemplazar">
            <label for="radio1">Reemplazar</label>
            <input type="radio" id="radio2" name="radio" value="renombrar">
            <label for="radio2">Renombrar</label>
            <br />
            <br />
            <input type="reset" name="reset" value="Reiniciar"><br />
            <input type = "submit" />            
        </form>
    </body>
</html>
