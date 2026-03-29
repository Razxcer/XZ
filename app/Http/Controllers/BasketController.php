<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
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
            'basket' => $basket,
            'user'=> auth()->user()
        ]);
    }

    public function toggle(Product $product)
    {
        auth()->user()->baskets()->toggle($product -> id);
        return back(); // Inertia обновит данные на фронте без перезагрузки
    }

    public function updateDiscount(Request $request, User $user) {

        $validated = $request->validate([
            'discount' => 'required|integer|min:0|max:100',
        ]);

        $user->update($validated);

        return back();
    }

    public function clear() {
        Basket::where('user_id', auth()->id())->delete();
    }

    public function buyAll(Request $request) {

        $user = auth()->user();

        $user->sales()->syncWithoutDetaching($request->products);

        return back();

    }



}
