<?php

/**
 * Class Subir
 *
 * @version 0.1
 * @author izv
 * @license http://...
 * @copyright izv by 2daw
 * Esta clase dispone de métodos que se utilizan para
 * la subida de archivos.
 * 
 */
class Subir {

    private $atributo;
    private $files;

    /* private $origen;
      private $type;
      private $rutaRelativa;
      private $error;
      private $size; */
    private $destino;
    private $nombre;

    const IGNORAR = 0, RENOMBRAR = 1, REEMPLAZAR = 2;
    const ERROR_INPUT = -1;

    private $accion;
    private $maximo;
    private $extension;
    private $tipo;
    private $error;
    private $crearCarpeta;

    public function getErrorMensaje() {
        
    }

    function __construct($param) {
        $this->atributo = $param;
        $this->destino = "./";
        $this->nombre = "";
        $this->accion = Subir::IGNORAR;
        $this->maximo = 2 * 1024 * 1024;
        $this->tipo = array();
        $this->extension = array();
        $this->error = "";
        $this->files = $_FILES[$param];
        $this->crearCarpeta = FALSE;
        /* $this->origen = $_FILES[$nombre]["name"];
          $this->type = $_FILES[$nombre]["type"];
          $this->rutaRelativa = $_FILES[$nombre]["tmp_name"];
          $this->error = $_FILES[$nombre]["error"];
          $this->size = $_FILES[$nombre]["size"]; */
    }

    /**
     * Establece la ruta relativa donde subir el archivo.
     * @access public
     * @param string $param Cadena con el nombre del parámetro
     */
    public function setDestino($param) {
        $caracter = substr($param, -1);
        if ($caracter != "/") {
            $param.="/";
        }
        $this->destino = $param;
    }

    public function getDestino() {
        return $this->destino;
    }

    /**
     * Establece el nombre sin extension con que se guarda el archivo.
     * @access public
     * @param string $param Cadena con el nombre del parámetro
     */
    public function setNombre($param) {
        $this->nombre = $param;
    }

    public function getNombre() {
        return $this->nombre;
    }

    /**
     * Establece la politica de guardado, sobreescribe, reemplaza o
     * ignora si el archivo ya existe.
     * @access public
     * @param string $param Cadena con el nombre del parámetro
     */
    public function setAccion($param) {
        if ($param == self::RENOMBRAR || $param == self::REEMPLAZAR ||
                $param == self::IGNORAR) {
            $this->accion = $param;
        } else {
            $this->accion = self::IGNORAR;
        }
    }

    /**
     * Establece el tamaño máximo del archivo a subir.
     * @access public
     * @param integer $param Entero
     */
    public function setMaximo($maximo) {
        $this->maximo = $maximo;
    }

    /**
     * Añade una extensión que vamos a permitir subir.
     * @access public
     * @param string|array $param Cadena con el nombre del parámetro
     */
    public function addExtension($param) {
        if (is_array($param)) {
            $this->extension = array_merge($this->extension, $param);
        } else {
            $this->extension[] = $param;
        }
    }

    /**
     * Añade el tipo MIME que vamos a permitir subir.
     * @access public
     * @param string|array $param Cadena con el nombre del parámetro
     */
    public function addTipo($param) {
        if (is_array($param)) {
            $this->tipo = array_merge($this->extension, $param);
        } else {
            $this->tipo[] = $param;
        }
    }

    /**
     * Devuelve el codigo del error de subida del archivo
     * @access public
     * @return 
     */
    public function getError() {
        return $_FILES[$this->atributo]["error"];
    }

    /**
     * Devuelve el mensaje de subida del archivo
     * @access public
     * @return 
     */
    public function getMensajeError() {
        return $this->error;
    }

    private function isInput() {
        if (!isset($_FILES[$this->atributo])) {
            $this->error = "NO existe el campo";
            return false;
        }
        return true;
    }

    private function isError() {
        if ($_FILES[$this->atributo]["error"] != UPLOAD_ERR_OK) {
            return true;
        }
        return false;
    }

    private function isTamano() {
        if ($this->files["size"] > $this->maximo) {
            $this->error = "sobre pasa tamaño";
            return false;
        }
        return true;
    }

    private function isExtension($param) {
        if (sizeof($this->extension) > 0 &&
                !in_array($param, $this->extension)) {
            $this->error = "extension no valida";
            return false;
        }
        return true;
    }

    private function isCarpeta() {
        if (!file_exists($this->destino) && !is_dir($this->destino)) {
            //$this->mensaje = "Carpeta no valida";
            $this->error = -4;
            return false;
        }
        return true;
    }

    public function setCrearCarpeta($param) {
        $this->crearCarpeta = $param;
    }

    private function crearCarpeta() {
        return mkdir($this->destino, Configuracion::PERMISOS, true);
    }

    public function subir() {


        if (!$this->isCarpeta()) {
            if ($this->crearCarpeta) {
                $this->error = 0;
                if (!$this->crearCarpeta()) {
                    $this->error = -7;
                    return FALSE;
                }
            } else {
                return FALSE;
            }
        }


        //destino
        if ($this->destino != "") {
            if (substr($this->destino, -1) != "/") {
                $this->destino .= "/";
            }
        }
        //nombre
        $nombreOriginal = $_FILES[$this->atributo]["name"];
        if ($this->nombre == "") {
            $this->nombre = $nombreOriginal;
        } else {
            $n = pathinfo($_FILES[$this->atributo]["name"]);
            $this->nombre .="." . $n["extension"];
        }
        $guardar = $this->destino . $this->nombre;
        $rutaRelativa = $_FILES[$this->atributo]["tmp_name"];
        if (move_uploaded_file($rutaRelativa, $guardar)) {
            $this->error = "Se ha subido correctamente el archivo";
        } else {
            $this->error = "No se ha subido el archivo";
        }
    }

}
