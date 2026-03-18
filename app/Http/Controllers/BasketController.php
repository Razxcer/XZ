<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BasketController extends Controller
{
    public function index() {

        $basket = auth()->user()->baskets()->get()->map(function ($item) {
            $item->is_favorite = $item->favorites->contains(auth()->id());
            $item->in_basket = $item->baskets->contains(auth()->id());
            return $item;
        });

        return Inertia::render('Basket', [
            'basket' => $basket
        ]);
    }

    public function toggle(Product $product)
    {
        auth()->user()->baskets()->toggle($product -> id);
        return back(); // Inertia обновит данные на фронте без перезагрузки
    }
}
