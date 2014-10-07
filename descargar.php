<?php

if (isset($_GET["id"])) {


    $id = $_GET["id"];

    if ($id == 1) {
        $tipo = "gif";
        $imagen = "imagen.gif";
    } else if ($id == 2) {
        $tipo = "png";
        $imagen = "imagen.png";
    } else if ($id == 3) {
        $tipo = "jpg";
        $imagen = "pepe.jpg";
    }
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=destino.'.$tipo);
    header('Content-Transfer-Encoding: binary');
    readfile('../../../carpeta/carpeta/' . $imagen);

    /*
      switch ($id) {
      case "gif":
      header('Content-type: image/gif');
      readfile('../../../carpeta/carpeta/imagen.gif');
      break;
      case "png":
      header('Content-type: image/png');
      readfile('../../../carpeta/carpeta/imagen.png');
      break;
      case "jpg":
      case "jpeg":
      header('Content-type: image/jpg');
      readfile('../../../carpeta/carpeta/pepe.jpg');
      break;
      default :
      echo ("<h1>id incorrecto</h1>");
      }
     */
} else {
    echo ("<h1>No</h1>");
}