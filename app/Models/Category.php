<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'value'];

    // Defina as regras de validação, se necessário
    public static $rules = [
        'name' => 'required',
        'value' => 'required|numeric',
    ];
}
