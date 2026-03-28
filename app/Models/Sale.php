<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class); // Внешний ключ user_id
    }

    public function product()
    {
        return $this->belongsTo(Product::class); // Внешний ключ product_id
    }
}
