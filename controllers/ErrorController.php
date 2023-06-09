<?php

class ErrorController extends CoreController
{
    private $messageerror;

    public function index()
    {
        require_once("views/templates/header.php");
        require_once("views/templates/menu.php");
        require_once("views/error/index.php");
        require_once("views/templates/footer.php");
    }

    public function setError404($messageerror)
    {
        $this->messageerror = $messageerror;
    }

    public function getError404()
    {
        return $this->messageerror;
    }
}
