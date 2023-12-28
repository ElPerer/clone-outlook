<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GeneralsQueries\MessagesComposer;
use ServiceQueries\MessagesService;
use App\Models\Messages;
use App\Helpers\HelperNotify;

class MessagesController extends Controller
{
    public $message = 'El correo';
    public function service ($request = null) {
        $message = new Messages();
        $composer = new MessagesComposer($message, 'View1', $this->message, $request);
        $service = new MessagesService($composer);
        return $service;
    }

    public function helper () {
        return new HelperNotify();
    }

    public function create (Request $request) {
        $data = $request->all();
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
