<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [];

        echo view("templates/header",$data);
        echo view("dashboard");
        echo view("templates/footer");
    }
}
