<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    public function genres() {
        return $this->belongsToMany(Genre::class);
    }
    protected $fillable = ['title', 'price', 'content', 'imageURL'];

}
