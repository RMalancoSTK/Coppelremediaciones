<?php

require_once('models/apsModel.php');

class ApsController extends CoreController
{
    private $apsModel;

    public function __construct()
    {
        parent::__construct();
        Utils::setJsScript('<script src="' . BASE_URL . 'assets/js/aps.js"></script>');
        $this->apsModel = new apsModel();
    }

    private function loadView($view)
    {
        if (isset($_SESSION['autenticado'])) {
            require_once("views/templates/header.php");
            require_once("views/templates/menu.php");
            require_once("views/" . $view . ".php");
            require_once("views/templates/footer.php");
        } else {
            Utils::redirect(LOCATION_LOGIN);
        }
    }

    public function index()
    {
        $this->loadView('aps/index');
    }

    public function aps()
    {
        require_once("views/templates/header.php");
        require_once("views/templates/menu.php");
        require_once("views/aps.php");
        require_once("views/templates/footer.php");
    }

    public function listApsJson()
    {
        $arreglo = array();
        $query = $this->apsModel->listApsJson();
        foreach ($query as $data) {
            $arreglo[] = $data;
        }
        echo json_encode($arreglo);
        die();
    }

    public function getApsJson($datos)
    {
        $query = $this->apsModel->getApsJson($datos);
        $data = $query->fetch_object();
        echo json_encode($data);
        die();
    }

    public function guardarApsJson($datos)
    {
        $nombre = isset($datos['nombre']) ? $datos['nombre'] : null;
        $idAps = isset($datos['id_aps']) ? $datos['id_aps'] : null;

        if ($idAps && $nombre) {
            $this->apsModel->editApsJson($datos);
            $status = 'success';
            $message = 'Registro actualizado correctamente';
        } elseif ($nombre) {
            $this->apsModel->saveApsJson($datos);
            $status = 'success';
            $message = 'Registro guardado correctamente';
        } else {
            $status = 'error';
            $message = 'No se pudo guardar el registro';
        }

        echo json_encode(array(
            'status' => $status,
            'message' => $message,
        ));
    }

    public function desactivarApsJson($datos)
    {
        $idAps = isset($datos['id_aps']) ? $datos['id_aps'] : null;

        if ($idAps) {
            $this->apsModel->estatusApsJson($datos);
            $status = 'success';
            $message = 'Registro desactivado correctamente' . $datos['estatus'];
        } else {
            $status = 'error';
            $message = 'No se pudo eliminar el registro';
        }

        echo json_encode(array(
            'status' => $status,
            'message' => $message,
        ));
    }

    public function activarApsJson($datos)
    {
        $idAps = isset($datos['id_aps']) ? $datos['id_aps'] : null;

        if ($idAps) {
            $this->apsModel->estatusApsJson($datos);
            $status = 'success';
            $message = 'Registro activado correctamente';
        } else {
            $status = 'error';
            $message = 'No se pudo activar el registro';
        }

        echo json_encode(array(
            'status' => $status,
            'message' => $message,
        ));
    }
}
