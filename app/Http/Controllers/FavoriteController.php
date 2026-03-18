<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FavoriteController extends Controller
{

    public function index() {

        $favorites = auth()->user()->favorites()->get()->map(function ($item) {
            $item->is_favorite = $item->favorites->contains(auth()->id());
            $item->in_basket = $item->baskets->contains(auth()->id());
            return $item;
        });

        return Inertia::render('Favorite', [
            'favorites' => $favorites
        ]);
    } 



    public function toggle(Product $product)
    {
        auth()->user()->favorites()->toggle($product -> id);
        return back(); // Inertia обновит данные на фронте без перезагрузки
    }
}
