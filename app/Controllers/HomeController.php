<?php

namespace App\Controllers;

use App\Models\Contact;

class HomeController extends Controller
{
    public function index()
    {
        $contactModel = new Contact();
        return $contactModel->find(2);
        
         return $this->view('home',[
            'title' => 'Home',
            'content' => 'Hola desde la pagina de Home'
         ]);
    }
}