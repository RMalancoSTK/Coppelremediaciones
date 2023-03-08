<?php

require_once('models/apsModel.php');

class ApsController extends coreController
{
    private $js;
    private $aps;

    public function __construct()
    {
        parent::__construct();
        $this->js = '<script src="' . BASE_URL . 'assets/js/aps.js"></script>';
        $this->aps = new apsModel();
    }

    public function aps()
    {
        Utils::validateSession();
        $_SESSION['script'] = $this->js;
        require_once("views/templates/header.php");
        require_once("views/templates/menu.php");
        require_once("views/aps.php");
        require_once("views/templates/footer.php");
    }

    public function list()
    {
        $aps = $this->aps->listAps();
        $aps = array_map(function ($ap) {
            return (object) array(
                'id' => $ap['id_aps'],
                'nombre' => $ap['nombre'],
                'estatus_aps' => $ap['estatus_aps'],
                'colores_aps' => $ap['colores_aps'],
                'fecha_reg' => $ap['fecha_reg'],
            );
        }, $aps);
        return $aps;
    }

    public function listApsJson()
    {
        $arreglo = array();
        $query = $this->aps->listApsJson();
        foreach ($query as $data) {
            $arreglo[] = $data;
        }
        echo json_encode($arreglo);
        die();
    }

    public function edit()
    {
        $res = $this->aps->editAps($_POST);
        $data["res"] = "Tu registro se ha actualizado correctamente";
        echo json_encode($data);
    }

    public function delete()
    {
        $res = $this->aps->deleteAps($_POST);
        echo json_encode($res);
    }

    public function save()
    {
        $res = $this->aps->saveAps($_POST);
        $data["res"] = "Tu registro se ha agregado correctamente";
        echo json_encode($data);
    }
}
