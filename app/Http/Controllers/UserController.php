<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use GuzzleHttp\Client;

class UserController extends Controller
{

    public function getUsers(){
        // dd('Obtener');
        $req = Request();
        // print_r($req);
        $cliente = new Client();
        $respuesta = $cliente->request('GET', 'https://gorest.co.in/public/v2/users');
        $contenido = $respuesta->getBody()->getContents();
        // print_r(gettype(($contenido)));
        $datosJson = json_decode($contenido);
        // print_r(gettype($datosJson));
        $datos = collect($datosJson)->map(function ($item) {
            return [
                'id'        => $item->id,
                'nombre'    => $item->name,
                'email'     => $item->email,
                'genero'    => $item->gender,
                'activo'    => $item->status === 'active' ? true : false
            ];
        });
        // dd(gettype($datos));
        return $datos;
    }

    public function addUser(){
        dd('Agregar');
    }

    public function updateUser(){
        dd('Actualizar');
    }

}
