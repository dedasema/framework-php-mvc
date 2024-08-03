<?php

namespace App\Controllers;
use App\Models\Contact;

class HomeController extends Controller
{
    public function index()
    {
        $contactModel = new Contact();

        $contactModel->update(3,[
            'name' => 'Celia',
            'email' => 'celia@mail.com',
            'phone' => '4059249'
            ]);

        // $contactModel->create([
        //     'name' => 'Jaimito',
        //     'email' => 'jaimi@mail.com',
        //     'phone' => '34430029']);

        return $this->view('home',[
            'title' => 'Bienvenido',
            'description' => 'Este es un sistema de prueba'
        ]);
    }
}