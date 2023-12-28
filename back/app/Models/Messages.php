<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    use HasFactory;

    protected $table = 'messages';

    // AQUÍ SE INDICAN QUE CAMPOS SE TOMARÁN EN CUENTA
    protected $fillable = [
        'para',
        'asunto',
        'contenido'
    ];

    // AQUÍ SE DECLARARON LAS REGLAS PARA USARLAS DESPUÉS EN validate EN LARAVEL
    public static $rules = [
        'para' => ['required', 'email'],
        'asunto' => ['required', 'max:255'],
        'contenido' => ['required', 'max:255'],
    ];
}
