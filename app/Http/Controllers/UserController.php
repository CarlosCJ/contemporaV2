<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use GuzzleHttp\Client;

class UserController extends Controller
{

    public function getUsers(){
        dd('Obtener');
    }

    public function addUser(){
        dd('Agregar');
    }

    public function updateUser(){
        dd('Actualizar');
    }

}
