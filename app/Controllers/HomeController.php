<?php

namespace App\Controllers;
use App\Models\Contact;

class HomeController extends Controller
{
    public function index()
    {
        $contactModel = new Contact();
        $contactModel->query("SELECT * FROM contacts")->get();
        
        return $this->view('home',[
            'title' => 'Bienvenido',
            'description' => 'Este es un sistema de prueba'
        ]);
    }
}