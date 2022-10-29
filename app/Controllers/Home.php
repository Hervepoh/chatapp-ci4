<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return  view("templates/header") . view("welcome_message").view("templates/footer");
    }
}
