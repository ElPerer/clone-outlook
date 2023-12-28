<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    use HasFactory;

    protected $table = 'messages';

    protected $fillable = [
        'para',
        'asunto',
        'contenido'
    ];

    public static $rules = [
        'para' => ['required', 'email'],
        'asunto' => ['required', 'max:255'],
        'contenido' => ['required', 'max:255'],
    ];
}
