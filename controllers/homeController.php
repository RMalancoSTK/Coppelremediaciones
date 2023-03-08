<?php

class HomeController extends CoreController
{

    public function dashboard()
    {
        require_once("views/templates/header.php");
        require_once("views/templates/menu.php");
        require_once("views/home/home.php");
        require_once("views/templates/footer.php");
    }
}
