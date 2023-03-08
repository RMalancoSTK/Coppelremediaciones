<?php

require_once('models/PuntosCambioModel.php');

class PuntosCambioController extends CoreController
{
    private $puntosModel;

    public function __construct()
    {
        parent::__construct();
        Utils::setJsScript('<script src="' . BASE_URL . 'assets/js/puntosCambio.js"></script>');
        $this->puntosModel = new PuntosCambioModel();
    }

    public function puntos()
    {
        $this->puntosModel->readLenguajes();
        $this->puntosModel->readPalabras();
        require_once("views/templates/header.php");
        require_once("views/templates/menu.php");
        require_once("views/.php");
        require_once("views/templates/footer.php");
    }

    public function update()
    {
        $this->puntosModel->update($_POST);
        $data['res'] = 'Tu registro se ha actualizado correctamente';
        echo json_encode($data);
    }

    public function crearSelect()
    {
        $res = $this->puntosModel->getLenguajes();
        echo json_encode($res);
    }

    public function delete()
    {
        $this->puntosModel->delete($_POST["id"]);
        echo json_encode("Tu registro ha sido eliminado");
    }

    public function savePalabra()
    {
        $this->puntosModel->savePalabra($_POST);
        echo json_encode("Tu registro ha sido creado");
    }

    public function saveLanguage()
    {
        $this->puntosModel->saveLanguage($_POST);
        echo json_encode("Tu registro ha sido creado");
    }

    public function leerZip()
    {
        $path_completo = $_FILES['envioarchivos']['name'];
        $path_completo = str_replace('.zip', '', $path_completo);

        $ruta = $_FILES['envioarchivos']["tmp_name"];

        // Función descomprimir 
        $zip = new ZipArchive;
        if ($zip->open($ruta) === TRUE) {
            //función para extraer el ZIP
            $extraido = $zip->extractTo('uploads/');
            $zip->close();
            $dir = opendir('uploads/' . $path_completo);
            $getPalabras = $this->puntosModel->getPalabrasExtension('php');

            global $resultados;
            $nombreCarpeta = 'uploads/' . $path_completo;

            $contadorPC = 0;
            $tabla = '';
            if (is_dir($nombreCarpeta)) {
                if ($dh = opendir($nombreCarpeta)) {
                    $tabla .= "<table class='table' border='1'>";
                    $tabla .= "<tr><th>Nombre Archivo</th>";
                    foreach ($getPalabras as $palabra) {
                        $tabla .= "<th>" . $palabra . "<\th>";
                    }
                    $tabla .= "</tr>";
                    while (($archivo = readdir($dh))) {
                        if ($archivo != "." && $archivo != "..") {
                            $rutaArchivo = $nombreCarpeta . "/" . $archivo;
                            $contenido = file_get_contents($rutaArchivo);
                            $result = array_fill_keys($getPalabras, 0);
                            foreach ($getPalabras as $palabra) {
                                $result[$palabra] = substr_count($contenido, $palabra);
                            }
                            $tabla .= "<tr><td>" . $rutaArchivo . "</td>";
                            foreach ($result as $palabra => $count) {
                                $tabla .= "<td>" . $count . "</td>";
                            }
                            $tabla .= "</tr>";
                            $resultados[] = array(
                                'archivo' => $rutaArchivo,
                                'resultados' => $result,
                                'contadorPC' => $contadorPC,
                            );
                        }
                    }
                    $tabla .= "</table>";
                    closedir($dh);
                }
            }
        }
        echo json_encode($tabla);
    }
}
