<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    public function toggle(Product $product)
    {
        auth()->user()->baskets()->toggle($product -> id);
        return back(); // Inertia обновит данные на фронте без перезагрузки
    }
}
