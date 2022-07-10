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

    public function addUser(Request $request){
        // dd('Agregar');
        $data_entrada = $request->input();
        $token = '40adc5ce702bf6220a5fcb1f97b4011b0583ed15f667fcd072350aeefe2035cf';
        $cli = new Client();
        $peticion = $cli->request('POST', 'https://gorest.co.in/public/v2/users', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ],
            'form_params' => [
                'name'      => $request->input('nombre'),
                'email'     => $request->input('email'),
                'gender'    => $request->input('genero'),
                'status'    => $request->input('activo') === true ? 'active' : 'inactive',
            ]
        ]);
        // return ['result' => 'Data has been saved.'];
        return json_decode($peticion->getBody()->getContents());
        // return json_decode($request);
    }

    public function updateUser(){
        dd('Actualizar');
    }

}
