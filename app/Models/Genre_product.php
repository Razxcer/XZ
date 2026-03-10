<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre_product extends Model
{
    protected $table = 'genre_product'; // Связь с нужной таблицей
    protected $fillable = ['product_id', 'genre_id'];
}
