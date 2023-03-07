<?php

class Utils
{
    public static function limpiarDatos($datos)
    {
        $datos = trim($datos);
        $datos = stripslashes($datos);
        $datos = htmlspecialchars($datos);
        return $datos;
    }

    public static function validateSession()
    {
        if (!isset($_SESSION['autenticado'])) {
            header("Location:" . BASE_URL . "login/index");
        }
    }

    public static function deleteSession($name)
    {
        if (isset($_SESSION[$name])) {
            unset($_SESSION[$name]);
        }
    }
}
