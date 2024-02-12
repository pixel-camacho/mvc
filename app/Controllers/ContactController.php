<?php

namespace App\Controllers;

use App\Models\Contact;

class ContactController extends Controller
{

    public function index(){ 

        $model = new Contact();
        $contacts = $model->all();

        return $this->view('contacts.index', compact('contacts'));
    }

    public function create(){
        return $this->view('contacts.create');
    }

    public function store(){
        return "Aquí se procesará el formulario para crear contacto";
    }

    public function show($id){
        return "Aquí se mostrará el contacto con id: $id";
    }

    public function edit($id){
        return "Aqui se mostrará el fomrulario para editar el contacto con id: $id";
    }

    public function update($id){
        return "Aqui se procesará el formulario para editar el contacto con id: $id";
    }

    public function destroy($id){
        return "Aqui se procesará la petcion para eliminar el contacto con id: $id";
    }

}