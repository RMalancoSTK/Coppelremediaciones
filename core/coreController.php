<?php
require_once(__DIR__ . '/../models/menuModel.php');

class CoreController
{
    private $instanciaMenu;
    public $menu;

    public function __construct()
    {
        $this->instanciaMenu = new MenuModel();
        $this->menu = $this->crearMenu($this->instanciaMenu, $_SESSION['rol']);
    }
    private function crearMenu($instancia, $rol)
    {
        $menu = $instancia->getMenu($rol);
        foreach ($menu['id_rol'] as $i => $men) {
            $decode = json_decode($menu['json_submenu'][$i]);
            $id_submenu = explode(",", $decode->id);

            foreach ($id_submenu as $id) {
                $submenu = $instancia->getSubMenu(implode(",", $id_submenu));
                $menu['submenu'][$i] = $submenu;
            }
        }
        return $menu;
    }
}
