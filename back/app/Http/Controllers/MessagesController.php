<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GeneralsQueries\MessagesComposer;
use ServiceQueries\MessagesService;
use App\Models\Messages;

class MessagesController extends Controller
{
    public $message = 'El mensaje';
    public function service () {
        $message = new Messages();
        $composer = new MessagesComposer($message, 'View1', $this->message);
        $service = new MessagesService($composer);
        return $service;
    }

    public function create (Request $request) {
        $data = $request->all();
        $validate = $request->validate([
            'para' => ['required', 'email'],
            'asunto' => ['required', 'max:255'],
            'contenido' => ['required', 'max:255'],
        ]);
        $service = $this->service()->create($data);
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
