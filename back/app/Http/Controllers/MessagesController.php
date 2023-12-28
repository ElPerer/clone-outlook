<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GeneralsQueries\MessagesComposer;
use ServiceQueries\MessagesService;
use App\Models\Messages;

class MessagesController extends Controller
{
    public $message = 'El correo';
    // MÉTODO QUE RETORNA LOS DATOS PROCESADOS
    // MessagesComposer y MessagesService SON ARCHIVOS QUE HEREDAN DE Service y ComposerQueries
    public function service ($request = null) {
        $message = new Messages();
        $composer = new MessagesComposer($message, 'View1', $this->message, $request);
        // SE MANDA POR PARÁMETRO EL $composer PARA UTILIZAR LAS QUERIES GENERALES DE ComposerQueries
        $service = new MessagesService($composer);
        return $service;
    }

    public function create (Request $request) {
        $data = $request->all();
        // EL PARÁMETRO $request SE PASA AL MÉTODO service PARA PODER ENVIARSELO A ComposerQueries Y VALIDAR
        $service = $this->service($request)->create($data);
        return response()->json($service);
    }

    public function update ($id, Request $request) {
        $arreglo = $request->all();
        $service = $this->service()->update($id, $arreglo);
        return response()->json($service);
    }

    public function delete ($id) {
        $service = $this->service()->delete($id);
        return response()->json($service);
    }

    public function getAll (Request $request) {
        $arreglo = $request->all();
        $service = $this->service()->pagination_model([], $arreglo);
        return response()->json($service);
    }
}
