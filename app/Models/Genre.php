<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Genre extends Model
{
    public function games() {
        return $this->belongsToMany(Product::class);
    }

    protected $fillable = ['name', 'content'];
}
