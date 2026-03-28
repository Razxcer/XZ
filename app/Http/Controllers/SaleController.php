<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Sale;

class SaleController extends Controller
{
    public function index() {

        $sales = auth()->user()->sales()->get();
        $admin=null;

        if(auth()->user()->name == "SuperMegaAdmin"){
            $sales = Sale::with(['user', 'product'])->get();
            $admin = true;
        }

        

        return Inertia::render('Profile', [
            'sales' => $sales,
            'admin' => $admin
        ]);
    }

    public function detach(Product $product) {
        auth()->user()->sales()->syncWithoutDetaching([$product->id]);
        return back();
    }
}
